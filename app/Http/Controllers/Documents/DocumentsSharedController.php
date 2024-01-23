<?php

namespace App\Http\Controllers\Documents;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\DocumentShare;
use App\Models\DocumentComment;
use App\Models\Views\DocumentView;
use App\Http\Controllers\Controller;

class DocumentsSharedController extends Controller
{
    public function shared_document ($slug) {
        if ($slug) {
            $shared_document = DocumentShare::where('url_hash',$slug)->first();
            if ($shared_document) {

                 $document_id = $shared_document->document_id;
                 $mainDocument = DocumentView::getById($document_id);

                 $now = Carbon::now();

                 if ($shared_document->shared_till > $now) {
                    $permissions = $shared_document->permission_string;
                    $permissions = explode("_",$permissions);

                    $assignees = null;
                    $comments = null;
                    $attachments = null;

                    if (in_array("assignees", $permissions)) { $assignees = DocumentView::taggedPersons($mainDocument->id, $mainDocument->owner_id); }
                    if (in_array("comments", $permissions)) { $comments = DocumentComment::getByDocumentIDee($mainDocument->id);  }
                    if (in_array("files", $permissions)) { $attachments = DocumentView::attachments($mainDocument->id); }

                    return view('documents.shared_document',compact('mainDocument','assignees','comments','attachments'));

                 } else {
                    $message = 'Access to the link has been terminated.';
                    return response()->json([
                        'status' => 403,
                        'message' => $message,
                    ]);
                 }

            }
        }
    }
}
