<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DocumentComment extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'document_comments';

    protected $fillable = [
        'document_id','comment_type','comments'
    ];

    public function validateForm($request = false) {
        if ($request === false) {
            $request = request();
        }
        $v = \Illuminate\Support\Facades\Validator::make($request->all(), [
            'comments' => 'required'
            //'is_private' => 'required'
        ],[
            'comments.required'=>'Comment is required',
        ]);

        if ($v->fails())
        {
            return response()->json([
                'status' => 400,
                'message' => $v->getMessageBag()->toArray()
            ]);
        }
        return true;
    }

    public function validateFormAudioComment($request = false) {
        if ($request === false) {
            $request = request();
        }
        $v = \Illuminate\Support\Facades\Validator::make($request->all(), [
            'audio' => 'required'
        ],[
            'audio.required'=>'Please provide audio comment',
        ]);

        if ($v->fails())
        {
            return response()->json([
                'status' => 400,
                'message' => $v->getMessageBag()->toArray()
            ]);
        }
        return true;
    }


    public static function documentsVoiceDir () {
        return "comments/voice_notes/";
    }

    public function updateAudioComment( $save = true) {

        $request = request();
        $dir = self::documentsVoiceDir();
        $path = public_path(). '/' . $dir;
        $voice = 'audio';

        File::isDirectory($path) or File::makeDirectory($path, 0755, true, true);

        if ($this->comments != '' && File::exists($dir . $this->comments)) {
            File::delete($dir . $this->comments);
        }

        if ($request->audio_remove == 1 && File::exists($dir . $this->comments)) {
            File::delete($dir . $this->comments);
                $this->comments = '';

        } else {
            if($request->hasFile($voice)) {
                $extension = 'wav';
                $AudioFileName =  strtolower(time().'_'.rand(1000,9999).'.'.$extension);
                $request->file($voice)->move(self::documentsVoiceDir(), $AudioFileName);
                $this->comments = $AudioFileName;
            } else {
                $this->comments = '';
            }
        }

        if($save)
            $this->save();

        return $this->comments;

    }

    public function AddAudioComment($documentId, $request = false) {

        if($request === false)
            $request = request();

        $valid = $this->validateFormAudioComment();

        if($valid !== true)
            return $valid;

        $this->document_id = $documentId;
        $this->comment_type = 'voice';
        $this->created_by = auth()->user()->id;

        if ($request->has('audio')) {
           $this->updateAudioComment(true);
        }
        $this->save();

        $message = "Audio Comment has been added successfully";
        return response()->json([
            'status' => 200,
            'message' => $message,
            'document_id' => $documentId
        ]);
    }

    public function addForm($documentId, $request = false) {

        if($request === false)
            $request = request();

        $valid = $this->validateForm();

        if($valid !== true)
            return $valid;

        $this->document_id = $documentId;
        $this->comment_type = 'text';
        $this->comments = $request->comments;
        $this->created_by = auth()->user()->id;
        $this->save();

        $message = "Note has been added successfully";
        return response()->json([
            'status' => 200,
            'document_id' => $this->document_id,
            'message' => $message,
        ]);
    }


    public static function getByDocumentId($documentId) {

        $personId = auth()->user()->id;

        return self::join('persons as p', 'document_comments.created_by', 'p.id')
            ->where(function($where) use($personId) {
                $where->where('document_comments.created_by', $personId);
            })
            ->where('document_comments.document_id', $documentId)
            ->select('document_comments.*', 'p.first_name', 'p.last_name', 'p.picture as picture')
            ->orderby('document_comments.created_at', 'desc')
            ->get();
    }

    public static function getByDocumentIDee ($documentId) {
        return self::join('persons as p', 'document_comments.created_by', 'p.id')
            ->where('document_comments.document_id', $documentId)
            ->select('document_comments.*', 'p.first_name', 'p.last_name', 'p.picture as picture')
            ->orderby('document_comments.created_at', 'desc')
            ->get();
    }


}
