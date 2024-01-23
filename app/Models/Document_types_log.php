<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Document_types_log extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'document_id','type_id','created_by','updated_by','deleted_by'
    ];
    protected $dates = ['deleted_at'];
    protected $table = 'document_types_logs';
}
