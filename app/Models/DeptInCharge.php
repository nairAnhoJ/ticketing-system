<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DeptInCharge extends Model
{
    use HasFactory;

    public function department(){
        return $this->belongsTo(Department::class, 'dept_id');
    }
}
