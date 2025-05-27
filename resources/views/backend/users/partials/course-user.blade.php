<div class="container-fluid p-0">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex">
                        <h5>Danh sách khoá học</strong>
                        </h5>
                        <div class="ml-auto">
                            {{-- @if (Auth::user()->hasPermission('admins.course-user.index')) --}}
                            <a class="btn btn-outline-primary btn-sm" href="{{ route('admins.course-user.create') }}"
                                title="Thêm mới"><i class="bx bx-plus"></i>Thêm mới</a>
                            {{-- @endif --}}
                        </div>
                    </div>
                    <form data-reload="#load-data-ajax-course-user" id="search-form-course-user" class="mb-3 form-search-submit">
                        <div class="row">
                            <input type="hidden" value="{{ $user->id }}" name="user_id">
                        </div>
                    </form>
                    <div class="table-responsive mt-1 mb-1 load-data-ajax"
                        data-url="{{ route('admins.course-user.data') }}" id="load-data-ajax-course-user"
                        data-search="#search-form-course-user">
                        <div class="loading-overlay">
                            <div class="loading-spinner"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
