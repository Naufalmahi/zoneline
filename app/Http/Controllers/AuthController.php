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
            'laundry_name' => ['required', 'string', 'max:255'],
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'phone' => ['required', 'string', 'max:20'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user = DB::transaction(function () use ($request) {
            // 1. Create Tenant
            $tenant = Tenant::create([
                'name' => $request->laundry_name,
                'status' => 'Trial',
            ]);

            // 2. Create Tenant Settings
            TenantSetting::create([
                'tenant_id' => $tenant->id,
                'business_name' => $request->laundry_name,
                'phone' => $request->phone,
            ]);

            // 3. Create Default Order Statuses
            $statuses = [
                ['name' => 'Diterima', 'slug' => 'received', 'color_hex' => '#F59E0B', 'sequence' => 1, 'is_final' => false],
                ['name' => 'Dicuci', 'slug' => 'washing', 'color_hex' => '#3B82F6', 'sequence' => 2, 'is_final' => false],
                ['name' => 'Selesai', 'slug' => 'ready', 'color_hex' => '#22C55E', 'sequence' => 3, 'is_final' => false],
                ['name' => 'Diambil', 'slug' => 'picked_up', 'color_hex' => '#6B7280', 'sequence' => 4, 'is_final' => true],
            ];
            foreach ($statuses as $status) {
                $tenant->orderStatuses()->create($status);
            }

            // 4. Create Default Service
            $category = ServiceCategory::create([
                'tenant_id' => $tenant->id,
                'name' => 'Reguler',
            ]);
            $service = Service::create([
                'tenant_id' => $tenant->id,
                'category_id' => $category->id,
                'name' => 'Cuci Setrika Reguler',
                'unit_type' => 'KG',
            ]);
            $service->prices()->create([
                'price' => 6000,
                'effective_date' => now(),
            ]);

            // 5. Create Default Payment Method
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
            ]);

            // $user->assignRole('owner'); // Temporarily disabled

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
