<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ClientTypeRequest extends FormRequest
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
                'name' => 'required|string|max:15|unique:client_types,name'
            ];
        } else {
            $rules = [
                'name' => 'required|string|max:15|unique:client_types,name,'.$this->id
            ];
        }

        return $rules;

    }

    public function attributes()
    {
        return [
            'name' => removebeginninLetters(trans_choice('site.categories', 0), 2) .' '. trans_choice('site.clients', 0),
        ];
    }
}
