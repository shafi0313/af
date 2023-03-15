<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PatientStoreRequest extends FormRequest
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
            'name'         => 'required|string|max:191',
            'f_name'       => 'required|string|max:191',
            'm_name'       => 'required|string|max:191',
            'phone'        => 'required|string|max:30',
            'e_phone'      => 'required|string|max:30',
            'division_id'  => 'required',
            'district_id'  => 'required',
            'upazila_id'   => 'required',
            'post'         => 'required|string|max:191',
            'village'      => 'required|string|max:191',
            'finance'      => 'required|string|max:500',
            'hospital'     => 'required|string|max:191',
            'doctor'       => 'required|string|max:191',
            'total_income' => 'required',
            'patient_img'  => 'nullable|image|mimes:png,jpeg,jpg,JPG,PNG,JPEG|max:512',
            'nid'          => 'nullable|image|mimes:png,jpeg,jpg,JPG,PNG,JPEG|max:512',
            'sonod'        => 'nullable|image|mimes:png,jpeg,jpg,JPG,PNG,JPEG|max:512',
            'prescription' => 'nullable|image|mimes:png,jpeg,jpg,JPG,PNG,JPEG|max:512',
        ];
    }
}
