<table id="example" class="table table-sm table-bordered table-hover">
    <thead>
        <tr>
            <th>STT</th>
            <th>Thời gian bắt đầu</th>
            <th>Thời gian kết thúc</th>
            <th>Hạng thi</th>
            <th>Sân thi</th>
            <th>Loại thi</th>
            <th>Mô tả</th>
            <th>Trạng thái</th>
            <th class="fixed-column text-center">Hành động</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($examSchedules as $examSchedule)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{!! formatDateTimeVn($examSchedule->date_start) !!}</td>
            <td>{{ formatDateTimeVn($examSchedule->date_end) }}</td>
            <td>{!! getRank($examSchedule->ranks, false) !!}</td>
            <td>{{ $examSchedule->examField->name }}</td>
            <td>{!! getLoaiThi($examSchedule->loai_thi) !!}</td>
            <td>{{ $examSchedule->description }}</td>
            <td>{!! getStatus($examSchedule->status) !!}</td>
            <td class="fixed-column text-center">
                <a href="{{ route('admins.exam-schedules.edit', $examSchedule->id) }}"
                    class="btn btn-warning btn-sm mr-2 btn-edit-ajax" data-cs-modal="#modal-exam-schedules-edit-ajax">
                    <i class="bx bx-edit"></i>
                </a>
                <form action="{{ route('admins.exam-schedules.destroy', $examSchedule->id) }}" class="delete-form-ajax"
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
{{ $examSchedules->links() }}
