<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreShipmentRequest extends FormRequest
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
        ];
    }

    public function messages()
    {
        return [
            'sender_id.required' => 'Sender is required',
            'receiver_id.required' => 'Receiver is required',
            'from_city.required' => 'From city is required',
            'to_city.required' => 'To city is required',
            'courier_type.required' => 'Courier type is required',
            'weight.required' => 'Weight is required',
            'price.required' => 'Price is required',
            'expected_delivery_date.required' => 'Expected delivery date is required',
        ];
    }
}
