<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DocumentProject extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'document_id',
        'project_id',
        'created_by',
        'updated_by',
        'deleted_by',
    ];

    // Relationships or additional configurations can be defined here

    /**
     * Get the document associated with the project.
     */
    public function document()
    {
        return $this->belongsTo(Document::class, 'document_id');
    }

    /**
     * Get the project associated with the document.
     */
    public function project()
    {
        return $this->belongsTo(Project::class, 'project_id');
    }
}
