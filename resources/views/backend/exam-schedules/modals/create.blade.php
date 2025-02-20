<!-- Modal add -->
<div class="modal fade" id="modal-exam-schedules-create-ajax" aria-labelledby="modal-exam-schedules-create-ajaxLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-scrollable">
        <form class="row g-3 needs-validation form-submit-ajax" method="POST"
            action="{{ route('admins.exam-schedules.store') }}" data-reload="#load-data-ajax-exam-schedules">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modal-exam-schedules-create-ajaxLabel">Thêm lịch thi sát hạch</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label for="date_start">Thời gian bắt đầu</label>
                            <input type="datetime-local" name="date_start" id="date_start" class="form-control"
                                required>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="date_end">Thời gian kết thúc</label>
                            <input type="datetime-local" name="date_end" id="date_end" class="form-control">
                        </div>
                    </div>
                    <div class="border radius-10 p-15 mb-3">
                        <label for="ranks">Hạng thi</label>
                        <div class="row">
                            @foreach (listRanks() as $key => $item)
                            <div class="col-md-3">
                                <div class="form-check">
                                    <input class="form-check-input" name="ranks[]" type="checkbox" value="{{ $key }}"
                                        id="flexCheckChecked{{ $key }}">
                                    <label class="form-check-label" for="flexCheckChecked{{ $key }}">{{ $item
                                        }}</label>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-12">
                            <label for="exam_field_id" class="d-flex justify-content-between">
                                <span>Sân</span>
                                <a href="{{ route('admins.exam-fields.index') }}" title="Thêm mới" target="_blank"><i
                                        class="bx bx-plus"></i>Thêm sân thi</a>
                            </label>
                            <select class="select2-ajax-single form-control" name="exam_field_id" data-selected-id=""
                                data-placeholder="Chọn sân" data-url="{{ route('admins.exam-fields.list') }}">
                            </select>
                        </div>
                    </div>
                    <div class="border radius-10 p-15 mb-3">
                        <label for="loai_thi">Loại thi</label>
                        <div class="row">
                            @foreach (listLoaiThis() as $key => $item)
                            <div class="col-md-6">
                                <div class="form-check">
                                    <input class="form-check-input" name="loai_thi[]" type="checkbox" value="{{ $key }}"
                                        id="flexCheckChecked{{ $key }}">
                                    <label class="form-check-label" for="flexCheckChecked{{ $key }}">{{ $item
                                        }}</label>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-12">
                            <label for="description">Mô tả</label>
                            <textarea name="description" id="description" class="form-control"></textarea>
                        </div>
                        <div class="form-group col-md-12">
                            <label for="status">Trạng thái</label>
                            <select name="status" id="status" class="form-control" required>
                                @foreach (listStatus() as $key => $item)
                                <option value="{{ $key }}" {{ old('status', 1)==$key ? 'selected' : '' }}>{{ $item }}
                                </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light px-5 mr-2" data-dismiss="modal">
                        <i class="bx bx-window-close me-1"></i>
                        Hủy
                    </button>
                    <button type="submit" class="btn btn-primary px-5">
                        <i class="bx bx-save me-1"></i>
                        Lưu
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
