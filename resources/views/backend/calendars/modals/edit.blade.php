<!-- Modal edit -->
<div class="modal fade" id="modal-calendars-edit-ajax" tabindex="-1" aria-labelledby="modal-calendars-edit-ajaxLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-scrollable">
        <form class="row g-3 needs-validation form-submit-ajax" method="POST"
            action="{{ route('admins.calendars.update', $calendar->id) }}" data-reload="#load-data-ajax-calendars">
            @csrf
            @method('PUT')
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modal-calendars-edit-ajaxLabel">Chỉnh sửa lịch</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-8">
                            <div class="row">
                                @if (request()->has('type'))
                                <input type="hidden" name="type" value="{{ request()->type }}" class="type-calendars">
                                @else
                                <div class="form-group col-md-12">
                                    <label for="type">Loại sự kiện <span class="text-danger">*</span></label>
                                    <div>
                                        @foreach (listTypeCalendars() as $key => $item)
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input type-calendars" type="radio" name="type"
                                                id="type_{{ $key }}" required value="{{ $key }}" {{ $key==old('type',
                                                $calendar->type) ? 'checked' : '' }}>
                                            <label class="form-check-label" for="type_{{ $key }}">{{ $item }}</label>
                                        </div>
                                        @endforeach
                                    </div>
                                </div>
                                @endif
                                <div class="form-group col-md-12">
                                    <label for="name">Tên sự kiện <span class="text-danger">*</span></label>
                                    <input type="text" name="name" id="name" class="form-control"
                                        value="{{ old('name', $calendar->name) }}" required>
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="date_start">Thời gian bắt đầu<span class="text-danger">*</span></label>
                                    <input type="datetime-local" name="date_start" id="date_start" class="form-control"
                                        value="{{ old('date_start', $calendar->date_start) }}" required>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="date_end">Thời gian kết thúc<span class="text-danger">*</span></label>
                                    <input type="datetime-local" name="date_end" id="date_end" class="form-control"
                                        value="{{ old('date_end', $calendar->date_end) }}" required>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="duration">Thời lượng (phút)</label>
                                    <select name="duration" id="duration" class="form-control" required>
                                        @foreach (listDurations() as $key => $item)
                                        <option value="{{ $key }}" {{ $key==old('duration', $calendar->duration) ?
                                            'selected' : '' }}>{{ $item }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="priority">Độ ưu tiên</label>
                                    <select name="priority" id="priority" class="form-control" required>
                                        @foreach (listPriorities() as $key => $item)
                                        <option value="{{ $key }}" {{ $key==old('priority', $calendar->priority) ?
                                            'selected' : '' }}>{{ $item }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="status">Trạng thái</label>
                                    <select name="status" id="status-calendar" class="form-control" required>
                                        @php
                                           $listStatusCalendars = listStatusCalendars();
                                           $listStatusCalendars = $listStatusCalendars[$calendar->type] ?? [];
                                        @endphp
                                        @foreach ($listStatusCalendars as $key => $item)
                                        <option value="{{ $key }}" {{ $key==old('status', $calendar->status) ? 'selected' : '' }}>
                                            {{ $item }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group col-md-12">
                                    <label for="description">Mô tả</label>
                                    <textarea name="description" id="description"
                                        class="form-control">{{ old('description', $calendar->description) }}</textarea>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            @if (!request()->has('show') || (request()->has('show') && request()->show == 'admin_id') )
                            <div class="form-group">
                                <label for="admin_id">Người phụ trách (Admin)</label>
                                <select class="select2-ajax-single form-control" name="admin_id"
                                    data-placeholder="Chọn người phụ trách"
                                    data-url="{{ route('admins.admins.list') }}" data-selected-id="{{ old('admin_id', $calendar->admin_id) }}">
                                </select>
                            </div>
                            @endif

                            @if (!request()->has('show') || (request()->has('show') && request()->show == 'user_id') )
                            <div class="form-group">
                                <label for="user_id">Học viên</label>
                                <select class="select2-ajax-single form-control" name="user_id"
                                    data-placeholder="Chọn học viên" data-url="{{ route('admins.users.list') }}" data-selected-id="{{ old('user_id', $calendar->user_id) }}">
                                </select>
                            </div>
                            @endif

                            @if (!request()->has('show') || (request()->has('show') && request()->show == 'course_user_id') )
                            <div class="form-group">
                                <label for="course_user_id">Học viên khóa học</label>
                                <select class="select2-ajax-single form-control" name="course_user_id"
                                    data-placeholder="Chọn học viên khóa học"
                                    data-url="{{ route('admins.course-user.list') }}" data-selected-id="{{ old('course_user_id', $calendar->course_user_id) }}">
                                </select>
                            </div>
                            @endif

                            @if (!request()->has('show') || (request()->has('show') && request()->show == 'lead_id') )
                            <div class="form-group">
                                <label for="lead_id">Lead</label>
                                <select class="select2-ajax-single form-control" name="lead_id"
                                    data-placeholder="Chọn lead" data-url="{{ route('admins.leads.list') }}" data-selected-id="{{ old('lead_id', $calendar->lead_id) }}">
                                </select>
                            </div>
                            @endif
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
                        Cập nhật
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
