@extends('layouts.master')

@section('before-css')
<link rel="stylesheet" href="{{ asset('assets/styles/vendor/datatables.min.css') }}">
@endsection

@section('main-content') 

@include('alert-session')

<div class="card">
    <div class="card-body">
        <h3 style="text-align: center">JABATAN PENTING</h3>
        <div style="margin-bottom: 20px; margin-top:20px">
            @role('adminkelurahan')
            <button type="button" class="btn btn-info " data-toggle="modal" data-target="#tambahJabatan">
                <i class="bi bi-person-plus-fill">Tambah</i>
            </button>
            @endrole
        </div>
        <div class="table-responsive">
            <table class="display table table-striped table-bordered" id="penomoranTable">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Nama</th>
                        <th scope="col">jabatan</th>
                        <th scope="col">nip</th>
                        <th scope="col">nik</th>
                        <th scope="col">golongan</th>
                        <th scope="col">eselon</th>
                        <th scope="col">Kode Jabatan</th>
                        @role('adminkelurahan')
                        <th scope="col">Aksi</th>
                        @endrole
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $index => $item )
                    <tr>
                        <td scope="row">{{ $index + 1}}</td>
                        <td>{{ $item->nama }}</td>
                        <td>{{ $item->jabatan }}</td>
                        <td>{{ $item->nip }}</td>
                        <td>{{ $item->nik }}</td>
                        <td>{{ $item->gol }}</td>
                        <td>{{ $item->eselon }}</td>
                        <td>{{ $item->kode_jabatan }}</td>
                        @role('adminkelurahan')
                        <td>
                            <button type="button" class="btn btn-info btn-sm btn-edit-jabatan" data-bs-toggle="modal" data-item="{{ $item }}">
                                <i class="i-Edit"></i>
                            </button>

                            <a href="{{ route('pejabat.delete', [$item->id]) }}" class="btn btn-danger btn-sm" onclick="return confirm('Apa kamu yakin ingin mengahpus data {{ $item->nama }}')">
                                <i class="i-Remove"></i>
                            </a>
                        </td>
                        @endrole
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Modal Tambah Jabatan -->
<div class="modal fade " id="tambahJabatan" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-info">
                <h5 class="modal-title" id="exampleModalLabel" style="color: white">Tambah Jabatan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" class="btn btn-danger">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                  <form action="{{ route("pejabat.tambah")}}" method="POST">
                    @csrf
                    <table style="width: 100%">
                        <tr>
                            <td >Nama  </td>
                            <td>:</td>
                            <td><input type="text" class="form-control" name="nama"></td>
                        </tr>
                        <tr>
                            <td >jabatan</td>
                            <td>:</td>
                            <td><input type="text" class="form-control" name="jabatan"></td>
                        </tr>
                        <tr> 
                            <td >Nip</td>
                            <td>:</td>
                            <td><input type="text" class="form-control" name="nip"></td>
                        </tr>
                        <tr> 
                            <td >Nik</td>
                            <td>:</td>
                            <td><input type="text" class="form-control" name="nik"></td>
                        </tr>
                        <tr> 
                            <td >Golongan</td>
                            <td>:</td>
                            <td><input type="text" class="form-control" name="gol"></td>
                        </tr>
                        <tr> 
                            <td >Eselon</td>
                            <td>:</td>
                            <td><input type="text" class="form-control" name="eselon"></td>
                        </tr>
                        <tr> 
                            <td >Kode Jabatan</td>
                            <td>:</td>
                            <td><input type="text" class="form-control" name="kode_jabatan"></td>
                        </tr>
                    </table>
                </div>
            </div> 
            <div class="modal-footer bg-info">
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
          </form>
        </div>
    </div>
</div>
<!-- End Tambah Jabatan -->

<!-- Modal EDIT JABATAN -->
{{-- @foreach($data as $row) --}}
<div class="modal fade " id="editjabatan" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-info">
                <h5 class="modal-title" id="exampleModalLabel" style="color: white">Edit Jabatan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" class="btn btn-danger">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div>
                  <form id="form-edit-jabatan" action="{{ route('pejabat.edit')}}" method="POST">
                    @method('PUT')
                    @csrf
                        <input type="hidden" name="id">

                        <div class="form-group">
                            <label for="nama">Nama</label>
                            <input type="text" class="form-control" name="nama">
                        </div>
                        <div class="form-group">
                            <label for="jabatan">Jabatan</label>
                            <input type="text" class="form-control" name="jabatan">
                        </div>
                        <div class="form-group">
                            <label for="nip">Nip</label>
                            <input type="text" class="form-control" name="nip">
                        </div>
                        <div class="form-group">
                            <label for="nik">Nik</label>
                            <input type="text" class="form-control" name="nik">
                        </div>
                        <div class="form-group">
                            <label for="gol">Golongan</label>
                            <input type="text" class="form-control" name="gol">
                        </div>
                        <div class="form-group">
                            <label for="eselon">Eselon</label>
                            <input type="text" class="form-control" name="eselon">
                        </div>
                        <div class="form-group">
                            <label for="kode_jabatan">Kode Jabatan</label>
                            <input type="text" class="form-control" name="kode_jabatan">
                        </div>

                        <div class="modal-footer bg-info">
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                    </form>
                </div>
            </div> 
        </div>
    </div>
</div>
{{-- @endforeach --}}
<!-- End  EDIT JABATAN -->


@endsection

@section('bottom-js')
    <script src="{{ asset('assets/js/vendor/datatables.min.js') }}"></script>
    <script src="http://gull-html-laravel.com/assets/js/modal.script.js"></script>
    <script>
        $(document).ready( function () {
        $('#JabatanTable').DataTable();
        });

        $('.btn-edit-jabatan').on('click', function(){
            item = $(this).data('item');
            
            $('#form-edit-jabatan input[name="nama"]').val(item.nama);
            $('#form-edit-jabatan input[name="jabatan"]').val(item.jabatan);
            $('#form-edit-jabatan input[name="nip"]').val(item.nip);
            $('#form-edit-jabatan input[name="nik"]').val(item.nik);
            $('#form-edit-jabatan input[name="gol"]').val(item.gol);
            $('#form-edit-jabatan input[name="eselon"]').val(item.eselon);
            $('#form-edit-jabatan input[name="kode_jabatan"]').val(item.kode_jabatan);
            $('#form-edit-jabatan input[name="id"]').val(item.id);

            $('#editjabatan').modal('show');
            console.log(item);
        })
    </script>
@endsection