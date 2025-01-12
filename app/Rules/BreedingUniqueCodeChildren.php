<?php

namespace App\Rules;

use App\Models\Breeding;
use Illuminate\Contracts\Validation\Rule;

class BreedingUniqueCodeChildren implements Rule
{
    protected $id;
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($id)
    {
        $this->id = $id; 
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        // Kiểm tra xem mã code đã tồn tại và có type là 'abc' hay không
        $query = Breeding::join('pigs', 'pigs.breeding_id', '=', 'breedings.id')
            ->where('pig_type', PIG_BREED)
            ->where('pigs.code', $value);
        if($this->id > 0){
            $query->where('breedings.id', '!=', $this->id);
        }
        $exists = $query->exists();

        // Trả về true nếu điều kiện được thỏa mãn, ngược lại trả về false
        return !$exists;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Mã số đàn con đã tồn tại, vui lòng chọn mã số đàn con khác';
    }
}
