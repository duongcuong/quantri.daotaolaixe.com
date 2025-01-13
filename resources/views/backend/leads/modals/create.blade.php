<!-- Modal add -->
<div class="modal fade" id="modal-leads-create-ajax" tabindex="-1" aria-labelledby="modal-leads-create-ajaxLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-scrollable">
        <form class="row g-3 needs-validation form-submit-ajax" method="POST" action="{{ route('admins.leads.store') }}"
            data-reload="#load-data-ajax-leads">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modal-leads-create-ajaxLabel">Thêm khóa học mới</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label for="user_id">Chọn học viên(Nếu có)</label>
                            <select class="select2-ajax-single form-control" name="user_id"  data-selected-id="" data-placeholder="Chọn học viên" data-url="{{ route('admins.users.list') }}" id="change-hoc-vien" >
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="name">Họ tên</label>
                            <input type="text" name="name" id="name" class="form-control" value="{{ old('name') }}" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="email">Email</label>
                            <input type="email" name="email" id="email" class="form-control" value="{{ old('email') }}">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="phone">SĐT</label>
                            <input type="text" name="phone" id="phone" class="form-control" value="{{ old('phone') }}">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="address">Địa chỉ</label>
                            <input type="text" name="address" id="address" class="form-control" value="{{ old('address') }}">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="dob">Ngày sinh</label>
                            <input type="date" name="dob" id="dob" class="form-control" value="{{ old('dob') }}">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="source">Nguồn</label>
                            <input type="text" name="source" id="source" class="form-control">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="interest_level">Mức độ quan tâm</label>
                            <select name="interest_level" id="interest_level" class="form-control">
                                @foreach (listLevels() as $key => $item)
                                <option value="{{ $key }}" {{ old('interest_level')==$key ? 'selected' : '' }}>{{ $item
                                    }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="assigned_to">Người phụ trách</label>
                            <select class="select2-ajax-single form-control" name="assigned_to"  data-selected-id="" data-placeholder="Chọn người phụ trách" data-url="{{ route('admins.admins.list', ['role'=> ROLE_SALE]) }}" >
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="description">Ghi chú</label>
                            <textarea name="description" id="description" class="form-control">{{ old('description') }}</textarea>
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
