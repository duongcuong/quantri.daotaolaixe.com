<!-- Modal add -->
<div class="modal fade" id="modal-calendars-ly-thuyet-create-ajax" aria-labelledby="modal-calendars-ly-thuyet-create-ajaxLabel"
    aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-lg modal-dialog-scrollable">
        <form class="row g-3 needs-validation form-submit-ajax" method="POST"
            action="{{ route('admins.calendars.store') }}"
            data-reload="#{{ request()->reload ?? 'load-data-ajax-calendars'}}">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modal-calendars-ly-thuyet-create-ajaxLabel">Thêm {!!
                        getTypeCalendar(request()->type) !!}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-8">
                            <input type="hidden" value="{{ getTypeTextCalendar(request()->type) }}" name="name">
                            <input type="hidden" name="type" value="{{ request()->type }}" class="type-calendars">
                            <div class="row mb-3">
                                @if(!request()->date_start)
                                <div class="form-group col">
                                    <label for="date_start">Chọn ngày <span class="text-danger">*</span></label>
                                    <input type="date" class="form-control date_start_change" required>
                                </div>
                                @endif
                                <div class="form-group col">
                                    <label for="name">Chọn thời gian <span class="text-danger">*</span></label>
                                    <select class="form-control" required name="date_start" id="date_start">
                                        <option>Chọn thời gian</option>
                                        <option value="{{ request()->date_start . " 07:00:00" }}">Sáng</option>
                                        <option value="{{ request()->date_start . " 13:00:00" }}">Chiều</option>
                                    </select>
                                </div>
                                <div class="form-group col">
                                    <label for="exam_attempts">Lần thi <span class="text-danger">*</span></label>
                                    <select class="form-control" required name="exam_attempts" id="exam_attempts">
                                        @foreach (listLans() as $key => $item)
                                        <option value="{{ $key }}">{{ $item }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="border radius-10 p-15 mb-3">
                                <div class="row">
                                    @php
                                    $listLoaiThis = listLoaiThis();
                                    if(request()->type == 'lythuyet'){
                                        $listLoaiThis = listLoaiThiLyThuyets();
                                    }elseif(request()->type == 'thuchanh'){
                                        $listLoaiThis = listLoaiThiThucHanhs();
                                    }
                                    @endphp
                                    @foreach ($listLoaiThis as $key => $item)
                                    <div class="col-md-6">
                                        <div class="form-check">
                                            <input class="form-check-input" name="loai_thi[]" type="checkbox"
                                                value="{{ $key }}" id="flexCheckChecked{{ $key }}" {{ request()->type == 'lythuyet' || request()->type == 'thuchanh' ? 'checked' : '' }}>
                                            <label class="form-check-label" for="flexCheckChecked{{ $key }}">{{ $item
                                                }}</label>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label for="sbd">SBD</label>
                                    <input type="number" name="sbd" id="sbd" class="form-control">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="pickup_registered">Đăng ký</label>
                                    <div class="form-check">
                                        <input class="form-check-input" name="pickup_registered" type="checkbox"
                                            value="1" id="pickup_registered">
                                        <label class="form-check-label" for="pickup_registered">Đăng ký đưa đón</label>
                                    </div>
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

                                @if (request()->type == 'class_schedule')
                                <div class="form-group col-md-12 reason-cancel" id="reason-cancel"
                                    style="display: none;">
                                    <label for="reason">Lý do huỷ ca</label>
                                    <textarea name="reason" id="reason" class="form-control"></textarea>
                                </div>
                                @endif

                                <div class="form-group col-md-12">
                                    <label for="description">Mô tả</label>
                                    <textarea name="description" id="description" class="form-control"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="course_user_id">Học viên khóa học</label>
                                <select multiple class="select2-ajax-single form-control select2-ajax-single-calendar"
                                    name="course_user_id[]" data-placeholder="Chọn học viên khóa học"
                                    data-url="{{ route('admins.course-user.list') }}"
                                    data-selected-id="{{ request()->course_user_id }}">
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
                        Lưu
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
