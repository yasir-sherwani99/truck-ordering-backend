<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BookingStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'first_name' => 'required|string|max:191',
            'last_name' => 'required|string|max:191',
            'email' => 'required|string|email',
            'phone' => 'required|string',
            'company' => 'nullable|string|max:191',
            'pickup_address' => 'required|string|max:191',
            'delivery_address' => 'required|string|max:191',
            'cargo_type' => 'required|string',
            'cargo_weight' => 'required|string',
            'truck_type' => 'required|integer',
            'pickup_date' => 'required|date',
            'delivery_date' => 'required|date',
            'message' => 'nullable|string|max:500'
        ];
    }
}
