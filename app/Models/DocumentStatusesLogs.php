<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DocumentStatusesLogs extends Model
{
    protected $fillable = ['document_id',
     'status_id',
      'comment_type',
       'comment',
       'updated_by',
        'created_by',
         'deleted_by'];
}
