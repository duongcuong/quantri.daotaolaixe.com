<!-- Modal add -->
<form class="row g-3 needs-validation form-submit-ajax-convert-lead" method="POST" action="{{ route('admins.leads.convert_list') }}">
    @csrf
    <div class="modal fade" id="modal-leads-convert-ajax" tabindex="-1" aria-labelledby="modal-leads-convert-ajaxLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modal-leads-convert-ajaxLabel">Chuyển sang Học viên - Khoá học</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="card radius-15">
                                <div class="card-body">
                                    <h5 class="card-title">Thông tin học viên</h5>
                                    <div class="form-group">
                                        <select class="form-control select-option-type-user-lead" name="select_lead_user_type" required>
                                            <option value="">Vui lòng chọn</option>
                                            <option value="1">Chọn học viên cũ</option>
                                            <option value="2">Tạo học viên mới</option>
                                        </select>
                                    </div>

                                    <div class="box-lead-exist-user" style="display: none">
                                        <div class="form-group">
                                            <label for="user_id">Chọn học viên</label>
                                            <select class="select2-ajax-single form-control" name="users[user_id]"
                                                data-selected-id="{{ $lead->user_id }}" data-placeholder="Chọn học viên"
                                                data-url="{{ route('admins.users.list') }}">
                                            </select>
                                        </div>
                                    </div>

                                    <div class="box-lead-not-user" style="display: none">
                                        <div class="row">
                                            <div class="form-group col-md-6">
                                                <label for="name">Họ tên</label>
                                                <input type="text" name="users[name]" id="name" class="form-control" value="{{ old('name', $lead->name) }}"
                                                    required>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="email">Email</label>
                                                <input type="email" name="users[email]" id="email" class="form-control" value="{{ old('email', $lead->email) }}">
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="phone">SĐT</label>
                                                <input type="text" name="users[phone]" id="phone" class="form-control" value="{{ old('phone', $lead->phone) }}">
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="address">Địa chỉ</label>
                                                <input type="text" name="users[address]" id="address" class="form-control"
                                                    value="{{ old('address', $lead->address) }}">
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="dob">Ngày sinh</label>
                                                <input type="date" name="users[dob]" id="dob" class="form-control" value="{{ old('dob', getDateTimeStamp($lead->dob)) }}">
                                            </div>
                                        </div>
                                    </div>


                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card radius-15">
                                <div class="card-body">
                                    <h5 class="card-title">Thông tin khoá học</h5>
                                    <div class="form-group">
                                        <select class="form-control select-option-type-course-lead" name="select_lead_course_type" required>
                                            <option value="">Vui lòng chọn</option>
                                            <option value="1">Chọn khoá học đã có</option>
                                            <option value="2">Tạo khoá học mới</option>
                                        </select>
                                    </div>

                                    <div class="box-lead-exist-course" style="display: none">
                                        <div class="form-group">
                                            <label for="course_id">Chọn khoá học</label>
                                            <select class="select2-ajax-single form-control" name="courses[course_id]"
                                                data-selected-id="" data-placeholder="Chọn khoá học"
                                                data-url="{{ route('admins.courses.list') }}">
                                            </select>
                                        </div>
                                    </div>

                                    <div class="box-lead-not-course" style="display: none">
                                        <div class="row">
                                            <div class="col-md-6 mb-3">
                                                <label for="code" class="form-label">Mã khóa học</label>
                                                <input type="text" name="courses[code]" id="code" class="form-control" required>
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label for="rank" class="form-label">Hạng</label>
                                                <select name="courses[rank]" id="rank" class="form-control single-select">
                                                    @foreach (listRanks() as $key => $value)
                                                    <option value="{{ $key }}" {{ $key==old('rank') ? 'selected' : '' }}>{{ $value }}
                                                    </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label for="rank_gp" class="form-label">Hạng GP</label>
                                                <select name="courses[rank_gp]" id="rank_gp" class="form-control single-select">
                                                    @foreach (listRanks() as $key => $value)
                                                    <option value="{{ $key }}" {{ $key==old('rank_gp') ? 'selected' : '' }}>{{ $value }}
                                                    </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label for="number_bc" class="form-label">Số BC</label>
                                                <input type="text" name="courses[number_bc]" id="number_bc" class="form-control">
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label for="date_bci" class="form-label">Ngày BCI</label>
                                                <input type="date" name="courses[date_bci]" id="date_bci" class="form-control">
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label for="start_date" class="form-label">Ngày bắt đầu</label>
                                                <input type="date" name="courses[start_date]" id="start_date" class="form-control" required>
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label for="end_date" class="form-label">Ngày kết thúc</label>
                                                <input type="date" name="courses[end_date]" id="end_date" class="form-control">
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label for="tuition_fee" class="form-label">Học phí</label>
                                                <input type="number" name="courses[tuition_fee]" id="tuition_fee" class="form-control">
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label for="number_students" class="form-label">Số học viên</label>
                                                <input type="number" name="courses[number_students]" id="number_students" class="form-control">
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label for="decision_kg" class="form-label">Quyết định KG</label>
                                                <input type="text" name="courses[decision_kg]" id="decision_kg" class="form-control">
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label for="duration" class="form-label">Thời gian</label>
                                                <input type="number" name="courses[duration]" id="duration" class="form-control">
                                            </div>
                                        </div>
                                    </div>


                                </div>
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
        </div>
    </div>
</form>
