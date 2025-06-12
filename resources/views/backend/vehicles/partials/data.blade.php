<table id="example" class="table table-sm table-bordered table-hover">
    <thead>
        <tr>
            <th rowspan="2">STT</th>
            <th rowspan="2">Biển số</th>
            <th rowspan="2">Model</th>
            <th rowspan="2">Hạng</th>
            <th rowspan="2">Loại</th>
            <th rowspan="2">Màu sắc</th>
            <th rowspan="2">Số GPTL</th>
            {{-- <th>Ngày hết hạn GPTL</th> --}}
            <th rowspan="2">Năm SX</th>
            <th colspan="2">Số giờ chạy được</th>
            <th rowspan="2">Ghi chú</th>
            <th class="fixed-column text-center" rowspan="2">Hành động</th>
        </tr>
        <tr>
            <th>Sa hình</th>
            <th>Chạy DAT</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($vehicles as $vehicle)
        <tr>
            <td>{{ getSTT($vehicles, $loop->iteration) }}</td>
            <td>
                <a href="{{ route('admins.vehicles.show', ['vehicle' => $vehicle->id]) }}">
                    {{ $vehicle->license_plate }}
                </a>
            </td>
            <td>{{ $vehicle->model }}</td>
            <td>{{ $vehicle->rank }}</td>
            <td>{{ $vehicle->type }}</td>
            <td>{{ $vehicle->color }}</td>
            <td>{{ $vehicle->gptl_number }}</td>
            {{-- <td>{{ getDateTimeStamp($vehicle->gptl_expiry_date, 'd/m/Y') }}</td> --}}
            <td>{{ $vehicle->manufacture_year }}</td>
            <td>{{ getFormattedSoGioChayDuocAttribute($vehicle->so_gio_chay_duoc_thuc_hanh) }}</td>
            <td>{{ getFormattedSoGioChayDuocAttribute($vehicle->so_gio_chay_duoc_chay_dat) }}</td>
            <td>{{ $vehicle->note }}</td>
            <td class="fixed-column text-center">
                <div class="d-inline-flex">
                    <a href="{{ route('admins.vehicles.show', ['vehicle' => $vehicle->id]) }}"
                        class="btn btn-primary btn-sm mr-2">
                        <i class="lni lni-eye"></i>
                    </a>
                    <a href="{{ route('admins.vehicles.edit', $vehicle->id) }}" class="btn btn-warning btn-sm mr-2">
                        <i class="bx bx-edit"></i>
                    </a>
                    <form action="{{ route('admins.vehicles.destroy', $vehicle->id) }}" method="POST"
                        style="display:inline-block;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm delete-btn-confirm">
                            <i class="bx bx-trash"></i>
                        </button>
                    </form>
                </div>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
{{ $vehicles->links() }}
