<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LawsuitCaseRequest extends FormRequest
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
                'name' => 'required|string|max:20|unique:lawsuit_cases,name',
                'color' => 'required|string|max:10',
            ];
        } else {
            $rules = [
                'name' => 'required|string|max:20|unique:lawsuit_cases,name,'.$this->id,
                'color' => 'required|string|max:10'
            ];
        }

        return $rules;
    }

    public function attributes()
    {
        return [
            'name' => trans_choice('site.status', 0) .' '. trans_choice('site.lawsuites', 0),
            'color' => __('site.color')
        ];
    }
}
