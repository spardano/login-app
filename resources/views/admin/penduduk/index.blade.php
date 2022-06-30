@extends('layouts.master')

@section('before-css')
<link rel="stylesheet" href="{{ asset('assets/styles/vendor/datatables.min.css') }}">
@endsection

@section('main-content') 

@include('alert-session')

<div class="card">
    <div class="card-body">
      <h3 style="text-align: center">DATA PENDUDUK</h3>
        <div style="margin-bottom: 20px; margin-top:20px">
            @role('adminkelurahan')

            <button type="button" class="btn btn-info" data-toggle="modal" data-target="#Tambahpenduduk">
                <i class="">Tambah</i>
            </button>

            <button type="button" class="btn btn-info" data-toggle="modal" data-target="#ModalImport">
                <i class="bi bi-file-earmark-spreadsheet">Import</i>
            </button>
            @endrole

            <a href="pendudukexport" class="btn btn-danger">
                <i class="bi bi-file-earmark-spreadsheet">Export</i>
            </a>
        </div>
        <div class="table-responsive">
            <table class="table table-striped" id="pendudukTable">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Nama</th>
                        <th scope="col" style="text-align: center">Nik</th>
                        <th scope="col" style="text-align: center">KK</th>
                        <th scope="col" style="text-align: center">Tempat Lahir
                        </th>
                        <th scope="col" style="text-align: center">Tanggal Lahir</th>
                        <th scope="col" style="text-align: center">Jenis Kelamin</th>
                        <th scope="col" style="text-align: center">Agama</th>
                        <th scope="col" style="text-align: center">Alamat</th>
                        <th scope="col" style="text-align: center; width:15%">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $index => $item )
                    <tr>
                        <td scope="row">{{ $index + 1}}</td>
                        <td>{{ $item->nama }}</td>
                        <td>{{ $item->nik }}</td>
                        <td>{{ $item->kk }}</td>
                        <td style="text-align: center">{{ $item->tmp_lahir }}</td>
                        <td style="text-align: center">{{ $item->tgl_lahir }}</td>
                        <td style="text-align: center">{{ $item->jenkel }}</td>
                        <td style="text-align: center">{{ $item->agama }}</td>
                        <td style="text-align: center">{{ $item->alamat }}</td>
                        <td>
                            {{-- <button
                                type="button"
                                class="btn btn-primary btn-sm"
                                data-toggle="modal"
                                data-item="{{ $item }}"
                                data-target="#detailpenduduk-{{ $item->nik }}">
                                <i class="nav-icon i-Eye-Scan"></i>
                            </button> --}}

                            <button type="button" class="btn btn-primary btn-sm btn-show" data-toggle="modal" data-item="{{ $item }}">
                                <i class="nav-icon i-Eye-Scan"></i>
                            </button>

                            @role('adminkelurahan')
                            <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#Editpenduduk-{{ $item->nik }}">
                                <i class="i-Edit"></i>
                            </button>

                            <a href="/datapenduduk/delete/{{ $item->nik }}" class="btn btn-danger btn-sm" onclick="return confirm('Apa kamu yakin ingin mengahpus data {{ $item->nama }}')">
                                <i class="i-Remove"></i>
                            </a>
                            @endrole
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

    <!-- Tambah Data Penduduk -->
    <div class="modal fade " id="Tambahpenduduk" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-info">
                    <h5 class="modal-title" id="exampleModalLabel" style="color: aliceblue">Form Input Data</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" class="btn btn-danger">&times;</span>
                    </button>
                </div>
                <div class="modal-body" style="border: 10px solid rgb(31, 202, 228);">
                    <div>
                        <form action="{{ route('datapenduduk.store')}}" method="POST">
                        <table>
                            @csrf
                            <tr>
                                <label class="mb-2" for="nama">Nama</label>
                                <input type="text"  class="form-control" name="nama"  required>
                            </tr>
                            <tr>
                                <label class="mb-2" for="nama">NIK</label>
                                <input type="text"  class="form-control" name="nik">
                            </tr>
                            <tr>
                                <label class="mb-2" for="nama">KK</label>
                                <input type="text"  class="form-control" name="kk"  required>
                            </tr>
                            <tr>
                                <label class="mb-2" for="nama">Tempat lahir</label>
                                <input type="text" class="form-control" name="tmp_lahir"  required>
                            </tr>
                            <tr>
                                <label class="mb-2" for="nama">Tanggal Lahir</label>
                                <input type="date" class="form-control" name="tgl_lahir" required>
                            </tr>
                            <tr>
                                <label class="mb-2" for="nama">Jenis kelamin</label>
                                <select name="jenkel" class="form-control" id="jenkel" required >
                                    <option value="Perempuan">Perempuan</option>
                                    <option value="Laki">Laki-laki</option>
                                </select>
                            </tr>
                            <tr>
                                <label class="mb-2" for="nama">Golongan Darah</label>
                                <select name="goldar" id="goldar" class="form-control" required >
                                    <option value="A">A</option>
                                    <option value="B">B</option>
                                    <option value="AB">AB</option>
                                    <option value="O">O</option>
                                </select>
                            </tr>
                            <tr>
                                <label class="mb-2" for="nama">Agama</label>
                                <select name="agama" id="agama" class="form-control" required>
                                    <option value="Islam">Islam</option>
                                    <option value="Protestan">Protestan</option>
                                    <option value="Khatolik">Khatolik</option>
                                    <option value="Hindu">Hindu</option>
                                    <option value="Budha">Budha</option>
                                    <option value="Konghucu">Konghucu</option>
                                    <option value="Tionghua">Tionghua</option>
                                </select>
                            
                            </tr>
                            <tr>
                                <label class="mb-2" for="nama">Status hubungan Keluarga</label>
                                <select name="stat_hbkel" class="form-control" id="stat_hbkel" required>
                                    <option value="Orang tua laki-laki">Orang tua laki-laki</option>
                                    <option value="Orang tua Perempuan">Orang tua Perempuan</option>
                                    <option value="Anak kandung Laki-laki">Anak kandung Laki-laki</option>
                                    <option value="Anak kandung Perempuan">Anak kandung Perempuan</option>
                                </select>
                            </tr>
                            <tr>
                                <label class="mb-2" for="nama">status kawin</label>
                                <select name="status_kawin"  class="form-control" required>
                                    <option value="Sudah">Sudah</option>
                                    <option value="Belum">Belum</option>
                                </select>
                            </tr>
                            <tr>
                                <label class="mb-2" for="nama">Pendidikan</label>
                                <select name="pendidikan" id="pendidikan" class="form-control" required>
                                    <option value='SD'>SD</option>
                                    <option value='SMP/Sederajat'>SMP/Sederajat</option>
                                    <option value='SMA/Sederajat'>SMA/Sederajat</option>
                                    <option value='D3'>D3</option>
                                    <option value='S1/D4'>S1/D4</option>
                                    <option value='S2'>S2</option>
                                    <option value='S3'>S3</option>
                                </select>
                            </tr>
                            <tr>
                                <label class="mb-2" for="nama">Pekerjaan</label>
                                <input type="text" class="form-control" name="pekerjaan"  required>
                            </tr>
                            <tr>
                                <label class="mb-2" for="nama">Nama Ibu</label>
                                <input type="text" class="form-control" name="nama_ibu"  required>
                            </tr>
                            <tr>
                                <label class="mb-2" for="nama">Nama Ayah</label>
                                <input type="text" class="form-control" name="nama_ayah"  required>
                            </tr>
                            <tr>
                                <label class="mb-2" for="nama">Alamat</label><br>
                                <input type="text" class="form-control" name="alamat"  required>
                                RT :<input type="text" class="form-control" name="rt" required>
                                RW :<input type="text" class="form-control" name="rw"  required>
                            </tr>
                            <tr>
                                <label for="">kelurahan</label>
                                <select name="kelurahan" id="kelurahan" class="form-control" required>
                                    @foreach ($kelurahan as $row)
                                    <option value="{{ $row->id }}">{{ $row->nama_kel_desa}}</option>  
                                    @endforeach
                                </select>
                            </tr>
                            <tr>
                                Kecamatan :<input type="text" class="form-control" name="kecamatan"  required>
                                Kota/kab  :<input type="text" class="form-control" name="kotakab"  required>
                                Provinsi  :<input type="text" class="form-control" name="propinsi" required>
                            </tr>
                            <tr>
                                <label class="mb-2" for="nama">Status Pendidikan</label>
                                <select name="status_pend" class="form-control" id="status_pend" required>
                                    <option value="Lulus Pelajar">Lulus Pelajar</option>
                                    <option value="Pelajar">Pelajar</option>
                                    <option value="Mahasiswa">Mahasiswa</option>
                                    <option value="Sarjana">Sarjana</option>
                                </select>
                            </tr>

                        </table>  
                    </div>
                </div>
                <div class="modal-footer bg-info">
                    <button type="submit" class="btn btn-primary ">Simpan</button>
                </div>
                </form> 
            </div>
        </div>
    </div>
    <!-- End Tambah Penduduk -->

