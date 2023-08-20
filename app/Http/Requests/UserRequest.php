<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        if ($this->method() == 'POST') {
            $rules = [
                'first_name'    => 'required|string|max:15',
                'last_name'     => 'required|string|max:15',
                'user_name'     => 'required|string|max:15|unique:users,user_name',
                'email'         => 'required|string|email|max:30|unique:users,email',
                'password'      => 'required|string|min:8|confirmed',
                'status'        => 'sometimes|nullable|boolean',
                'roles_id'      => 'required|array|min:1|exists:roles,id',
            ];
        } else {
            $rules = [
                'first_name'     => 'required|string|max:15',
                'last_name'     => 'required|string|max:15',
                'user_name'     => 'required|string|max:15|unique:users,user_name,'.$this->id,
                'email'         => 'required|string|email|max:30|unique:users,email,'.$this->id,
                'password'      => 'sometimes|nullable|min:8|confirmed',
                'status'        => 'sometimes|nullable|boolean',
                'roles_id'      => 'required|array|min:1|exists:roles,id',
            ];
        }

        return $rules;

    }


    public function attributes()
    {
        return  [
            'first_name'    => trans('site.first_name'),
            'last_name'     => trans('site.last_name'),
            'name'          => trans('site.name_attr', ['attr' => trans_choice('site.users', 0)]),
            'status'        => trans('site.status'),
            'roles_id'      => trans_choice('site.roles', 1),
        ];
    }
}
