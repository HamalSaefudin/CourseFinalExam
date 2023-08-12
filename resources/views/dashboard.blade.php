@extends('layouts.app')

@section('page-title')
Dashboard
@endsection
@push('add-js')
<script src="{{ $chart->cdn() }}"></script>
<link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
{{ $chart->script() }}
@endpush


@section('page-content')
@switch(Auth::user()->role)
@case('admin')
<div class="row">
    <div class="col-6 col-md-3">
        <div class="card">
            <div class="card-body px-4 py-4-5">
                <div class="row">
                    <div class="col-md-4 col-lg-5 d-flex justify-content-start ">
                        <div class="stats-icon purple mb-2">
                            <i class="bi bi-person-badge-fill"></i>
                        </div>
                    </div>
                    <div class="col-md-8 col-lg-7">
                        <h6 class="text-muted font-semibold">User</h6>
                        <h6 class="font-extrabold mb-0">{{ number_format($user_count) }}</h6>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-6 col-md-3">
        <div class="card">
            <div class="card-body px-4 py-4-5">
                <div class="row">
                    <div class="col-md-4 col-lg-5 d-flex justify-content-start ">
                        <div class="stats-icon blue mb-2">
                            <i class="bi bi-person-fill"></i>
                        </div>
                    </div>
                    <div class="col-md-8 col-lg-7">
                        <h6 class="text-muted font-semibold">Active Course</h6>
                        <h6 class="font-extrabold mb-0">{{ $activeCourse }}</h6>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-6 col-md-3">
        <div class="card">
            <div class="card-body px-4 py-4-5">
                <div class="row">
                    <div class="col-md-4 col-lg-4 d-flex justify-content-start ">
                        <div class="stats-icon gray mb-2">
                            <i class="bi bi-person-fill"></i>
                        </div>
                    </div>
                    <div class="col-md-8 col-lg-8">
                        <h6 class="text-muted font-semibold">InActive Course</h6>
                        <h6 class="font-extrabold mb-0">{{ $inActiveCourse }}</h6>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {!! $chart->container() !!}
</div>
@break

@case('user')
<div class="row">
    <div class="col-6 col-md-3">
        <div class="card">
            <div class="card-body px-4 py-4-5">
                <div class="row">
                    <div class="col-md-4 col-lg-5 d-flex justify-content-start ">
                        <div class="stats-icon blue mb-2">
                            <i class="bi bi-person-fill"></i>
                        </div>
                    </div>
                    <div class="col-md-8 col-lg-7">
                        <h6 class="text-muted font-semibold">User</h6>
                        <h6 class="font-extrabold mb-0">{{ number_format($user_count) }}</h6>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
@break
@endswitch
@endsection