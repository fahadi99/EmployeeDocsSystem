<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DocumentKeyword extends Model
{
    use SoftDeletes;

    protected $fillable = ['document_id', 'keywords', 'created_by', 'deleted_by', 'updated_by'];
}

