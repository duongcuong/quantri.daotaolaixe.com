@if ($calendar->type == 'exam_schedule')
@include('backend.calendars.sathach.modals.edit')
@elseif ($calendar->type == 'exam_edu')
@include('backend.calendars.totnghiep.modals.edit')
@elseif ($calendar->type == 'lythuyet')
@include('backend.calendars.lythuyet.modals.edit')
@elseif ($calendar->type == 'thuchanh')
@include('backend.calendars.thuchanh.modals.edit')
@elseif ($calendar->type == 'class_schedule')
@include('backend.calendars.dayhoc.modals.edit')
@else
@include('backend.calendars.modals.edit')
@endif
