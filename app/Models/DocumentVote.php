<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DocumentVote extends Model
{
    use SoftDeletes;

    protected $table = 'document_votes';

    protected $fillable = [
        'document_id',
        'vote_type_id',
        'created_by',
        'deleted_by',
        'updated_by',
    ];


}
