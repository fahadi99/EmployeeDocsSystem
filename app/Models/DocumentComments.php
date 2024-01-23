<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DocumentComment extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'doc_id',
        'comment_type',
        'comments',
        'created_by',
        'updated_by',
        'deleted_by',
        'is_private',
    ];

    // Relationships or additional configurations can be defined here

    /**
     * Get the document that owns the comment.
     */
    public function document()
    {
        return $this->belongsTo(Document::class, 'doc_id');
    }
}
