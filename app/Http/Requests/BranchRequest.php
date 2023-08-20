<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BranchRequest extends FormRequest
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
                'name' => 'required|string|max:20|unique:branches,name'
            ];
        } else {
            $rules = [
                'name' => 'required|string|max:20|unique:branches,name,'.$this->id
            ];
        }

        return $rules;

    }

    public function attributes()
    {
        return [
            'name' => trans_choice('site.branches', 0),
        ];
    }
}
