<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DocumentOrganizationLog extends Model
{
    use SoftDeletes,HasFactory;

    protected $table = 'document_organization_logs';

    protected $fillable = [
        'document_id',
        'organization_id',
        'timestamps',
        'created_by',
        'deleted_by',
        'updated_by',
    ];
}
