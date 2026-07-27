<?php

namespace App\Http\Requests\Customer;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateCustomerRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->check();
    }

    public function rules(): array
    {
        $customerId = $this->route('customer')?->id;

        return [
            'name'  => ['required', 'string', 'max:150'],
            'phone' => [
                'nullable',
                'string',
                'max:20',
                Rule::unique('customers', 'phone')
                    ->where('tenant_id', auth()->user()->tenant_id)
                    ->whereNull('deleted_at')
                    ->ignore($customerId),
            ],
            'email' => ['nullable', 'email', 'max:150'],
            'notes' => ['nullable', 'string', 'max:500'],
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Nama pelanggan wajib diisi.',
            'phone.unique'  => 'Nomor HP sudah terdaftar untuk pelanggan lain.',
        ];
    }
}
