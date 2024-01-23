<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DocumentFile extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'document_files';

    protected $fillable = [
        'document_id','file_id','comment_type','comment'
    ];

    public static function getDocumentById($document_id) {

        return self::leftjoin('files as f','f.id','document_files.file_id')
            ->where('document_files.document_id', $document_id)
            ->select('f.*','document_files.document_id as document_id')
            ->get();
    }

    public static function getByDocumentIdAttachmentId ($document_id,$attachmentId) {
        return self::leftjoin('files as f','f.id','document_files.file_id')
            ->where('document_id', $document_id)
            ->where('file_id', $attachmentId)
            ->select('f.*','document_files.document_id as document_id')
            ->first();
    }

    public function saveFileRecord ($document_id, $file_id, $save = true) {
        $this->document_id = $document_id;
        $this->file_id = $file_id;
        $this->comment_type = 'text';
        $this->comments = 'Test comment added';
        $this->created_by = auth()->user()->id;

        if ($save) { $this->save();}
    }
}
