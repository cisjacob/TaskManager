<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function creator(){
        return $this->belongsTo(User::class, 'admin_id');
    }

    public function assignee(){
        return $this->belongsTo(User::class, 'assigned_user_id');
    }
}
