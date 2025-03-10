<table id="example" class="table table-sm table-hover">
    <thead>
        <tr>
            <th>STT</th>
            <th>Tên file</th>
            <th>Người import</th>
            <th>Ngày import</th>
            <th class="fixed-column text-center">Hành động</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($imports as $import)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>
                <a href="{{ Storage::url( $import->sanitized_file_name) }}" target="_blank">
                    {{ $import->file_name }}
                </a>
            </td>
            <td>{{ $import->admin->name }}</td>
            <td>{{ $import->created_at }}</td>
            <td class="fixed-column text-center">
                <a href="{{ route('admins.imports.show', $import->id) }}" class="btn btn-primary btn-sm mr-1">
                    <i class="lni lni-eye"></i>
                </a>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
{{ $imports->links() }}
