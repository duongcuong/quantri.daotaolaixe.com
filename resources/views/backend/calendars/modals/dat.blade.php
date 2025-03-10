<div class="modal fade no-remove" id="modal-dat-calendars-ajax" aria-labelledby="modal-dat-calendars-ajaxLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modal-dat-calendars-ajaxLabel">Lịch sử chạy DAT</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form data-reload="#load-data-ajax-class-calendars" id="search-form-class-calendars"
                    class="mb-3 form-search-submit">
                    @csrf
                    @php
                    $type = 'class_schedule';
                    $showColumn = 'name,date_start,date_end,name_hocvien,km,so_gio_chay_duoc';
                    $loaiHoc = 'chay_dat';
                    @endphp
                    <input type="hidden" name="show_column" value="{{ $showColumn }}">
                    <input type="hidden" name="type" value="{{ $typeColumn }}">
                    <input type="hidden" name="reload" value="{{ $reload }}">
                </form>
                <div id="load-data-ajax-class-calendars" class="table-responsive mt-1 mb-1 load-data-ajax"
                    data-search="#search-form-class-calendars" data-url="{{ route('admins.calendars.data') }}">
                    <div class="loading-overlay">
                        <div class="loading-spinner"></div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light px-5 mr-2" data-dismiss="modal">
                    <i class="bx bx-window-close me-1"></i>
                    Hủy
                </button>
            </div>
        </div>
    </div>
</div>
