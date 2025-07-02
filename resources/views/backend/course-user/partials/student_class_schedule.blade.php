<div class="container-fluid p-0">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex">
                        <div class="left">
                            <h5>Lịch học Lý thuyết - Cabin</h5>
                        </div>
                        <div class="ml-auto">
                            <div class="d-flex">
                                <form data-reload="#load-data-ajax-exam-lich-hoc-calendars" id="search-form-ly-thuyet-calendars"
                                    class="mb-3 form-search-submit">
                                    <div class="d-flex">
                                        <input type="hidden" value="{{ $courseUser->id }}" name="course_user_id">
                                        <input type="hidden" name="type" value="student_class_schedule">
                                        <input type="hidden" name="view" value="backend.calendars.lichhoc.data">
                                        <input type="hidden" name="reload" value="load-data-ajax-exam-lich-hoc-calendars">
                                        {{-- <div class="mr-2">
                                            <select class="form-control form-control-sm" name="loai_hoc">
                                                <option value="">Loại học</option>
                                                @foreach (listLoaiHocs() as $key => $item)
                                                <option value="{{ $key }}">{{ $item }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <button type="submit" class="btn btn-sm btn-primary ml-2">Tìm kiếm</button> --}}
                                    </div>
                                </form>
                                <div class="ml-2">
                                    {{-- @if (Auth::user()->hasPermission('admins.course-user.index')) --}}
                                    <a class="btn btn-outline-primary btn-sm btn-create-ajax"
                                        href="{{ route('admins.calendars.create', ['course_user_id' => $courseUser->id, 'type' => 'student_class_schedule', 'reload' => 'load-data-ajax-exam-lich-hoc-calendars']) }}"
                                        data-cs-modal="#modal-calendars-lich-hoc-create-ajax" title="Tạo Lịch Học Lý Thuyết - Cabin"><i
                                            class="bx bx-plus"></i>Tạo Lịch Học Lý Thuyết - Cabin</a>
                                    {{-- @endif --}}
                                </div>
                            </div>
                        </div>
                    </div>

                    <div id="load-data-ajax-exam-lich-hoc-calendars" class="table-header-fixed mt-1 mb-1 load-data-ajax"
                        data-search="#search-form-ly-thuyet-calendars" data-url="{{ route('admins.calendars.data') }}">
                        <div class="loading-overlay">
                            <div class="loading-spinner"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
