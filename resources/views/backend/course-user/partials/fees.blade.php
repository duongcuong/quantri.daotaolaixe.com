<div class="container-fluid p-0" id="fees-section">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex">
                        <h5>Lịch sử nộp học phí</strong>
                        </h5>
                        <div class="ml-auto">
                            {{-- @if (Auth::user()->hasPermission('admins.course-user.index')) --}}
                            <a class="btn btn-outline-primary btn-sm btn-create-ajax" href="{{ route('admins.fees.create', ['course_user_id' => $courseUser->id]) }}" data-cs-modal="#modal-fees-create-ajax" title="Tạo Học Phí"><i
                                    class="bx bx-plus"></i>Tạo Học Phí</a>
                            {{-- @endif --}}
                        </div>
                    </div>
                    <form data-reload="#load-data-ajax-fees" id="search-form-fees" class="mb-3 form-search-submit">
                        <div class="row">
                            <input type="hidden" value="{{ $courseUser->id }}" name="course_user_id">
                        </div>
                    </form>
                    <div id="load-data-ajax-fees" class="table-header-fixed mt-1 mb-1 load-data-ajax" data-search="#search-form-fees" data-url="{{ route('admins.fees.data') }}">
                        <div class="loading-overlay">
                            <div class="loading-spinner"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
