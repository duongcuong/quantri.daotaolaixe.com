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
        <div class="card-title d-flex align-items-center justify-content-between">
            <h4 class="mb-0">Import Khoá học - Học viên</h4>
            <a class="btn btn-outline-danger btn-sm mr-2" href="{{ asset('backend/files/hsmn2024.xlsx') }}"
            title="Import" download><i class="lni lni-cloud-download mr-1"></i>Download file</a>
        </div>
        <hr />
        <form action="" method="POST" enctype="multipart/form-data" id="import-form">
            @csrf
            <input id="image-uploadify" type="file" accept=".xlsx,.xls" name="file_xlsx">
            <button type="submit" class="btn btn-primary"><i class="lni lni-cloud-upload mr-2"></i>Import</button>
        </form>

        <div id="progress-container" style="display: none;">
            <h3>Đang import...</h3>
            <div class="progress">
                <div id="progress-bar" class="progress-bar" role="progressbar" style="width: 0%;" aria-valuenow="0"
                    aria-valuemin="0" aria-valuemax="100">0%</div>
            </div>
        </div>
    </div>
</div>
<form data-reload="#load-data-ajax-imports" id="search-form-imports" class="mb-3 form-search-submit">
    @csrf
</form>
<div class="card radius-15">
    <div class="card-body">
        <div class="table-responsive mt-1 mb-1 load-data-ajax" data-url="{{ route('admins.imports.data') }}"
            id="load-data-ajax-imports" data-search="#search-form-imports">
            <div class="loading-overlay">
                <div class="loading-spinner"></div>
            </div>
        </div>
    </div>
</div>

@endsection
@push('js')
<script>
    $(document).ready(function() {
        var isImport = false;
        var isImportSuccess = false;
        $('#import-form').on('submit', function(e) {
            e.preventDefault();
            isImport = true;

            $('#progress-bar').css('width', 0 + '%');
            $('#progress-bar').text(Math.round(0) + '%');

            var formData = new FormData(this);
            $.ajax({
                url: '{{ route('admins.course-user.importFile') }}',
                type: 'POST',
                data: formData,
                contentType: false,
                processData: false,
                success: function(response) {
                    isImportSuccess = true;
                    $('.form-search-submit').submit();
                },
                error: function(xhr, status, error) {
                    alert('Có lỗi xảy ra: ' + error);
                }
            });
        });

        var interval = setInterval(function() {
            if (isImport) {
                $('#progress-container').show();
                $.ajax({
                    url: '{{ route('admins.course-user.importProgress') }}',
                    type: 'GET',
                    success: function(progress) {
                        var percentComplete = (progress.processed / progress.total) * 100;
                        $('#progress-bar').css('width', percentComplete + '%');
                        $('#progress-bar').text(Math.round(percentComplete) + '%');

                        if (isImportSuccess) {
                            setTimeout(function() {
                                clearInterval(interval);
                            }, 2000);
                        }
                    }
                });
            }
        }, 1000);
    });
</script>
@endpush
