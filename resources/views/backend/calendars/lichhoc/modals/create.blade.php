<!-- Modal add -->
<div class="modal fade" id="modal-calendars-lich-hoc-create-ajax" aria-labelledby="modal-calendars-lich-hoc-create-ajaxLabel"
    aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-lg modal-dialog-scrollable">
        <form class="row g-3 needs-validation form-submit-ajax" method="POST"
            action="{{ route('admins.calendars.store') }}"
            data-reload="#{{ request()->reload ?? 'load-data-ajax-calendars'}}">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modal-calendars-lich-hoc-create-ajaxLabel">Thêm {!!
                        getTypeCalendar(request()->type) !!}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-8">
                            <div class="row">
                                <input type="hidden" name="type" value="{{ request()->type }}" class="type-calendars">
                                <div class="form-group col-md-12">
                                    <label for="name">Tên sự kiện <span class="text-danger">*</span></label>
                                    <input type="text" name="name" id="name" class="form-control" required>
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="date_start">Thời gian bắt đầu<span class="text-danger">*</span></label>
                                    <input type="datetime-local" name="date_start" id="date_start" class="form-control" value="{{ request()->date_start . date(' H:i:s') }}"
                                        required>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="date_end">Thời gian kết thúc<span class="text-danger">*</span></label>
                                    <input type="datetime-local" name="date_end" id="date_end" class="form-control" value="{{ request()->date_start . date(' H:i:s') }}"
                                        required>
                                </div>
                            </div>

                            <div class="border radius-10 p-15 mb-3">
                                <div class="row">
                                    @foreach (listLoaiHoc2s() as $key => $item)
                                    <div class="col-md-4">
                                        <div class="form-check">
                                            <input class="form-check-input" name="loai_hoc" type="radio"
                                                value="{{ $key }}" id="flexCheckChecked{{ $key }}">
                                            <label class="form-check-label" for="flexCheckChecked{{ $key }}">{{ $item
                                                }}</label>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                            <div class="border radius-10 p-15 mb-3" id="show-select-dat" style="display: none;">
                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label for="km">Km</label>
                                        <input type="text" name="km" id="km" class="form-control"
                                            value="{{ old('km', 0) }}" />
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="so_gio_chay_duoc">Số giờ chạy được</label>
                                        <input type="text" name="so_gio_chay_duoc" id="so_gio_chay_duoc"
                                            class="form-control cs-time-picker" placeholder="HH:MM">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <div class="custom-control custom-checkbox">
                                            <input name="is_tudong" value="1" type="checkbox"
                                                class="custom-control-input" id="is_tudong">
                                            <label class="custom-control-label" for="is_tudong">Học tự động</label>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" value="1" class="custom-control-input"
                                                id="is_bandem">
                                            <label class="custom-control-label" for="is_bandem">Học ban đêm</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-12">
                                    <label for="diem_don">Điểm đón</label>
                                    <textarea name="diem_don" id="diem_don"
                                        class="form-control">{{ old('diem_don') }}</textarea>
                                </div>
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
                                        <option value="{{ $examField->id }}"> {{ $examField->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="row">
                                <div class="form-group col-md-12">
                                    <label for="status">Trạng thái</label>
                                    <select name="status" id="status-calendar" class="form-control status-calendar"
                                        required>
                                        @foreach (listStatusCalendars()[request()->type] as $key => $item)
                                        <option value="{{ $key }}">{{ $item }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group col-md-12 reason-cancel" id="reason-cancel"
                                    style="display: none;">
                                    <label for="reason">Lý do huỷ ca</label>
                                    <textarea name="reason" id="reason" class="form-control"></textarea>
                                </div>

                                <div class="form-group col-md-12">
                                    <label for="description">Mô tả</label>
                                    <textarea name="description" id="description" class="form-control"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">

                            <div class="form-group">
                                <label for="teacher_id">Giáo viên</label>
                                <select class="select2-ajax-single-all form-control" name="teacher_id"
                                    data-placeholder="Chọn giáo viên"
                                    data-url="{{ route('admins.admins.lists', ['role' => ROLE_TEACHER]) }}"
                                    data-selected-id="{{ request()->teacher_id }}">
                                    <option></option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="course_user_id">Học viên khóa học</label>
                                <select multiple class="select2-ajax-single form-control select2-ajax-single-calendar"
                                    name="course_user_id[]" data-placeholder="Chọn học viên khóa học"
                                    data-url="{{ route('admins.course-user.list') }}"
                                    data-selected-id="{{ request()->course_user_id }}">
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="course_user_id">Chọn xe</label>
                                <select class="select2-ajax-single-all form-control" name="vehicle_id"
                                    data-placeholder="Chọn xe" data-url="{{ route('admins.vehicles.list') }}"
                                    data-selected-id="">
                                    <option></option>
                                </select>
                            </div>

                            @if (Auth::guard('admin')->user()->hasPermission('admins.calendars.approval'))
                            <div class="custom-control custom-switch cs-approval" style="display: none">
                                <input type="checkbox" class="custom-control-input" id="customSwitch1" name="approval">
                                <label class="custom-control-label" for="customSwitch1">Duyệt số Km này</label>
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
                        Lưu
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
