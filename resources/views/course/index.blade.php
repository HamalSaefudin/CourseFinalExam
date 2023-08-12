@extends('layouts.app')

@section('page-title')
Daftar Courses
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
        $("#tableCourse").DataTable({
            language: {
                emptyTable: "Data Courses belum tersedia"
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
                <h4 class="card-title">Data Courses</h4>
                <a href="{{ route('course.create') }}" class="btn btn-outline-primary icon"><i class="bi bi-plus-lg"></i></a>
            </div>

            @include('layouts.partials.alert')

            <div class="responsive-table mt-5">
                <table class="table table-borderless table-hover" id="tableCourse">
                    <thead>
                        <tr>
                            <th scope="col">Courses</th>
                            <th scope="col">Hari</th>
                            <th scope="col">Sertifikat</th>
                            <th scope="col">Harga</th>
                            <th scope="col">Status</th>
                            <th scope="col" width="100px">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($list_courses as $course)
                        <tr>
                            <td>{{ $course->course_name }}</td>
                            <td>{{ $course->days }} Hari</td>
                            <td>{{ $course->is_certificate == 1?'Ya':'Tidak' }}</td>
                            <td>Rp {{ number_format($course->price, 2, ',', '.') }}</td>
                            <td>{{ $course->is_active?'Aktif':'Non Aktif' }}</td>
                            <td>
                                <div class="d-flex gap-2">
                                    <a href="{{ route('course.edit', $course->id) }}" class="btn icon btn-sm btn-outline-warning">
                                        <i class="bi bi-pencil-square"></i>
                                    </a>
                                    <a href="#" role="button" class="btn icon btn-sm btn-outline-danger" data-bs-toggle="modal" data-bs-target="#deleteCourseModal-{{ $course->id }}">
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
@foreach ($list_courses as $course)
<div class="modal fade text-left" id="deleteCourseModal-{{ $course->id }}" tabindex="-1" role="dialog" aria-labelledby="deletCourseModal" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deletCourseModal">Konfirmasi</h5>
                <button type="button" class="close rounded-pill" data-bs-dismiss="modal" aria-label="Close">
                    <i data-feather="x"></i>
                </button>
            </div>
            <div class="modal-body">
                Apakah Anda ingin menghapus data Courses: <b>{{ $course->course_name }}</b>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-bs-dismiss="modal">
                    <i class="bx bx-x d-block d-sm-none"></i>
                    <span class="d-none d-sm-block">Tidak</span>
                </button>
                <form action="{{ route('course.destroy', $course->id) }}" method="POST">
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