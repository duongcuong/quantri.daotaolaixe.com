<!-- Modal edit -->
<div class="modal fade" id="modal-calendars-tot-nghiep-edit-ajax" tabindex="-1" aria-labelledby="modal-calendars-tot-nghiep-edit-ajaxLabel"
    aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-lg modal-dialog-scrollable">
        <form class="row g-3 needs-validation form-submit-ajax" method="POST"
            action="{{ route('admins.calendars.update', $calendar->id) }}"
            data-reload="#{{ request()->reload ?? 'load-data-ajax-calendars' }}">
            @csrf
            @method('PUT')
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modal-calendars-tot-nghiep-edit-ajaxLabel">Chỉnh sửa lịch</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-8">
                            <input type="hidden" value="{{ $calendar->name }}" name="name">
                            <input type="hidden" name="type" value="{{ $calendar->type }}" class="type-calendars">
                            <div class="row mb-3">
                                <div class="form-group col-md-6">
                                    <label for="name">Chọn thời gian <span class="text-danger">*</span></label>
                                    <select class="form-control" required name="date_start" id="date_start">
                                        <option>Chọn thời gian</option>
                                        <option value="{{ getDateTimeStamp($calendar->date_start, 'Y-m-d') . " 07:00:00" }}" {{ \Carbon\Carbon::parse($calendar->date_start)->hour < 13 ? 'selected' : '' }}>Sáng</option>
                                        <option value="{{ getDateTimeStamp($calendar->date_start, 'Y-m-d') . " 13:00:00" }}" {{ \Carbon\Carbon::parse($calendar->date_start)->hour >= 13 ? 'selected' : '' }}>Chiều</option>
                                    </select>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="exam_attempts">Lần thi <span class="text-danger">*</span></label>
                                    <select class="form-control" required name="exam_attempts" id="exam_attempts">
                                        @foreach (listLans() as $key => $item)
                                        <option value="{{ $key }}" {{ $calendar->exam_attempts == $key ? 'selected' : '' }}>{{ $item }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="border radius-10 p-15 mb-3">
                                <div class="row">
                                    @foreach (listLoaiThis() as $key => $item)
                                    <div class="col-md-6">
                                        <div class="form-check">
                                            <input class="form-check-input" name="loai_thi[]" type="checkbox"
                                                value="{{ $key }}" id="flexCheckChecked{{ $key }}" {{
                                                $calendar->loai_thi && in_array($key,
                                            $calendar->loai_thi) ? 'checked' : '' }}>
                                            <label class="form-check-label" for="flexCheckChecked{{ $key }}">{{ $item
                                                }}</label>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-3">
                                    <label for="sbd">SBD</label>
                                    <input type="number" name="sbd" id="sbd" class="form-control"
                                        value="{{ old('sbd', $calendar->sbd) }}" />
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="pickup_registered">Đăng ký</label>
                                    <div class="form-check">
                                        <input class="form-check-input" name="pickup_registered" type="checkbox"
                                            value="1" id="pickup_registered" {{ $calendar->pickup_registered ? 'checked'
                                        : '' }}>
                                        <label class="form-check-label" for="pickup_registered">Đăng ký đưa đón</label>
                                    </div>
                                </div>
                                {{-- <div class="form-group col-md-6">
                                    <label for="ngay_dong_hoc_phi">Ngày nộp tiền</label>
                                    <input type="datetime-local" name="ngay_dong_hoc_phi" id="ngay_dong_hoc_phi"
                                        class="form-control"
                                        value="{{ old('ngay_dong_hoc_phi', $calendar->ngay_dong_hoc_phi) }}">
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="tuition_fee">Số tiền</label>
                                    <input type="text" name="tuition_fee" id="tuition_fee"
                                        class="form-control thousand-text"
                                        value="{{ old('tuition_fee', $calendar->tuition_fee) }}" />
                                </div> --}}
                            </div>
                            <div class="row">
                                <div class="form-group col-md-12">
                                    <label for="exam_field_id" class="d-flex justify-content-between">
                                        <span>Sân</span>
                                        <a href="{{ route('admins.exam-fields.index') }}" title="Thêm mới"
                                            target="_blank"><i class="bx bx-plus"></i>Thêm sân</a>
                                    </label>
                                    <select name="exam_field_id" id="exam_field_id" class="form-control single-select"
                                        data-placeholder="Chọn sân" data-allow-clear="true">
                                        <option></option>
                                        @foreach ($examFields as $examField)
                                        <option value="{{ $examField->id }}" {{ $examField->id ==
                                            $calendar->exam_field_id ? 'selected' : '' }}> {{ $examField->name }}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="row">
                                <div class="form-group col-md-12">
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

                            <div class="form-group">
                                <label for="course_user_id">Học viên khóa học</label>
                                <select class="select2-ajax-single form-control select2-ajax-single-calendar"
                                    name="course_user_id" data-placeholder="Chọn học viên khóa học"
                                    data-url="{{ route('admins.course-user.list') }}"
                                    data-selected-id="{{ old('course_user_id', $calendar->course_user_id) }}">
                                </select>
                            </div>
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
