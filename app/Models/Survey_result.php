<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Survey_result extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'surveyor_id',
        'survey_id',
        'lat',
        'lan',
        'created_at',
        'updated_at'
    ];
}
