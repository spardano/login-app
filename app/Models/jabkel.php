<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class jabkel extends Model
{
    use HasFactory;
    protected $table = 'jab_kel';

    public function jabatan()
    {
        return $this->hasOne(KodeJabatan::class, 'id', 'id_jab');
    }
}