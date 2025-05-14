<div class="container-fluid p-0">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex">
                        <div class="left">
                            <h5>Lịch thi tốt nghệp</h5>
                        </div>
                        <div class="ml-auto">
                            <div class="d-flex">
                                <form data-reload="#load-data-ajax-tot-nghiep-calendars" id="search-form-tot-nghiep-calendars"
                                    class="mb-3 form-search-submit">
                                    <div class="d-flex">
                                        <input type="hidden" value="{{ $courseUser->id }}" name="course_user_id">
                                        <input type="hidden" name="type" value="exam_edu">
                                        <input type="hidden" name="view" value="backend.calendars.totnghiep.data">
                                        <input type="hidden" name="reload" value="load-data-ajax-tot-nghiep-calendars">
                                    </div>
                                </form>
                                <div class="ml-2">
                                    {{-- @if (Auth::user()->hasPermission('admins.course-user.index')) --}}
                                    <a class="btn btn-outline-primary btn-sm btn-create-ajax"
                                        href="{{ route('admins.calendars.create', ['course_user_id' => $courseUser->id, 'type' => 'exam_edu', 'reload' => 'load-data-ajax-tot-nghiep-calendars']) }}"
                                        data-cs-modal="#modal-calendars-tot-nghiep-create-ajax" title="Thêm mới"><i
                                            class="bx bx-plus"></i>Thêm  lịch thi tốt nghiệp</a>
                                    {{-- @endif --}}
                                </div>
                            </div>
                        </div>
                    </div>

                    <div id="load-data-ajax-tot-nghiep-calendars" class="table-header-fixed mt-1 mb-1 load-data-ajax"
                        data-search="#search-form-tot-nghiep-calendars" data-url="{{ route('admins.calendars.data') }}">
                        <div class="loading-overlay">
                            <div class="loading-spinner"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
