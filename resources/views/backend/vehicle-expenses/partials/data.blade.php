<table id="example" class="table table-sm table-bordered table-hover">
    <thead>
        <tr>
            <th>STT</th>
            <th>Biển số Xe</th>
            <th>Loại chi phí</th>
            <th>Thời gian</th>
            <th>Số tiền</th>
            <th>Người chi</th>
            <th class="fixed-column text-center">Hành động</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($vehicle_expenses as $vehicle_expense)
        <tr>
            <td>{{ getSTT($vehicle_expenses, $loop->iteration) }}</td>
            <td>{{ $vehicle_expense->vehicle->license_plate }}</td>
            <td>{!! getTypeVahicleExpense($vehicle_expense->type) !!}</td>
            <td>{{ getDateTimeStamp($vehicle_expense->expense_date, 'd/m/Y') }}</td>
            <td>{{ $vehicle_expense->admin->name }}</td>
            <td>{!! getMoney($vehicle_expense->amount) !!}</td>

            <td class="fixed-column text-center">
                <div class="d-inline-flex">
                    {{-- <a href="{{ route('admins.vehicle-expenses.show', ['vehicle_expense' => $vehicle_expense->id]) }}"
                        class="btn btn-primary btn-sm mr-2 btn-edit-ajax" data-cs-modal="#modal-vehicle-expenses-edit-ajax">
                        <i class="lni lni-eye"></i>
                    </a> --}}
                    <a href="{{ route('admins.vehicle-expenses.edit', ['vehicle_expense' => $vehicle_expense->id, 'vehicle_id' => request()->vehicle_id ?? '']) }}"
                        class="btn btn-warning btn-sm mr-2 btn-edit-ajax" data-cs-modal="#modal-vehicle-expenses-edit-ajax">
                        <i class="bx bx-edit"></i>
                    </a>
                    <form action="{{ route('admins.vehicle-expenses.destroy', $vehicle_expense->id) }}" class="delete-form-ajax" method="POST"
                        style="display:inline-block;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm">
                            <i class="bx bx-trash"></i>
                        </button>
                    </form>
                </div>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
{{ $vehicle_expenses->links() }}
