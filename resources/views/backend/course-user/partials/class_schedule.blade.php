<div class="container-fluid p-0">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex">
                        <div class="left">
                            <h5>Lịch học</h5>
                            <div class="d-flex">
                                <strong class="mr-1 text-danger">Tổng: </strong>
                                <strong class="mr-1">Tổng km: </strong> <strong class="mr-2 text-danger"> {{
                                    number_format($courseUser->calendars_sum_km, 2) }}</strong>
                                <strong class="mr-1">Tổng km tự động: </strong> <strong class="mr-2 text-danger"> {{
                                    number_format($courseUser->total_km_tudong, 2) }}</strong>
                                <strong class="mr-1">Tổng giờ chạy được: </strong>
                                <strong class="mr-2 text-danger"> {{
                                    getFormattedSoGioChayDuocAttribute($courseUser->calendars_sum_so_gio_chay_duoc)
                                    }}</strong>
                                <strong class="mr-1">Tổng giờ ban đêm: </strong>
                                <strong class="text-danger"> {{
                                    getFormattedSoGioChayDuocAttribute($courseUser->total_so_gio_chay_duoc_bandem)
                                    }}</strong>
                            </div>
                            <div class="d-flex">
                                <strong class="mr-1 text-success">Đã duyệt: </strong>
                                <strong class="mr-1">Tổng km: </strong> <strong class="mr-2 text-success"> {{
                                    number_format($courseUser->total_km_approved, 2) }}</strong>
                                <strong class="mr-1">Tổng km tự động: </strong> <strong class="mr-2 text-success"> {{
                                    number_format($courseUser->total_km_tudong_approved, 2) }}</strong>
                                <strong class="mr-1">Tổng giờ chạy được: </strong>
                                <strong class="mr-2 text-success"> {{
                                    getFormattedSoGioChayDuocAttribute($courseUser->so_gio_chay_duoc_approved)
                                    }}</strong>
                                <strong class="mr-1">Tổng giờ ban đêm: </strong>
                                <strong class="text-success"> {{
                                    getFormattedSoGioChayDuocAttribute($courseUser->total_so_gio_chay_duoc_bandem_approved)
                                    }}</strong>
                            </div>
                        </div>
                        <div class="ml-auto">
                            <div class="d-flex">
                                <form data-reload="#load-data-ajax-class-calendars" id="search-form-class-calendars"
                                    class="mb-3 form-search-submit">
                                    <div class="d-flex">
                                        <input type="hidden" value="{{ $courseUser->id }}" name="course_user_id">
                                        <input type="hidden" name="type" value="class_schedule">
                                        <input type="hidden" name="view" value="backend.calendars.dayhoc.data">
                                        <input type="hidden" name="reload" value="load-data-ajax-class-calendars">
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
                                        href="{{ route('admins.calendars.create', ['course_user_id' => $courseUser->id, 'type' => 'class_schedule', 'reload' => 'load-data-ajax-class-calendars']) }}"
                                        data-cs-modal="#modal-calendars-day-hoc-create-ajax" title="Thêm mới"><i
                                            class="bx bx-plus"></i>Thêm mới</a>
                                    {{-- @endif --}}
                                </div>
                            </div>
                        </div>
                    </div>

                    <div id="load-data-ajax-class-calendars" class="table-header-fixed mt-1 mb-1 load-data-ajax"
                        data-search="#search-form-class-calendars" data-url="{{ route('admins.calendars.data') }}">
                        <div class="loading-overlay">
                            <div class="loading-spinner"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
