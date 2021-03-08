<?php

namespace App\Http\Requests;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class PasswordRequest extends FormRequest
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
            'old_password' => [
                'required', function ($attribute, $value, $fail) {
                    if (!Hash::check($value, Auth::user()->password)) {
                        $fail('পুরাতন পাসওয়ার্ডটি মিলছে না');
                    }
                },
            ],
            'password' => ['required','min:6',"max:20",'confirmed','different:old_password'],
        ];
    }
    public function messages()
    {
         return [
            'old_password.required'  => 'আপনার পাসওয়ার্ডটি লিখুন',
            'password.required'  => 'আপনার নতুন পাসওয়ার্ডটি লিখুন',
            'password.different'  => 'ভিন্ন পাসওয়ার্ড দিন',
            'password.min'  => 'পাসওয়ার্ড কমপক্ষে ৬টি অক্ষরের হতে হবে',
            'password.confirmed'  => 'পাসওয়ার্ডটি মিলছে না '
        ];
    }
    public function validated() {
        $instance = $this->getValidatorInstance();
        if ($instance->fails()) {
            throw new HttpResponseException(response()->json($instance->errors(), 422));
        }
    }
}
