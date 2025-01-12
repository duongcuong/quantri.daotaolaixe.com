<div class="card-header">
    <div class="row">
        <div class="col-6">Danh sách lợn hậu bị
            ( <strong>Lợn nái HB:</strong> <span id="total-female" class="text-danger">{{ $counts['total_female'] }}</span> |
            <strong>Lợn đực HB:</strong> <span id="total-male" class="text-success">{{ $counts['total_male'] }}</span> )
        </div>
        <div class="col-6 text-right">
            <button type="button" class="btn btn-light px-3 btn-sm" data-toggle="modal" data-target="#modalCreateBreed">
                <i class="bx bx-plus mr-1"></i>Thêm
            </button>
        </div>
    </div>
</div>
<div class="card-body">
    <div class="table-responsive">
        <table id="form-breed-list-table"
            class="table table-sm table-striped table-bordered table-fixed-column text-center table-hover">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Số tai</th>
                    <th>Giới tính</th>
                    <th class="fixed-column text-center">Hành động</th>
                </tr>
            </thead>
            <tbody>
                @if ($pigs->count() > 0)
                    @foreach ($pigs as $key => $pig)
                        <tr>
                            <td>{{ $key + 1 }}</td>
                            <td>{{ $pig->code }}</td>
                            <td>{{ \App\Helpers\Common::getGender($pig->gender) }}</td>
                            <td>
                                {{-- @if (Auth::user()->hasPermission('app.pig-breeds.edit')) --}}
                                <a class="btn btn-sm btn-success mr-1" target="_blank"
                                    href="{{ route('app.pig-centers.edit', $pig->id) }}" data-toggle="tooltip"
                                    title="Sửa &#128221"><i class="fadeIn animated bx bx-edit"></i>
                                </a>
                                {{-- @endif --}}
                                {{-- @if (Auth::user()->hasPermission('app.pig-breeds.destroy')) --}}
                                <button class="form-pig-breed-submit-delete btn btn-sm btn-danger delete-confirm-button" data-id="{{ $pig->id }}" type="button" data-toggle="tooltip" title="Xóa &#128683">
                                    <i class="fadeIn animated bx bx-trash"></i>
                                </button>
                                {{-- @endif --}}
                            </td>
                        </tr>
                    @endforeach
                @else
                    <td colspan="4">Không tồn tại bản ghi nào</td>
                @endif
            </tbody>
        </table>
    </div>
    <div class="justify-content-end d-flex pagination-render">
        {{ $pigs->links() }}
    </div>
</div>
