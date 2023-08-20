<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class AccountSettingsRequest extends FormRequest
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
        if (Auth::guard('client')->check()) {
            $rules = [
                'name'                  => "required|string|max:35",
                'email'                 => 'required|string|email|max:35|unique:users,email,'.auth()->id(),
                'user_name'             => 'required|string|max:15|unique:users,user_name,'.auth()->id(),
                'password'              => "sometimes|nullable|min:8|confirmed",
            ];
        }else {
            $rules = [
                'first_name'            => "required|string|max:35",
                'last_name'             => "required|string",
                'email'                 => 'required|string|email|max:35|unique:users,email,'.auth()->id(),
                'user_name'             => 'required|string|max:15|unique:users,user_name,'.auth()->id(),
                'password'              => "sometimes|nullable|min:8|confirmed",
            ];
        }
        return $rules;
    }

    public function attributes()
    {
        return  [
            'name'          => trans('site.name'),
            'first_name'    => trans('site.first_name'),
            'last_name'     => trans('site.last_name'),
            'email'         => trans('site.email'),
            'user_name'     => trans('site.user_name'),
            'password'      => trans('site.password'),
        ];
    }
}
