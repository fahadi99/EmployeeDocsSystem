<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Document_priority;
// use Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use App\Data;
use Gate;
use App\Services\DocumentPriorityService;
use exception;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateDocumentPriorityRequest;
class DocumentPriorityController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the profile for a given user.
     *
     * @param  int  $id
     * @return \Illuminate\View\View
     */
    public function index(Request $request, DocumentPriorityService $documentPriorityService)
    {
        $data = $documentPriorityService->index();

        return view('document_priority.index', $data);
    }


    public function search(Request $request) {
    $searchTerm = $request->input('name');
    $data = Document_priority::where('name', 'ilike', '%' . $searchTerm . '%')->get();
    $total_count = count($data);

    $returnHTML = view('document_priority.include.d_priority_grid', compact('data','total_count'))->render();
    return response()->json([
        'status' => 200,
        'html' => $returnHTML
    ]);
}


    //Add function starts here
    public function add(Request $request){

        if(!checkPersonPermission('add-document_priority-3-0'))
            return ErrorMessage(403);

        $v = Validator::make($request->all(), [
            'document_priority_name' => 'required',
            ],[
            'document_priority_name.required'=>'Please provide Document Priority Name',
            ]); // Validation ends here

            if ($v->fails())
            { return response()->json([
            'status' => 400,
            'message' => $v->getMessageBag()->toArray()
            ]); }

            if (Document_priority::where('name', '=', $request->document_priority_name)->exists()) {
                $errors = "Document priority name already exists";
                return response()->json([
                'status' => 409,
                'message' => $errors
                ]);
             }

            try{

            $department = new Document_priority();
            $department->name = $request->document_priority_name;

            $department->created_by = Auth::user()->id;
            $department->save();

            $message = "Document priority_name Added Successfully";
            return response()->json(['status' => 200,'message' => $message ]);

            }catch(Exception $e)  {
                $message =  $e->getMessage();
                return response()->json([
                    'status' => 400,
                    'message' => $message
                ]);
            }
    }
    //Add function ends here

    //Get deatment function starts here
    public function get_department(Request $request){
        $id = $request->id;
        $data = Document_priority::where('id','=',$id)->first();
            echo json_encode($data);
              exit;
    }
    //Get department function ends here

    //Update function starts here
    public function update_department(Request $request){
        // dd($request->all());
        if(!checkPersonPermission('update-document_priority-3-0'))
            return ErrorMessage(403);

        $v = Validator::make($request->all(), [
            'document_priority_name' => 'required',
            ],[
            'document_priority_name.required'=>'Please provide document priority name',
            ]); // Validation ends here

            if ($v->fails())
            { return response()->json([
            'status' => 400,
            'message' => $v->getMessageBag()->toArray()
            ]); }


            try{
            $department = Document_priority::find($request->department_id);
            $department->name = $request->document_priority_name;
            if($request->document_priority_name === null){
            return response()->json([
                'status' => 400,
                'message' => "Please provide document priority name"
                ]);
            }
            $department->update();

            $message = "Document priority updated successfully";
            return response()->json(['status' => 200,'message' => $message ]);

            }catch(Exception $e)  {
                $message =  $e->getMessage();
                return response()->json([
                    'status' => 400,
                    'message' => $message
                ]);
            }
    }
    //Update function ends here

    //Delete function starts here
    public function delete_department(Request $request){
        try{

            if(!checkPersonPermission('delete-document_priority-3-0'))
                return ErrorMessage(403);

            $department = Document_priority::find($request->id);
            $department->deleted_by = Auth::user()->id;
            $department->delete();

            $message = "Document Priority Deleted Successfully";
            return response()->json(['status' => 200,'message' => $message ]);

            }catch(Exception $e)  {
                $message =  $e->getMessage();
                return response()->json([
                    'status' => 400,
                    'message' => $message
                ]);
            }
    }
    //Delete function ends here

}
