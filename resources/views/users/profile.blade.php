@extends('layouts.app')

@section('page-title')
Profile
@endsection

@push('add-css')
@endpush

@push('add-js')
<script src="{{ asset('assets/extensions/jquery/jquery.min.js') }}"></script>

@endpush

@section('page-content')
@include('layouts.partials.alert')
<div class="card">
    <form action="{{ route('profile.update', Auth::user()->id) }}" method="POST" id="formAkun" class="needs-validation" novalidate>
        @csrf
        @method('PUT')
        <div class="card-content">
            <div class="card-body">
                <h4 class="card-title mb-5">Form Akun</h4>
                <div class="row">
                    <div class="col-12 col-md-6">
                        <div class="form-group">
                            <label for="nama">Nama User</label>
                            <input type="text" name="nama" id="nama" class="form-control @error('nama') is-invalid @enderror" value="{{ Auth::user()->nama }}">
                            @error('nama')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" name="email" id="email" class="form-control @error('email') is-invalid @enderror" value="{{ Auth::user()->email }}" readonly>
                            @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <div class="form-group">
                            <label for="password">Change Password</label>
                            <input type="password" name="password" id="password" class="form-control @error('password') is-invalid @enderror" placeholder="Masukkan password jika ingin mengubahnya">
                            @error('password')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="d-flex justify-content-end align-items-center gap-3 py-3">
                    <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                </div>
            </div>
        </div>
    </form>
</div>
@endif
@endsection