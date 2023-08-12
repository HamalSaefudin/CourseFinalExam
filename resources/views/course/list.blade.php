@extends('layouts.app')

@section('page-title')
Daftar Aktif Course
@endsection

@push('add-css')
@endpush

@push('add-js')
<script src="{{ asset('assets/extensions/jquery/jquery.min.js') }}"></script>
<script>
    $(document).ready(() => {
        $('input[name="membership"]').each((index, element) => {
            const parent = $(element).closest('.modal-content');
            const totalDisplay = parent.find('.totalDisplay');
            const harga = parseInt(parent.find('input[name="harga"]').val());

            function getSale(level) {
                switch (level) {
                    case 'silver':
                        return 5 / 100;
                    case 'gold':
                        return 10 / 100;
                    case 'platinum':
                        return 15 / 100;
                }
            }

            function hitungTotal() {
                const sale = getSale($(element).val());
                const total = harga - (harga * sale);

                totalDisplay.html(
                    `<span class="fs-5 align-top">Rp</span> ${total.toLocaleString('id-ID')}`);
            }

            $(element).on('change', hitungTotal);
            hitungTotal();
        });
    });
</script>
@endpush

@section('page-content')
@include('layouts.partials.alert')
<div class="row">
    @forelse ($list_courses as $course)
    <div class="col-12 col-md-4 col-lg-3">
        <div class="card rounded-5">
            <div class="card-content">
                <div class="card-body">
                    <img src="https://source.unsplash.com/ck0i9Dnjtj0/300x300" alt="foto course" class="img-fluid rounded-4 mb-3">
                    <h4 class="card-title">{{ $course->course_name }}</h4>
                    <p class="my-3 fs-2 fw-bold text-primary"><span class="fs-5 align-top">Rp</span>{{ number_format($course->price) }}</p>
                </div>
            </div>
            <div class="card-footer">
                <a href="#" role="button" data-bs-toggle="modal" data-bs-target="#courseModal-{{ $course->id }}" class="btn d-block btn-primary">Enroll</a>
            </div>
        </div>
    </div>
    @empty
    <p>Belum ada aktif course yang tersedia</p>
    @endforelse
</div>

{{-- Modal --}}
{{-- Course Modal --}}
@foreach ($list_courses as $course)
<div class="modal fade text-left" id="courseModal-{{ $course->id }}" tabindex="-1" role="dialog" aria-labelledby="courseModal" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="{{ route('transactions.store') }}" method="POST">
                @csrf
                <input type="hidden" name="membership" value="{{ $user->membership }}">
                <input type="hidden" name="course_id" value="{{ $course->id }}">
                <div class="modal-header">
                    <h5 class="modal-title" id="courseModal">Pesan Course</h5>
                    <button type="button" class="close rounded-pill" data-bs-dismiss="modal" aria-label="Close">
                        <i data-feather="x"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="">Nama Course</label>
                                <p>{{ $course->course_name }}</p>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="">Harga</label>
                                <p>Rp{{ number_format($course->price) }}</p>
                                <input type="hidden" name="harga" id="harga" value="{{ $course->price }}">
                            </div>
                        </div>
                        <div class="row mb-4">
                            <div class="col-12">
                                <div class="form-floating">
                                    <select class="form-select" id="instructor" name="qualification_id" aria-label="Floating label select example">
                                        <option selected disabled>Select instructor</option>
                                        @foreach ($instructor_qualifications as $instructor)
                                        <option value="{{$instructor['id']}}">{{$instructor['instructor_name']}}</option>
                                        @endforeach
                                    </select>
                                    <label for="floatingSelect">Instructor</label>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label for="">Total</label>
                                <p class="totalDisplay" class="fs-1 fw-bold text-primary">
                                    <span class="fs-5 align-top">Rp</span>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">
                        <i class="bx bx-x d-block d-sm-none"></i>
                        <span class="d-none d-sm-block">Batal</span>
                    </button>
                    <button type="submit" class="btn btn-primary">
                        <i class="bx bx-check d-block d-sm-none"></i>
                        <span class="d-none d-sm-block">Enroll Course</span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endforeach
@endsection