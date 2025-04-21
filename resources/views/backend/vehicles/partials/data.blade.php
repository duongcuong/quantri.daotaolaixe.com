<table id="example" class="table table-sm table-bordered table-hover">
    <thead>
        <tr>
            <th>STT</th>
            <th>Biển số</th>
            <th>Model</th>
            <th>Hạng</th>
            <th>Loại</th>
            <th>Màu sắc</th>
            <th>Số GPTL</th>
            {{-- <th>Ngày hết hạn GPTL</th> --}}
            <th>Năm SX</th>
            <th>Số giờ chạy được</th>
            <th>Ghi chú</th>
            <th class="fixed-column text-center">Hành động</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($vehicles as $vehicle)
        <tr>
            <td>{{ getSTT($vehicles, $loop->iteration) }}</td>
            <td>{{ $vehicle->license_plate }}</td>
            <td>{{ $vehicle->model }}</td>
            <td>{{ $vehicle->rank }}</td>
            <td>{{ $vehicle->type }}</td>
            <td>{{ $vehicle->color }}</td>
            <td>{{ $vehicle->gptl_number }}</td>
            {{-- <td>{{ getDateTimeStamp($vehicle->gptl_expiry_date, 'd/m/Y') }}</td> --}}
            <td>{{ $vehicle->manufacture_year }}</td>
            <td>{{ getFormattedSoGioChayDuocAttribute($vehicle->calendars_sum_so_gio_chay_duoc) }}</td>
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
