@extends('layouts.app')

@section('page-title')
Daftar Instructor
@endsection

@push('add-css')
<link rel="stylesheet" href="{{ asset('assets/css/pages/fontawesome.css') }}">
<link rel="stylesheet" href="{{ asset('assets/extensions/datatables.net-bs5/css/dataTables.bootstrap5.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/css/pages/datatables.css') }}">
@endpush

@push('add-js')
<script src="{{ asset('assets/extensions/jquery/jquery.min.js') }}"></script>
<script src="https://cdn.datatables.net/v/bs5/dt-1.12.1/datatables.min.js"></script>
<script>
    $(document).ready(() => {
        $("#tableInstructor").DataTable({
            language: {
                emptyTable: "Data instructor belum tersedia"
            }
        });
    })
</script>
@endpush

@section('page-content')
<div class="card">
    <div class="card-content">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h4 class="card-title">Data Instructor</h4>
                <a href="{{ route('instructor.create') }}" class="btn btn-outline-primary icon"><i class="bi bi-plus-lg"></i></a>
            </div>

            @include('layouts.partials.alert')

            <div class="responsive-table mt-5">
                <table class="table table-borderless table-hover" id="tableInstructor">
                    <thead>
                        <tr>
                            <th scope="col">Nama Instructor</th>
                            <th scope="col">Gender</th>
                            <th scope="col">Umur</th>
                            <th scope="col">Tahun Pengalaman</th>
                            <th scope="col">Deskripsi Pengalaman</th>
                            <th scope="col" width="100px">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($list_instructor as $instructor)
                        <tr>
                            <td>{{ $instructor->instructor_name }}</td>
                            <td>{{ $instructor->gender == 'L'?'Laki-Laki':'Perempuan' }}</td>
                            <td>{{ $instructor->age}} Tahun</td>
                            <td>{{ $instructor->exp_year }} Tahun</td>
                            <td>{{ $instructor->exp_desc }}</td>
                            <td>
                                <div class="d-flex gap-2">
                                    <a href="{{ route('instructor.edit', $instructor->id) }}" class="btn icon btn-sm btn-outline-warning">
                                        <i class="bi bi-pencil-square"></i>
                                    </a>
                                    <a href="#" role="button" class="btn icon btn-sm btn-outline-danger" data-bs-toggle="modal" data-bs-target="#deleteInstructorModal-{{ $instructor->id }}">
                                        <i class="bi bi-trash3"></i>
                                    </a>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

{{-- Modal --}}
{{-- Delete User Modal --}}
@foreach ($list_instructor as $instructor)
<div class="modal fade text-left" id="deleteInstructorModal-{{ $instructor->id }}" tabindex="-1" role="dialog" aria-labelledby="deleteInstructorModal" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteInstructorModal">Konfirmasi</h5>
                <button type="button" class="close rounded-pill" data-bs-dismiss="modal" aria-label="Close">
                    <i data-feather="x"></i>
                </button>
            </div>
            <div class="modal-body">
                Apakah Anda ingin menghapus data: <b>{{ $instructor->instructor_name }}</b>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-bs-dismiss="modal">
                    <i class="bx bx-x d-block d-sm-none"></i>
                    <span class="d-none d-sm-block">Tidak</span>
                </button>
                <form action="{{ route('instructor.destroy', $instructor->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">
                        <i class="bx bx-check d-block d-sm-none"></i>
                        <span class="d-none d-sm-block">Ya, Hapus</span>
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endforeach
@endsection