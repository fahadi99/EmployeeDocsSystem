<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DocumentStatusLog extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'document_status_logs';

    protected $fillable = [
        'document_id','status_id'
    ];
    //
}
