@extends('backend.app')
@section('title')
Xem chi tiết file Upload
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
                    <li class="breadcrumb-item active" aria-current="page">Xem chi tiết</li>
                </ol>
            </nav>
        </div>
    </div>
</div>

<div class="container-fluid p-0">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Course User ID</th>
                                    {{-- <th>Row Data</th> --}}
                                    <th>Success</th>
                                    <th>Error Message</th>
                                    <th>Created At</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($importRows as $row)
                                <tr>
                                    <td>{{ $row->id }}</td>
                                    <td><a href="{{ route("admins.course-user.show", $row->course_user_id) }}" target="_blank">Xem học viên</a></td>
                                    {{-- <td>{{ $row->row_data }}</td> --}}
                                    <td>{{ $row->success ? 'Yes' : 'No' }}</td>
                                    <td>{{ $row->error_message }}</td>
                                    <td>{{ $row->created_at }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="mt-3">
                        {{ $importRows->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
@push('js')
@endpush
