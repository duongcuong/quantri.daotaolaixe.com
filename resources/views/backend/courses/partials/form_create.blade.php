<div class="col-md-6 mb-3">
    <label for="code" class="form-label">Mã khóa học</label>
    <input type="text" name="code" id="code" class="form-control" required>
</div>
<div class="col-md-6 mb-3">
    <label for="rank" class="form-label">Hạng</label>
    <select name="rank" id="rank" class="form-control single-select">
        @foreach (listRanks() as $key => $value)
        <option value="{{ $key }}" {{ $key==old('rank') ? 'selected' : '' }}>{{ $value }}
        </option>
        @endforeach
    </select>
</div>
<div class="col-md-6 mb-3">
    <label for="rank_gp" class="form-label">Hạng GP</label>
    <select name="rank_gp" id="rank_gp" class="form-control single-select">
        @foreach (listRanks() as $key => $value)
        <option value="{{ $key }}" {{ $key==old('rank_gp') ? 'selected' : '' }}>{{ $value }}
        </option>
        @endforeach
    </select>
</div>
<div class="col-md-6 mb-3">
    <label for="number_bc" class="form-label">Số BC</label>
    <input type="text" name="number_bc" id="number_bc" class="form-control" required>
</div>
<div class="col-md-6 mb-3">
    <label for="date_bci" class="form-label">Ngày BCI</label>
    <input type="date" name="date_bci" id="date_bci" class="form-control" required>
</div>
<div class="col-md-6 mb-3">
    <label for="start_date" class="form-label">Ngày bắt đầu</label>
    <input type="date" name="start_date" id="start_date" class="form-control" required>
</div>
<div class="col-md-6 mb-3">
    <label for="end_date" class="form-label">Ngày kết thúc</label>
    <input type="date" name="end_date" id="end_date" class="form-control" required>
</div>
<div class="col-md-6 mb-3">
    <label for="tuition_fee" class="form-label">Học phí</label>
    <input type="number" name="tuition_fee" id="tuition_fee" class="form-control">
</div>
<div class="col-md-6 mb-3">
    <label for="number_students" class="form-label">Số học viên</label>
    <input type="number" name="number_students" id="number_students" class="form-control">
</div>
<div class="col-md-6 mb-3">
    <label for="decision_kg" class="form-label">Quyết định KG</label>
    <input type="text" name="decision_kg" id="decision_kg" class="form-control">
</div>
<div class="col-md-6 mb-3">
    <label for="duration" class="form-label">Thời gian</label>
    <input type="number" name="duration" id="duration" class="form-control">
</div>
