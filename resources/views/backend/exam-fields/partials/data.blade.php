<table id="example" class="table table-sm table-bordered table-hover">
    <thead>
        <tr>
            <th>STT</th>
            <th>Địa điểm</th>
            <th>Ghi chú</th>
            <th class="fixed-column text-center">Hành động</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($examFields as $examField)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $examField->name }}</td>
            <td>{{ $examField->description }}</td>
            <td class="fixed-column text-center">
                <a href="{{ route('admins.exam-fields.edit', $examField->id) }}"
                    class="btn btn-warning btn-sm mr-2 btn-edit-ajax" data-cs-modal="#modal-exam-fields-edit-ajax">
                    <i class="bx bx-edit"></i>
                </a>
                <form action="{{ route('admins.exam-fields.destroy', $examField->id) }}" class="delete-form-ajax" method="POST"
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
{{ $examFields->links() }}
