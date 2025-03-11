<table id="example" class="table table-sm table-hover">
    <thead>
        <tr>
            <th>STT</th>
            <th>Avatar</th>
            <th>Họ tên</th>
            <th>Giới tính</th>
            <th>Ngày sinh</th>
            <th>CMT/CCCD</th>
            <th>Địa chỉ</th>
            <th>SĐT</th>
            <th>Tổng số HV-KH</th>
            <th>Tổng lead</th>
            <th>Trạng thái</th>
            <th>Ngày hoạt động</th>
            <th class="fixed-column text-center">Hành động</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($sales as $sale)
        <tr>
            <td>{{ getSTT($sales, $loop->iteration) }}</td>
            <td><img src="{{ getImageUpload($sale->thumbnail, 'admins', 'small') }}" alt="Avatar" class="avatar"
                    width="50"></td>
            <td>{{ $sale->name }}</td>
            <td>{{ $sale->gender == 0 ? 'Nam' : ($sale->gender == 1 ? 'Nữ' : 'Khác') }}</td>
            <td>{{ $sale->dob }}</td>
            <td>{{ $sale->identity_card }}</td>
            <td>{{ $sale->address }}</td>
            <td>{{ $sale->phone }}</td>
            {{-- <td>{{ $sale->card_name }}</td>
            <td>{{ $sale->card_number }}</td> --}}
            <td>{{ $sale->course_users_count }}</td>
            <td>{{ $sale->leads_count }}</td>
            <td>{!! getStatus($sale->status) !!}</td>
            <td>{{ getDateTimeStamp($sale->created_at, 'd/m/Y') }}</td>
            <td class="fixed-column text-center">
                <a href="{{ route('admins.sales.edit', $sale->id) }}" class="btn btn-warning btn-sm mr-2">
                    <i class="bx bx-edit"></i>
                </a>
                <form action="{{ route('admins.sales.destroy', $sale->id) }}" method="POST"
                    style="display:inline-block;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger btn-sm delete-btn">
                        <i class="bx bx-trash"></i>
                    </button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
{{ $sales->links() }}
