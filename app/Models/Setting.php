<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;

    protected $fillable = [
        'smtp_is_activated',
        'smtp_server',
        'smtp_username',
        'smtp_password',
        'smtp_port'
    ];
}
