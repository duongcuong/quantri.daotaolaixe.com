<!-- Modal edit -->
<div class="modal fade" id="modal-courses-edit-ajax" tabindex="-1" aria-labelledby="modal-courses-edit-ajax" data-modal aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-scrollable">
        <form class="row g-3 needs-validation form-submit-ajax" method="POST" action="{{ route('admins.courses.update', $course->id) }}" data-reload="#load-data-ajax-courses">
            @csrf
            @method('PUT')
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modal-courses-edit-ajax">Sửa khóa học</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="code" class="form-label">Mã khóa học</label>
                            <input type="text" name="code" id="code" class="form-control" value="{{ $course->code }}" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="rank" class="form-label">Hạng</label>
                            <select name="rank" id="rank" class="form-control single-select">
                                @foreach (listRanks() as $key => $value)
                                    <option value="{{ $key }}" {{ $key == old('rank', $course->rank) ? 'selected' : '' }}>{{ $value }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="rank_gp" class="form-label">Hạng GP</label>
                            <select name="rank_gp" id="rank_gp" class="form-control single-select">
                                @foreach (listRanks() as $key => $value)
                                    <option value="{{ $key }}" {{ $key == old('rank_gp', $course->rank_gp) ? 'selected' : '' }}>{{ $value }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="number_bc" class="form-label">Số BC</label>
                            <input type="text" name="number_bc" id="number_bc" class="form-control" value="{{ $course->number_bc }}" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="date_bci" class="form-label">Ngày BCI</label>
                            <input type="date" name="date_bci" id="date_bci" class="form-control" value="{{ \Carbon\Carbon::parse($course->date_bci)->format('Y-m-d') }}" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="start_date" class="form-label">Ngày bắt đầu</label>
                            <input type="date" name="start_date" id="start_date" class="form-control" value="{{ \Carbon\Carbon::parse($course->start_date)->format('Y-m-d') }}" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="end_date" class="form-label">Ngày kết thúc</label>
                            <input type="date" name="end_date" id="end_date" class="form-control" value="{{ \Carbon\Carbon::parse($course->end_date)->format('Y-m-d') }}" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="tuition_fee" class="form-label">Học phí</label>
                            <input type="number" name="tuition_fee" id="tuition_fee" class="form-control" value="{{ old('tuition_fee', $course->tuition_fee) }}">
                        </div>
                        {{-- <div class="col-md-6 mb-3">
                            <label for="number_students" class="form-label">Số lượng học viên</label>
                            <input type="number" name="number_students" id="number_students" class="form-control" value="{{ $course->number_students }}">
                        </div> --}}
                        <div class="col-md-6 mb-3">
                            <label for="decision_kg" class="form-label">Quyết định KG</label>
                            <input type="text" name="decision_kg" id="decision_kg" class="form-control" value="{{ $course->decision_kg }}">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="duration" class="form-label">Thời lượng</label>
                            <input type="number" name="duration" id="duration" class="form-control" value="{{ $course->duration }}">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light px-5 mr-2" data-dismiss="modal">
                        <i class="bx bx-window-close me-1"></i>
                        Hủy
                    </button>
                    <button type="submit" class="btn btn-primary px-5">
                        <i class="bx bx-save me-1"></i>
                        Lưu
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