<!-- Modal Detail Penduduk -->
<div class="modal fade" id="detailpenduduk" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="namaPendudukLabel"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" class="btn btn-danger">&times;</span>
                </button>
            </div>
            <div class="modal-body">    
                <div class="detail-penduduk"></div>
            </div>
            <div class="modal-footer"></div>
        </div>
    </div>
</div>
<!-- End Detail Penduduk -->

    @foreach ($data as $row)
    <!-- Edit Data Penduduk -->
    <div class="modal fade " id="Editpenduduk-{{ $row->nik }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-info">
                    <h5 class="modal-title" id="exampleModalLabel" style="color: aliceblue">Edit Data {{ $row->nama }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" class="btn btn-danger">&times;</span>
                    </button>
                </div>
                <div class="modal-body" style="border: 10px solid rgb(31, 202, 228);">
                    <div>
                        <form action="{{ route('datapenduduk.update', [$row->nik]) }}" method="POST">
                        <table>
                            @csrf
                            <tr>
                                <label class="mb-2" for="nama">Nama</label>
                                <input type="text"  class="form-control" name="nama" id="nama"  value="{{ $row->nama }}" required>
                            </tr>
                            <tr>
                                <label class="mb-2" for="nama">NIK</label>
                                <input type="text" readonly="true" class="form-control" name="nik" id="nik"  value="{{ $row->nik }}" required>
                            </tr>
                            <tr>
                                <label class="mb-2" for="nama">KK</label>
                                <input type="text" readonly="true" class="form-control" name="kk" id="kk"  value="{{ $row->kk }}" required>
                            </tr>
                            <tr>
                                <label class="mb-2" for="nama">Tempat lahir</label>
                                <input type="text" class="form-control" name="tmp_lahir" id="tmp_lahir"  value="{{ $row->tmp_lahir }}" required>
                            </tr>
                            <tr>
                                <label class="mb-2" for="nama">Tanggal Lahir</label>
                                <input type="date" class="form-control" name="tgl_lahir" id="tgl_lahir"  value="{{ $row->tgl_lahir }}" required>
                            </tr>
                            <tr>
                                <label class="mb-2" for="nama">Jenis kelamin</label>
                                <select name="jenkel" class="form-control" id="jenkel" required >
                                    <option hidden value="{{ $row->jenkel }}">{{ $row->jenkel }}</option>
                                    <option value="Perempuan">Perempuan</option>
                                    <option value="Laki">Laki-laki</option>
                                </select>
                            </tr>
                            <tr>
                                <label class="mb-2" for="nama">Golongan Darah</label>
                                <select name="goldar" id="goldar" class="form-control" value="{{ $row->goldar }}" required >
                                    <option hidden value="{{ $row->goldar }}">{{ $row->goldar }}</option>
                                    <option value="A">A</option>
                                    <option value="B">B</option>
                                    <option value="AB">AB</option>
                                    <option value="O">O</option>
                                </select>
                            </tr>
                            <tr>
                                <label class="mb-2" for="nama">Agama</label>
                                <select name="agama" id="agama" class="form-control" value="{{ $row->agama }}"  required>
                                    <option value="{{ $row->agama }}">{{ $row->agama }}</option>
                                    <option value="Islam">Islam</option>
                                    <option value="Protestan">Protestan</option>
                                    <option value="Khatolik">Khatolik</option>
                                    <option value="Hindu">Hindu</option>
                                    <option value="Budha">Budha</option>
                                    <option value="Konghucu">Konghucu</option>
                                    <option value="Tionghua">Tionghua</option>
                                </select>
                            
                            </tr>
                            <tr>
                                <label class="mb-2" for="nama">Status hubungan Keluarga</label>
                                <select name="stat_hbkel" class="form-control" id="stat_hbkel" value="{{ $row->stat_hbkel }}"  required>
                                    <option value="{{ $row->stat_hbkel }}">{{ $row->stat_hbkel }}</option>
                                    <option value="Orang tua laki-laki">Orang tua laki-laki</option>
                                    <option value="Orang tua Perempuan">Orang tua Perempuan</option>
                                    <option value="Anak kandung Laki-laki">Anak kandung Laki-laki</option>
                                    <option value="Anak kandung Perempuan">Anak kandung Perempuan</option>
                                </select>
                            </tr>
                            <tr>
                                <label class="mb-2" for="nama">status kawin</label>
                                <select name="status_kawin" id="status_kawin" value="{{ $row->status_kawin }}" class="form-control" required>
                                    <option value="{{ $row->status_kawin }}">{{ $row->status_kawin }}</option>
                                    <option value="Sudah">Sudah</option>
                                    <option value="Belum">Belum</option>
                                </select>
                            </tr>
                            <tr>
                                <label class="mb-2" for="nama">Pendidikan</label>
                                <select name="pendidikan" id="pendidikan" value="{{ $row->pendidikan }}" class="form-control" required>
                                    <option value='{{ $row->pendidikan }}'>{{ $row->pendidikan }}</option>
                                    <option value='SD'>SD</option>
                                    <option value='SMP/Sederajat'>SMP/Sederajat</option>
                                    <option value='SMA/Sederajat'>SMA/Sederajat</option>
                                    <option value='D3'>D3</option>
                                    <option value='S1/D4'>S1/D4</option>
                                    <option value='S2'>S2</option>
                                    <option value='S3'>S3</option>
                                </select>
                            </tr>
                            <tr>
                                <label class="mb-2" for="nama">Pekerjaan</label>
                                <input type="text" class="form-control" name="pekerjaan" id="pekerjaan"  value="{{ $row->pekerjaan }}" required>
                            </tr>
                            <tr>
                                <label class="mb-2" for="nama">Nama Ibu</label>
                                <input type="text" class="form-control" name="nama_ibu" id="nama_ibu"  value="{{ $row->nama_ibu }}" required>
                            </tr>
                            <tr>
                                <label class="mb-2" for="nama">Nama Ayah</label>
                                <input type="text" class="form-control" name="nama_ayah" id="nama_ayah"  value="{{ $row->nama_ayah }}" required>
                            </tr>
                            <tr>
                                <label class="mb-2" for="nama">Alamat</label><br>
                                <input type="text" class="form-control" name="alamat" id="alamat"  value="{{ $row->alamat }}" required>
                                RT :<input type="text" class="form-control" name="rt" id="rt"  value="{{ $row->rt }}" required>
                                RW :<input type="text" class="form-control" name="rw" id="rw"  value="{{ $row->rw }}" required>
                            </tr>
                            <tr>
                                <label for="">kelurahan</label>
                                <select name="kelurahan" id="kelurahan" class="form-control" required>
                                    <option hidden value="{{ $row->kelurahan }}">{{ $row->getdatakeldes->nama_kel_desa}}</option>
                                    @foreach($kelurahan as $item)  
                                    <option value="{{ $item->id }}">{{ $item->nama_kel_desa}}</option>
                                    @endforeach  
                                </select>
                            </tr>
                            <tr>
                                Kecamatan :<input type="text" class="form-control" name="kecamatan" id="kecamatan"  value="{{ $row->kecamatan }}" required>
                                Kota/kab  :<input type="text" class="form-control" name="kotakab" id="kotakab"  value="{{ $row->kotakab }}" required>
                                Provinsi  :<input type="text" class="form-control" name="propinsi" id="propinsi"  value="{{ $row->propinsi }}" required>
                            </tr>
                            <tr>
                                <label class="mb-2" for="nama">Status Pendidikan</label>
                                <select name="status_pend" id="status_pend" value="{{ $row->status_pend }}" class="form-control" required>
                                    <option hidden value="{{ $row->status_pend }}">{{ $row->status_pend }}</option>
                                    <option value="Lulus Pelajar">Lulus Pelajar</option>
                                    <option value="Pelajar">Pelajar</option>
                                    <option value="Mahasiswa">Mahasiswa</option>
                                    <option value="Sarjana">Sarjana</option>
                                </select>
                            </tr>

                        </table>  
                    </div>
                </div>
                <div class="modal-footer bg-info">
                    <button type="submit" class="btn btn-primary ">Update</button>
                </div>
                </form> 
            </div>
        </div>
    </div>
    @endforeach
    <!-- End Edit Penduduk -->


    <!-- Import Data Penduduk -->
    <div class="modal fade" id="ModalImport" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">import File</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" class="btn btn-danger">&times;</span>
                    </button>
                </div>

                <form action="pendudukImport" method="POST" enctype="multipart/form-data">

                    @csrf

                    <div class="modal-body">
                        <div class="form-group">
                            <input type="file" name="importFile" required>
                        </div>
                    </div>

                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
                
                </form>
            </div>
        </div>
    </div>
    <!-- End Import Data Penduduk -->

</div>
@endsection

@section('bottom-js')
<script src="{{ asset('assets/js/vendor/datatables.min.js') }}"></script>
<script src="http://gull-html-laravel.com/assets/js/modal.script.js"></script>
<script>
    $(document).ready( function () {
        $('#pendudukTable').DataTable();

        $('.btn-show').on('click', function(){

        item = $(this).data('item');
        
        $('#namaPendudukLabel').html(`${item.nama}`);

        $('.detail-penduduk').html(`
            <div class="form-group row">
                <label class="col-sm-4">Nama</label>
                <div class="col-sm-8"> ${item.nama} </div>
            </div>
            
            <div class="form-group row">
                <label class="col-sm-4">NIK</label>
                <div class="col-sm-8"> ${item.nik} </div>
            </div>
            
            <div class="form-group row">
                <label class="col-sm-4">KK</label>
                <div class="col-sm-8"> ${item.kk} </div>
            </div>
            
            
            <div class="form-group row">
                <label class="col-sm-4">Tempat Lahir</label>
                <div class="col-sm-8"> ${item.tmp_lahir} </div>
            </div>
            
            <div class="form-group row">
                <label class="col-sm-4">Tanggal Lahir</label>
                <div class="col-sm-8"> ${item.tgl_lahir} </div>
            </div>
            
            <div class="form-group row">
                <label class="col-sm-4">Jenis Kelamin</label>
                <div class="col-sm-8"> ${item.jenkel} </div>
            </div>
            
            
            <div class="form-group row">
                <label class="col-sm-4">Golongan Darah</label>
                <div class="col-sm-8"> ${item.goldar} </div>
            </div>
            
            <div class="form-group row">
                <label class="col-sm-4">Agama</label>
                <div class="col-sm-8"> ${item.agama} </div>
            </div>
            
            <div class="form-group row">
                <label class="col-sm-4">Status dalam keluarga</label>
                <div class="col-sm-8">  ${item.stat_hbkel} </div>
            </div>
            
            <div class="form-group row">
                <label class="col-sm-4">Status kawin</label>
                <div class="col-sm-8"> ${item.status_kawin} </div>
            </div>
            
            <div class="form-group row">
                <label class="col-sm-4">Status Pendidikan</label>
                <div class="col-sm-8"> ${item.status_pend} </div>
            </div>
            
            <div class="form-group row">
                <label class="col-sm-4">Pendidikan</label>
                <div class="col-sm-8"> ${item.pendidikan}  </div>
            </div>
            
            <div class="form-group row">
                <label class="col-sm-4">Pekerjaan</label>
                <div class="col-sm-8"> ${item.pekerjaan}  </div>
            </div>
            
            <div class="form-group row">
                <label class="col-sm-4">Nama ibu</label>
                <div class="col-sm-8"> ${item.nama_ibu}  </div>
            </div>
            
            <div class="form-group row">
                <label class="col-sm-4">Nama Ayah</label>
                <div class="col-sm-8"> ${item.nama_ayah}  </div>
            </div>
            
            <div class="form-group row">
                <label class="col-sm-4">Alamat</label>
                <div class="col-sm-8"> ${item.alamat},
                    <br>RT. ${item.rt}/RW. ${item.rw}
                    <br>kelurahan : ${item.getdatakeldes.nama_kel_desa},
                    <br>kecamatan : ${item.kecamatan},
                    <br>kab/kota  : ${item.kotakab},
                    <br>Provinsi  : ${item.propinsi}</div>
            </div>`);
            
            $('#detailpenduduk').modal('show');
        });
    });

    
</script>
@endsection
