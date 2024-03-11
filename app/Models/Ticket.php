<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    use HasFactory;

    public function requestor() {
        return $this->belongsTo(User::class, 'user_id');
    }
    
    public function departmentRow() {
        return $this->belongsTo(Department::class, 'department');
    }

    public function category() {
        return $this->belongsTo(TicketCategory::class, 'nature_of_problem');
    }

    public function assigned() {
        return $this->belongsTo(User::class, 'assigned_to');
    }
}
