<table id="example" class="table table-sm table-bordered table-hover">
    <thead>
        <tr>
            <th rowspan="2">STT</th>
            {{-- <th rowspan="2">Avatar</th> --}}
            <th rowspan="2">Mã ĐK</th>
            <th rowspan="2">Hạng</th>
            <th rowspan="2">Họ tên</th>
            <th rowspan="2">Ngày sinh</th>
            <th rowspan="2">Giới tính</th>
            <th rowspan="2">Ngày kí hợp đồng</th>
            <th rowspan="2">CMT/CCCD</th>
            {{-- <th rowspan="2">Id thẻ</th> --}}
            <th rowspan="2">Số thẻ</th>
            <th rowspan="2">Giáo viên</th>
            <th colspan="3" class="text-center">
                Tình trạng học
            </th>
            <th colspan="4" class="text-center">
                Phiên học
            </th>
            <th colspan="3" class="text-center">
                Học phí
            </th>
            <th rowspan="2">Trạng thái</th>
            <th class="fixed-column text-center" rowspan="2">Hành động</th>
        </tr>
        <tr>
            <th>Thi hết LT</th>
            <th>Thi hết TH</th>
            <th>Thi tốt nghiệp</th>
            <th>Giờ</th>
            <th>Km</th>
            <th>Giờ đêm</th>
            <th>Giờ tự động</th>
            <th class="text-center">Tổng</th>
            <th class="text-center">Đã nộp</th>
            <th class="text-center">Còn thiếu</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($courseUsers as $courseUser)
        <tr>
            <td>{{ getSTT($courseUsers, $loop->iteration) }}</td>
            {{-- <td>
                <img src="{{ getImageUpload($courseUser->user->thumbnail, 'users', 'small') }}" alt="User Thumbnail"
                    class="avatar" width="50">
            </td> --}}
            <td>{{ $courseUser->course->code }}</td>
            <td>{{ $courseUser->course->rank }}</td>
            <td>
                {{-- <a class="btn-show-list-ajax"
                    href="{{ route('admins.calendars.learningExam', ['course_user_id' => $courseUser->id]) }}"
                    data-cs-modal="#modal-dat-calendars-ajax" data-reload="#load-data-ajax-dat-calendars">
                    {{ $courseUser->user->name ?? '' }}
                </a> --}}
                <a class="" href="{{ route('admins.course-user.show', $courseUser->id) }}"
                    data-cs-modal="#modal-dat-calendars-ajax" data-reload="#load-data-ajax-dat-calendars">
                    {{ $courseUser->user->name ?? '' }}
                </a>
            </td>
            <td>{{ \Carbon\Carbon::parse($courseUser->user->dob)->format('d/m/Y') }}</td>
            <td>{{ $courseUser->user->gender == 0 ? 'Nam' : ($courseUser->user->gender == 1 ? 'Nữ' : 'Khác')
                }}</td>
            <td>{{ getDateTimeStamp($courseUser->contract_date, 'd/m/Y') }}</td>
            <td>{{ $courseUser->user->identity_card }}</td>
            {{-- <td>{{ $courseUser->user->card_name }}</td> --}}
            <td>{{ $courseUser->user->card_number }}</td>

            <td>{{ $courseUser->teacher->name ?? '' }}</td>

            <td class="text-center fs-5">{!! getTickTrueOrFalse($courseUser->theory_exam) !!}</td>
            <td class="text-center fs-5">{!! getTickTrueOrFalse($courseUser->practice_exam) !!}</td>
            <td class="text-center fs-5">{!! getTickTrueOrFalse($courseUser->graduation_exam) !!}</td>

            <td>
                @if ($courseUser->calendars_sum_km > 0)
                <a class="btn-show-list-ajax"
                    href="{{ route('admins.calendars.dat', ['course_user_id' => $courseUser->id]) }}"
                    data-cs-modal="#modal-dat-calendars-ajax" data-reload="#load-data-ajax-dat-calendars">{{
                    getFormattedSoGioChayDuocAttribute($courseUser->calendars_sum_so_gio_chay_duoc) }}</a>
                @else
                {{ getFormattedSoGioChayDuocAttribute($courseUser->calendars_sum_so_gio_chay_duoc) }}
                @endif
            </td>
            <td>
                @if ($courseUser->calendars_sum_km > 0)
                <a class="btn-show-list-ajax-dat"
                    href="{{ route('admins.calendars.dat', ['course_user_id' => $courseUser->id]) }}">{{
                    number_format($courseUser->calendars_sum_km, 2) }}</a>
                @else
                {{ number_format($courseUser->calendars_sum_km) }}
                @endif
            </td>
            <td>{{ getFormattedSoGioChayDuocAttribute($courseUser->total_so_gio_chay_duoc_tudong) }}</td>
            <td>{{ getFormattedSoGioChayDuocAttribute($courseUser->total_so_gio_chay_duoc_bandem) }}</td>
            <td>{!! getMoney($courseUser->course->tuition_fee) !!}</td>
            <td>{!! getMoney($courseUser->fees_sum_amount) !!}</td>
            <td>{!! getMoneyConThieu($courseUser->tuition_fee, $courseUser->fees_sum_amount) !!}</td>
            <td>{!! getStatusCalendarByType2($courseUser->latestCalendar->type ?? '',
                $courseUser->latestCalendar->status ?? '') !!}</td>
            <td class="fixed-column text-center">
                <div class="d-flex">
                    @if (canAccess('admins.course-user.show'))
                    <a href="{{ route('admins.course-user.show', $courseUser->id) }}"
                        class="btn btn-primary btn-sm mr-1">
                        <i class="lni lni-eye"></i>
                    </a>
                    @endif

                    @if (canAccess('admins.course-user.edit'))
                    <a href="{{ route('admins.course-user.edit', $courseUser->id) }}"
                        class="btn btn-warning btn-sm mr-1">
                        <i class="bx bx-edit"></i>
                    </a>
                    @endif

                    @if (canAccess('admins.course-user.destroy'))
                    <form action="{{ route('admins.course-user.destroy', $courseUser->id) }}" class="delete-form-ajax"
                        method="POST" style="display:inline-block;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm delete-btn-confirm">
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
{{ $courseUsers->links() }}
