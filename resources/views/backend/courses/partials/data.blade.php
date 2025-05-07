<table id="example" class="table table-sm table-bordered table-hover">
    <thead>
        <tr>
            <th>STT</th>
            <th>Mã</th>
            <th>Hạng</th>
            <th>Ngày học Cabin</th>
            <th>Ngày học DAT</th>
            {{-- <th>Hạng GP</th> --}}
            <th>Số BC</th>
            <th>Ngày BCI</th>
            <th>Khai giảng</th>
            <th>Bế giảng</th>
            <th>Số HS</th>
            {{-- <th>QĐKG</th> --}}
            <th>Thời gian</th>
            {{-- <th>Học phí</th> --}}
            <th class="fixed-column text-center">Hành động</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($courses as $course)
        <tr>
            <td>{{ getSTT($courses, $loop->iteration) }}</td>
            <td>
                <a href="{{ route('admins.course-user.index', ['course_id' => $course->id]) }}">
                    {{ $course->code }}
                </a>
            </td>
            <td>{{ $course->rank }}</td>
            <td>{{ getDateTimeStamp($course->ngay_hoc_cabin, 'd/m/Y') }}</td>
            <td>{{ getDateTimeStamp($course->ngay_hoc_dat, 'd/m/Y') }}</td>
            {{-- <td>{{ $course->rank_gp }}</td> --}}
            <td>{{ $course->number_bc }}</td>
            <td>{{ \Carbon\Carbon::parse($course->date_bci)->format('d/m/Y') }}</td>
            <td>{{ \Carbon\Carbon::parse($course->start_date)->format('d/m/Y') }}</td>
            <td>{{ \Carbon\Carbon::parse($course->end_date)->format('d/m/Y') }}</td>
            <td>{{ $course->course_users_count }}</td>
            {{-- <td>{{ $course->decision_kg }}</td> --}}
            <td>{{ $course->duration }}</td>
            {{-- <td>{!! getMoney($course->tuition_fee) !!}</td> --}}
            <td class="fixed-column text-center">
                <div class="d-flex">
                    @if(canAccess('admins.courses.edit'))
                    <a href="{{ route('admins.courses.edit', $course->id) }}" class="btn btn-warning btn-sm mr-2 btn-edit-ajax" data-cs-modal="#modal-courses-edit-ajax">
                        <i class="bx bx-edit"></i>
                    </a>
                    @endif

                    @if(canAccess('admins.courses.destroy'))
                    <form action="{{ route('admins.courses.destroy', $course->id) }}" class="delete-form-ajax" method="POST"
                        style="display:inline-block;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm">
                            <i class="bx bx-trash"></i>
                        </button>
                    </form>
                    @endif
                </div>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
{{ $courses->links() }}
