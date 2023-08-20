<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CaseSessionRequest extends FormRequest
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
                'title'             => 'required|max:70|string',
                'start'             => 'required|date|date_format:Y-m-d',
                'bg_color'          => 'sometimes|nullable|string|max:15',
                'session_details'   => 'sometimes|nullable|string',
                'court_id'          => 'required|numeric|exists:courts,id',
                'lawsuite_id'       => 'required|numeric|exists:lawsuites,id',
            ];
        } else {
            $rules = [
                'title'             => 'required|max:70|string',
                'start'             => 'required|date|date_format:Y-m-d',
                'bg_color'          => 'sometimes|nullable|string|max:15',
                'session_details'   => 'sometimes|nullable|string'
            ];
        }

        return $rules;

    }

    public function attributes()
    {
        return [
            'title'             => removebeginninLetters(trans('site.title'), 2) .' '. trans_choice('site.sessions',0),
            'start'             => trans('site.date_attr', ['attr' => trans_choice('site.sessions', 0)]),
            'bg_color'          => trans('site.bg_color_for_calendar'),
            'session_details'   => removebeginninLetters(trans('site.details'), 2) .' '. trans_choice('site.sessions',0),
            'court_id'          => trans_choice('site.courts', 0),
            'lawsuite_id'       => trans_choice('site.lawsuites', 0),
        ];
    }
}
