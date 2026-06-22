<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ReservationRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:30',
            'email' => 'nullable|email|max:255',
            'reservation_date' => 'required|date|after_or_equal:today',
            'reservation_time' => 'required',
            'guests' => 'required|integer|min:1|max:50',
            'seating_preference' => 'nullable|string|max:255',
            'special_request' => 'nullable|string|max:2000',
        ];
    }
}
