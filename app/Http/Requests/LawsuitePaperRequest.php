<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LawsuitePaperRequest extends FormRequest
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
                'title'         => 'required|string|max:50',
                'date'          => 'required|date|date_format:Y-m-d',
                'subject'       => 'required|string',
                'based_on_it'   => 'required|string',
                'lawsuite_id'   => 'required|numeric|exists:lawsuites,id',
            ];
        } else {
            $rules = [
                'title'         => 'required|string|max:50',
                'date'          => 'required|date|date_format:Y-m-d',
                'subject'       => 'required|string',
                'based_on_it'   => 'required|string',
                'lawsuite_id'   => 'sometimes|nullable|numeric|exists:lawsuites,id',
            ];
        }

        return $rules;
    }

    public function attributes()
    {
        return [
            'title'         => removebeginninLetters(trans('site.title'), 2) .' '. trans_choice('site.newspapers', 0),
            'date'          => trans('site.date_attr', ['attr' => trans_choice('site.newspapers', 0)]),
            'subject'       => removebeginninLetters(trans('site.subject'), 2) .' '. trans_choice('site.newspapers', 0),
            'based_on_it'   => trans('site.based_on_it'),
            'lawsuite_id'   => trans_choice('site.lawsuites', 0),
        ];
    }
}
