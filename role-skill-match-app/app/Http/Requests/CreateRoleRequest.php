<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateRoleRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'Role_Name' => 'required|string',
            'Description' => 'required|string',
            'Department_ID' => 'required|integer',
            'Country_ID' => 'required|integer',
            'Work_Arrangement' => 'required|integer',
            'Vacancy' => 'required|integer',
            'Status' => 'required|integer',
            'Deadline' => 'required|date|after:today',
            'Skills' => 'required|array',
        ];
    }

    public function messages(): array
    {
        return [
            'Role_Name.required' => 'Role name is required',
            'Description.required' => 'Description is required',
            'Department_ID.required' => 'Department is required',
            'Country_ID.required' => 'Country is required',
            'Work_Arrangement.required' => 'Work arrangement is required',
            'Vacancy.required' => 'Vacancy is required',
            'Status.required' => 'Status is required',
            'Deadline.required' => 'Deadline is required',
            'Skills.required' => 'Skills is required',
        ]
    };
}
