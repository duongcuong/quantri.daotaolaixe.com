<div class="container-fluid p-0">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex">
                        <h5>Lịch học</strong>
                        </h5>
                        <div class="ml-auto">
                            {{-- @if (Auth::user()->hasPermission('admins.course-user.index')) --}}
                            <a class="btn btn-outline-primary btn-sm btn-create-ajax" href="{{ route('admins.calendars.create', ['course_user_id' => $courseUser->id, 'type' => 'class_schedule']) }}" data-cs-modal="#modal-calendars-create-ajax" title="Thêm mới"><i
                                    class="bx bx-plus"></i>Thêm mới</a>
                            {{-- @endif --}}
                        </div>
                    </div>
                    <form data-reload="#load-data-ajax-calendars" id="search-form-calendars" class="mb-3 form-search-submit">
                        <div class="row">
                            <input type="hidden" value="{{ $courseUser->id }}" name="course_user_id">
                        </div>
                    </form>
                    <div id="load-data-ajax-calendars" class="table-responsive mt-1 mb-1 load-data-ajax" data-search="#search-form-calendars" data-url="{{ route('admins.calendars.data', ['course_user_id' => $courseUser->id, 'type' => 'class_schedule', 'show_column' => 'name,date_start,date_end,name_hocvien,diem_don,san,course_code,loai_hoc,km']) }}">
                        <div class="loading-overlay">
                            <div class="loading-spinner"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
