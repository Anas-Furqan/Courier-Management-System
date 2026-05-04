<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateAgentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return auth()->check() && auth()->user()->isAdmin();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $agentId = $this->route('agent') ?? $this->route('admin');
        return [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $agentId,
            'phone' => 'required|string|max:20',
            'branch_city' => 'required|string|max:255',
            'agent_code' => 'required|string|unique:agents,agent_code',
            'status' => 'required|in:active,inactive',
        ];
    }
}
