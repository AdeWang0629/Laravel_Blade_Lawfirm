<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ClientRequest extends FormRequest
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

        if ($this->method() == 'POST') {
            $rules = [
                'name'              => 'required|string|max:35|min:4|unique:clients,name',
                'user_name'         => 'required|string|max:15|unique:clients,user_name',
                'id_number'         => 'required|string|numeric|unique:clients,id_number',
                'cr_number'         => 'sometimes|nullable|numeric|unique:clients,cr_number',
                'nationality'       => 'required|string|min:4',
                'po_box'            => 'sometimes|nullable|string|max:15',
                'mobile'            => 'required|numeric|min:11|unique:clients,mobile',
                'phone'             => 'sometimes|nullable|numeric',
                'email'             => 'sometimes|nullable|email',
                'city'              => 'sometimes|nullable|string|max:15',
                'address'           => 'sometimes|nullable|string',
                'password'          => 'sometimes|nullable|string',
                'status'            => 'sometimes|nullable|boolean',
                'notes'             => 'sometimes|nullable|string',
            ];
        } else {
            $rules = [
                'name'              => 'required|string|max:35|max:100|min:4|unique:clients,name,'.$this->id,
                'user_name'         => 'required|string|max:15|unique:clients,user_name,'.$this->id,
                'id_number'         => 'required|string|numeric|unique:clients,id_number,'.$this->id,
                'cr_number'         => 'sometimes|nullable|numeric|unique:clients,cr_number,'.$this->id,
                'nationality'       => 'required|string|min:4',
                'po_box'            => 'sometimes|nullable|string|max:15',
                'mobile'            => 'required|numeric|min:11|unique:clients,mobile,'.$this->id,
                'phone'             => 'sometimes|nullable|numeric',
                'email'             => 'sometimes|nullable|email',
                'city'              => 'sometimes|nullable|string|max:15',
                'address'           => 'sometimes|nullable|string',
                'password'          => 'sometimes|nullable|string',
                'status'            => 'sometimes|nullable|boolean',
                'notes'             => 'sometimes|nullable|string',
            ];
        }

        return $rules;
    }

    public function attributes()
    {
        return [
            'name'              => trans('site.name'),
            'user_name'         => trans('site.user_name'),
            'id_number'         => trans('site.id_number'),
            'cr_number'         => trans('site.cr_number'),
            'nationality'       => trans('site.nationality'),
            'po_box'            => trans('site.po_box'),
            'mobile'            => trans('site.mobile'),
            'phone'             => trans('site.phone'),
            'email'             => trans('site.email'),
            'city'              => trans('site.city'),
            'address'           => trans('site.address'),
            'password'          => trans('site.password'),
            'status'            => trans('site.client_status'),
            'notes'             => trans('site.notes'),
        ];
    }
}
