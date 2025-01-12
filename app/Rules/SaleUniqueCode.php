<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class SaleUniqueCode implements Rule
{
    public function passes($attribute, $value)
    {
        $salesCodes = request()->input('sales.*.code');

        // Kiểm tra giá trị của các trường nhập liệu không trùng nhau
        return count($salesCodes) === count(array_unique($salesCodes));
    }

    public function message()
    {
        return 'Trường mã đàn hoặc số tai không được trùng nhau.';
    }
}