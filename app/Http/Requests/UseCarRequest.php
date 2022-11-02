<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Foundation\Http\FormRequest;

class UseCarRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'car_id'  => 'required|integer|exists:cars,id',
            'user_id' => 'required|integer|exists:users,id',
        ];
    }

    public function messages()
    {
        return [
            'car_id.required'  => 'Не передано car_id',
            'user_id.required' => 'Не передано user_id',
            'car_id.exists'    => 'Данный автомобиль не существует',
            'user_id.exists'   => 'Данного юзера не существует',
        ];
    }

    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json($validator->errors(), 422));
    }
}
