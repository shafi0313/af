<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ApplicantUpdateRequest extends FormRequest
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
            'student_name'   => 'required|max:255',
            'father_name'    => 'required|max:255',
            'mother_name'    => 'required|max:255',
            'gram'           => 'required|max:255',
            'post_office'    => 'required|max:255',
            'division_id'    => 'required|max:255',
            'thana'          => 'required|max:255',
            'disctrict'      => 'required|max:255',
            'finance'        => 'required',
            'phone'          => 'required|max:30',
            'phone2'         => 'required|max:30',
            'email'          => 'nullable|max:30',
            'class'          => 'required|max:255',
            'school'         => 'required|max:255',
            'fee'            => 'required|max:8',
            'member'         => 'required|max:10',
            'income'         => 'required|max:20',
            'expense'        => 'nullable',
            'admission_fee'  => 'required|max:8',
            'board_reg_fee'  => 'required|max:8',
            'book_purchase'  => 'required|max:8',
            'exm_fee1'       => 'required|max:8',
            'exm_fee2'       => 'required|max:8',
            'exm_fee3'       => 'required|max:8',
            'student_image'  => 'nullable|image|mimes:png,jpeg,jpg,JPG,PNG,JPEG|max:512',
            'student_idcard' => 'nullable|image|mimes:png,jpeg,jpg,JPG,PNG,JPEG|max:512',
            'parent_idcard'  => 'nullable|image|mimes:png,jpeg,jpg,JPG,PNG,JPEG|max:512',
            'charac_cer'     => 'nullable|image|mimes:png,jpeg,jpg,JPG,PNG,JPEG|max:512',
            'marksheet'      => 'nullable|image|mimes:png,jpeg,jpg,JPG,PNG,JPEG|max:512',
            'document'       => 'nullable|image|mimes:png,jpeg,jpg,JPG,PNG,JPEG|max:512',
        ];
    }
}
