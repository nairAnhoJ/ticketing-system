<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;

    protected $fillable = [
        'type',
        'code',
        'brand',
        'serial_no',
        'description',
        'date_purchased',
        'status',
        'computer_id',
        'site'
    ];
}
