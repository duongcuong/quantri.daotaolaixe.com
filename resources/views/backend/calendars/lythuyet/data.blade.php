@php
$columns = request()->has('show_column') ? explode(',', request()->show_column) : [];
@endphp
<table id="example" class="table table-sm table-bordered table-hover">
    <thead>
        <tr>
            <th>STT</th>
            <th>Buổi thi</th>
            <th class="w-150px">Học viên</th>
            <th>Ngày sinh</th>
            <th>CCCD</th>
            <th>SĐT</th>
            <th>SBD</th>
            {{-- <th>Sân thi</th> --}}
            <th>Khoá học</th>
            <th>Môn thi</th>
            <th>Khám SK</th>
            <th>Sân</th>
            <th>Đưa đón</th>
            <th>Kết quả</th>
            <th class="text-center">Ghi chú</th>
            <th class="fixed-column text-center">Hành động</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($calendars as $calendar)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{!! getSangChieu($calendar->date_start) !!}</td>
            <td>{{ $calendar->courseUser->user->name ?? '' }}</td>
            <td>{{ $calendar->courseUser && $calendar->courseUser->user ?
                getDateTimeStamp($calendar->courseUser->user->dob, 'd/m/Y') : "" }}</td>
            <td>{{ $calendar->courseUser->user->identity_card ?? '' }}</td>
            <td>{{ $calendar->courseUser->user->phone ?? '' }}</td>
            <td>{{ $calendar->sbd ?? '' }}</td>
            <td>{{ $calendar->courseUser->course->code ?? '' }}</td>
            <td>{!! getLoaiThi($calendar->loai_thi) !!}</td>
            <td>{{ $calendar->courseUser ? getDateTimeStamp($calendar->courseUser->health_check_date, 'd/m/Y') : '' }}
            </td>
            <td>{{ $calendar->examField->name ?? '' }}</td>
            <td class="text-center fs-5">{!! getTickTrueOrFalse($calendar->pickup_registered) !!}</td>
            <td>{!! getStatusCalendarByType($calendar->type, $calendar->status) !!}</td>
            <td>{{ $calendar->description }}</td>
            <td class="fixed-column text-center">
                <div class="d-flex">
                    @if (canAccess('admins.calendars.edit'))
                    <a href="{{ route('admins.calendars.edit', ['calendar' => $calendar->id, 'reload' => request()->reload]) }}"
                        class="btn btn-warning btn-sm mr-2 btn-edit-ajax" data-cs-modal="#modal-calendars-ly-thuyet-edit-ajax">
                        <i class="bx bx-edit"></i>
                    </a>
                    @endif

                    @if (canAccess('admins.calendars.destroy'))
                    <form action="{{ route('admins.calendars.destroy', $calendar->id) }}" class="delete-form-ajax"
                        method="POST" style="display:inline-block;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm">
                            <i class="bx bx-trash"></i>
                        </button>
                    </form>
                    @endif
                </div>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
{{ $calendars->links() }}
