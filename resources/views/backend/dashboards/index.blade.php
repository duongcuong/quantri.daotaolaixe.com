@section('title')
App Dashboard
@endsection
@extends('backend.app')
@section('content')
<div class="row">
    <div class="col-12 col-lg-6">
        <div class="card w-100">
            <div class="card-body">
                <div>
                    <div id="chart5"></div>
                    <p class="total-number-chart">0</p>
                </div>
            </div>
        </div>
    </div>
    <div class="col-12 col-lg-6">
        <div class="card w-100">
            <div class="card-body">
                <div id="chart1"></div>
            </div>
        </div>
    </div>
</div>
@endsection
@push('js')
@endpush
