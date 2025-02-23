@extends('backend.app')
@section('title')
Tất cả Lịch
@endsection
@push('css')
@endpush
@section('content')
<div class="d-flex mb-3">
    <div class="page-breadcrumb d-flex align-items-center">
        <div class="">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="{{ route('admins.dashboard') }}"><i
                                class='bx bx-home-alt'></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Lịch</li>
                </ol>
            </nav>
        </div>
    </div>
    <div class="ml-auto">
        {{-- @if (Auth::user()->hasPermission('admins.calendars.index')) --}}
        @foreach (listTypeCalendars() as $key => $item)
        <a class="btn btn-outline-primary btn-sm btn-create-ajax mr-2 mb-2" href="{{ route('admins.calendars.create', ["type" => $key]) }}"
            data-cs-modal="#modal-calendars-create-ajax" title="Thêm mới">
            <i class="bx bx-plus"></i>
            {!! $item !!}
        </a>
        @endforeach
        {{-- @endif --}}
    </div>
</div>

<div class="card radius-15">
    <div class="card-body">
        <div class="table-responsive">
            <div id='calendar'></div>
        </div>
    </div>
</div>

<div class="card radius-15">
    <div class="card-body">
        <div class="table-responsive mt-1 mb-1 load-data-ajax" data-url="{{ route('admins.calendars.data') }}"
            id="load-data-ajax-calendars" data-search="#search-form-calendars">
            <div class="loading-overlay">
                <div class="loading-spinner"></div>
            </div>
        </div>
    </div>
</div>
@endsection
@push('js')
<script>
    function getColorByType(type, isPast) {
        if (isPast) {
            return 'gray'; // Màu sắc cho lịch đã qua
        }
        switch (type) {
            case 'task':
                return 'red';
            case 'meeting':
                return 'blue';
            case 'call':
                return 'green';
            case 'exam_schedule':
                return 'orange';
            default:
                return 'gray';
        }
    }

    document.addEventListener('DOMContentLoaded', function () {
        var calendarEl = document.getElementById('calendar');
        var calendar = new FullCalendar.Calendar(calendarEl, {
            headerToolbar: {
                left: 'prev,next today',
                center: 'title',
                right: 'dayGridMonth,timeGridWeek,timeGridDay,listWeek'
            },
            initialView: 'dayGridMonth',
            navLinks: true,
            selectable: true,
            nowIndicator: true,
            // dayMaxEvents: true,
            editable: true,
            businessHours: true,
            events: [
                @foreach ($calendars as $calendar)
                {
                    id: '{{ $calendar->id }}',
                    title: '{{ $calendar->name }}',
                    start: '{{ $calendar->date_start }}',
                    end: '{{ $calendar->date_end }}',
                    color: getColorByType('{{ $calendar->type }}', new Date('{{ $calendar->date_end }}') < new Date())
                },
                @endforeach
            ],
            dateClick: function(info) {
                var createButton = $('<button/>', {
                    class: 'btn-create-ajax',
                    style: 'display:none;',
                    href: '{{ route('admins.calendars.create') }}',
                    'data-cs-modal': '#modal-calendars-create-ajax',
                }).appendTo('body');
                createButton.trigger('click');
                createButton.remove();
            },
            eventClick: function(info) {
                if (new Date(info.event.end) < new Date()) {
                    alertError('Không thể chỉnh sửa lịch đã qua.');
                    return;
                }
                var editButton = $('<button/>', {
                    class: 'btn-edit-ajax',
                    style: 'display:none;',
                    href: '/admin/calendars/' + info.event.id + '/edit',
                    'data-cs-modal': '#modal-calendars-edit-ajax'
                }).appendTo('body');

                editButton.trigger('click');
                editButton.remove();

            }
        });
        calendar.render();
    });

</script>
@endpush
