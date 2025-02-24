<div class="form-group col-md-6">
    <label for="name">Họ tên</label>
    <input type="text" name="name" id="name" class="form-control" value="{{ old('name', $lead->name) }}"
        required>
</div>
<div class="form-group col-md-6">
    <label for="email">Email</label>
    <input type="email" name="email" id="email" class="form-control" value="{{ old('email', $lead->email) }}">
</div>
<div class="form-group col-md-6">
    <label for="phone">SĐT</label>
    <input type="text" name="phone" id="phone" class="form-control" value="{{ old('phone', $lead->phone) }}">
</div>
<div class="form-group col-md-6">
    <label for="address">Địa chỉ</label>
    <input type="text" name="address" id="address" class="form-control"
        value="{{ old('address', $lead->address) }}">
</div>
<div class="form-group col-md-6">
    <label for="dob">Ngày sinh</label>
    <input type="date" name="dob" id="dob" class="form-control" value="{{ old('dob', getDateTimeStamp($lead->dob)) }}">
</div>
