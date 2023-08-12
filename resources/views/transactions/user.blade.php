@extends('layouts.app')

@section('page-title')
@if(Auth::user()->role == 'user')
Course Yang Saya Ambil
@else
Daftar Seluruh Course Diambil
@endif
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
        $("#tablePesanan").DataTable({
            language: {
                emptyTable: "Anda belum meng-enroll course"
            },
        });

        $('input[name="jumlah"]').each((index, element) => {
            const parent = $(element).closest('.modal-content');
            const totalDisplay = parent.find('.totalDisplay');
            const harga = parseInt(parent.find('input[name="harga"]').val());

            function hitungTotal() {
                const jumlah = parseInt($(element).val());
                const total = jumlah * harga;
                totalDisplay.html(
                    `<span class="fs-5 align-top">Rp</span> ${total.toLocaleString('id-ID')}`);
            }

            $(element).on('change', hitungTotal);

            hitungTotal();
        });
    })
</script>
@endpush

@section('page-content')
<div class="card">
    <div class="card-content">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h4 class="card-title">Data Course Diambil</h4>

            </div>

            @include('layouts.partials.alert')

            <div class="responsive-table mt-5">
                <table class="table table-borderless table-hover" id="tablePesanan">
                    <thead>
                        <tr>
                            <th scope="col">Nama Customer</th>
                            @if(Auth::user()->role == 'admin')
                            <th scope="col">Membership</th>
                            @endif
                            <th scope="col">Nama Course</th>
                            <th scope="col">Nama Instruktur</th>
                            <th scope="col">Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($list_detail_transaction as $transaction)
                        <tr>
                            <td>{{ $transaction['customer_name'] }}</td>
                            @if(Auth::user()->role == 'admin')
                            <td>{{ $transaction['membership'] }}</td>
                            @endif
                            <td>{{ $transaction['course_name'] }}</td>
                            <td>{{ $transaction['instructor_name'] }}</td>
                            <td>Rp{{ number_format($transaction['total'] ,2, ',', '.') }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection