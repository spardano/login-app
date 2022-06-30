<?php

namespace App\Exports;

use App\Models\data_penduduk;
use Maatwebsite\Excel\Concerns\FromCollection;


class pendudukExport implements FromCollection
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return data_penduduk::all();
    }
}