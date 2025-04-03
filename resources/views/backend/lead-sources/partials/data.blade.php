<table id="example" class="table table-sm table-bordered table-hover">
    <thead>
        <tr>
            <th>STT</th>
            <th>Nguồn</th>
            <th>Ghi chú</th>
            <th class="fixed-column text-center">Hành động</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($leadSources as $leadSource)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $leadSource->name }}</td>
            <td>{{ $leadSource->description }}</td>
            <td class="fixed-column text-center">
                <a href="{{ route('admins.lead-sources.edit', $leadSource->id) }}"
                    class="btn btn-warning btn-sm mr-2 btn-edit-ajax" data-cs-modal="#modal-lead-sources-edit-ajax">
                    <i class="bx bx-edit"></i>
                </a>
                <form action="{{ route('admins.lead-sources.destroy', $leadSource->id) }}" class="delete-form-ajax" method="POST"
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
{{ $leadSources->links() }}
