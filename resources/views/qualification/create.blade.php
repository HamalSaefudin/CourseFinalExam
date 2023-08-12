@extends('layouts.app')

@section('page-title')
Tambah Qualification
@endsection

@push('add-css')
@endpush

@push('add-js')
@endpush

@section('page-content')
@include('layouts.partials.alert')
<div class="card">
    <form action="{{ route('qualification.store') }}" method="POST" class="needs-validation" novalidate>
        @csrf
        <div class="card-content">
            <div class="card-body">
                <h4 class="card-title mb-5">Form Qualification</h4>
                <div class="row">
                    <div class="col-12 col-md-12">
                        <label for="topic_id">Topic</label>
                        <input type="text" name="topic_id" id="course_name" class="form-control @error('topic_id') is-invalid @enderror" value="{{ old('topic_id') }}">
                        @error('topic_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="row mt-4">
                    <div class="col-12 col-md-12">
                        <div class="form-floating">
                            <select class="form-select" id="instructor" name="instructor_id" aria-label="Floating label select example">
                                <option selected disabled>Select instructor</option>
                                @foreach ($list_instructor as $instructor)
                                <option value="{{$instructor->id}}">{{$instructor->instructor_name}}</option>
                                @endforeach
                            </select>
                            <label for="floatingSelect">Instructor</label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="d-flex justify-content-end align-items-center gap-3 py-3">
                <a href="{{ url()->previous() }}" class="btn btn-secondary">Batal</a>
                <button type="submit" class="btn btn-primary">Tambah Qualification</button>
            </div>
        </div>
</div>
</form>
</div>
@endsection