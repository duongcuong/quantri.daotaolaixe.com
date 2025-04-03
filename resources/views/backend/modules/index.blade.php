@extends('backend.app')
@section('title')
All Modules
@endsection
@push('css')
@endpush
@section('content')
<div class="row">
    <div class="col-md-6">
        <div class="d-flex mb-3">
            <div class="page-breadcrumb d-flex align-items-center">
                <div class="">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0 p-0">
                            <li class="breadcrumb-item"><a href="{{ route('admins.dashboard') }}"><i
                                        class='bx bx-home-alt'></i></a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">Module</li>
                        </ol>
                    </nav>
                </div>
            </div>
            <div class="ml-auto">
                {{-- @if (Auth::user()->hasPermission('admins.modules.index')) --}}
                <a class="btn btn-outline-primary btn-sm" href="{{ route('admins.modules.create') }}"
                    data-toggle="tooltip" title="Thêm mới"><i class="bx bx-plus"></i>Thêm mới</a>
                {{-- @endif --}}
            </div>
        </div>
        <div class="card radius-15">
            <div class="card-body">
                <div class="table-responsive">
                    <table id="example" class="table table-sm table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>Tên</th>
                                <th>Hành động</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($modules as $module)
                            <tr>
                                <td>
                                    {{ $module->name }}
                                </td>

                                <td>
                                    {{-- <a href="{{ route('admins.modules.show', $module->id) }}" class="">
                                        <i class="bx lni-eye"></i>
                                    </a> --}}
                                    <a href="{{ route('admins.modules.edit', $module->id) }}"
                                        class="btn btn-warning btn-sm mr-2">
                                        <i class="bx bx-edit"></i>
                                    </a>
                                    <form action="{{ route('admins.modules.destroy', $module->id) }}" method="POST"
                                        style="display:inline-block;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm delete-btn">
                                            <i class="bx bx-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{ $modules->links() }}
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
@push('js')
@endpush
