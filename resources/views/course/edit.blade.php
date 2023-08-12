@extends('layouts.app')

@section('page-title')
Tambah Courses
@endsection

@push('add-css')
@endpush

@push('add-js')
@endpush

@section('page-content')
@include('layouts.partials.alert')
<div class="card">
    <form action="{{ route('course.update',$course->id) }}" method="POST" class="needs-validation" novalidate>
        @csrf
        @method('PUT')
        <div class="card-content">
            <div class="card-body">
                <h4 class="card-title mb-5">Form Courses</h4>
                <div class="row">
                    <div class="col-12 col-md-8">
                        <div class="form-group">
                            <label for="course_name">Nama Courses</label>
                            <input type="text" name="course_name" id="course_name" class="form-control @error('course_name') is-invalid @enderror" value="{{ old('course_name')??$course->course_name }}">
                            @error('course_name')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-12 col-md-2">
                        <div class="form-group">
                            <label for="price">Harga</label>
                            <input type="number" name="price" id="price" class="form-control @error('price') is-invalid @enderror" value="{{ old('price')??$course->price }}">
                            @error('price')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-12 col-md-2">
                        <div class="form-group">
                            <label for="days">Hari</label>
                            <input type="number" name="days" id="days" class="form-control @error('days') is-invalid @enderror" value="{{ old('days')??$course->days }}">
                            @error('days')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group ms-4 d-flex align-items-baseline">
                        <input class="form-check-input mb-2" type="checkbox" name="is_certificate" id="is_certificate" value="Y" {{ $course->is_certificate ==1 ? 'checked' : '' }}>
                        <label class="form-check-label mb-0" style="margin-left: 10px;margin-top:2px" for="is_certificate">Ber sertifikat</label>
                    </div>
                    <div class="form-group ms-4 d-flex align-items-baseline">
                        <input class="form-check-input mb-2" type="checkbox" name="is_active" id="is_active" value="Y" {{ $course->is_active ==1 ? 'checked' : '' }}>
                        <label class="form-check-label mb-0" style="margin-left: 10px;margin-top:2px" for="is_active">Aktif</label>
                    </div>
                </div>
                <div class="d-flex justify-content-end align-items-center gap-3 py-3">
                    <a href="{{ url()->previous() }}" class="btn btn-secondary">Batal</a>
                    <button type="submit" class="btn btn-primary">Tambah Courses</button>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection