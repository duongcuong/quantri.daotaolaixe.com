<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BreedingRequest extends FormRequest
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
        $id = $this->route('breeding');
        return [
            'pig_id' => 'required_without:pig_code',
            'pig_code' => 'required_without:pig_id',
            // 'code_children' => ['nullable', new \App\Rules\BreedingUniqueCodeChildren($id)],
            'actual_date_of_birth' => 'required_with:code_children',
            'breed_id' => 'required_with:code_children',
            'number_of_children_to_raise' => 'nullable|integer|min:1|required_with:code_children',
            'week' => 'nullable|integer|min:1'

        ];
    }

    public function messages()
    {
        return [
            'pig_id.required_without' => 'Vui lòng chọn số tai',
            'pig_code.required_without' => 'Vui lòng chọn số tai',
            // 'code_children.unique' => 'Mã đàn con đã tồn tại',
            'actual_date_of_birth.required_with' => 'Nếu Mã đàn có giá trị, vui lòng nhập ngày đẻ thực tế',
            'number_of_children_to_raise.integer' => 'SL con để nuôi phải là số nguyên',
            'number_of_children_to_raise.min' => 'SL con để nuôi phải lớn hơn 0',
            'number_of_children_to_raise.required_with' => 'Nếu mã đàn có giá trị, vui lòng nhập SL con để nuôi',
            'breed_id.required_with' => 'Nếu mã đàn có giá trị, vui lòng chọn giống',
            'week.integer' => 'Tuần phối phải là số nguyên',
            'week.min' => 'Tuần phối phải lớn hơn 0',
        ];
    }
}
