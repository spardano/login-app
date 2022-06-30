@extends('layouts.master')

@section('before-css')
<link rel="stylesheet" href="{{ asset('assets/styles/vendor/datatables.min.css') }}">

@endsection

@section('main-content') 

@include('alert-session')

<div class="card">
    <div class="card-body">
        <h3 style="text-align: center">Surat Masuk</h3>
        <div style="margin-bottom: 20px; margin-top:20px"></div>
        </a>
        <div class="table-responsive">
            <table class="table table-striped" id="SuratTable">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Nama</th>
                        <th scope="col">Nik</th>
                        <th scope="col">Kode Surat</th>
                        <th scope="col">Tanggal Surat</th>
                        <th scope="col">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($datasurat as $index => $item )
                    <tr>
                        <td scope="row">{{ $index + 1}}</td>
                        <td>{{ $item->penduduk->nama }}</td>
                        <td>{{ $item->nik }}</td>
                        <td>{{ $item->kode_surat }}</td>
                        <td>{{ $item->tgl_surat }}</td>
                        <td>
                            <a href="/exportpdf/{{ $item->id }} && {{ $item->kode_surat }}" type="button" class="btn btn-info btn-sm"><i class="nav-icon i-File"></i></a>
                            @if($item->status_surat == 1)
                            <a href="/suratditerima/{{ $item->id }}" type="button" class="btn btn-success btn-sm"><i class="i-Yes"></i></a>
                            <a href="/suratditolak/{{ $item->id }}" type="button" class="btn btn-danger btn-sm"><i class="i-Remove"></i></a>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection

@section('bottom-js')
    <script src="{{ asset('assets/js/vendor/datatables.min.js') }}"></script>
    <script src="http://gull-html-laravel.com/assets/js/modal.script.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<script>
    $(document).ready( function () {
    $('#SuratTable').DataTable();
} );
</script>
@endsection