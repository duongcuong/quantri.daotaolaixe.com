<table id="example" class="table table-sm table-bordered table-hover">
    <thead>
        <tr>
            <th>#</th>
            <th>Họ tên</th>
            <th>Người phụ trách</th>
            <th>Email</th>
            <th>SĐT</th>
            <th>Nguồn</th>
            <th>Mức độ quan tâm</th>
            {{-- <th>Trạng thái</th> --}}
            <th class="fixed-column text-center" rowspan="2">Hành động</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($leads as $lead)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $lead->name }}</td>
            <td>{{ $lead->assignedTo->name }}</td>
            <td>{{ $lead->email }}</td>
            <td>{{ $lead->phone }}</td>
            <td>{{ $lead->source }}</td>
            <td>{!! getLevel($lead->interest_level) !!}</td>
            {{-- <td>{{ ucfirst($lead->status) }}</td> --}}
            <td class="fixed-column text-center">
                <a href="{{ route('admins.leads.show', $lead->id) }}" class="btn btn-primary btn-sm mr-1">
                    <i class="lni lni-eye"></i>
                </a>
                <a href="{{ route('admins.leads.edit', $lead->id) }}" class="btn btn-warning btn-sm mr-1">
                    <i class="bx bx-edit"></i>
                </a>
                <form action="{{ route('admins.leads.destroy', $lead->id) }}" method="POST"
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
{{ $leads->links() }}
