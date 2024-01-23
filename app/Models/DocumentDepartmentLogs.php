<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DocumentDepartmentLog extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'document_id',
        'department_id',
        'created_by',
        'updated_by',
        'deleted_by',
    ];

    // Relationships or additional configurations can be defined here

    /**
     * Get the document associated with the department log.
     */
    
}
