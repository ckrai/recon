<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Survey extends Model
{
    use HasFactory;

    protected $fillable = [
        'id', 
        'title', 
        'description', 
        'start_date', 
        'end_date', 
        'auth_token',
        'created_at',
        'updated_at'
    ];
}
