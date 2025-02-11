<table id="example" class="table table-sm table-hover">
    <thead>
        <tr>
            <th>STT</th>
            <th>Loại</th>
            <th>Tên</th>
            <th>Trạng thái</th>
            <th>Ưu tiên</th>
            <th>Ngày bắt đầu</th>
            <th>Ngày kết thúc</th>
            <th>Thời lượng</th>
            <th>Mô tả</th>
            @if (!request()->has('show'))
            <th>Người phụ trách</th>
            <th>Học viên</th>
            <th>Học viên - Khóa học</th>
            <th>Lead</th>
            @endif
            <th class="fixed-column text-center">Hành động</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($calendars as $calendar)
        <tr>
            <td>{{ $calendar->id }}</td>
            <td>{!! getTypeCalendar($calendar->type) !!}</td>
            <td>{{ $calendar->name }}</td>
            <td>{!! getStatusCalendarByType($calendar->type, $calendar->status) !!}</td>
            <td>{!! getPriority($calendar->priority) !!}</td>
            <td>{{ getDateTimeStamp($calendar->date_start, 'd/m/Y') }}</td>
            <td>{{ getDateTimeStamp($calendar->date_end, 'd/m/Y') }}</td>
            <td>{!! getDuration($calendar->duration) !!}</td>
            <td>{{ $calendar->description }}</td>
            @if (!request()->has('show'))
            <td>{{ $calendar->admin->name ?? '' }}</td>
            <td>{{ $calendar->user->name ?? '' }}</td>
            <td>{{ $calendar->courseUser->user->name ?? '' }} - {{ $calendar->courseUser->course->code ?? '' }}</td>
            <td>{{ $calendar->lead->name ?? '' }}</td>
            @endif
            <td class="fixed-column text-center">
                @php
                    $params = [
                        'calendar' => $calendar->id,
                        'type' => request()->type
                    ];
                    if(request()->admin_id){
                        $params['admin_id'] = request()->admin_id;
                        $params['show'] = 'admin_id';
                    }
                    if(request()->user_id){
                        $params['user_id'] = request()->user_id;
                        $params['show'] = 'user_id';
                    }
                    if(request()->course_user_id){
                        $params['course_user_id'] = request()->course_user_id;
                        $params['show'] = 'course_user_id';
                    }
                    if(request()->lead_id){
                        $params['lead_id'] = request()->lead_id;
                        $params['show'] = 'lead_id';
                    }
                @endphp
                <a href="{{ route('admins.calendars.edit', $params) }}"
                    class="btn btn-warning btn-sm mr-2 btn-edit-ajax" data-cs-modal="#modal-calendars-edit-ajax">
                    <i class="bx bx-edit"></i>
                </a>
                <form action="{{ route('admins.calendars.destroy', $calendar->id) }}" class="delete-form-ajax"
                    method="POST" style="display:inline-block;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger btn-sm">
                        <i class="bx bx-trash"></i>
                    </button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
{{ $calendars->links() }}
