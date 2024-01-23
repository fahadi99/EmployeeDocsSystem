<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

use App\Models\DocumentCategory;
use App\Models\Person;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;
use App\Data;
use Auth;
use Gate;


class DocumentCategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        if(!checkPersonPermission('view-organization-3-0'))
            return ErrorMessage(403);

    //     $data = DocumentCategory::getAllorganizations();

    //     $total_count = count($data);

    //   /*   if($request->ajax()){
    //         return  view('organization.include.organizations_grid', compact('data'));
    //     } */

    //     return view('organization.index', compact('data','total_count'));
        $data = DocumentCategory::getAllDocumentCategories(); // Replace with your actual method to retrieve all DocumentCategories

        $total_count = count($data);

        return view('document-category.index', compact('data', 'total_count'));
    }


    public function search ( Request $request ) {

        $data = DocumentCategory::filter_search();
        $total_count = count($data);


        $returnHTML = view('document-category.include.document-category_grid', compact('data','total_count'))->render();

        return response()->json([
            'status' => 200,
            'html' => $returnHTML
            ]);

    }




    //Add function starts here
    // public function add(Request $request){
    //     if(!checkPersonPermission('add-organization-3-0'))
    //         return ErrorMessage(403);
    //     $v = Validator::make($request->all(), [
    //         'organization_name' => 'required',
    //         ],[
    //         'organization_name.required'=>'Please provide Organization name',
    //         ]); // Validation ends here

    //         if ($v->fails())
    //         { return response()->json([
    //         'status' => 400,
    //         'message' => $v->getMessageBag()->toArray()
    //         ]); }

    //         if (Organization::where('name', '=', $request->organization_name)->exists()) {
    //         $errors = "Organization name Already exists";
    //         return response()->json([
    //         'status' => 409,
    //         'message' => $errors
    //         ]);
    //         }

    //         try{

    //         $organization = new Organization();
    //         $organization->name = $request->organization_name;
    //         $organization->created_by = Auth::user()->id;
    //         $organization->save();

    //         $message = "Organization Added Successfully";
    //         return response()->json(['status' => 200,'message' => $message ]);

    //         }catch(Exception $e)  {
    //             $message =  $e->getMessage();
    //             return response()->json([
    //                 'status' => 400,
    //                 'message' => $message
    //             ]);
    //         }

    // }
    public function add(Request $request)
    {
        // dd($request->all());
        if (!checkPersonPermission('add-organization-3-0')) {
            return ErrorMessage(403);
        }

        $validator = Validator::make($request->all(), [
            'name' => 'required', // Use 'name' instead of 'organization_name'
        ], [
            'name.required' => 'Please provide a name for the document category', // Updated error message
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'message' => $validator->getMessageBag()->toArray(),
            ]);
        }

        if (DocumentCategory::where('name', $request->name)->exists()) {
            $errors = "Document category name already exists";
            return response()->json([
                'status' => 409,
                'message' => $errors,
            ]);
        }

        try {
            $documentCategory = new DocumentCategory();
            $documentCategory->name = $request->name; // Use 'name' instead of 'organization_name'
            $documentCategory->created_by = Auth::user()->id;
            $documentCategory->save();

            $message = "Document category added successfully";
            return response()->json(['status' => 200, 'message' => $message]);
        } catch (Exception $e) {
            $message = $e->getMessage();
            return response()->json([
                'status' => 400,
                'message' => $message,
            ]);
        }
    }

    //Add function ends here

    //Get organization function starts here
    public function get_organization(Request $request){

        $id = $request->id;
        $data = DocumentCategory::where('id','=',$id)->first();
            echo json_encode($data);
              exit;

            }
    //Get organization function ends here

    //Update function starts here
    // public function update_organization(Request $request){

    //     if(!checkPersonPermission('update-organization-3-0'))
    //         return ErrorMessage(403);
    //     $v = Validator::make($request->all(), [
    //         'organization_name' => 'required',
    //         ],[
    //         'organization_name.required'=>'Please provide Organization name',
    //         ]); // Validation ends here

    //         if ($v->fails())
    //         { return response()->json([
    //         'status' => 400,
    //         'message' => $v->getMessageBag()->toArray()
    //         ]); }

    //         try{
    //         $organization = Organization::find($request->organization_id);
    //         $organization->name = $request->organization_name;
    //         $organization->update();

    //         $message = "Organization updated Successfully";
    //         return response()->json(['status' => 200,'message' => $message ]);

    //         }catch(Exception $e)  {
    //             $message =  $e->getMessage();
    //             return response()->json([
    //                 'status' => 400,
    //                 'message' => $message
    //             ]);
    //         }
    // }

    public function updateDocumentCategory(Request $request)
    {
        dd($request->all());
        if (!checkPersonPermission('update-organization-3-0')) {
            return ErrorMessage(403);
        }

        $validator = Validator::make($request->all(), [
            'name' => 'required', // Use 'name' instead of 'organization_name'
        ], [
            'name.required' => 'Please provide a name for the Document category', // Updated error message
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'message' => $validator->getMessageBag()->toArray(),
            ]);
        }

        try {
            $documentCategory = DocumentCategory::find($request->document_category_id);
            $documentCategory->name = $request->name; // Use 'name' instead of 'organization_name'
            $documentCategory->update();

            $message = "Document category updated successfully";
            return response()->json(['status' => 200, 'message' => $message]);
        } catch (Exception $e) {
            $message = $e->getMessage();
            return response()->json([
                'status' => 400,
                'message' => $message,
            ]);
        }
    }

    //Update function ends here

    //Delete function starts here
    // public function delete_organization(Request $request){
    //     if(!checkPersonPermission('delete-organization-3-0'))
    //         return ErrorMessage(403);
    //     try{
    //         $organization = DocumentCategory::find($request->id);
    //         $organization->deleted_by = Auth::user()->id;

    //         $organization->delete();

    //         $message = "Orgaization Deleted Successfully";
    //         return response()->json(['status' => 200,'message' => $message ]);

    //         }catch(Exception $e)  {
    //             $message =  $e->getMessage();
    //             return response()->json([
    //                 'status' => 400,
    //                 'message' => $message
    //             ]);
    //         }
    // }
    public function deleteDocumentCategory(Request $request)
    {
        if (!checkPersonPermission('delete-organization-3-0')) {
            return ErrorMessage(403);
        }

        try {
            $documentCategory = DocumentCategory::find($request->id);
            $documentCategory->deleted_by = Auth::user()->id;
            $documentCategory->delete(); // Use 'delete' on the DocumentCategory model

            $message = "Document Category Deleted Successfully";
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
