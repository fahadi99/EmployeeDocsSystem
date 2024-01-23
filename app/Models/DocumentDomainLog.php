<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DocumentDomainLog extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'document_domain_logs';

    protected $fillable = [
        'document_id','domain_id'
    ];
}
