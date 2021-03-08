<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class UserRegistrationRequest extends FormRequest
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
        switch ($this->method()) {
            case 'GET':
            case 'DELETE': {
                    return [];
                }
            case 'POST': {
                    return [
                        'name' => ['required', 'string',"max:100"],
                        'email' => ['required', 'email',"max:100", 'unique:register_users,email,NULL,id,deleted_at,NULL'],
                        'phone_number' => ['required',"numeric","digits:11",'unique:register_users,phone_number,NULL,id,deleted_at,NULL'],
                        'affiliated_id' => ['required'],
                        'gender' => ['required'],
                        'organization' => ['required',"max:100"],
                        'designation_id' => ['required'],
                        'designation_other' => [Rule::requiredIf(function (){
                            return \request()->input("designation_id")==13;
                        })],
                        'age' => ['required',"max:5"],
                        'password' => ['required','min:6',"max:20"],
                        'password_confirmation' => ['same:password'],
                        'upazilla_id' => ['required']
                    ];
                }
            case 'PUT':
            case 'PATCH': {
                    return [
                        'name' => ['required', 'string',"max:100"],
                        'email' => ['required', 'email',"max:100", 'unique:register_users,email,'.Auth::id().',id,deleted_at,NULL'],
                        'phone_number' => ['required',"numeric","digits:11",'unique:register_users,name,'.Auth::id().',id,deleted_at,NULL'],
                        'affiliated_id' => ['required',"max:100"],
                        'gender' => ['required'],
                        'organization' => ['required',"max:100"],
                        'designation_id' => ['required'],
                        'designation_other' => [Rule::requiredIf(function (){
                            return \request()->input("designation_id")==13;
                        })],
                        'age' => ['required',"max:5"],
                        'upazilla_id' => ['required']
                    ];
                }
            default:
                break;
        }
    }
  public function messages()
    {
         return [
            'name.required' => 'আপনার নাম লিখুন',
            'email.required'  => 'আপনার ইমেইলটি লিখুন ',
            'email.unique'  => 'ইমেইলটি পূর্বে  ব্যবহৃত হয়েছে ',
            'email.email'  => 'ইমেইলটি সঠিক নয় ',
            'phone_number.required'  => 'আপনার মোবাইল নাম্বারটি লিখুন',
            'phone_number.digits'  => 'ফোন নাম্বারটি অবশ্যই ১১ ডিজিটের হতে হবে',
            'phone_number.unique'  => 'মোবাইল নাম্বারটি পূর্বে ব্যবহৃত হয়েছে',
            'affiliated_id.required'  => ' আপনার সম্পৃক্ততা নির্বাচন করুন',
            'gender.required'  => 'আপনার লিঙ্গ নির্বাচন করুন',
            'organization.required'  => 'আপনার সংস্থার নাম লিখুন',
            'designation_id.required'  => 'আপনার পদবীটি লিখুন',
            'designation_other.required'  => 'আপনার পদবীটি লিখুন',
            'age.required'  => 'আপনার বয়স নির্বাচন করুন',
            'age.max'  => 'বয়স অবশ্যই 5 ডিজিটের এর নিচে হতে হবে',
            'password.required'  => 'আপনার পাসওয়ার্ডটি লিখুন',
            'password.min'  => 'পাসওয়ার্ড কমপক্ষে ৬টি অক্ষরের হতে হবে',
            'password_confirmation.same'  => 'পাসওয়ার্ডটি মিলছে না',
            'upazilla_id.required'  => 'আপনার উপজেলা নির্বাচন করুন '
        ];
    }
    public function validated() {
        $instance = $this->getValidatorInstance();
        if ($instance->fails()) {
            throw new HttpResponseException(response()->json($instance->errors(), 422));
        }
    }
}
