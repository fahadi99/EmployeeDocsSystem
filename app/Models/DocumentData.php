<?php

namespace App\Models;

use Laravel\Scout\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DocumentData extends Model
{
    use HasFactory, SoftDeletes, Searchable;

    protected $table = 'document_data';

    protected $fillable = [
        'document_id',
        'file_id',
        'file_text',
        'created_by',
    ];

    public function toSearchableArray(): array
    {
       return [
           'file_text' => $this->file_text
       ];
    }

    public function saveTextInDataBase  ($document_id, $file_id, $file_text) {

        $this->document_id = $document_id;
        $this->file_id = $file_id;
        $this->file_text = $file_text;
        $this->created_by = auth()->user()->id;
        $this->save();

    }

}
