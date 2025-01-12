@extends('backend.app')
@section('title')
    Giống
@endsection
@push('css')
@endpush
@section('content')
    <div class="page-breadcrumb d-none d-md-flex align-items-center mb-3">
        <div class="breadcrumb-title pr-3">Dashboard</div>
        <div class="pl-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="{{ route('app.dashboard') }}"><i class='bx bx-home-alt'></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Danh sách giống</li>
                </ol>
            </nav>
        </div>
    </div>
    <div class="row">
        <div class="col-md-3">
            @include('backend.settings.sidebar')
        </div>
        <div class="col-md-9">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex align-items-center">
                        <div class="ml-auto">
                            {{-- @if (Auth::user()->hasPermission('app.pig-centers.create')) --}}
                            <button type="button" class="btn btn-primary px-3" data-toggle="modal"
                                data-target="#modalCreateSettingBreed"><i class="bx bx-plus mr-1"></i>Thêm</button>
                            {{-- @endif --}}
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="form-list-table" class="table table-striped table-bordered text-center table-hover">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Giống</th>
                                    <th>Ghi chú</th>
                                    <th>Hành động</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal add -->
    <div class="modal fade" id="modalCreateSettingBreed" tabindex="-1" aria-labelledby="modalCreateSettingBreedLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <form class="row g-3 needs-validation form-submit-create" novalidate="" method="POST" action="{{ route('app.settings.breed.store') }}">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalCreateSettingBreedLabel">Thêm giống mới</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12 mb-3">
                                <label for="validationCustom04" class="form-label">Giống</label>
                                <input type="text" value="" name="name" placeholder="Nhập giống" class="form-control">
                                <div class="invalid-feedback">Vui lòng nhập giống.</div>
                            </div>
                            <div class="col-md-12 mb-3">
                                <label for="validationCustom04" class="form-label">Ghi chú</label>
                                <textarea name="description" id="" cols="30" rows="3" class="form-control" placeholder="Nhập ghi chú"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light px-5 mr-2" data-dismiss="modal">
                            <i class="bx bx-window-close me-1"></i>
                            Hủy
                        </button>
                        <button type="submit" class="btn btn-primary px-5">
                            <i class="bx bx-save me-1"></i>
                            Lưu
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal edit -->
    <div class="modal fade" id="modalEditSettingBreed" tabindex="-1" aria-labelledby="modalEditSettingBreedLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <form class="row g-3 needs-validation form-submit-edit" novalidate="">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalCreateSettingBreedLabel">Sửa giống</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12 mb-3">
                                <label for="validationCustom04" class="form-label">Giống</label>
                                <input type="text" value="" name="name" placeholder="Nhập giống" class="form-control">
                                <div class="invalid-feedback">Vui lòng nhập giống.</div>
                            </div>
                            <div class="col-md-12 mb-3">
                                <label for="validationCustom04" class="form-label">Ghi chú</label>
                                <textarea name="description" id="" cols="30" rows="3" class="form-control" placeholder="Nhập ghi chú"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light px-5 mr-2" data-dismiss="modal">
                            <i class="bx bx-window-close me-1"></i>
                            Hủy
                        </button>
                        <button type="submit" class="btn btn-primary px-5">
                            <i class="bx bx-save me-1"></i>
                            Lưu
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
@push('js')
<script>
    $(document).ready(function() {

        var elmTableResult = $('#form-list-table tbody');
        var elmFormSubmit = $('.form-submit-create');
        var elmModalCreate = $('#modalCreateSettingBreed');
        var elmModalEdit = $('#modalEditSettingBreed');
        var classToggleEditSettingBreed = '.toggleEditSettingBreed';
        var elmToggleEdit = $(classToggleEditSettingBreed);
        var elmFormSubmitEdit = $('.form-submit-edit');
        var classFormSubmitDelete = '.form-submit-delete';
        var classConfirm = '.delete-confirm';

        function getData() {
            loading.show();
            $.ajax({
                url: '{{ route('app.settings.breed.list') }}',
                type: 'GET',
                dataType: 'json',
                success: function(response) {
                    let htmlRes = "";
                    if (response.datas.length) {
                        response.datas.forEach((element, index) => {
                            htmlRes += `
                            <tr>
                                <td>${index + 1}</td>
                                <td>${element.name}</td>
                                <td>${element.description}</td>
                                <td>
                                    <button type="button"
                                        class="btn btn-sm btn-success mr-1 toggleEditSettingBreed" data-id="${element.id}"
                                        data-toggle="tooltip" title="Sửa &#128221">
                                        <i class="fadeIn animated bx bx-edit"></i>
                                    </button>
                                    <form action="#" class="form-submit-delete" style="display: inline-block" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-sm btn-danger delete-confirm" data-id="${element.id}" type="button"
                                            data-toggle="tooltip" title="Xóa &#128683">
                                            <i class="fadeIn animated bx bx-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            `;
                        });
                    }
                    elmTableResult.html(htmlRes);
                },
                error: function(xhr, status, error) {
                    console.log(error);
                },
                complete: function() {
                    loading.hide();
                }
            });
        }
        getData();

        function validateForm(form) {
            var elmName = form.find('input[name="name"]');
            var valName = elmName.val();
            if (!valName) elmName.addClass('is-invalid')
            else elmName.removeClass('is-invalid');

            if (!valName) return false;
            return true;
        }

        elmFormSubmit.on("submit", function(e) {
            e.preventDefault();
            var form = $(this);
            if (!validateForm(form)) return;
            loading.show();
            var url = form.attr('action');
            var method = form.attr('method');
            var data = form.serialize();

            $.ajax({
                url: url,
                type: method,
                data: data,
                dataType: 'json',
                success: function(response) {
                    alertSuccess(response.msg);
                    form[0].reset();
                    elmModalCreate.modal('hide');
                    getData();
                },
                error: function(xhr, status, error) {
                    alertErrorAPI(xhr.responseJSON.errors);
                },
                complete: function() {
                    loading.hide();
                }
            });
        });

        elmFormSubmitEdit.on("submit", function(e) {
            e.preventDefault();
            var form = $(this);
            if (!validateForm(form)) return;
            loading.show();

            var url = form.attr('action');
            var method = form.attr('method');
            var data = form.serialize();

            $.ajax({
                url: url,
                type: method,
                data: data,
                dataType: 'json',
                success: function(response) {
                    alertSuccess(response.msg);
                    form[0].reset();
                    elmModalEdit.modal('hide');
                    getData();
                },
                error: function(xhr, status, error) {
                    alertErrorAPI(xhr.responseJSON.errors);
                },
                complete: function() {
                    loading.hide();
                }
            });
        });

        var urlUpdate = '';

        function getDetail(id){
            loading.show();
            let url = '';
            url = `{{ route('app.settings.breed.edit', ['id' => '__id__']) }}`;
            url = url.replace('__id__', id);

            urlUpdate = `{{ route('app.settings.breed.update', ['id' => '__id__']) }}`;
            urlUpdate = urlUpdate.replace('__id__', id);
            $.ajax({
                url: url,
                type: 'GET',
                dataType: 'json',
                success: function(response) {
                    elmFormSubmitEdit.find('.modal-title').html(`Sửa chi phí <strong>${response.datas.name}</strong>`);
                    elmFormSubmitEdit.find('input[name="name"]').val(response.datas.name);
                    elmFormSubmitEdit.find('textarea[name="description"]').val(response.datas.description);
                    elmModalEdit.modal()
                },
                error: function(xhr, status, error) {
                    alertErrorAPI(xhr.responseJSON.errors);
                },
                complete: function() {
                    loading.hide();
                }
            });
        }

        $(document).on('click', classToggleEditSettingBreed, function() {
            let id = $(this).data('id');
            getDetail(id);
        });

        elmFormSubmitEdit.on("submit", function(e) {
            e.preventDefault();
            var form = $(this);
            if (!validateForm(form)) return;
            loading.show();
            var data = form.serialize();

            $.ajax({
                url: urlUpdate,
                type: 'PUT',
                data: data,
                dataType: 'json',
                success: function(response) {
                    alertSuccess(response.msg);
                    form[0].reset();
                    elmModalEdit.modal('hide');
                    getData();
                },
                error: function(xhr, status, error) {
                    alertErrorAPI(xhr.responseJSON.errors);
                },
                complete: function() {
                    loading.hide();
                }
            });
        });

        $(document).on('submit', classFormSubmitDelete, function(e) {
            e.preventDefault();
            loading.show();
            let id = $(this).find('button').data('id');
            let url = `{{ route('app.settings.breed.delete', ['id' => '__id__']) }}`;
            url = url.replace('__id__', id);

            $.ajax({
                url: url,
                type: 'DELETE',
                dataType: 'json',
                success: function(response) {
                    alertSuccess(response.msg);
                    getData();
                },
                error: function(xhr, status, error) {
                    loading.hide();
                    if(xhr.status === 500){
                        alertError('Bạn không được xóa bản ghi này vì các thành phần khác sử dụng các thành phần này!');
                        return;
                    }
                    alertErrorAPI(xhr.responseJSON.errors);
                },
                complete: function() {
                    loading.hide();
                }
            });
        });
    });
</script>
@endpush
