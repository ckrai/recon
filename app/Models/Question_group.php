<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question_group extends Model
{
    use HasFactory;

    protected $fillable = [
            'id',
            'survey_id',
            'title',
            'description',
            'created_at',
            'updated_at'
    ];
}
