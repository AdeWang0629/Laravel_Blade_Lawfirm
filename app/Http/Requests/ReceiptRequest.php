<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ReceiptRequest extends FormRequest
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
        return [
            'title'             => 'required|string|max:100',
            'date'              => 'required|date|date_format:Y-m-d',
            'payment_type'      => 'required|string',
            'client_id'         => 'required|numeric|exists:clients,id',
            'lawsuite_id'       => 'required_if:consultation_id,null|sometimes|nullable|numeric|exists:lawsuites,id',
            'consultation_id'   => 'required_if:lawsuite_id,null|sometimes|nullable|numeric|exists:consultations,id',
            'debit'             => 'required|numeric',
            'note'              => 'sometimes|nullable|string',
        ];
    }

    public function attributes()
    {
        return [
            'title'         => removebeginninLetters(trans('site.title'), 2) .' '. trans_choice('site.payments', 0),
            'date'          => trans('site.date_attr', ['attr' => trans_choice('site.payments', 0)]),
            'payment_type'  => trans('site.payment_way'),
            'client_id'     => trans_choice('site.clients', 0),
            'lawsuite_id'   => trans_choice('site.lawsuites', 0),
            'debit'         => trans('site.amount_attr', ['attr' => trans_choice('site.payments', 0)]),
            'note'          => trans('site.notes'),
        ];
    }
}
