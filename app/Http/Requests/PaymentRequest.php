<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PaymentRequest extends FormRequest
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
            'receiver'              => 'required|string|max:50',
            'date'                  => 'required|date|date_format:Y-m-d',
            'payment_type'          => 'required|string',
            'expense_section_id'    => 'required|numeric|exists:expense_sections,id',
            'branch_id'             => 'required|numeric|exists:branches,id',
            'debit'                 => 'required|numeric',
            'note'                  => 'sometimes|nullable|string',
        ];
    }

    public function attributes()
    {
        return [
            'receiver'              => trans('site.receiver'),
            'expense_section_id'    => trans_choice('site.sections', 0),
            'branch_id'             => trans_choice('site.branches', 0),
            'debit'                 => trans('site.amount_attr', ['attr' => trans_choice('site.payments', 0)]),
            'date'                  => trans('site.date_attr', ['attr' => trans_choice('site.payments', 0)]),
            'payment_type'          => trans('site.payment_way'),
            'note'                  => trans('site.notes'),

        ];
    }
}
