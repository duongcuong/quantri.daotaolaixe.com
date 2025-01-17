@extends('backend.app')
@section('title')
Import Khoá Học Học Viên
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
                    <li class="breadcrumb-item active" aria-current="page">Import Khoá Học Học Viên</li>
                </ol>
            </nav>
        </div>
    </div>
</div>

<div class="card radius-15">
    <div class="card-body">
        <div class="card-title">
            <h4 class="mb-0">Import Khoá học - Học viên</h4>
        </div>
        <hr />
        <form action="{{ route('admins.course-user.importFile') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <input id="image-uploadify" type="file"
                accept=".xlsx,.xls,image/*,.doc,audio/*,.docx,video/*,.ppt,.pptx,.txt,.pdf" name="file_xlsx">
            <button type="submit" class="btn btn-primary"><i class="lni lni-cloud-upload mr-2"></i>Import</button>
        </form>
    </div>
</div>

@endsection
@push('js')
@endpush
