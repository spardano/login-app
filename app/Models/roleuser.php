<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class roleuser extends Model
{
    use HasFactory;
    protected $table = 'role_user';
    protected $fillable = [
        'id',
        'role_id',
        'user_id'
    ];

    public function roleid()
    {
        return $this->hasOne(roles::class, 'id', 'role_id');
    }

    public function userid()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }
}