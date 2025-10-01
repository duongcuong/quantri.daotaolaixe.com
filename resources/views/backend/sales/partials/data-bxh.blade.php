<style>
    /* Bảng xếp hạng highlight top 3 */
    table.table-bxh tbody tr.rank-1 {
        background: linear-gradient(90deg, #fff7e0, #ffe9b3);
        font-weight: 600;
    }

    table.table-bxh tbody tr.rank-2 {
        background: linear-gradient(90deg, #eef6ff, #d6e9ff);
        font-weight: 600;
    }

    table.table-bxh tbody tr.rank-3 {
        background: linear-gradient(90deg, #f3ecff, #e2d8ff);
        font-weight: 600;
    }

    table.table-bxh tbody tr.rank-1:hover,
    table.table-bxh tbody tr.rank-2:hover,
    table.table-bxh tbody tr.rank-3:hover {
        filter: brightness(0.97);
    }

    /* Badge nhỏ cho hạng */
    .rank-badge {
        display: inline-flex;
        align-items: center;
        gap: 4px;
        padding: 2px 6px;
        border-radius: 12px;
        font-size: 12px;
        line-height: 1.1;
        background: #ececec;
    }

    .rank-1 .rank-badge {
        background: #ffcf33;
        color: #5c4200;
    }

    .rank-2 .rank-badge {
        background: #c9d6e7;
        color: #23374d;
    }

    .rank-3 .rank-badge {
        background: #d9c6ff;
        color: #3d2866;
    }
</style>
<div class="alert alert-info py-2 mb-2">
    <strong class="text-danger">Tổng doanh thu:</strong> {!! getMoney($totalRevenueAll) !!} |
    <strong class="text-danger">Tổng số hợp đồng:</strong> {{ number_format($totalContractsAll) }}
</div>
<table id="example" class="table table-sm table-bordered table-hover">
    <thead>
        <tr>
            <th style="width: 50px;">STT</th>
            <th>Họ tên</th>
            <th>Giới tính</th>
            <th>Ngày sinh</th>
            <th>CMT/CCCD</th>
            <th>Địa chỉ</th>
            <th>SĐT</th>
            <th>Số Hợp Đồng Đã Ký</th>
            <th>Doanh thu</th>
            <th>Ngày hoạt động</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($sales as $sale)
        @php
        // Lấy thứ hạng thực tế (kể cả phân trang)
        $rank = getSTT($sales, $loop->iteration);
        @endphp
        <tr class="{{ $rank <= 3 ? 'rank-' . $rank : '' }}">
            <td>
                @if($rank <= 3) <span class="rank-badge">
                    @if($rank === 1) 🥇
                    @elseif($rank === 2) 🥈
                    @elseif($rank === 3) 🥉
                    @endif
                    {{ $rank }}
                    </span>
                    @else
                    {{ $rank }}
                    @endif
            </td>
            <td>
                @if($rank === 1)
                <strong>{{ $sale->name }}</strong>
                @else
                {{ $sale->name }}
                @endif
            </td>
            <td>{{ getGender($sale->gender) }}</td>
            <td>{{ $sale->dob }}</td>
            <td>{{ $sale->identity_card }}</td>
            <td>{{ $sale->address }}</td>
            <td>{{ $sale->phone }}</td>
            <td>{{ number_format($sale->total_contracts) }}</td>
            <td>{!! getMoney($sale->total_revenue) !!}</td>
            <td>{{ getDateTimeStamp($sale->created_at, 'd/m/Y') }}</td>

        </tr>
        @endforeach
    </tbody>
</table>
{{ $sales->links() }}