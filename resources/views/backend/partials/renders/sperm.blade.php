<div class="table-responsive">
    <table id="form-breed-list-table"
        class="table table-sm table-striped table-bordered table-fixed-column text-center table-hover">
        <thead>
            <tr>
                <th>#</th>
                <th>Ngày</th>
                @if ($isShowCode)
                    <th>Số tai đực</th>
                @endif
                <th>Khối lượng(ml)</th>
                <th>Hành động</th>
            </tr>
        </thead>
        <tbody>
            @if ($datas->count() > 0)
                @foreach ($datas as $key => $data)
                    <tr>
                        <td>{{ $key + 1 }}</td>
                        <td>{{ $data->dated_at }}</td>
                        @if ($isShowCode)
                            <td>{{ $data->code }}</td>
                        @endif
                        <td>{{ $data->weight ? number_format($data->weight, 0) : '' }}</td>
                        <td>
                            <button type="button" class="btn btn-sm btn-success mr-1 toggleEditSpermExtractions"
                                data-id="{{ $data->id }}" data-toggle="tooltip" title="Sửa &#128221">
                                <i class="fadeIn animated bx bx-edit"></i>
                            </button>
                            <button class="form-sperm-submit-delete btn btn-sm btn-danger delete-confirm-button"
                                data-id="{{ $data->id }}" type="button" data-toggle="tooltip" title="Xóa &#128683">
                                <i class="fadeIn animated bx bx-trash"></i>
                            </button>
                        </td>
                    </tr>
                @endforeach
            @else
                <td colspan="20">Không tồn tại bản ghi nào</td>
            @endif
        </tbody>
    </table>
</div>
<div class="justify-content-end d-flex pagination-sperm-render">
    {{ $datas->links() }}
</div>
