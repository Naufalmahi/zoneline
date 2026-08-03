<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Tenant;
use App\Models\TenantSetting;
use App\Models\User;
use App\Models\ServiceCategory;
use App\Models\Service;
use App\Models\OrderStatus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials, $request->boolean('remember'))) {
            $request->session()->regenerate();
            $user = Auth::user();
            // Superadmin tidak punya tenant, redirect ke halaman tersendiri
            if ($user->isSuperAdmin()) {
                return redirect()->route('superadmin.dashboard');
            }
            return redirect()->intended(route('owner.dashboard'));
        }

        return back()->withErrors([
            'email' => 'Kredensial yang diberikan tidak cocok dengan data kami.',
        ])->onlyInput('email');
    }

    public function showRegister()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'niche' => ['required', 'in:laundry,coffee,barbershop'],
            'laundry_name' => ['required', 'string', 'max:255'],
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'phone' => ['required', 'string', 'max:20'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user = DB::transaction(function () use ($request) {
            $slug = \Illuminate\Support\Str::slug($request->laundry_name);
            $count = Tenant::where('slug', 'LIKE', "{$slug}%")->count();
            if ($count > 0) $slug = $slug . '-' . ($count + 1);

            // 1. Create Tenant
            $tenant = Tenant::create([
                'name' => $request->laundry_name,
                'slug' => $slug,
                'niche' => $request->niche,
                'status' => 'Trial',
            ]);

            // 2. Create Tenant Settings
            TenantSetting::create([
                'tenant_id' => $tenant->id,
                'business_name' => $request->laundry_name,
                // phone column does not exist in tenant_settings, stored in tenant
            ]);

            // Store phone on tenant
            $tenant->update(['phone' => $request->phone]);

            // 3. Create Default Roles based on Niche
            $roles = [];
            if ($request->niche === 'coffee') {
                $roles = ['owner', 'manager', 'kasir', 'kitchen', 'waiter'];
            } elseif ($request->niche === 'laundry') {
                $roles = ['owner', 'admin', 'kasir', 'kurir', 'operator_laundry'];
            } else {
                $roles = ['owner', 'manager', 'barber', 'kasir', 'receptionist'];
            }
            
            foreach ($roles as $r) {
                \App\Models\Role::firstOrCreate(['name' => $r, 'guard_name' => 'web']);
            }
            $ownerRole = \App\Models\Role::where('name', 'owner')->first();

            // 4. Default Data (If Laundry)
            if ($request->niche === 'laundry') {
                $statuses = [
                    ['name' => 'Diterima', 'slug' => 'received', 'color_hex' => '#F59E0B', 'sequence' => 1, 'is_final' => false],
                    ['name' => 'Dicuci', 'slug' => 'washing', 'color_hex' => '#3B82F6', 'sequence' => 2, 'is_final' => false],
                    ['name' => 'Selesai', 'slug' => 'ready', 'color_hex' => '#22C55E', 'sequence' => 3, 'is_final' => false],
                    ['name' => 'Diambil', 'slug' => 'picked_up', 'color_hex' => '#6B7280', 'sequence' => 4, 'is_final' => true],
                ];
                foreach ($statuses as $status) {
                    $tenant->orderStatuses()->create($status);
                }

                $category = ServiceCategory::create(['tenant_id' => $tenant->id, 'name' => 'Reguler']);
                $service = Service::create([
                    'tenant_id' => $tenant->id, 'category_id' => $category->id, 'name' => 'Cuci Setrika Reguler', 'unit_type' => 'KG'
                ]);
                $service->prices()->create(['price' => 6000, 'effective_date' => now()]);
            }

            // Default Payment Method
            $tenant->paymentMethods()->createMany([
                ['name' => 'Tunai (Cash)', 'code' => 'cash'],
                ['name' => 'QRIS', 'code' => 'qris'],
            ]);

            // 6. Create Owner User
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'tenant_id' => $tenant->id,
                'role_id' => $ownerRole->id,
            ]);

            return $user;
        });

        Auth::login($user);

        return redirect()->route('owner.dashboard');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}
