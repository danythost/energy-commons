<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Zone extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'leader_name',
        'leader_email',
        'leader_phone',
        'leader_home_address',
        'leader_ada_wallet'
    ];
}

