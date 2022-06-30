@extends('layouts.master')

@section('before-css')
<link rel="stylesheet" href="{{ asset('assets/styles/vendor/datatables.min.css') }}">
@endsection

@section('main-content') 

@include('alert-session')

<div class="card">
  <div class="card-body">
      <h3 style="text-align: center">DATA PENGAJUAN SURAT NIKAH</h3>
      <div style="margin-bottom: 20px; margin-top:20px">
          <a href="" class="btn btn-info">
              <i class="bi bi-person-plus-fill">Tambah</i>
          </a>
      </div>
      <div class="table-responsive">
      <table class="display table table-striped table-bordered" id="suratnikahTable">
          <thead>
            <tr>
              <th scope="col">#</th>
              <th scope="col">Calon</th>
              <th scope="col">Pasangan</th>
              <th scope="col" style="text-align: center">Tgl Nikah</th>
              <th scope="col" style="text-align: center">Tmp Nikah</th>
              <th scope="col" style="text-align: center">Status</th>
              <th scope="col" style="text-align: center">Aksi</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($data as $index => $item  )
            <tr>
              <td scope="row">{{ $index + 1}}</td>
              <td>{{ $item->penduduk->nama }}</td>
              <td>{{ $item->penduduk_pasangan->nama }}</td>
              <td style="text-align: center">{{ $item->tgl_nikah }}</td>
              <td style="text-align: center">{{ $item->tempat_nikah }}</td>
              <td style="text-align: center">@if ($item->status_surat == 0)
                  <span class="badge rounded-pill bg-warning text-dark">Dalam proses</span>
                  @endif
                  @if ($item->status_surat == 1)
                      <span class="badge rounded-pill bg-success">Di Setujui</span>
                  @endif</td>
              <td>
                <a href="#" class="btn btn-info">
                  <i class="nav-icon i-Eye-Scan"></i>
                </a>
                {{-- <a href="/pdfnikah/{{ $item->id }}"  class="btn btn-primary btn-sm "><i class="bi bi-eye"></i></a> --}}
                <button type="button" class="btn btn-danger " >Tolak</button>
              </td>
            </tr>
          @endforeach   
        </tbody>
      </table>
      </div>
  </div>
</div>

<!-- End Table Data Pengajuan Surat Nikah -->

@endsection

@section('bottom-js')
<script src="{{ asset('assets/js/vendor/datatables.min.js') }}"></script>
<script src="http://gull-html-laravel.com/assets/js/modal.script.js"></script>
<script>
    $(document).ready( function () {
    $('#suratnikahTable').DataTable();
} );
</script>
@endsection