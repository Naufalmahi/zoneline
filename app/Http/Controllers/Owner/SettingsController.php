<?php

namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SettingsController extends Controller
{
    public function index()
    {
        $tenant = Auth::user()->tenant;
        $settings = $tenant->settings()->firstOrCreate(
            ['tenant_id' => $tenant->id],
            ['business_name' => $tenant->name, 'primary_color' => '#2563EB', 'font_family' => 'Inter']
        );
        return view('owner.settings', compact('settings'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'business_name' => 'nullable|string|max:150',
            'tagline' => 'nullable|string|max:255',
            'primary_color' => 'nullable|string|max:20',
            'font_family' => 'nullable|string|max:50',
            'whatsapp_number' => 'nullable|string|max:20',
            'address' => 'nullable|string',
            'logo' => 'nullable|image|max:2048', // max 2MB
        ]);

        $tenant = Auth::user()->tenant;
        $settings = $tenant->settings()->firstOrCreate(
            ['tenant_id' => $tenant->id],
            ['business_name' => $tenant->name]
        );

        if ($request->hasFile('logo')) {
            $file = $request->file('logo');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/logos'), $filename);
            $settings->logo = 'uploads/logos/' . $filename;
        }

        $settings->business_name = $request->business_name ?? $tenant->name;
        $settings->tagline = $request->tagline;
        $settings->primary_color = $request->primary_color ?? '#2563EB';
        $settings->font_family = $request->font_family ?? 'Inter';
        $settings->whatsapp_number = $request->whatsapp_number;
        $settings->address = $request->address;
        $settings->show_whatsapp_button = $request->has('show_whatsapp_button');
        
        $settings->save();

        return redirect()->route('owner.settings.index')->with('success', 'Pengaturan berhasil diperbarui!');
    }
}
