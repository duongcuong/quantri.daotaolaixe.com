<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PigBreedRequest extends FormRequest
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
        $id = $this->route('pig_breed');
        $string = '';
        if($id) $string = ','.$id;
        return [
            'code' => 'required|unique:pigs,code'. $string,
            'birthday' => 'required',
            'origin' => 'required',
            'total' => 'nullable|integer|min:1',
            // 'total_meat' => 'nullable|integer|min:1|lte:total',
            'total_die' => 'nullable|integer|min:1|lte:total'
        ];
    }

    public function messages()
    {
        return [
            'code.required' => 'Vui lòng nhập mã đàn',
            'code.unique' => 'Mã đàn đã tồn tại',
            'birthday.required' => 'Vui lòng chọn ngày sinh',
            'origin.required' => 'Vui lòng chọn nguồn gốc',
            'total.integer' => 'Tổng đàn phải là số nguyên',
            'total.min' => 'Tổng đàn phải lớn hơn 0',
            // 'total_meat.integer' => 'Số lượng nuôi thịt phải là số nguyên',
            // 'total_meat.min' => 'Số lượng nuôi thịt phải lớn hơn 0',
            // 'total_meat.lte' => 'Số lượng nuôi thịt phải nhỏ hơn tổng đàn',
            'total_die.integer' => 'Số lượng Chết/loại phải là số nguyên',
            'total_die.min' => 'Số lượng Chết/loại phải lớn hơn 0',
            'total_die.lte' => 'Số lượng Chết/loại phải nhỏ hơn tổng đàn',
        ];
    }
}
