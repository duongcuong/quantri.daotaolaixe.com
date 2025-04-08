<div class="container-fluid p-0">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex">
                        <h5>Chi phí</strong>
                        </h5>
                        <div class="ml-auto">
                            {{-- @if (Auth::user()->hasPermission('admins.course-user.index')) --}}
                            <a class="btn btn-outline-primary btn-sm btn-create-ajax" href="{{ route('admins.vehicle-expenses.create', ['vehicle_id' => $vehicle->id]) }}" data-cs-modal="#modal-vehicle-expenses-create-ajax" title="Thêm mới"><i
                                    class="bx bx-plus"></i>Thêm mới</a>
                            {{-- @endif --}}
                        </div>
                    </div>
                    <form data-reload="#load-data-ajax-vehicle-expenses" id="search-form-vehicle-expenses" class="mb-3 form-search-submit">
                        <div class="row">
                            <input type="hidden" value="{{ $vehicle->id }}" name="vehicle_id">
                        </div>
                    </form>
                    <div id="load-data-ajax-vehicle-expenses" class="table-responsive mt-1 mb-1 load-data-ajax" data-search="#search-form-vehicle-expenses" data-url="{{ route('admins.vehicle-expenses.data') }}">
                        <div class="loading-overlay">
                            <div class="loading-spinner"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
