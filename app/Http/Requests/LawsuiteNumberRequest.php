<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LawsuiteNumberRequest extends FormRequest
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
        return [
            'description'   => 'required|string|min:5',
            'number'        => 'required|string',
            'notes'         => 'sometimes|nullable|string|max:50',
            'lawsuite_id'   => 'required|numeric|exists:lawsuites,id',
        ];

    }
    
    public function attributes()
    {
        return [
            'description'   => trans('site.description'),
            'number'        => trans('site.number'),
            'notes'         => trans('site.notes'),
            'lawsuite_id'   => trans_choice('site.lawsuites', 0),
        ];
    }
}
