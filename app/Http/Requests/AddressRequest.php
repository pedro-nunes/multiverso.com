<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;

class AddressRequest extends BaseFormRequest
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
                    'type' => [
                        'required',
                        'string',
                        'max:10',
                    ],
                    'responsible' => [
                        'required',
                        'string',
                        'max:20',
                    ],
                    'phone' => [
                        'required',
                        'regex:/^\d{2}\s\d{4}\-\d{4,5}$/',
                    ],
                    'zip' => [
                        'required',
                        'regex:/^\d{2}\.?\d{3}-\d{3}$/'
                    ],
                    'address' => [
                        'required',
                        'string',
                        'max:45',
                    ],
                    'number' => [
                        'required',
                        'string',
                        'max:8',
                    ],
                    'complement' => [
                        'nullable',
                        'string',
                        'max:30'
                    ],
                    'district' => [
                        'required',
                        'string',
                        'max:35'
                    ],
                    'city' => [
                        'required',
                        'string',
                        'max:30'
                    ],
                    'state' => [
                        'required',
                        'string',
                        'size:2'
                    ],
                    'information' => [
                        'nullable',
                        'string',
                        'max:128'
                    ],
                ];
                break;
            case 'POST':
                $rules = [
                    'type' => [
                        'required',
                        'string',
                        'max:10',
                    ],
                    'responsible' => [
                        'required',
                        'string',
                        'max:20',
                    ],
                    'phone' => [
                        'required',
                        'regex:/^\d{2}\s\d{4}\-\d{4,5}$/',
                    ],
                    'zip' => [
                        'required',
                        'regex:/^\d{2}\.?\d{3}-\d{3}$/'
                    ],
                    'address' => [
                        'required',
                        'string',
                        'max:45',
                    ],
                    'number' => [
                        'required',
                        'string',
                        'max:8',
                    ],
                    'complement' => [
                        'nullable',
                        'string',
                        'max:30'
                    ],
                    'district' => [
                        'required',
                        'string',
                        'max:35'
                    ],
                    'city' => [
                        'required',
                        'string',
                        'max:30'
                    ],
                    'state' => [
                        'required',
                        'string',
                        'size:2'
                    ],
                    'information' => [
                        'nullable',
                        'string',
                        'max:128'
                    ],
                ];
                break;
            default:
                break;
        }
        return $rules;
    }
}