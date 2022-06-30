@extends('layouts.app')

@push('css')
<link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css">
@endpush

<!-- Table Data Pengajuan Surat Nikah -->
@section('content')
<table class="table display mt-2" id="suratnikahTable">
    <thead>
      <tr>
        <th scope="col">#</th>
        <th scope="col">Form Pengajuan</th>
        <th scope="col">Aksi</th>  
      </tr>
    </thead>
    <tbody>
      <tr>
        <td scope="row">{{ $index + 1}}</td>
        <td>FormulirPermohonanKehendakNikah</td>
        <td>suratizinorangtua</td>
        <td>FormulirPersetujuanCalonPengantin</td>
        <td style="text-align: center">suratpernyataancalonmempelai</td>
        <td style="text-align: center">
            
        </td>
  </tbody>
</table>
@endsection

@push('js')
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
<script>
    $(document).ready( function () {
    $('#suratnikahTable').DataTable();
} );
</script>
@endpush