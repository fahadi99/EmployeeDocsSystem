<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DocumentTag extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'document_id',
        'person_id',
        'created_by',
    ];

    public function tagDocument ($document_id, $user_id) {

          $this->document_id = $document_id;
          $this->person_id = $user_id;
          $this->created_by = auth()->user()->id;
          $this->save();

   }

   public static function getDocumentTags ($document_id) {
    $data = self::select('*')->where('document_id',$document_id)->get();
    return $data;
    }

    public function updateTag ($document_id, $user_id) {
        $logged_in_user_id = auth()->user()->id;
        $matchThese = ['document_id'=>$document_id,'person_id'=>$user_id];
        self::updateOrCreate($matchThese,['created_by'=>$logged_in_user_id ]);
    }

}
