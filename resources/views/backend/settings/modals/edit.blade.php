<!-- Modal edit -->
<div class="modal fade" id="modalEditSettingExpense" tabindex="-1" aria-labelledby="modalEditSettingExpenseLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <form class="row g-3 needs-validation form-submit-edit" novalidate="">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalCreateSettingExpenseLabel">Sửa loại chi phí</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="validationCustom04" class="form-label">Loại chi phí <span
                                    class="text-danger">*</span></label>
                            <select class="form-control single-select" name="type"  required="">
                                <option value="">Chọn loại chi phí</option>
                                <option value="{{ TYPE_EXPENSE }}">{{ getTitleExpense(TYPE_EXPENSE) }}</option>
                                <option value="{{ TYPE_FOOD }}">{{ getTitleExpense(TYPE_FOOD) }}</option>
                            </select>
                            <div class="invalid-feedback">Vui lòng nhập loại chi phí</div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="validationCustom04" class="form-label">Tên chi phí <span
                                    class="text-danger">*</span></label>
                            <input type="text" value="" name="name" placeholder="Nhập tên chi phí"
                                class="form-control">
                            <div class="invalid-feedback">Vui lòng tên loại chi phí</div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="validationCustom04" class="form-label">Đơn vị tính <span
                                    class="text-danger">*</span></label>
                            <input type="text" value="" name="unit" placeholder="Nhập đơn vị tính"
                                class="form-control">
                            <div class="invalid-feedback">Vui lòng nhập đơn vị tính</div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="validationCustom04" class="form-label">Ghi chú</label>
                            <textarea id="" cols="30" rows="3" name="description" class="form-control"
                                placeholder="Nhập ghi chú"></textarea>
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
