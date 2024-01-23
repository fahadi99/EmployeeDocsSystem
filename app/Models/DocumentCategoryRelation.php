<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DocumentCategoryRelation extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'document_categories_relation';

    protected $fillable = [
        'document_id','category_id','created_by'
    ];

    public function AddDocumentCategory ($document_id, $category_id) {

        $this->document_id = $document_id;
        $this->category_id = $category_id;
        $this->created_by = auth()->user()->id;
        $this->save();

    }


    public function updateDocumentCategory ($document_id, $category_id) {

        $logged_in_user_id = auth()->user()->id;
        $matchThese = ['document_id'=>$document_id,'category_id'=>$category_id];
        self::updateOrCreate($matchThese,['created_by'=> $logged_in_user_id ]);

    }

    public static function getDocumentCategories ($document_id) {

        $data = self::select('*')->where('document_id',$document_id)->get();
        return $data;

    }
}
