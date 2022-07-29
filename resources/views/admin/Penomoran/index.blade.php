@extends('layouts.master')

@section('before-css')
<link rel="stylesheet" href="{{ asset('assets/styles/vendor/datatables.min.css') }}">
@endsection

@section('main-content')
 
@include('alert-session')

<div class="card">
    <div class="card-body">
      <h3 style="text-align: center">PENOMORAN SURAT</h3>
        <div style="margin-bottom: 20px; margin-top:20px">
            <button type="button" class="btn btn-info" data-toggle="modal" data-target="#tambahpenomoran">
                <i class="bi bi-person-plus-fill">Tambah penomoran</i>
            </button>
        </div>
    <div class="table-responsive">
        <table class="display table table-striped table-bordered"  id="penomoranTable">
            <thead>
                <tr>
                    <th scope="col">id</th>
                    <th scope="col">penomoran_surat</th>
                    <th scope="col">Mulai Dari</th>
                    <th scope="col">jenis_surat</th>
                    <th scope="col">Kelurahan</th>
                    <th scope="col">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    @foreach ($penomoran_surat as $item)
                    <tr>
                        <td>{{ $item->id }}</td>
                        <td>{{ $item->no_surat }}</td>
                        <td>{{ $item->mulai_dari }}</td>
                        <td>{{ $item->klasifikasi_surat->uraian }}</td>
                        <td>{{ $item->kel_desa->nama_kel_desa }}</td>
                        <td>
                            <button type="button" class="btn btn-info  btn-edit-penomoran" data-bs-toggle="modal" data-item="{{ $item }}">
                                <i class="i-Edit"></i>
                            </button>

                            <button type="button" class="btn btn-danger  btn-hapus-penomoran">
                                <i class="i-Remove"></i>
                            </button>

                            <form id="form-hapus-penomoran" action="{{ route('penomoran_surat.delete', ['id'=> $item->id]) }}" method="POST">
                                @method('DELETE')
                                @csrf
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tr>
            </tbody>
        </table>
      </div>
    </div>
</div>

<!-- tambah Data Penomoran -->
    <div class="modal fade " id="tambahpenomoran" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-info">
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Data Penomoran</h5>
                </div>
                <div class="modal-body" style="border: 10px solid rgb(31, 202, 228);">
                    <div>
                        <form action="{{ route('penomoran_surat.store') }}" method="POST">
                            @csrf

                            @isset($kelurahan)
                                <div class="form-group">
                                    <label for="id_kel_desa">Kelurahan</label>
                                    <select name="id_kel_desa" id="id_kel_desa" class="form-control">

                                        @foreach ($kelurahan as $item)
                                        <option value="{{ $item->id }}">{{ $item->nama_kel_desa }}</option>
                                        @endforeach

                                    </select>
                                </div>    
                            @endisset

                            <div class="form-group">
                                <label for="id_jenis_surat">Jenis Surat</label>
                                <select name="id_jenis_surat" id="id_jenis_surat" class="form-control">

                                    @foreach ($kode_surat as $item)
                                    <option value="{{ $item->id }}">{{ $item->uraian }}</option>
                                    @endforeach

                                </select>
                            </div>

                            <div class="form-group">
                                <label for="mulai_dari">mulai Dari</label>
                                <input type="number" class="form-control" name="mulai_dari"></div>

                                <div class="form-group">
                                    <label for="no_surat">Rumus Penomoran</label>
                                    <input type="text" class="form-control" name="no_surat"></div>

                                    <div class="modal-footer bg-info">
                                        <button type="submit" class="btn btn-primary ">Tambahkan</button>
                                    </div>

                                </form>
                            </div>
                        </div>

                    </div>
                </form>
            </div>
        </div>
        <!-- End tambah Data Penomoran -->

<!-- Edit Data Penomoran -->
<div class="modal fade " id="editpenomoran" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-info">
                <h5 class="modal-title" id="exampleModalLabel" style="color: white">Edit Data Penomoran</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" class="btn btn-danger">&times;</span>
                </button>
            </div>
            <div class="modal-body" style="border: 10px solid rgb(31, 202, 228);">
                <div>
                    <form id="form-edit-penomoran" action="{{ route('penomoran_surat.update') }}" method="POST">
                        @method('PUT')
                        @csrf
                            <input type="hidden" name="id" />

                            @isset($kelurahan)
                                <div class="form-group">
                                    <label for="id_kel_desa">Kelurahan</label>
                                    <select name="id_kel_desa" id="id_kel_desa" class="form-control">

                                        @foreach ($kelurahan as $item)
                                        <option value="{{ $item->id }}">{{ $item->nama_kel_desa }}</option>
                                        @endforeach

                                    </select>
                                </div>    
                            @endisset

                            <div class="form-group">
                                <label for="id_jenis_surat">Jenis Surat</label>
                                <select name="id_jenis_surat" id="id_jenis_surat" class="form-control">
                                    @foreach ($kode_surat as $item)
                                    <option value="{{ $item->id }}">{{ $item->uraian }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="mulai_dari">mulai Dari</label>
                                <input type="number" class="form-control" name="mulai_dari">
                            </div>

                            <div class="form-group">
                                <label for="no_surat">Rumus Penomoran</label>
                                <input type="text" class="form-control" name="no_surat">
                            </div>

                            <div class="modal-footer bg-info">
                                <button type="submit" class="btn btn-primary ">Simpan</button>
                            </div>    
                        </div>
                    </form>    
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Edit Data Penomoran -->
@endsection 

@section('bottom-js')
    <script src="{{ asset('assets/js/vendor/datatables.min.js') }}"></script>
    <script src="http://gull-html-laravel.com/assets/js/modal.script.js"></script>
        <script>
            $(document).ready(function () {
                $('#penomoranTable').DataTable();
            });

            $('.btn-edit-penomoran').on('click', function(){
                item = $(this).data('item');

                $('#form-edit-penomoran select[name="id_kel_desa"]').val(item.id_kel_desa).change();
                $('#form-edit-penomoran select[name="id_jenis_surat"]').val(item.id_jenis_surat).change();
                $('#form-edit-penomoran input[name="mulai_dari"]').val(item.mulai_dari);
                $('#form-edit-penomoran input[name="no_surat"]').val(item.no_surat);
                $('#form-edit-penomoran input[name="id"]').val(item.id);
                

                $('#editpenomoran').modal('show');
                console.log(item);
            })

            $('.btn-hapus-penomoran').on('click', function(){
                console.log('conf');
                let conf = confirmHapus();

                if(conf){
                    $('#form-hapus-penomoran').submit();
                }
            })

            function confirmHapus(){
               return confirm('Apa kamu yakin ingin mengahpus data');
            }
        </script>
@endsection