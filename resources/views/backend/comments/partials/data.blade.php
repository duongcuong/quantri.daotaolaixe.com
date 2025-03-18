{{-- <div class="alert alert-info alert-dismissible fade show" role="alert">
    <strong class="mr-1">Tổng tiền đã nạp: </strong>
    <strong class="mr-2 text-danger">{!! getMoney($commentTotal) !!}</strong>
</div> --}}
<table id="example" class="table table-sm table-hover">
    <thead>
        <tr>
            <th>STT</th>
            <th>Học viên</th>
            <th>Giáo viên</th>
            <th>Khoá học</th>
            <th>Nhận xét</th>
            <th>Đánh giá</th>
            <th>Ngày đánh giá</th>
            <th class="fixed-column text-center">Hành động</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($comments as $comment)
        <tr>
            <td>{{ getSTT($comments, $loop->iteration) }}</td>

            <td class="fixed-column text-center">
                <a href="{{ route('admins.fees.edit', ['fee' => $comment->id, 'course_user_id' => request()->course_user_id ?? '']) }}"
                    class="btn btn-warning btn-sm mr-2 btn-edit-ajax" data-cs-modal="#modal-fees-edit-ajax">
                    <i class="bx bx-edit"></i>
                </a>
                <form action="{{ route('admins.fees.destroy', $comment->id) }}" class="delete-form-ajax" method="POST"
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
{{ $comments->links() }}
