<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DocumentPriorityLog extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'document_priority_logs';

    protected $fillable = [
        'document_id',
        'priority_id'
    ];

}
