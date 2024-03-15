<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Option extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'id',
        'survey_id',
        'question_group_id',
        'question_id',
        'option_text',
        'option_value',
        'created_at',
        'updated_at'
    ];

}
