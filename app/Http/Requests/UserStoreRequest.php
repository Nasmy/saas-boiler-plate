<?php

namespace App\Http\Requests;

use App\Traits\ApiResponse;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class UserStoreRequest extends FormRequest
{
    use ApiResponse;
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
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email|unique:users,email',
            'mobile' => 'required|unique:users,mobile',
            'username' => 'required|unique:users,username',
            'password' => 'required|min:8',
            'password_confirmation' => 'required|min:8|same:password',
            'role_id' => 'required',
            'city' => 'required',
            'address' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'email.required' => 'Email is required!',
            'email.unique' => 'Email is Unique!',
            'first_name.required' => 'First Name is required!',
            'last_name.required' => 'Last Name is required!',
            'mobile.required' => 'Mobile is required',
            'username.required' => 'User name is required',
            'username.unique' => 'Username already exist',
        ];
    }


    public function failedValidation(Validator $validator)
    {
        $message = $validator->errors()->all();
        throw new HttpResponseException($this->sendError($message, 401));
    }
}
