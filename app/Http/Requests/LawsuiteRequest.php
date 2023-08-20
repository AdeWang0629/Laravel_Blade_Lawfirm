<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LawsuiteRequest extends FormRequest
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
            'client_id'                         => 'required|numeric|exists:clients,id',
            'client_type_id'                    => 'required|numeric|exists:client_types,id',
            'opponents'                         => 'required|array|max:50',
            'opponents.*.opponent_name'         => 'required|string|max:50',
            'opponents.*.opponent_phone'        => 'sometimes|nullable|numeric|digits:11',
            'opponents.*.opponent_city'         => 'sometimes|nullable|string|max:50',
            'opponents.*.opponent_section'      => 'sometimes|nullable|string|max:50',
            'opponents.*.opponent_address'      => 'sometimes|nullable|string|max:50',
            'opponents.*.opponent_lawyer'       => 'sometimes|nullable|string|max:50',
            'opponents.*.opponent_lawyer_phone' => 'sometimes|nullable|numeric|digits:11',
            'case_type_id'                      => 'required|numeric|exists:case_types,id',
            'lawsuite_lawyer'                   => 'sometimes|nullable|string|max:50',
            'lawsuite_subject'                  => 'required|string|max:50',
            'case_stage_id'                     => 'required|numeric|exists:case_stages,id',
            'lawsuit_case_id'                   => 'required|numeric|exists:lawsuit_cases,id',
            'court_id'                          => 'required|numeric|exists:courts,id',
            'court_case_number'                 => 'sometimes|nullable|string|max:50',
            'contract_title'                    => 'sometimes|nullable|string',
            'contract_date'                     => 'sometimes|nullable|date|date_format:Y-m-d',
            'contract_amount'                   => 'required|numeric',
            'vat'                               => 'required|numeric',
            'total_amount'                      => 'required|numeric',
            'contract_terms'                    => 'sometimes|nullable|string',
            'notes'                             => 'sometimes|nullable|string',
        ];
    }

    public function attributes()
    {
        $dataAttributes = [
            'client_id'                => trans_choice('site.clients', 0),
            'client_type_id'           => removebeginninLetters(trans_choice('site.categories', 0), 2) .' '. trans_choice('site.clients', 0),
            'opponents'                => trans_choice('site.opponents', 0),
            'case_type_id'             => removebeginninLetters(trans_choice('site.categories', 0), 2) .' '. trans_choice('site.lawsuites', 0),
            'lawsuite_lawyer'          => trans('site.lawyer_attr', ['attr' => trans_choice('site.lawsuites', 0)]),
            'lawsuite_subject'         => removebeginninLetters(trans('site.subject'), 2) . ' ' . trans_choice('site.lawsuites', 0),
            'case_stage_id'            => removebeginninLetters(trans_choice('site.stages', 0), 2) .' '. trans('site.litigation'),
            'lawsuit_case_id'          => trans_choice('site.status', 0) .' '. trans_choice('site.lawsuites', 0),
            'court_id'                 => trans_choice('site.courts', 0),
            'court_case_number'        => trans('site.court_lawsيuite_number'),
            'contract_title'           => trans('site.title'),
            'contract_date'            => trans('site.date_attr', ['attr' => trans_choice('site.contracts', 0)]),
            'contract_amount'          => trans('site.amount_attr', ['attr' => trans_choice('site.contracts', 0)]),
            'vat'                      => trans('site.amount_attr', ['attr' => trans('site.vat')]),
            'total_amount'             => trans('site.contract_amount_including_tax'),
            'contract_terms'           => trans('site.contract_terms'),
            'notes'                    => trans('site.notes'),
        ];

        if ($this->opponents != null) {
            for ($i=0; $i < count($this->opponents); $i++) {
                $b = $i+1;
                $dataAttributes['opponents.'.$i.'.opponent_name'] = trans('site.name_attr', ['attr' => trans_choice('site.opponents', 0)]).' '.$b;
                $dataAttributes['opponents.'.$i.'.opponent_phone'] = trans('site.phone_attr', ['attr' => trans_choice('site.opponents', 0)]).' '.$b;
                $dataAttributes['opponents.'.$i.'.opponent_city'] = trans('site.city').' '.$b;
                $dataAttributes['opponents.'.$i.'.opponent_section'] = trans_choice('site.stations', 0).' '.$b;
                $dataAttributes['opponents.'.$i.'.opponent_address'] = trans('site.address_attr', ['attr' => trans_choice('site.opponents', 0)]).' '.$b;
                $dataAttributes['opponents.'.$i.'.opponent_lawyer'] = trans('site.lawyer_attr', ['attr' => trans_choice('site.opponents', 0)]).' '.$b;
                $dataAttributes['opponents.'.$i.'.opponent_lawyer_phone'] =trans('site.lawyer_phone_attr', ['attr' => trans_choice('site.opponents', 0)]).' '.$b;
            }
        }

        return $dataAttributes;
    }
}
