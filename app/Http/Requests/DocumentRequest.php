<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DocumentRequest extends FormRequest
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
            'lawsuite_id'           => 'required|numeric|exists:lawsuites,id',
            'lawsuite_documents'    => 'required|array|min:1',
            'lawsuite_documents.*'  => 'file|mimes:png,jpg,jpeg,pdf,docx|max:2048',
        ];
    }
}
