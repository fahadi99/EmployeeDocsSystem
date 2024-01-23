<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DocumentDepartmentLog extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'document_department_logs';

    protected $fillable = [
        'document_id','department_id'
    ];
}
