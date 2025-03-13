<div class="container-fluid p-0">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex">
                        <div class="left">
                            <h5>Lịch thi</h5>
                        </div>
                        <div class="ml-auto">
                            <div class="d-flex">
                                <form data-reload="#load-data-ajax-exam-calendars" id="search-form-exam-calendars"
                                    class="mb-3 form-search-submit">
                                    <div class="d-flex">
                                        <input type="hidden" value="{{ $courseUser->id }}" name="course_user_id">
                                        <input type="hidden" name="type" value="exam_schedule">
                                        <input type="hidden" name="show_column"
                                            value="name,priority,status,date_start,date_end,loai_thi,tuition_fee,ngay_dong_hoc_phi,sbd">
                                        <input type="hidden" name="reload" value="load-data-ajax-exam-calendars">
                                        <div class="mr-2">
                                            <select class="form-control form-control-sm" name="loai_hoc">
                                                <option value="">Loại học</option>
                                                @foreach (listLoaiHocs() as $key => $item)
                                                <option value="{{ $key }}">{{ $item }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <button type="submit" class="btn btn-sm btn-primary ml-2">Tìm kiếm</button>
                                    </div>
                                </form>
                                <div class="ml-2">
                                    {{-- @if (Auth::user()->hasPermission('admins.course-user.index')) --}}
                                    <a class="btn btn-outline-primary btn-sm btn-create-ajax"
                                        href="{{ route('admins.calendars.create', ['course_user_id' => $courseUser->id, 'type' => 'exam_schedule', 'reload' => 'load-data-ajax-exam-calendars']) }}"
                                        data-cs-modal="#modal-calendars-create-ajax" title="Thêm mới"><i
                                            class="bx bx-plus"></i>Thêm mới</a>
                                    {{-- @endif --}}
                                </div>
                            </div>
                        </div>
                    </div>

                    <div id="load-data-ajax-exam-calendars" class="table-responsive mt-1 mb-1 load-data-ajax"
                        data-search="#search-form-exam-calendars"
                        data-url="{{ route('admins.calendars.data') }}">
                        <div class="loading-overlay">
                            <div class="loading-spinner"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
