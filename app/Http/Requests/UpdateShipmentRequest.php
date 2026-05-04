<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateShipmentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return auth()->check() && (auth()->user()->isAdmin() || auth()->user()->isAgent());
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'sender_id' => 'required|exists:customers,id',
            'receiver_id' => 'required|exists:customers,id',
            'from_city' => 'required|string|max:255',
            'to_city' => 'required|string|max:255',
            'courier_type' => 'required|in:standard,express,overnight',
            'weight' => 'required|numeric|min:0.1',
            'price' => 'required|numeric|min:0',
            'expected_delivery_date' => 'required|date|after:today',
            'status' => 'required|in:pending,in_transit,delivered,cancelled',
        ];
    }
}
