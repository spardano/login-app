<?php

namespace App\Http\Controllers;

use App\Models\KodeJabatan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SignaturePadController extends Controller
{
    public function index()
    {
        return view('signaturePad');
    }

    public function upload(Request $request)
    {
        $data = KodeJabatan::where('nik' , Auth::user()->nik);

        $folderPath = public_path('upload/');
        
        $image_parts = explode(";base64,", $request->signed);
              
        $image_type_aux = explode("image/", $image_parts[0]);
           
        $image_type = $image_type_aux[1];
           
        $image_base64 = base64_decode($image_parts[1]);

        $file_name = uniqid() . '.'.$image_type;
           
        $file = $folderPath .$file_name;
        file_put_contents($file, $image_base64);

        if($data){
            $data->update([
                'ttd' => $file_name
            ]);
        }
        return back()->with('success', 'success Full upload signature');
    }
}
