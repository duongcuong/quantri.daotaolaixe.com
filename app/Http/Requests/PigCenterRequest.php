<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PigCenterRequest extends FormRequest
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
        $id = $this->route('pig_center');
        $string = '';
        if($id) $string = ','.$id;
        return [
            'code' => 'required|unique:pigs,code'. $string,
            'gender' => 'required',
            'origin' => 'required',
            'type' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'code.required' => 'Vui lòng nhập số tai',
            'code.unique' => 'Số tai đã tồn tại',
            'origin.required' => 'Vui lòng chọn nguồn gốc',
            'gender.required' => 'Vui lòng chọn giới tính',
            'type.required' => 'Vui lòng chọn phân loại'
        ];
    }
}
