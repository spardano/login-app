@extends('layouts.master')

@section('before-css')
<link rel="stylesheet" href="{{ asset('assets/styles/vendor/datatables.min.css') }}">
@endsection

@section('main-content')

@include('alert-session')

<style>
    .form{
        margin-top: 5px;
        margin-bottom: 5px;
        margin-right: 2px;
        margin-left: 5px;
    }
</style>

<div class="card">
    <div class="card-body">
        <a href="{{ route('suratumum')}}" type="button" class="btn btn-danger"><i class="i-Previous"></i></a>
      <div class="border-top mb-5"></div>
            <div class="row">
                <div class="col-md-6">
                    <h4>Detail Surat</h4>
                    <div class="card mb-5">
                        <div class="card-body">
                            <div class="d-flex flex-column">
                                <form action="{{ route('updatedetailsurat', [$data->id]) }}" method="post">
                                    @csrf
                                    <div class="form-group">
                                        <label for="no_surat">Nomor Surat</label>
                                        <input type="hidden" id="id_klasifikasi_surat" value="{{ $data->KlasifikasiSurat->id }}">
                                        <input type="text" name="no_surat" id="no_surat" class="form-control" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="uraian_surat">Jenis Surat</label>
                                        <input type="text" readonly="true"  class="form-control" value="{{ $data->KlasifikasiSurat->uraian }}" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="jabatan">pejabat penandatangan</label>
                                        @csrf
                                        <select name="kode_jabatan" id="kode_jabatan" class="form-control">
                                            <option hidden  value="{{ $data->kode_jabatan }}">{{ $data->kodejabatan->jabatan }}</option>
                                            @foreach ($jabatan as $row)
                                            <option value="{{ $row->kode_jabatan }}">{{ $row->jabatan }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <a href="/exportpdf/{{ $data->id }} && {{ $data->kode_surat }}" type="button" class="btn btn-success">
                                        <i class="nav-icon i-File"></i>
                                    </a>

                                    @if($data->status_surat == 0)
                                        <button type="submit"  class="btn btn-info">teruskan</button> 
                                    @endif

                                    @if($data->status_surat == 1)
                                    <button type="submit"  class="btn btn-info">update</button> 
                                    @endif
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <h4>Detail Pengaju</h4>
                    <div class="card mb-5">
                        <div class="card-body">
                            <div class="d-flex flex-column">
                               
                                    <div class="form-group">
                                        <label for="no_surat">Tanggal Surat : {{ $data->tgl_surat }}</label>
                                    </div>
                                    <div class="form-group">
                                        <label for="no_surat">Nama Pengaju</label>
                                        <input type="text" readonly="true" class="form-control" value="{{ $data->penduduk->nama }}" required>
                                    </div>
                                    <div class="form-group">  
                                        <label for="alasan">Alasan</label>
                                        <input type="text" readonly="true" class="form-control" value="{{ $data->alasan }}" required>   
                                    </div>
                                    <div class="form-group">  
                                        <label for="tujuan">Tujuan</label>
                                        <input type="text" readonly="true" class="form-control" value="{{ $data->tujuan }}" required>
                                    </div>
                                    <div class="form-group">  
                                        <label for="alamat">Alamat</label>
                                        <input type="text" readonly="true" class="form-control" value="{{ $data->penduduk->alamat }}, RT/RW : {{ $data->penduduk->rt }}/{{ $data->penduduk->rw }}, {{ $data->getkodeDesa->nama_kel_desa }}, {{ $data->penduduk->kecamatan }}" required>
                                    </div>
                               
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="border-top mb-5"></div>
        </div>
    </div>
</div>

@endsection

@section('bottom-js')
<script>

    getPenomoranOtomatis();

    function romanize (num) {
    if (!+num)
        return false;
        var digits = String(+num).split(""),
            key    = ["","C","CC","CCC","CD","D","DC","DCC","DCCC","CM",
                    "","X","XX","XXX","XL","L","LX","LXX","LXXX","XC",
                    "","I","II","III","IV","V","VI","VII","VIII","IX"],
            roman  = "",
            i      = 3;
        while (i--)
            roman = (key[+digits.pop() + (i * 10)] || "") + roman;
        return Array(+digits.join("") + 1).join("M") + roman;
    }

    function getPenomoranOtomatis(){
        var id_klasifikasi_surat = $('#id_klasifikasi_surat').val();
        var url = `{{ url('detailsurat/getnomorotomatis/${id_klasifikasi_surat}') }}`

        $.ajax({
            url: url,
            type: 'GET', 
            dataType: 'JSON',
            async: true,
            success: function(result){

                var penomoran = result.penomoran;
                var kode_surat = penomoran.klasifikasi_surat.kode_surat;
                var mulai_dari = penomoran.mulai_dari;
                var kode_kelurahan = penomoran.kel_desa.kode_kel_desa;
                
                const d = new Date();

                var bulan = romanize(d.getMonth()+1);
                
                var tahun = d.getFullYear();

                var no_surat = penomoran.no_surat.split("/")

                var stringNomorSurat = ``;
                var num = 0;
                no_surat.forEach(data => {
                    if(num == 0){
                        switch(data) {
                            case 'kode_surat':
                                stringNomorSurat += `${kode_surat}`
                                break;
                            case 'mulai_dari':
                                stringNomorSurat += `${mulai_dari}`
                                break;
                            case 'kode_kelurahan':
                                stringNomorSurat += `KEL-${kode_kelurahan}`
                                break;
                            case 'bulan':
                                stringNomorSurat += `${bulan}`
                                break;
                            case 'tahun':
                                stringNomorSurat += `${tahun}`
                                break;
                            default:
                                // code block
                            } 
                    } else {
                        switch(data) {
                            case 'kode_surat':
                                stringNomorSurat += `/${kode_surat}`
                                break;
                            case 'mulai_dari':
                                stringNomorSurat += `/${mulai_dari}`
                                break;
                            case 'kode_kelurahan':
                                stringNomorSurat += `/KEL-${kode_kelurahan}`
                                break;
                            case 'bulan':
                                stringNomorSurat += `/${bulan}`
                                break;
                            case 'tahun':
                                stringNomorSurat += `/${tahun}`
                                break;
                            default:
                                // code block
                            } 
                    }

                    num++;
                });

                $('#no_surat').val(stringNomorSurat);
                console.log('stringNomorSurat');
            }
        });
    }

</script>
@endsection
