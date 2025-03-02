<div class="container-fluid p-0">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex">
                        <h5>Lịch thi</strong>
                        </h5>
                        <div class="ml-auto">
                            {{-- @if (Auth::user()->hasPermission('admins.course-user.index')) --}}
                            <a class="btn btn-outline-primary btn-sm btn-create-ajax" href="{{ route('admins.calendars.create', ['course_user_id' => $courseUser->id, 'type' => 'exam_schedule', 'reload' => 'load-data-ajax-exam-calendars']) }}" data-cs-modal="#modal-calendars-create-ajax" title="Thêm mới"><i
                                    class="bx bx-plus"></i>Thêm mới</a>
                            {{-- @endif --}}
                        </div>
                    </div>
                    <form data-reload="#load-data-ajax-exam-calendars" id="search-form-exam-calendars" class="mb-3 form-search-submit">
                        <div class="row">
                            <input type="hidden" value="{{ $courseUser->id }}" name="course_user_id">
                        </div>
                    </form>
                    <div id="load-data-ajax-exam-calendars" class="table-responsive mt-1 mb-1 load-data-ajax" data-search="#search-form-exam-calendars" data-url="{{ route('admins.calendars.data', ['course_user_id' => $courseUser->id, 'type' => 'exam_schedule', 'show_column' => 'name,priority,status,date_start,date_end,loai_thi,teacher_id,tuition_fee,ngay_dong_hoc_phi,sbd', 'reload' => 'load-data-ajax-exam-calendars']) }}">
                        <div class="loading-overlay">
                            <div class="loading-spinner"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
