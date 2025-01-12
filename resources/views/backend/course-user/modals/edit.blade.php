<!-- Modal edit -->
<div class="modal fade" id="modal-course-user-edit-ajax" tabindex="-1" aria-labelledby="modal-course-user-edit-ajaxLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-scrollable">
        <form class="row g-3 needs-validation form-submit-ajax" method="POST"
            action="{{ route('admins.course-user.update', $courseUser->id) }}" data-reload="#load-data-ajax-course-user">
            @csrf
            @method('PUT')
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modal-course-user-edit-ajaxLabel">Sửa khóa học</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label for="user_id">Chọn học viên</label>
                            <select name="user_id" id="user_id" class="form-control single-select">
                                @foreach ($users as $user)
                                <option value="{{ $user->id }}" {{ $user->id == old('user_id', $courseUser->user_id) ?
                                    'selected' : '' }}>{{ $user->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="course_id">Chọn khóa học</label>
                            <select name="course_id" id="course_id" class="form-control single-select">
                                @foreach ($courses as $course)
                                <option value="{{ $course->id }}" {{ $course->id == old('course_id',
                                    $courseUser->course_id) ? 'selected' : '' }}>{{ $course->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="basic_status">Cơ bản</label>
                            <select name="basic_status" id="basic_status" class="form-control">
                                @foreach (listStatusCourseUser() as $key => $item)
                                <option value="{{ $key }}" {{ old('basic_status', $courseUser->basic_status)==$key ?
                                    'selected' : '' }}>{{ $item
                                    }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="shape_status">Sa hình</label>
                            <select name="shape_status" id="shape_status" class="form-control">
                                @foreach (listStatusCourseUser() as $key => $item)
                                <option value="{{ $key }}" {{ old('shape_status', $courseUser->shape_status)==$key ?
                                    'selected' : '' }}>{{ $item
                                    }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="road_status">Đường trường</label>
                            <select name="road_status" id="road_status" class="form-control">
                                @foreach (listStatusCourseUser() as $key => $item)
                                <option value="{{ $key }}" {{ old('road_status', $courseUser->road_status)==$key ?
                                    'selected' : '' }}>{{ $item
                                    }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="chip_status">Xe chíp</label>
                            <select name="chip_status" id="chip_status" class="form-control">
                                @foreach (listStatusCourseUser() as $key => $item)
                                <option value="{{ $key }}" {{ old('chip_status', $courseUser->chip_status)==$key ?
                                    'selected' : '' }}>{{ $item
                                    }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="hours">Giờ</label>
                            <input type="number" name="hours" id="hours" class="form-control" value="{{ old('hours', $courseUser->hours) }}" />
                        </div>
                        <div class="form-group col-md-6">
                            <label for="km">Km</label>
                            <input type="number" name="km" id="km" class="form-control" value="{{ old('km', $courseUser->km) }}" />
                        </div>
                        <div class="form-group col-md-6">
                            <label for="status">Trạng thái</label>
                            <select name="status" id="status" class="form-control" required>
                                @foreach (listStatus() as $key => $item)
                                <option value="{{ $key }}" {{ old('status', $courseUser->status)==$key ? 'selected' : ''
                                    }}>{{ $item }}
                                </option>
                                @endforeach
                            </select>
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
