<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ConsultationRequest extends FormRequest
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
            'client_id'                 => 'required|numeric|exists:clients,id',
            'consultation_subject'      => 'required|string|min:5|max:20',
            'contract_amount'           => 'required|numeric',
            'vat'                       => 'required|numeric',
            'total_amount'              => 'required|numeric',
            'contract_date'             => 'sometimes|nullable|date|date_format:Y-m-d',
            'contract_terms'            => 'sometimes|nullable|string|min:50',
        ];
    }

    public function attributes()
    {
        return [
            'client_id'                     => trans_choice('site.clients', 0),
            'consultation_subject'          => removebeginninLetters(trans('site.subject'), 2) . ' ' . trans_choice('site.consultations', 0),
            'contract_amount'               => trans('site.amount_attr', ['attr' => trans_choice('site.contracts', 0)]),
            'vat'                           => trans('site.amount_attr', ['attr' => trans('site.vat')]),
            'total_amount'                  => trans('site.contract_amount_including_tax'),
            'contract_date'                 => trans('site.date_attr', ['attr' => trans_choice('site.contracts', 0)]),
            'contract_terms'                => trans('site.contract_terms'),
        ];
    }
}
