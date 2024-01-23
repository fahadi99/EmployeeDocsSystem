<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DocumentStarred extends Model
{
    use HasFactory;

    public function setStarred($DocumentId, $personId = false) {

        try{

        if($personId === false)
            $personId = auth()->user()->id;

        $exists = self::where('document_id', $DocumentId)
            ->first();

        if($exists) {
            $exists->deleted_by = auth()->user()->id;
            $exists->save();
            $exists->delete();
            $message = "Removed as starred";

        } else {
            $obj = new DocumentStarred();
            $obj->document_id = $DocumentId;
            $obj->created_by = auth()->user()->id;
            $obj->save();
            $message = "Added as starred";
        }

        return response()->json([
            'status' => 200,
            'message' => $message,
        ]);

    }catch(Exception $e)  {
        $message =  $e->getMessage();
        return response()->json([
            'status' => 400,
            'message' => $message
        ]);
    }

    }
}
