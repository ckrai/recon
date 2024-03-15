<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;

     protected $fillable = [
        'id',
        'survey_id',
        'question_group_id',
        'title',
        'type',
        'unique_identifier',
        'parent_question',
        'show_when',
        'is_greater',
        'is_lesser',
        'required',
        'readonly',
        'created_at',
        'updated_at'
    ];

}
