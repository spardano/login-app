@extends('layouts.master')

@section('before-css')
<link rel="stylesheet" href="{{ asset('assets/styles/vendor/datatables.min.css') }}">
@endsection

@section('main-content') 

@include('alert-session')

<div class="card">
    <div class="card-body">
        <h3 style="text-align: center">DATA PENGAJUAN SURAT UMUM</h3>
        <div style="margin-bottom: 20px; margin-top:20px">
            <a href="" class="btn btn-info">
                <i class="bi bi-person-plus-fill">Tambah</i>
            </a>
        </div>
        <div class="table-responsive">
            <table id="suratumumTable" class="display table table-striped table-bordered">
                <thead >
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Nama</th>
                        <th scope="col">Jenis surat</th>
                        <th scope="col">Alasan</th>
                        <th scope="col">Tujuan</th>
                        <th scope="col">Status surat</th>
                        <th scope="col">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $index => $item )
                    <tr>
                        <td scope="row">{{ $index + 1}}</td>
                        <td>{{ $item->penduduk->nama }}</td>
                        <td>{{ $item->KlasifikasiSurat->uraian }}</td>
                        <td>{{ $item->alasan }}</td>
                        <td>{{ $item->tujuan }}</td>
                        <td>@if ($item->status_surat == 0)
                            <span class="badge rounded-pill bg-secondary">Belum dibaca</span>
                            @endif 
                            @if ($item->status_surat == 1)
                            <span class="badge rounded-pill bg-primary">Diteruskan</span>
                            @endif 
                            @if ($item->status_surat == 2)
                            <span class="badge rounded-pill bg-success">Diterima</span>
                            @endif 
                            @if ($item->status_surat == 3)
                            <span class="badge rounded-pill bg-danger">Di Tolak</span>
                            @endif
                        </td>
                        <td>
                            <a href="/exportpdf/{{ $item->id }} && {{ $item->kode_surat }}" type="button" class="btn btn-success">
                                <i class="nav-icon i-File"></i>
                            </a>

                            <a href="/detailsurat/{{ $item->id }}" class="btn btn-info">
                                <i class="nav-icon i-Eye-Scan"></i>
                            </a>

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
<script>
    $(document).ready( function () {
        $('#suratumumTable').DataTable();
    });
</script>
@endsection