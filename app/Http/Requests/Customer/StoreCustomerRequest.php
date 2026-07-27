<?php

namespace App\Http\Requests\Customer;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

/**
 * StoreCustomerRequest
 *
 * Form Request Validation untuk menambahkan customer baru.
 * Prinsip: Validasi TIDAK boleh dilakukan di Controller.
 */
class StoreCustomerRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->check();
    }

    public function rules(): array
    {
        return [
            'name'  => ['required', 'string', 'max:150'],
            'phone' => [
                'nullable',
                'string',
                'max:20',
                // Nomor HP harus unik dalam 1 tenant (Laundry A & B bisa punya customer dengan nomor sama)
                Rule::unique('customers', 'phone')
                    ->where('tenant_id', auth()->user()->tenant_id)
                    ->whereNull('deleted_at'),
            ],
            'email'   => ['nullable', 'email', 'max:150'],
            'notes'   => ['nullable', 'string', 'max:500'],
        ];
    }

    public function messages(): array
    {
        return [
            'name.required'   => 'Nama pelanggan wajib diisi.',
            'name.max'        => 'Nama pelanggan maksimal 150 karakter.',
            'phone.unique'    => 'Nomor HP sudah terdaftar untuk pelanggan lain.',
            'email.email'     => 'Format email tidak valid.',
        ];
    }
}
