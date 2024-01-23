<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Support\Str;
use App\Models\DocumentData;

use App\Models\DocumentFile;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Eloquent\Model;
use App\Services\Document\DocxConversion;
use Illuminate\Support\Facades\Validator;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\File as UploadFile;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class File extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'files';

    protected $fillable = [
        'name','file_type','file_size','file_path'
    ];

    public static function FilesDir()
    {
        return 'assets/media/files/';
    }

    public static function uploadAllFiles ( $file , $document_id = false ) {

            $upload_file = new File;
            $dir = self::FilesDir();
            $path = public_path().'/'.$dir;

            UploadFile::isDirectory($path) or UploadFile::makeDirectory($path, 0777, true, true);

            $extension = $file->getClientOriginalExtension();
            $name = $file->getClientOriginalName();
            $file_size = $file->getSize();

            $FileName = strtolower( Str::random(8).'_'.time().'_'.rand(1000, 9999).'.'.$extension );
            $file->move(self::FilesDir(), $FileName);

            $upload_file->name = $name;
            $upload_file->file_type = $extension;
            $upload_file->file_path = $FileName;
            $upload_file->file_size = $file_size;
            $upload_file->created_by = auth()->user()->id;
            $upload_file->save();

             /*  $docObj = new DocxConversion($document_id, $upload_file->file_path, $upload_file->id, $extension);
            $extractedDocText = $docObj->convertToText(1);

            $insertData = new DocumentData();
            $insertData->saveTextInDataBase( $document_id, $upload_file->id , $extractedDocText);   */

            if ($document_id) {

                $document_file = new DocumentFile;
                $document_file->saveFileRecord($document_id, $upload_file->id);

            }

    }

    public static function getPath() {
        return '/assets/media/files/';
    }

}
