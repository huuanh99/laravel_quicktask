<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\ValidationException;

class SignupUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name'=> 'required|min:6',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
            'confirmpassword'=>'same:password',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Trường tên là bắt buộc',
            'name.min' => 'Trường tên phải có nhiều hơn 6 ký tự',
            'email.required' => 'Trường email là bắt buộc',
            'email.email' => 'Email không đúng định dạng',
            'email.unique'=>'email này đã được sử dụng',
            'password.required' => 'Trường password là bắt buộc',
            'password.min' => 'Trường password phải nhiều hơn 6 ký tự',
            'confirmpassword.same'=>'Xác nhận password không chính xác',
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        $errors = (new ValidationException($validator))->errors();
        throw new HttpResponseException(response()->json(
            [
                'error' => $errors,
            ], JsonResponse::HTTP_UNPROCESSABLE_ENTITY));
    }
}
