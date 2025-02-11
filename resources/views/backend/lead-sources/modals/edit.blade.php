<!-- Modal edit -->
<div class="modal fade" id="modal-lead-sources-edit-ajax" tabindex="-1" aria-labelledby="modal-lead-sources-edit-ajaxLabel" aria-hidden="true">
    <div class="modal-dialog modal-md modal-dialog-scrollable">
        <form class="row g-3 needs-validation form-submit-ajax" method="POST" action="{{ route('admins.lead-sources.update', $leadSource->id) }}" data-reload="#load-data-ajax-lead-sources">
            @csrf
            @method('PUT')
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modal-lead-sources-edit-ajaxLabel">Sửa nguồn</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12 mb-3">
                            <label for="name">Tên nguồn</label>
                            <input type="text" name="name" id="name" class="form-control" required value="{{ $leadSource->name }}">
                        </div>
                        <div class="col-md-12 mb-3">
                            <label for="description">Ghi chú</label>
                            <textarea name="description" id="description" class="form-control">{{ $leadSource->description }}</textarea>
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
