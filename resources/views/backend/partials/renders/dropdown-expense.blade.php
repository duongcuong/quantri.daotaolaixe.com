<option selected="" value="">Chọn tên chi phí</option>
@foreach ($settingExpenses as $key => $settingExpense)
    <option value="{{ $settingExpense->id }}"
        {{ request('setting_expense_id') == $settingExpense->id ? 'selected' : '' }}>{{ $settingExpense->name }}
    </option>
@endforeach
