<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;

class UserRequest extends BaseFormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $rules = [];
        switch (mb_strtoupper($this->method())) {
            case 'PUT':
                $rules = [
                    'name' => [
                        'required',
                        'string',
                        'min:5',
                        'max:40',
                        Rule::unique('users')->ignore($this->id)
                    ],
                    'register' => [
                        'required',
                        'string',
                        'min:7',
                        'max:12',
                        'alpha_num:ascii',
                        Rule::unique('users')->ignore($this->id)
                    ],
                    'document' => [
                        'required',
                        'string',
                        'max:14',
                        'regex:/(^\d{3}\.\d{3}\.\d{3}\-\d{2}$)/',
                        Rule::unique('users')->ignore($this->id)
                    ],
                    'phone' => [
                        'required',
                        'string',
                        'max:15',
                        'regex:/^\d{2}\s\d{4}\-\d{4,5}$/',
                        Rule::unique('users')->ignore($this->id)
                    ],
                    'email' => [
                        'required',
                        'string',
                        'max:50',
                        'email:rfc,dns',
                        Rule::unique('users')->ignore($this->id)
                    ],
                    'zip' => [
                        'required',
                        'string',
                        'max:10',
                        'regex:/^\d{2}\.?\d{3}-\d{3}$/'
                    ],
                    'address' => [
                        'required',
                        'string',
                        'max:100',
                    ],
                    'number' => [
                        'required',
                        'string',
                        'max:15',
                    ],
                    'complement' => [
                        'nullable',
                        'string',
                        'max:30',
                    ],
                    'district' => [
                        'required',
                        'string',
                        'max:35',
                    ],
                    'city' => [
                        'required',
                        'string',
                        'max:30',
                    ],
                    'state' => [
                        'required',
                        'string',
                        'size:2',
                    ],
                    'password' => [
                        'nullable',
                        'string',
                        'min:8',
                        'confirmed',
                    ],
                ];
                break;
            case 'POST':
                $rules = [
                    'name' => [
                        'required',
                        'string',
                        'min:5',
                        'max:40',
                        'unique:users',
                    ],
                    'register' => [
                        'required',
                        'string',
                        'min:7',
                        'max:12',
                        'alpha_num:ascii',
                        'unique:users',
                    ],
                    'document' => [
                        'required',
                        'string',
                        'max:15',
                        'regex:/(^\d{3}\.\d{3}\.\d{3}\-\d{2}$)/',
                        'unique:users',
                    ],
                    'phone' => [
                        'required',
                        'string',
                        'max:15',
                        'regex:/^\d{2}\s\d{4}\-\d{4,5}$/',
                    ],
                    'email' => [
                        'required',
                        'string',
                        'max:50',
                        'email:rfc,dns',
                        'unique:users',
                    ],
                    'zip' => [
                        'required',
                        'string',
                        'max:10',
                        'regex:/^\d{2}\.?\d{3}-\d{3}$/',
                    ],
                    'address' => [
                        'required',
                        'string',
                        'max:100',
                    ],
                    'number' => [
                        'required',
                        'string',
                        'max:15',
                    ],
                    'complement' => [
                        'nullable',
                        'string',
                        'max:30',
                    ],
                    'district' => [
                        'required',
                        'string',
                        'max:35',
                    ],
                    'city' => [
                        'required',
                        'string',
                        'max:30',
                    ],
                    'state' => [
                        'required',
                        'string',
                        'size:2',
                    ],
                ];
                break;
            default:
                break;
        }
        return $rules;
    }
}