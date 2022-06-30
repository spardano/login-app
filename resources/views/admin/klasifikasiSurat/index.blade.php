@extends('layouts.app')
@push('css')
<link
    rel="stylesheet"
    href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap4.min.css">
<link
    rel="stylesheet"
    href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
@endpush 

@section('content')
<div class="card">
    <div class="card-body">
        <h3 style="text-align: center">KLASIFIKASI SURAT</h3>
        <div style="margin-bottom: 20px; margin-top:20px">
            <button type="button" class="btn btn-info " data-bs-toggle="modal" data-bs-target="#tambahKlasifikasi">
                <i class="bi bi-person-plus-fill">Tambah</i>
            </button>
        </div>
        <div class="table-responsive">
            <table class="table table-striped" id="klasifikasitable">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Kode Surat</th>
                        <th scope="col">Uraian</th>
                        <th scope="col">Spesifikasi Surat</th>
                        <th scope="col">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $index => $item )
                    <tr>
                        <td scope="row">{{ $index + 1}}</td>
                        <td>{{ $item->kode_surat }}</td>
                        <td>{{ $item->uraian }}</td>
                        <td>{{ $item->spesifikasi_surat }}</td>
                        <td>
                            <button
                                type="button"
                                class="btn btn-info btn-sm"
                                data-bs-toggle="modal"
                                data-bs-target="#EditKlasifikasiSurat{{ $item->id }}">
                                <i class="bi bi-pencil-square"></i>
                            </button>
                            <a
                                href="{{ route('klasifikasi_surat.delete', [$item->id]) }}"
                                class="btn btn-danger btn-sm"
                                onclick="return confirm('Apa kamu yakin ingin mengahpus data {{ $item->kode_surat }}')">
                                <i class="bi bi-trash3"></i>
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

<!-- Modal Tambah Klasifikasi Surat -->
<div class="modal fade " id="tambahKlasifikasi" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header bg-info">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Klasifikasi Surat</h5>
                <button type="button" class="btn btn-warning"  data-bs-dismiss="modal"><i class="bi bi-box-arrow-in-left"></i></button>
            </div>
            <div class="modal-body">
                <div>
                  <form action="{{ route("klasifikasi_surat.store")}}" method="POST">
                    @csrf
                    <table style="width: 100%">
                        <tr>
                            <td >kode Surat  </td>
                            <td>:</td>
                            <td><input type="text" class="form-control" name="kode_surat" ></td>
                        </tr>
                        <tr>
                            <td >Uraian</td>
                            <td>:</td>
                            <td><input type="text" class="form-control" name="uraian"></td>
                        </tr>
                        <tr>    
                            <td >Spesifikasi Surat</td>
                            <td>:</td>
                            <td><input type="text" class="form-control" name="spesifikasi_surat" ></td>
                        </tr>
                    </table>
                </div>
            </div> 
            <div class="modal-footer bg-info">
                <button type="submit" class="btn btn-primary">Save</button>
            </div>
          </form>
        </div>
    </div>
</div>
<!-- End Tambah Klasifikasi Surat -->

<!-- Modal EDIT Klasifikasi Surat -->
@foreach($data as $row)
<div class="modal fade " id="EditKlasifikasiSurat{{ $row->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-info">
                <h5 class="modal-title" id="exampleModalLabel">Edit Klasifikasi Surat</h5>
                <button type="button" class="btn btn-warning"  data-bs-dismiss="modal"><i class="bi bi-box-arrow-in-left"></i></button>
            </div>
            <div class="modal-body">
                <div>
                  <form action="{{ route("klasifikasi_surat.edit",[$row->id])}}" method="POST">
                    @csrf
                    <table style="width: 100%">
                        <tr>
                            <td >Kode Surat  </td>
                            <td>:</td>
                            <td><input type="text" class="form-control" name="kode_surat" value="{{  $row->kode_surat  }}" required></td>
                        </tr>
                        <tr>
                            <td >Uraian</td>
                            <td>:</td>
                            <td><input type="text" class="form-control" name="uraian" value="{{ $row->uraian }} "required></td>
                        </tr>
                        <tr> 
                            <td >Spesifikasi Surat</td>
                            <td>:</td>
                            <td><input type="text" class="form-control" name="spesifikasi_surat" value="{{ $row->spesifikasi_surat }}" required></td>
                        </tr>
                    </table>
                </div>
            </div> 
            <div class="modal-footer bg-info">
                <button type="submit" class="btn btn-primary">Save</button>
            </div>
          </form>
        </div>
    </div>
</div>
@endforeach
<!-- End  EDIT Klasifikasi Surat -->


@push('js')
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
<script>
    $(document).ready( function () {
    $('#klasifikasitable').DataTable();
} );
</script>
@endpush