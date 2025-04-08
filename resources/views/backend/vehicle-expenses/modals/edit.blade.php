<!-- Modal edit -->
<div class="modal fade" id="modal-vehicle-expenses-edit-ajax" tabindex="-1" aria-labelledby="modal-vehicle-expenses-edit-ajaxLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-scrollable">
        <form class="row g-3 needs-validation form-submit-ajax" method="POST" action="{{ route('admins.vehicle-expenses.update', $vehicle_expense->id) }}" data-reload="#load-data-ajax-vehicle-expenses">
            @csrf
            @method('PUT')
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modal-vehicle-expenses-edit-ajaxLabel">Sửa học phí</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        @if (request()->has('vehicle_id') && request()->vehicle_id)
                        <input type="hidden" name="vehicle_id" value="{{ request()->vehicle_id }}">
                        @else
                        <div class="col-md-6 mb-3">
                            <label for="vehicle_id">Chọn xe</label>
                            <select name="vehicle_id" id="vehicle_id" class="form-control single-select"
                                data-placeholder="Chọn xe" data-allow-clear="true">
                                <option></option>
                                @foreach ($vehicles as $vehicle)
                                <option value="{{ $vehicle->id }}" {{ $vehicle->id == $vehicle_expense->vehicle_id ? 'selected' : '' }}> {{ $vehicle->license_plate }}</option>
                                @endforeach
                            </select>
                        </div>
                        @endif
                        <div class="col-md-6 mb-3">
                            <label for="type">Loại chi phí</label>
                            <select name="type" id="type" class="form-control">
                                <option value="">Chọn loại chi phí</option>
                                @foreach (listTypeVahicleExpenses() as $key => $value)
                                <option value="{{ $key }}" {{ $key == $vehicle_expense->type ? 'selected' : '' }}>{{ $value }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="expense_date">Thời gian</label>
                            <input type="datetime-local" name="expense_date" id="expense_date" class="form-control" value="{{ $vehicle_expense->expense_date }}"
                                required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="amount">Số tiền</label>
                            <input type="text" name="amount" id="amount" class="form-control thousand-text" required value="{{ $vehicle_expense->amount }}">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="admin_id">Người thu</label>
                            <select class="select2-ajax-single form-control" name="admin_id" data-selected-id="{{ $vehicle_expense->admin_id }}"
                                data-placeholder="Chọn người thu"
                                data-url="{{ route('admins.admins.list', ['role'=> ROLE_VEHICLE_EXPENSE]) }}">
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="note">Ghi chú</label>
                            <textarea name="note" id="note" class="form-control">{{ $vehicle_expense->note }}</textarea>
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
