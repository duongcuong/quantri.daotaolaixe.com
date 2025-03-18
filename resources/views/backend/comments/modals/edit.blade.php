<!-- Modal edit -->
<div class="modal fade" id="modal-comments-edit-ajax" tabindex="-1" aria-labelledby="modal-comments-edit-ajaxLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-scrollable">
        <form class="row g-3 needs-validation form-submit-ajax" method="POST" action="{{ route('admins.comments.update', $comment->id) }}" data-reload="#load-data-ajax-comments">
            @csrf
            @method('PUT')
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modal-comments-edit-ajaxLabel">Sửa học phí</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        @if(request()->has('course_user_id') && request()->course_user_id)
                        <input type="hidden" name="course_user_id" value="{{ request()->course_user_id }}">
                        @else
                        <div class="col-md-6 mb-3">
                            <label for="course_user_id2">Chọn học viên - khóa học</label>
                            <select class="select2-ajax-single form-control" name="course_user_id" data-selected-id="{{ $comment->course_user_id }}"
                                data-placeholder="Chọn học viên - khóa học"
                                data-url="{{ route('admins.course-user.list') }}" >
                            </select>
                        </div>
                        @endif
                        <div class="col-md-6 mb-3">
                            <label for="amount">Số tiền</label>
                            <input type="text" name="amount" id="amount" class="form-control thousand-text" required value="{{ $comment->amount }}">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="payment_date">Ngày nạp</label>
                            <input type="date" name="payment_date" id="payment_date" class="form-control" required value="{{ \Carbon\Carbon::parse($comment->payment_date)->format('Y-m-d') }}">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="admin_id2">Người thu</label>
                            <select class="select2-ajax-single form-control" name="admin_id" data-selected-id="{{ $comment->admin_id }}"
                                data-placeholder="Chọn người thu"
                                data-url="{{ route('admins.admins.list', ['role'=> ROLE_FEE]) }}" >
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="note">Ghi chú</label>
                            <textarea name="note" id="note" class="form-control">{{ $comment->note }}</textarea>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="is_received">Tiền đã về công ty</label>
                            <select name="is_received" id="is_received" class="form-control">
                                <option value="0" {{ $comment->is_received == 0 ? 'selected' : '' }}>Chưa về</option>
                                <option value="1" {{ $comment->is_received == 1 ? 'selected' : '' }}>Đã về</option>
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
