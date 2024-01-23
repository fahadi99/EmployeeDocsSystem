<?php

namespace App\Models\Views;

use App\Models\File;
use App\Models\DocumentFile;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DocumentView extends Model
{
    use HasFactory;

    protected $table = 'documents_view';

    public static function getPersonDocuments ( $id ) {
         $data = self::leftjoin('document_tags as dt','dt.document_id','documents_view.id')
                     ->leftjoin('persons as person','person.id','dt.person_id')
                     ->where('dt.person_id',$id)
                     ->select([
                         'documents_view.*',
                         'person.id as person_id'
                      ])
                      ->distinct('documents_view.id')
                      ->get();

        return $data;
    }

    public static function getById ($id) {

       $data = self::leftjoin('document_starreds as ds','ds.document_id','documents_view.id')
       ->where('documents_view.id',$id)
       ->select([
        'documents_view.*',
        'ds.id as starred'
        ])
       ->first();

       return $data;
    }

    public function attachment($document_id,$attachmentId) {
        $this->attachment = DocumentFile::getByDocumentIdAttachmentId($document_id, $attachmentId);
        return $this->attachment;
    }

    public static function attachments($document_id) {
        $attachments = DocumentFile::getDocumentById($document_id);
        return $attachments;
    }

    public static function taggedPersons ($document_id,$owner_id) {

        $persons = self::leftjoin('document_tags as dt','dt.document_id','documents_view.id')
        ->leftjoin('persons as person','person.id','dt.person_id')
        ->select([
            'person.id as person_id',
            'person.email as email',
            'person.first_name as first_name',
            'person.last_name as last_name',
            'person.phone as phone',
            'person.picture as picture',
            'documents_view.owner_id as owner_id',
         ])
         ->where('documents_view.id',$document_id)
         ->distinct('person.id')
         ->whereNotNull('person.id')
         ->whereNull('dt.deleted_at')
         ->get();

         $tagged_persons = [];
         foreach ($persons as $tp) {
            if ($tp->person_id == $owner_id ) {
                $tp->is_owner = true;
            }
            $tagged_persons[] = $tp;
         }

         $data['tagged_persons'] = isset($tagged_persons) ? $tagged_persons : null;

         return $data;

    }
}
