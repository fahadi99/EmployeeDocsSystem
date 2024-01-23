<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DocumentShare extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'document_id',
        'url_hash',
        'shared_till',
        'duration_type',
        'duration_value',
        'permission_string',
        'created_by',
        'deleted_by',
        'updated_by',
    ];

    public static function getDocumentShareHistory ( $document_id ) {

        $data = self::where('document_id',$document_id)
                ->orderBy('created_at','desc')
                ->get();

                foreach($data as $d) {
                    $shared_document_url = route('document.shared_document', ['slug' => $d->url_hash]);
                    $d->url = $shared_document_url;
                }

        return $data;

    }



}
