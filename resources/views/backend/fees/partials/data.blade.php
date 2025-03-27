<div class="alert alert-info alert-dismissible fade show" role="alert">
    <strong class="mr-1">Tổng tiền đã nộp: </strong>
    <strong class="mr-2 text-danger">{!! getMoney($feeTotal) !!}</strong>
</div>
<table id="example" class="table table-sm table-hover">
    <thead>
        <tr>
            <th>STT</th>
            <th>Học viên</th>
            <th>Khóa học</th>
            <th>Số tiền</th>
            <th>Ngày nộp</th>
            <th>Người thu</th>
            <th>Ghi chú</th>
            <th>Tiền đã về công ty</th>
            <th class="fixed-column text-center">Hành động</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($fees as $fee)
        <tr>
            <td>{{ getSTT($fees, $loop->iteration) }}</td>
            <td>{{ $fee->courseUser->user->name }}</td>
            <td>{{ $fee->courseUser->course->code }}</td>
            <td>{{ number_format($fee->amount) }}</td>
            <td>{{ \Carbon\Carbon::parse($fee->payment_date)->format('d/m/Y') }}</td>
            <td>{{ $fee->admin->name }}</td>
            <td>{{ $fee->note }}</td>
            <td>{!! getStatusFee($fee->is_received) !!}</td>
            <td class="fixed-column text-center">
                <a href="{{ route('admins.fees.edit', ['fee' => $fee->id, 'course_user_id' => request()->course_user_id ?? '']) }}"
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
