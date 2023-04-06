<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class VendorApiRegistrationRequest extends FormRequest
{
    protected $stopOnFirstFailure = true;
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
            'name' => ['required','string'],
            'email' => ['required','email','unique:users'],
            'phone' => ['required','numeric'],
            'password' => ['required','string','min:8'],
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'name is required for the registration.',
            'email.required' => 'Please Provide a valid email.',
            'email.unique' => 'Email is already taken.',
            'email.email' => 'Email should be valid email',
            'password.required' => 'Password must be at least 8 character.',
            'password.string' => 'Password must be at least 8 character.',
        ];
    }
    
    //  public function failedValidation(\Illuminate\Contracts\Validation\Validator $validator ){
    //     throw new HttpResponseException(response()->json([
    //         'status' => false,
    //         'msg' => $validator->errors(),
    //         'msg2' => $validator->messages(),

    //     ]));
        
    // }
}
