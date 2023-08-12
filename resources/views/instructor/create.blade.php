@extends('layouts.app')

@section('page-title')
Tambah Instructor
@endsection

@push('add-css')
@endpush

@push('add-js')
@endpush

@section('page-content')
@include('layouts.partials.alert')
<div class="card">
    <form action="{{ route('instructor.store') }}" method="POST" class="needs-validation" novalidate>
        @csrf
        <div class="card-content">
            <div class="card-body">
                <h4 class="card-title mb-5">Form Instructor</h4>
                <div class="row">
                    <div class="col-12 col-md-6 ">
                        <div class="form-group">
                            <label for="instructor_name">Nama Instructor </label>
                            <input type="text" name="instructor_name" id="instructor_name" class="form-control @error('instructor_name') is-invalid @enderror" value="{{ old('instructor_name') }}">
                            @error('instructor_name')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-12 col-md-2">
                        <div class="form-group">
                            <label for="age">Umur Instructor </label>
                            <input type="number" name="age" id="age" class="form-control @error('age') is-invalid @enderror" value="{{ old('age') }}">
                            @error('age')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-12 col-md-2">
                        <div class="form-group">
                            <label for="exp_year">Umur Pengalaman </label>
                            <input type="number" name="exp_year" id="exp_year" class="form-control @error('exp_year') is-invalid @enderror" value="{{ old('exp_year') }}">
                            @error('exp_year')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-12 col-md-2">
                        <div class="form-group">
                            <label for="L">Laki-laki </label>
                            <input class="form-check-input" type="radio" name="gender" id="jk1" value="L" checked>
                            @error('gender')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="P">Perempuan </label>
                            <input class="form-check-input" type="radio" name="gender" id="jk2" value="P">
                            @error('gender')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 ">
                        <div class="form-group">
                            <label for="exp_desc">Deskripsi Pengalaman</label>
                            <input type="text" name="exp_desc" id="exp_desc" class="form-control @error('exp_desc') is-invalid @enderror" value="{{ old('exp_desc') }}">
                            @error('exp_desc')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                </div>
                <div class="d-flex justify-content-end align-items-center gap-3 py-3">
                    <a href="{{ url()->previous() }}" class="btn btn-secondary">Batal</a>
                    <button type="submit" class="btn btn-primary">Tambah Instructor</button>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection