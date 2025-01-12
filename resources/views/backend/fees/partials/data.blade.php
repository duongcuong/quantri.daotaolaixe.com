<table id="example" class="table table-sm table-hover">
    <thead>
        <tr>
            <th>STT</th>
            <th>Học viên</th>
            <th>Khóa học</th>
            <th>Số tiền</th>
            <th>Ngày nạp</th>
            <th>Ghi chú</th>
            <th>Tiền đã về công ty</th>
            <th class="fixed-column text-center">Hành động</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($fees as $fee)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $fee->courseUser->user->name }}</td>
            <td>{{ $fee->courseUser->course->name }}</td>
            <td>{{ number_format($fee->amount) }}</td>
            <td>{{ \Carbon\Carbon::parse($fee->payment_date)->format('d/m/Y') }}</td>
            <td>{{ $fee->note }}</td>
            <td>{!! getStatusFee($fee->is_received) !!}</td>
            <td class="fixed-column text-center">
                <a href="{{ route('admins.fees.edit', ['fee' => $fee->id, 'course_user_id' => $course_user_id ?? null]) }}"
                    class="btn btn-warning btn-sm mr-2 btn-edit-ajax" data-cs-modal="#modal-fees-edit-ajax">
                    <i class="bx bx-edit"></i>
                </a>
                <form action="{{ route('admins.fees.destroy', $fee->id) }}" class="delete-form-ajax" method="POST"
                    style="display:inline-block;">
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
{{ $fees->links() }}
