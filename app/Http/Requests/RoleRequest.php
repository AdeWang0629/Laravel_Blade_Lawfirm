<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RoleRequest extends FormRequest
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
                'name'                  => 'required|string|max:15|unique:roles,name',
                'permissions_id'        => 'required|array|min:1|exists:permissions,id',
            ];
        } else {
            $rules = [
                'name'                  => 'required|string|max:15|unique:roles,name,' . $this->id,
                'permissions_id'        => 'required|array|min:1|exists:permissions,id',
            ];
        }

        return $rules;
    }

    public function attributes()
    {
        return  [
            'name'              => trans('site.name'),
            'permissions_id'    => trans_choice('site.permissions', 1),
        ];
    }
}
