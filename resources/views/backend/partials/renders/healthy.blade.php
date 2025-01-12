<div class="table-responsive">
    <table id="form-breeding-list-table"
        class="table table-sm table-striped table-bordered table-fixed-column text-center table-hover">
        <thead>
            <tr>
                <th>Lứa đẻ</th>
                <th>Số tai nái</th>
                <th>Ngày động dục</th>
                <th>Ngày phối L1</th>
                <th>Đực phối L1</th>
                <th>Ngày phối L2</th>
                <th>Đực phối L2</th>
                <th>Tuần phối</th>
                <th>Ngày chửa thực tế</th>
                <th>Ngày đẻ thực tế</th>
                <th>Kết quả</th>
                <th>SL con</th>
                <th>Mã đàn con</th>
                <th>Ngày cai sữa</th>
                <th class="fixed-column text-center">Hành động</th>
            </tr>
        </thead>
        <tbody>
            @if ($datas->count() > 0)
                @foreach ($datas as $key => $data)
                    <tr>
                        <td>{{ $key + 1 }}</td>
                        <td>{{ $data->code }}</td>
                        <td>{{ convertDateVn($data->oestrous_day) }}</td>
                        <td>{{ convertDateVn($data->breeding_date_first) }}</td>
                        <td>{{ $data->male_first_code }}</td>
                        <td>{{ convertDateVn($data->breeding_date_second) }}</td>
                        <td>{{ $data->male_second_code }}</td>
                        <td>{{ $data->week }}</td>
                        <td>{{ convertDateVn($data->pregnancy_day) }}</td>
                        <td>{{ convertDateVn($data->actual_date_of_birth) }}</td>
                        <td>
                            @if ($data->result == \App\Helpers\Constant::STATUS_SUCCESS)
                                <span class="text-success">{{ \App\Helpers\Common::getResult($data->result) }}</span>
                            @elseif($data->result == \App\Helpers\Constant::STATUS_MISCARRIAGE)
                                <span class="text-warning">{{ \App\Helpers\Common::getResult($data->result) }}</span>
                            @else
                                <span class="text-danger">{{ \App\Helpers\Common::getResult($data->result) }}</span>
                            @endif
                        </td>
                        <td>{{ $data->number_of_children_to_raise }}</td>
                        <td>{{ $data->code_children }}</td>
                        <td>{{ convertDateVn($data->weaning_date) }}</td>
                        <td class="fixed-column text-center">
                            <button type="button" class="btn btn-sm btn-success mr-1 toggleEditBreeding"
                                data-id="{{ $data->id }}" data-toggle="tooltip" title="Sửa &#128221">
                                <i class="fadeIn animated bx bx-edit"></i>
                            </button>
                            <button class="form-breeding-submit-delete btn btn-sm btn-danger delete-confirm-button"
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
<div class="justify-content-end d-flex pagination-heathy-render">
    {{ $datas->links() }}
</div>
