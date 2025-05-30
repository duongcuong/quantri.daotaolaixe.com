<div class="alert alert-info alert-dismissible fade show" role="alert">
    <strong class="mr-1">Tổng tiền đã nộp: </strong>
    <strong class="mr-2 text-danger">{!! getMoney($feeTotal) !!}</strong>
</div>
<table id="example" class="table table-sm table-bordered table-hover">
    <thead>
        <tr>
            <th>STT</th>
            <th>Học viên</th>
            <th>Ngày sinh</th>
            <th>Số điện thoại</th>
            <th>Loại thu</th>
            <th>Khóa học</th>
            <th>Số tiền</th>
            <th>Ngày nộp</th>
            <th>Ghi chú</th>
            <th>Người thu</th>
            <th>Tiền đã về công ty</th>
            <th class="fixed-column text-center">Hành động</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($fees as $fee)
        <tr>
            <td>{{ getSTT($fees, $loop->iteration) }}</td>
            <td>{{ $fee->courseUser->user->name }}</td>
            <td>{{ getDateTimeStamp($fee->courseUser->user->dob, 'd/m/Y') }}</td>
            <td>{{ $fee->courseUser->user->phone }}</td>
            <td>{!! getFeeType($fee->type) !!}</td>
            <td>{{ $fee->courseUser->course->code }}</td>
            <td>{{ number_format($fee->amount) }}</td>
            <td>{{ \Carbon\Carbon::parse($fee->payment_date)->format('d/m/Y') }}</td>
            <td>{{ $fee->note }}</td>
            <td>{{ $fee->admin->name }}</td>
            <td>{!! getStatusFee($fee->is_received) !!}</td>
            <td class="fixed-column text-center">
                <div class="d-flex">
                    @if (canAccess('admins.fees.edit'))
                    <a href="{{ route('admins.fees.edit', ['fee' => $fee->id, 'course_user_id' => request()->course_user_id ?? '']) }}"
                        class="btn btn-warning btn-sm mr-2 btn-edit-ajax" data-cs-modal="#modal-fees-edit-ajax">
                        <i class="bx bx-edit"></i>
                    </a>
                    @endif

                    @if (canAccess('admins.fees.destroy'))
                    <form action="{{ route('admins.fees.destroy', $fee->id) }}" class="delete-form-ajax" method="POST"
                        style="display:inline-block;">
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
{{ $fees->links() }}
