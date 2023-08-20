<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SettingRequest extends FormRequest
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
        $rules = [];
        for ($i=0; $i < count(request()->key); $i++) {
            if (request()->key[$i] == 'logo' || request()->key[$i] == 'receipt_header' || request()->key[$i] == 'favicon') {
                $rules['value.'.$i] = 'image|mimes:png,jpg,gif,svg|max:3000';
            }elseif(request()->key[$i] == 'site_title' || request()->key[$i] == 'office_name' || request()->key[$i] == 'office_address' || request()->key[$i] == 'city' || request()->key[$i] == 'office_owner' || request()->key[$i] == 'office_name') {
                $rules['value.'.$i] = 'sometimes|nullable|string|max:20';
            }elseif(request()->key[$i] == 'email') {
                $rules['value.'.$i] = 'sometimes|nullable|email';
            }elseif(request()->key[$i] == 'mobile') {
                $rules['value.'.$i] = 'sometimes|nullable|min:11|regex:/(01)[0-9]{9}/';
            }elseif(request()->key[$i] == 'vat') {
                $rules['value.'.$i] = 'integer|max:50|min:0';
            }elseif(request()->key[$i] == 'vat_registration_number') {
                $rules['value.'.$i] = 'sometimes|nullable|string|min:15';
            }
        }

        return $rules;
    }

    public function attributes()
    {
        $translate = [];
        for ($i=0; $i < count(request()->key); $i++) {
            if (request()->key[$i] == 'logo') {
                $translate['value.'.$i] = trans('site.logo');
            }elseif (request()->key[$i] == 'receipt_header') {
                $translate['value.'.$i] = trans('site.receipt_header');
            }elseif (request()->key[$i] == 'favicon') {
                $translate['value.'.$i] = trans('site.favicon');
            }elseif(request()->key[$i] == 'site_title') {
                $translate['value.'.$i] = trans('site.site_title');
            }elseif(request()->key[$i] == 'office_name') {
                $translate['value.'.$i] = trans('site.office_name');
            }elseif(request()->key[$i] == 'office_address') {
                $translate['value.'.$i] = trans('site.office_address');
            }elseif(request()->key[$i] == 'city') {
                $translate['value.'.$i] = trans('site.city');
            }elseif(request()->key[$i] == 'office_owner') {
                $translate['value.'.$i] = trans('site.office_owner');
            }elseif(request()->key[$i] == 'email') {
                $translate['value.'.$i] = trans('site.email');
            }elseif(request()->key[$i] == 'mobile') {
                $translate['value.'.$i] = trans('site.mobile');
            }elseif(request()->key[$i] == 'vat_registration_number') {
                $translate['value.'.$i] = trans('site.vat_registration_number');
            }elseif(request()->key[$i] == 'vat') {
                $translate['value.'.$i] = trans('site.vat');
            }
        }

        return $translate;
    }
}
