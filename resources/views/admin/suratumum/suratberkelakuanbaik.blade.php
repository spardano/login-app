<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <style>
        .text-paragraf{
            text-indent: 0.5in;
        }
        .cup{
            text-align:center; 
            width:100%;
        }
        .cup p{
            line-height:2px;
        }

        .table-bio{
            margin-left: 130px; 
            margin-right:auto;
        }

        .text-center{
            text-align: center
        }

    </style>
    <title>Surat Keterangan Berkelakuan Baik</title>
</head>
<body>
    <table style="text-align:center; width:100% ">
        <tr>
            <td><img src="{{ asset('images/logo_Bukittinggi.png') }}" style="width: 90px;"><hr> </td>
            <td  style="text-align: center;">
                <p style="line-height: 2px; font-size:18px">PEMERINTAHAN KOTA BUKITTINGGI</p>
                <p style="line-height: 2px; font-size:18px; text-transform: UPPERCASE">KECAMATAN {{$data->penduduk->kecamatan}}</p>
                <p style="line-height: 2px; font-size:33px; text-transform: UPPERCASE " >KELURAHAN {{ $data->getkodeDesa->nama_kel_desa }}</p>
                <p style="line-height: 2px; font-size:14px">Jalan Sanjai Dalam Kode Pos 26129 Bukittinggi</p>
                <hr>
            </td>
        </tr>
    </table>
    <h3 style="text-align: center; text-decoration:underline">SURAT KETERANGAN BERKELAKUAN BAIK</h3>
    <p style="text-align: center;line-height: 1px ">{{ $data->nomor_surat }}</p><br>

    <p style="text-indent: 0.5in">Yang bertanda tangan dibawah ini Lurah {{ $data->getkodeDesa->nama_kel_desa }} Kecamatan {{ $data->penduduk->kecamatan }} Kota Bukittinggi dengan ini menerangkan bahwa:</p><br>

    <table style="margin-left: 130px; margin-right:auto; " cellpadding="3" >
        <tr>
            <td>Nama</td>
            <td style="text-transform: UPPERCASE">: {{ $data->penduduk->nama }}</td>
        </tr>
        <tr>
            <td>NIK</td>
            <td>: {{ $data->nik }}</td>
        </tr>
        <tr>
            <td>Tempat/Tgl.Lahir</td>
            <td style="text-transform: UPPERCASE">: {{ $data->penduduk->tmp_lahir }}, {{ \Carbon\Carbon::create($data->penduduk->tgl_lahir)->format('d-m-Y') }}</td>
        </tr>
        <tr>
            <td>Agama/Kewarganegaraan</td>
            <td>: {{ $data->penduduk->agama }}/Indonesia</td>
        </tr>
        <tr>
            <td>Pekerjaan</td>
            <td style="text-transform: UPPERCASE">: {{ $data->penduduk->pekerjaan }}</td>
        </tr>
                <td>Alamat</td>
                <td style="text-transform: capitalize">:
                    {{ $data->penduduk->alamat }}
                    <table>
                        <tr>
                            <td>Kelurahan:</td>
                            <td style="text-transform: capitalize">{{ $data->getkodeDesa->nama_kel_desa }}</td>

                        </tr>
                        <tr>
                            <td>Kecamatan:</td>
                            <td style="text-transform: capitalize">{{ $data->penduduk->kecamatan }}</td>
                        </tr>
                    </table>
                </td>  
            </tr>
    </table>
    
   
    <p style="text-indent: 0.5in; line-height: 130%" >Nama tersebut diatas adalah penduduk Kelurahan {{ $data->getkodeDesa->nama_kel_desa }} Kecamatan
   {{$data->penduduk->kecamatan}} Kota Bukittinggi. Sesuai dengan pernyataan diatas tanggal 10 Juli 2020
    dan diketahui oleh ketua RT.{{ $data->penduduk->rt }} RW.{{ $data->penduduk->rw }} Kel.{{ $data->getkodeDesa->nama_kel_desa }}
    yang bersangkutan selama berada di Kelurahan ini berkelakuan baik dan tidak terikat oleh minuman keras dan
    belum pernah dihukum karna kejahatan.</p>
    <p style="text-indent: 0.5in; line-height: 130%">Demikianlah surat keterangan ini di keluarkan sebagai persyaratan Mengurus 
    Surat Berkelakuan Baik di Polres Bukittinggi Guna {{ $data->tujuan }}.</p>

    <div style="margin-left: 450px; margin-top:50px; text-align:center" >
        <p style="line-height: 10%">Bukittinggi, {{ \Carbon\Carbon::create($data->create)->format('d-m-Y') }}</p>
        <p  style="line-height: 10%">a.n.LURAH {{ $data->getkodeDesa->nama_kel_desa }}</p>
        <p  style="line-height: 50%">{{ $TTD->jabatan }}</p><br>
        @if($data->status_surat == '2')
            <img src="{{ asset('upload/'.$TTD->ttd) }}" alt="" style="width:130px">
        @endif
        <p style=" text-decoration:underline;  margin-top:50px"> {{ $TTD->nama }}</p>
        <p style="line-height: 10%">NIP:{{ $TTD->nip }}</p>
    </div>

</body>
</html>