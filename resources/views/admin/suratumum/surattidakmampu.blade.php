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

        .table-kel{
            border-collapse: collapse;
            width: 100%;
        }

        .table-kel,.table-kel th {
            border: solid 1px black;
        }

        .table-kel,.table-kel td {
            border-right: solid 1px black;
        }

        .table-kel td {
            text-transform: capitalize
        }

        .text-center{
            text-align: center
        }

    </style>
    <title>Surat Keterangan Tidak Mampu</title>
</head>

<body>
    <table class="cup">  
        <tr>
            <td><img src="{{ asset('images/logo_Bukittinggi.png') }}" style="width: 90px;"><hr> </td>
            <td  class="text-center">
                <p style="font-size:18px">PEMERINTAHAN KOTA BUKITTINGGI</p>
                <p  style="font-size:18px; text-transform: UPPERCASE">KECAMATAN {{ $data->penduduk->kecamatan }}</p>
                <p style="font-size:33px; text-transform: UPPERCASE " >KELURAHAN {{ $data->getkodeDesa->nama_kel_desa }}</p>
                <p style="font-size:14px">Jalan Sanjai Dalam Kode Pos 26129 Bukittinggi</p>
                <hr>
            </td>
        </tr>     
    </table>

    <h3 style="text-decoration:underline" class="text-center">SURAT KETERANGAN TIDAK MAMPU</h3>
    <p style="line-height: 1px " class="text-center">{{ $data->nomor_surat }}</p><br>

    <p class="text-paragraf">Yang bertanda tangan dibawah ini Lurah {{ $data->getkodeDesa->nama_kel_desa }} Kecamatan {{ $data->penduduk->kecamatan }} Kota Bukittinggi dengan ini menerangkan bahwa:</p><br>
    
    <table class="table-bio" cellpadding="3" >
           
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
            <tr>
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
    
   
   <p style="line-height: 100%" class="text-paragraf" >Nama tersebut diatas adalah penduduk Kelurahan {{ $data->getkodeDesa->nama_kel_desa }} Kecamatan
   {{$data->penduduk->kecamatan}} Kota Bukittinggi. Sesuai dengan data base yang ada di kelurahan termasuk KELUARGA TIDAK MAMPU,
   dengan tanggungan sebagai berikut:</p>
  

   <table class="table-kel">
       <thead>
           <tr>
               <th>No.</th>
               <th>Nama</th>
               <th>Pekerjaan</th>
               <th>ket</th>
           </tr>
       </thead>
       <tbody>
           @foreach ($datakel as $index => $item)
           <tr>
            <td class="text-center">{{ $index+1 }}</td>
            <td>{{ $item->nama }}</td>
            <td class="text-center" style="text-transform: UPPERCASE">{{ $item->pekerjaan }}</td>
            <td class="text-center" style="text-transform: capitalize">{{ $item->stat_hbkel }}</td>
           </tr>
           @endforeach
       </tbody>
   </table>

   <P style="line-height: 130%" class="text-paragraf">Demikianlah Surat Keterangan ini dikeluarkan untuk dapat dipergunakan sebagai     {{ $data->tujuan }}
   </P>

    <div style="margin-left: 450px; margin-top:10px; text-align:center" >
        <p style="line-height: 10%">Bukittinggi, {{ \Carbon\Carbon::create($data->created_at)->format('d-m-Y') }}</p>
        <p  style="line-height: 10%">a.n.LURAH {{ $data->getkodeDesa->nama_kel_desa }}</p>
        <p  style="line-height: 50%">{{ $TTD->jabatan }}</p><br>
        @if($data->status_surat == '2')
            <img src="{{ asset('upload/'.$TTD->ttd) }}" alt="" style="width:130px">
        @endif
        <p style=" text-decoration:underline;  margin-top:30px"> {{ $TTD->nama }}</p>
        <p style="line-height: 10%">NIP:{{ $TTD->nip }}</p>
    </div>

</body>

</html>