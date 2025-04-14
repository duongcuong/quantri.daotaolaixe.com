<div class="container-fluid p-0">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex">
                        <div class="left">
                            <h5>Lịch làm việc</h5>
                        </div>
                        <div class="ml-auto">
                            <div class="d-flex">
                                <form data-reload="#load-data-ajax-calendars" id="search-form-class-calendars"
                                    class="mb-3 form-search-submit">
                                    <div class="d-flex">
                                        <input type="hidden" value="{{ $lead->id }}" name="lead_id">
                                        <button type="submit" class="btn btn-sm btn-primary ml-2">Tìm kiếm</button>
                                    </div>
                                </form>
                                <div class="ml-2">
                                    {{-- @if (Auth::user()->hasPermission('admins.course-user.index')) --}}
                                    @foreach (listTypeCalendars() as $key => $item)
                                    @if ($key == 'task' || $key == 'meeting' || $key == 'call')
                                    <a class="btn btn-outline-primary btn-sm btn-create-ajax mr-2 mb-2"
                                        href="{{ route('admins.calendars.create', [" type"=> $key, 'lead_id' =>
                                        $lead->id]) }}"
                                        data-cs-modal="#modal-calendars-create-ajax" title="Thêm mới">
                                        <i class="bx bx-plus"></i>
                                        {!! $item !!}
                                    </a>
                                    @endif
                                    @endforeach
                                    {{-- @endif --}}
                                </div>
                            </div>
                        </div>
                    </div>

                    <div id="load-data-ajax-calendars" class="table-header-fixed mt-1 mb-1 load-data-ajax"
                        data-search="#search-form-class-calendars"
                        data-url="{{ route('admins.calendars.data', ['lead_id' => $lead->id, 'show_column' => 'name,date_start,date_end,status,priority,type', 'reload' => 'load-data-ajax-calendars']) }}">
                        <div class="loading-overlay">
                            <div class="loading-spinner"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
