<!-- Modal edit -->
<div class="modal fade" id="modal-calendars-edit-ajax" tabindex="-1" aria-labelledby="modal-calendars-edit-ajaxLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-scrollable">
        <form class="row g-3 needs-validation form-submit-ajax" method="POST"
            action="{{ route('admins.calendars.update', $calendar->id) }}" data-reload="#{{ request()->reload ?? 'load-data-ajax-calendars' }}">
            @csrf
            @method('PUT')
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modal-calendars-edit-ajaxLabel">Chỉnh sửa lịch</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-8">
                            <div class="row">

                                <input type="hidden" name="type" value="{{ $calendar->type }}" class="type-calendars">
                                <div class="form-group col-md-12">
                                    <label for="name">Tên sự kiện <span class="text-danger">*</span></label>
                                    <input type="text" name="name" id="name" class="form-control"
                                        value="{{ old('name', $calendar->name) }}" required>
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="date_start">Thời gian bắt đầu<span class="text-danger">*</span></label>
                                    <input type="datetime-local" name="date_start" id="date_start" class="form-control"
                                        value="{{ old('date_start', $calendar->date_start) }}" required>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="date_end">Thời gian kết thúc<span class="text-danger">*</span></label>
                                    <input type="datetime-local" name="date_end" id="date_end" class="form-control"
                                        value="{{ old('date_end', $calendar->date_end) }}" required>
                                </div>
                                {{-- <div class="form-group col-md-6">
                                    <label for="duration">Thời lượng (phút)</label>
                                    <select name="duration" id="duration" class="form-control" required>
                                        @foreach (listDurations() as $key => $item)
                                        <option value="{{ $key }}" {{ $key==old('duration', $calendar->duration) ?
                                            'selected' : '' }}>{{ $item }}</option>
                                        @endforeach
                                    </select>
                                </div> --}}

                            </div>
                            @if ($calendar->type == 'class_schedule')
                            <div class="border radius-10 p-15 mb-3">
                                <div class="row">
                                    @foreach (listLoaiHocs() as $key => $item)
                                    <div class="col-md-4">
                                        <div class="form-check">
                                            <input class="form-check-input" name="loai_hoc" type="radio"
                                                value="{{ $key }}" id="flexCheckChecked{{ $key }}" {{
                                                $key==old('loai_hoc', $calendar->loai_hoc) ? 'checked' : '' }}>
                                            <label class="form-check-label" for="flexCheckChecked{{ $key }}">{{ $item
                                                }}</label>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                            <div id="show-select-dat"
                            style="display: {{ $calendar->loai_hoc == 'chay_dat' ? 'block' : 'none' }};" class="border radius-10 p-15 mb-3">
                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label for="km">Km</label>
                                        <input type="text" name="km" id="km" class="form-control"
                                            value="{{ $calendar->km }}" />
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="so_gio_chay_duoc">Số giờ chạy được</label>
                                        <input type="text" name="so_gio_chay_duoc" id="so_gio_chay_duoc"
                                            class="form-control"
                                            value="{{ old('so_gio_chay_duoc', $calendar->so_gio_chay_duoc) }}"
                                            placeholder="HH:MM">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-12">
                                    <label for="diem_don">Điểm đón</label>
                                    <textarea name="diem_don" id="diem_don"
                                        class="form-control">{{ $calendar->diem_don }}</textarea>
                                </div>
                            </div>
                            @endif
                            @if ($calendar->type == 'exam_schedule')
                            <div class="border radius-10 p-15 mb-3">
                                <div class="row">
                                    @foreach (listLoaiThis() as $key => $item)
                                    <div class="col-md-6">
                                        <div class="form-check">
                                            <input class="form-check-input" name="loai_thi[]" type="checkbox"
                                                value="{{ $key }}" id="flexCheckChecked{{ $key }}" {{ in_array($key,
                                                $calendar->loai_thi) ? 'checked' : '' }}>
                                            <label class="form-check-label" for="flexCheckChecked{{ $key }}">{{ $item
                                                }}</label>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label for="ngay_dong_hoc_phi">Ngày đóng lệ phí</label>
                                    <input type="datetime-local" name="ngay_dong_hoc_phi" id="ngay_dong_hoc_phi"
                                        class="form-control"
                                        value="{{ old('ngay_dong_hoc_phi', $calendar->ngay_dong_hoc_phi) }}">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="tuition_fee">Số tiền</label>
                                    <input type="number" name="tuition_fee" id="tuition_fee" class="form-control"
                                        value="{{ old('tuition_fee', $calendar->tuition_fee) }}" />
                                </div>
                            </div>
                            @endif
                            @if ($calendar->type == 'class_schedule'|| $calendar->type == 'exam_schedule')
                            <div class="row">
                                <div class="form-group col-md-12">
                                    <label for="exam_field_id" class="d-flex justify-content-between">
                                        <span>Sân</span>
                                        <a href="{{ route('admins.exam-fields.index') }}" title="Thêm mới"
                                            target="_blank"><i class="bx bx-plus"></i>Thêm sân thi</a>
                                    </label>
                                    <select class="select2-ajax-single form-control" name="exam_field_id"
                                        data-selected-id="{{ $calendar->exam_field_id }}" data-placeholder="Chọn sân"
                                        data-url="{{ route('admins.exam-fields.list') }}">
                                    </select>
                                </div>
                            </div>
                            @endif

                            <div class="row">

                                <div class="form-group col-md-6">
                                    <label for="priority">Độ ưu tiên</label>
                                    <select name="priority" id="priority" class="form-control" required>
                                        @foreach (listPriorities() as $key => $item)
                                        <option value="{{ $key }}" {{ $key==old('priority', $calendar->priority) ?
                                            'selected' : '' }}>{{ $item }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="status">Trạng thái</label>
                                    <select name="status" id="status-calendar" class="form-control status-calendar"
                                        required>
                                        @php
                                        $listStatusCalendars = listStatusCalendars();
                                        $listStatusCalendars = $listStatusCalendars[$calendar->type] ?? [];
                                        @endphp
                                        @foreach ($listStatusCalendars as $key => $item)
                                        <option value="{{ $key }}" {{ $key==old('status', $calendar->status) ?
                                            'selected' : '' }}>
                                            {{ $item }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                @if ($calendar->status == STATUS_CALENDAR_CANCEL)
                                <div class="form-group col-md-12 reason-cancel" id="reason-cancel">
                                    <label for="reason">Lý do huỷ ca</label>
                                    <textarea name="reason" id="reason"
                                        class="form-control">{{ $calendar->reason }}</textarea>
                                </div>
                                @endif
                                <div class="form-group col-md-12">
                                    <label for="description">Mô tả</label>
                                    <textarea name="description" id="description"
                                        class="form-control">{{ old('description', $calendar->description) }}</textarea>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            @if ($calendar->type == 'task' || $calendar->type == 'call' || $calendar->type == 'meeting')
                            <div class="form-group">
                                <label for="admin_id">Người phụ trách (Admin)</label>
                                <select class="select2-ajax-single form-control" name="admin_id"
                                    data-placeholder="Chọn người phụ trách" data-url="{{ route('admins.admins.list') }}"
                                    data-selected-id="{{ old('admin_id', $calendar->admin_id) }}">
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="lead_id">Lead</label>
                                <select class="select2-ajax-single form-control" name="lead_id"
                                    data-placeholder="Chọn lead" data-url="{{ route('admins.leads.list') }}"
                                    data-selected-id="{{ old('lead_id', $calendar->lead_id) }}">
                                </select>
                            </div>
                            @endif

                            @if ($calendar->type == 'class_schedule')
                            <div class="form-group">
                                <label for="teacher_id">Giáo viên</label>
                                <select class="select2-ajax-single form-control" name="teacher_id"
                                    data-placeholder="Chọn người phụ trách"
                                    data-url="{{ route('admins.admins.list', ['role' => ROLE_TEACHER]) }}"
                                    data-selected-id="{{ $calendar->teacher_id }}">
                                </select>
                            </div>
                            @endif

                            {{-- @if ($calendar->type == 'class_schedule')
                            <div class="form-group">
                                <label for="user_id">Học viên</label>
                                <select class="select2-ajax-single form-control" name="user_id"
                                    data-placeholder="Chọn học viên" data-url="{{ route('admins.users.list') }}"
                                    data-selected-id="{{ old('user_id', $calendar->user_id) }}">
                                </select>
                            </div>
                            @endif --}}

                            @if ($calendar->type == 'class_schedule' || $calendar->type == 'exam_schedule')
                            <div class="form-group">
                                <label for="course_user_id">Học viên khóa học</label>
                                <select class="select2-ajax-single form-control" name="course_user_id"
                                    data-placeholder="Chọn học viên khóa học"
                                    data-url="{{ route('admins.course-user.list') }}"
                                    data-selected-id="{{ old('course_user_id', $calendar->course_user_id) }}">
                                </select>
                            </div>
                            @endif
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
                        Cập nhật
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
