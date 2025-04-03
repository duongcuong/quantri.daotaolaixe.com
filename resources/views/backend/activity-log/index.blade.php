@extends('backend.app')
@section('title')
All user
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
                    <li class="breadcrumb-item active" aria-current="page">Log</li>
                </ol>
            </nav>
        </div>
    </div>
</div>
<div class="card radius-15">
    <div class="card-body">
        <div class="table-responsive">
            <table id="example" class="table table-sm table-bordered table-hover">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Mô tả</th>
                        <th>Model</th>
                        <th>Bản ghi</th>
                        <th>Người thực hiện</th>
                        <th>Hành động</th>
                        <th>Ngày thực hiện</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($activities as $activity)
                    <tr>
                        <td>{{ $activity->id }}</td>
                        <td>{{ $activity->description }}</td>
                        <td>{{ $activity->subject_type }}</td>
                        <td>{{ $activity->subject_id }}</td>
                        <td>
                            @if ($activity->causer_type == 'App\Models\Admin')
                            @php
                            $causer = \App\Models\Admin::find($activity->causer_id);
                            @endphp
                            @if ($causer)
                            <a href="{{ route('admins.admins.show', $causer->id) }}">{{ $causer->name }}</a>
                            @else
                            N/A
                            @endif
                            @else
                            N/A
                            @endif
                        </td>
                        <td>{{ json_encode($activity->properties) }}</td>
                        <td>{{ $activity->created_at }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            {{ $activities->links() }}
        </div>
    </div>
</div>

@endsection
@push('js')
@endpush
