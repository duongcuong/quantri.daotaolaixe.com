<!-- Modal add -->
<div class="modal fade" id="modal-lead-sources-create-ajax" aria-labelledby="modal-lead-sources-create-ajaxLabel" aria-hidden="true">
    <div class="modal-dialog modal-md modal-dialog-scrollable">
        <form class="row g-3 needs-validation form-submit-ajax" method="POST" action="{{ route('admins.lead-sources.store') }}" data-reload="#load-data-ajax-lead-sources">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modal-lead-sources-create-ajaxLabel">Thêm mới nguồn</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="mb-3 col-md-12">
                            <label for="name">Nguồn</label>
                            <input type="text" name="name" id="name" class="form-control" required>
                        </div>
                        <div class="mb-3 col-md-12">
                            <label for="description">Ghi chú</label>
                            <textarea name="description" id="description" class="form-control"></textarea>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light px-3 mr-1" data-dismiss="modal">
                        <i class="bx bx-window-close me-1"></i>
                        Hủy
                    </button>
                    <button type="submit" class="btn btn-primary px-3">
                        <i class="bx bx-save me-1"></i>
                        Lưu
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
