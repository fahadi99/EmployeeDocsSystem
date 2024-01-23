<?php

namespace App\Http\Controllers\Documents;

use Carbon\Carbon;
use App\Models\File;
use App\Models\Domain;
use App\Models\Module;
use App\Models\Person;
use App\Models\Project;
use App\Models\Document;
use App\Models\Projects;
use App\Models\Department;
use App\Models\VotingType;
use App\Models\Designation;
use App\Models\DocumentTag;
use App\Models\DocumentFile;
use App\Models\DocumentType;
use App\Models\Organization;
use Illuminate\Http\Request;
use App\Models\DocumentShare;
use App\Models\ModuleProject;
use App\Models\DocumentStatus;
use App\Models\DocumentComment;
use App\Models\DocumentStarred;
use App\Models\DocumentCategory;
use App\Models\DocumentPriority;
use App\Models\Views\DocumentView;
use App\Http\Controllers\Controller;
use App\Models\DocumentCategoryRelation;
use App\Services\Document\DocumentsService;

class DocumentsController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request) {

        $data = DocumentsService::mainPageListingByPersonId();
        $selectBoxes = DocumentsService::getSelectBoxes();
        $filters = $data['filters'];
        $documents = $data['documents'];
        $mainDocument = false;
        $comments = false;

        if($request->has('document') || $request->has('files')) {
            $mainDocument = DocumentView::getById($request->get('document'));
        }

       if($request->ajax() && $request->type == 'search') {
       // dd($filters);
            return response()->json([
                'status' => 200,
                'data' => view('documents.include.documents_partial', compact('mainDocument','documents', 'filters'))->render()
            ]);
        }

        if($request->ajax() && $request->type == 'document') {

            $document_comments = DocumentComment::getByDocumentId($mainDocument->id);
            $attachments = DocumentView::attachments($mainDocument->id);
            $tagged_users = DocumentView::taggedPersons($mainDocument->id, $mainDocument->owner_id);

            return response()->json([
                'status' => 200,
                'document' => view('documents.include.documents_detail_partial', compact('mainDocument','document_comments','attachments','tagged_users','selectBoxes'))->render()
            ]);
        }

        $date = Carbon::now()->format('m/d/Y');
        $date = Carbon::parse($date);
        //dd($date);

        return view('documents.index', compact('selectBoxes','filters','documents','mainDocument','date'));
    }

    public function read_file(Request $request, $id, $attachment_id) {
        if($id && $attachment_id) {
            $mainDocument = DocumentView::getById($id);
            if($mainDocument) {
                if($mainDocument->attachment($mainDocument->id,$attachment_id)) {
                    $file = public_path('/')  . File::FilesDir() . "/" . $mainDocument->attachment->file_path;
                    return response()->download($file, $mainDocument->attachment->name);
                }
            }
        }
    }

    public function store(Request $request)
    {
        $obj = new DocumentsService();
        return $obj->addForm();
    }

    public function add_basic_data(Request $request)
    {
        $obj = new DocumentsService();
        return $obj->addBasicData();
    }

    public function add_details(Request $request)
    {
        $obj = new DocumentsService();
        return $obj->addDetails();
    }

    public function add_assignees(Request $request)
    {
        $obj = new DocumentsService();
        return $obj->addAssignees();
    }

    public function add_comments(Request $request, $id) {

        if($id) {
           $document = Document::find($id);
           return $document->addComment();
        }
    }

    public function add_file (Request $request) {
        $obj = new DocumentsService();
        return $obj->uploadFiles();
    }

    public function starred (Request $request) {

        $documentStarred = new DocumentStarred();
        return $documentStarred->setStarred($request->id);

    }

    public function uploadAudio (Request $request) {

        $document_id = $request->id;
        if ($document_id) {
            $audio_comment = new DocumentComment;
            return $audio_comment->AddAudioComment($document_id);
        }

    }

    public function change_status(Request $request, $id, $status) {
        $mainDocument = Document::getById($id);
        if($mainDocument) {
                return $mainDocument->updateStatus($status);
        } else {
            return response()->json([
                'status' => 400,
                'message' => "Unauthorized"
            ]);
        }
    }

    public function delete_document($id = false) {
        if($id) {
            $obj = Document::find($id);
            return $obj->deleteObj();
        }
    }


    public function edit_document ($id = false) {

        if($id) {

            $mainDocument = DocumentView::getById($id);
            $selectBoxes = DocumentsService::getSelectBoxes();
            $selectedCategores = DocumentCategoryRelation::getDocumentCategories($id);
            $selectedTaggedPeople = DocumentTag::getDocumentTags($id);

            $basic_data = view('documents.include.partials.basic_data', compact('mainDocument','selectBoxes','selectedCategores'))->render();
            $details_data = view('documents.include.partials.details_data', compact('mainDocument','selectBoxes'))->render();
            $assignees_data = view('documents.include.partials.assignees_data', compact('mainDocument','selectBoxes','selectedTaggedPeople'))->render();
            $message = 'Edit data';

            return response()->json([
                'status' => 200,
                'message' => $message,
                'basic_data' => $basic_data,
                'details_data' => $details_data,
                'assignees_data' => $assignees_data,
            ]);

        }
    }

    public function update_basic_data (Request $request) {

        $obj = new DocumentsService();
        return $obj->updateBasicData();
    }

    public function update_details (Request $request) {

        $obj = new DocumentsService();
        return $obj->updateDetails();
    }

    public function update_assignees (Request $request) {

        $obj = new DocumentsService();
        return $obj->updateAssignees();
    }

    public function share_document (Request $request) {

        $obj = new DocumentsService();
        return $obj->shareDocument();
    }

    public function share_history ($document_id = false) {

        if ($document_id) {

            $mainDocument = DocumentView::getById($document_id);
            $documentSharedHistory = DocumentShare::getDocumentShareHistory($document_id);
            $document_history = view('documents.include.partials.shared_document_history_data', compact('mainDocument','documentSharedHistory'))->render();
            $message = 'Document history';

            return response()->json([
                'status' => 200,
                'message' => $message,
                'document_history' => $document_history,
            ]);
        }
    }

    public function shared_document_link ($slug) {

        if ($slug) {
             $shared_document_url = route('document.shared_document', ['slug' => $slug]);
             return  view('documents.document_link_page',compact('shared_document_url'));
        }
    }

}
