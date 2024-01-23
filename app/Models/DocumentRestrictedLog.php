<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DocumentRestrictedLog extends Model
{
    use SoftDeletes,HasFactory;

    protected $table = 'document_restricted_logs';

    protected $fillable = [
        'document_id',
        'is_restricted',
        'created_by',
    ];

}
