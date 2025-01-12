<?php

namespace App\Rules;

use App\Models\Pig;
use Illuminate\Contracts\Validation\Rule;

class SaleUniqueTypeCenterRule implements Rule
{
    protected $id;
    public function __construct($id = null){
        $this->id = $id; 
    }
    public function passes($attribute, $value)
    {
        // Kiểm tra xem mã code đã tồn tại và có type là 'abc' hay không
        $query = Pig::join('sales', 'pigs.id', '=', 'sales.pig_id')
            ->where('pig_type', PIG_CENTER)
            ->where('pigs.code', $value);
        if($this->id > 0){
            $query->where('sales.id', '!=', $this->id);
        }
        $exists = $query->exists();

        // Trả về true nếu điều kiện được thỏa mãn, ngược lại trả về false
        return !$exists;

    }

    public function message()
    {
        // Định nghĩa thông báo lỗi tùy chỉnh
        return 'Mã tai đã được bán, vui lòng chọn mã tai khác';
    }
}