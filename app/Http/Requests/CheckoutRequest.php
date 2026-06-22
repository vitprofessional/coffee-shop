<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CheckoutRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'customer_name' => 'required|string|max:255',
            'phone' => 'required|string|max:30',
            'email' => 'nullable|email|max:255',
            'address' => 'nullable|string|max:1024',
            'order_type' => 'required|in:pickup,delivery,dine_in',
            'payment_method' => 'required|in:cash,card,mobile_banking',
            'notes' => 'nullable|string|max:2000',
        ];
    }
}
