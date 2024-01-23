<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DocumentProject extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'document_projects';

    protected $fillable = [
        'document_id','project_id'
    ];
}
