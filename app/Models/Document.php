<?php

namespace App\Models;

use App\Models\DocumentComment;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Document extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'documents';

    protected $fillable = [
        'subject','short_description','description','dated','organization_id','department_id','domain_id','project_id','document_type_id','document_priority_id','document_status_id','is_restricted'
    ];

    public function addComment() {
        $documentComment = new DocumentComment();
        $type = 'text';
        return $documentComment->addForm($this->id);
    }

    public static function getById ($id) {
        $data = self::where('id',$id)->first();
        return $data;
    }

    public function updateStatus($status) {
        $this->document_status_id = $status;
        $this->save();
        $message = "Document Status updated";
        return response()->json([
            'status' => 200,
            'document_id' => $this->id,
            'message' => $message,
        ]);
    }

    public function deleteObj() {
        $this->deleted_by = auth()->user()->id;
        $this->delete();
        return response()->json([
            'status' => 200,
            'message' => "Document deleted successfully."
        ]);
    }


}
