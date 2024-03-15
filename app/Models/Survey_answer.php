<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Survey_answer extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'survey_result_id',
        'surveyor_id',
        'survey_id',
        'question_group_id',
        'question_id',
        'question',
        'answer', 
        'created_at', 
        'updated_at'
    ];
}
