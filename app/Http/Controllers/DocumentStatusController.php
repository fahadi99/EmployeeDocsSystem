<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use App\Data;
use Gate;
use Auth;
use App\Models\Department;
use App\Models\DocumentStatus;
use Illuminate\Http\Request;

class DocumentStatusController extends Controller
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

    public function index(Request $request)
    {
        $data = DocumentStatus::getAllDocumentStatuses();
        $total_count = count($data);

        return view('document_status.index', compact('data', 'total_count'));
    }


    public function search(Request $request) {

        $query = $request->input('name');
        $order = $request->input('order');

        $data = DocumentStatus::where('name', 'ilike', "%$query%");
        if ($order !== null) {
            if ($order === 'A - Z') {
                $data->orderBy('name');
            } elseif ($order === 'Z - A') {
                $data->orderBy('name', 'DESC');
            } elseif ($order === 'Recent added') {
                $data->latest();
            }
        }
        $data = $data->get();
        $total_count = count($data);

        $returnHTML = view('document_status.include.statuses_grid', compact('data','total_count'))->render();

        return response()->json([
            'status' => 200,
            'html' => $returnHTML
            ]);
    }



    //Add function starts here


    public function add(Request $request)
    {


        $v = Validator::make($request->all(), [
            'name' => 'required',
            'type' => 'required|in:start,in_progress,completed',
        ], [
            'name.required' => 'Please provide Document Status Name',
            'type.required' => 'Please select a valid type (start, in_progress, completed)',
            'type.in' => 'Invalid type. available options are: start, in_progress, completed',
        ]);

        if ($v->fails()) {
            return response()->json([
                'status' => 400,
                'message' => $v->getMessageBag()->toArray(),
            ]);
        }

        $documentStatus = new DocumentStatus();
        $documentStatus->name = $request->name;
        $documentStatus->type = $request->type;
        $documentStatus->created_by = Auth::user()->id;

        // Set other attributes based on your migration, e.g., is_default, updated_by, deleted_by

        try {
            $documentStatus->save();

            $message = "Document Status Added Successfully";
            return response()->json(['status' => 200, 'message' => $message]);
        } catch (\Exception $e) {
            $message = $e->getMessage();
            return response()->json([
                'status' => 400,
                'message' => $message,
            ]);
        }
    }

    //Add function ends here

    //Get deatment function starts here
    public function show(Request $request){

        $id = $request->id;
        $data = DocumentStatus::where('id', '=', $id)->first();
        return response()->json($data);
    }
    //Get department function ends here

    //Update function starts here
    public function update(Request $request){

            $v = Validator::make($request->all(), [
                'name' => 'required',
                'type' => 'in:start,in_progress,completed', // Use 'type' from your migration
            ], [
                'name.required' => 'Please provide Document Status Name',
                'type.in' => 'Invalid Document Status Type', // Error message for 'type'
            ]);

            if ($v->fails()) {
                return response()->json([
                    'status' => 400,
                    'message' => $v->getMessageBag()->toArray(),
                ]);
            }

            try {
                $documentStatus = DocumentStatus::find($request->department_id);
                $documentStatus->name = $request->name; // Update 'name'
                $documentStatus->type = $request->type; // Update 'type'

                $documentStatus->update();

                $message = "Document Status Updated Successfully";
                return response()->json(['status' => 200, 'message' => $message]);
            } catch (Exception $e) {
                $message = $e->getMessage();
                return response()->json([
                    'status' => 400,
                    'message' => $message,
                ]);
            }

        }


    //Delete function starts here
    public function deleteDocumentStatus(Request $request){
            try {
                $documentStatus = DocumentStatus::find($request->id);
                // Handle the deletion logic based on your migration
                $documentStatus->deleted_by = Auth::user()->id;
                $documentStatus->delete();

                $message = "Document Status Deleted Successfully";
                return response()->json(['status' => 200, 'message' => $message]);
            } catch (Exception $e) {
                $message = $e->getMessage();
                return response()->json([
                    'status' => 400,
                    'message' => $message,
                ]);
            }
    }
    //Delete function ends here
    }

