<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegistrationRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'phone' => ['required', 'regex:/^([0-9\s\-\+\(\)]*)$/', 'max:20', 'unique:users'],
            'company_name' => ['required', 'string', 'max:255'],
            'reseller_ID' => ['required', 'string', 'max:50'],
            'tax_image' => ['required', 'mimes:jpeg,png,jpg,pdf', 'max:1024'],
            'city' => ['required', 'string', 'max:255'],
            'united_region' => ['required', 'string'],
            'shipping_address' => ['required', 'string', 'max:500'],
            'billing_address' => ['required', 'string', 'max:500'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ];
    }
}

