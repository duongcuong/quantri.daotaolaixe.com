<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;


class SaleRequest extends FormRequest
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
        $id = $this->route('sale');
        return [
            'user_id' => 'required|exists:users,id',
            'dated_at' => 'required',
            'fullname' => 'required',
            'address' => 'required',
            'phone' => 'required',
            'sales.*.code' => ['required', 'exists:pigs,code', new \App\Rules\SaleUniqueCode, new \App\Rules\SaleUniqueTypeCenterRule($id)],
            'sales.*.total' => 'required|integer|min:1',
            'sales.*.weight' => 'required|numeric|min:0',
        ];
    }

    public function messages()
    {
        return [
            'user_id.required' => 'Vui lòng chọn tên',
            'user_id.exists' => 'Kỹ thuật không tồn tại',
            'dated_at.required' => 'Vui lòng chọn ngày xuất bán',
            'fullname.required' => 'Vui lòng nhập người mua',
            'address.required' => 'Vui lòng nhập địa chỉ',
            'phone.required' => 'Vui lòng nhập SĐT',
            'sales.*.code.required' => 'Vui lòng chọn Mã đàn/Mã tai',
            'sales.*.total.required' => 'Vui lòng nhập số lượng',
            'sales.*.total.integer' => 'Số lượng phải là kiểu số nguyên',
            'sales.*.total.min' => 'Số lượng không được bé hơn :min',
            'sales.*.weight.required' => 'Vui lòng nhập trọng lượng',
            'sales.*.weight.numeric' => 'Trọng lượng phải là kiểu số',
            'sales.*.weight.min' => 'Trọng lượng không được bé hơn :min',
        ];
    }
}
