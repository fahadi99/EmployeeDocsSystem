<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Organization;
use App\Models\Person;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;
use App\Data;
use Auth;
use Gate;


class DocumentShareController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        if(!checkPersonPermission('view-organization-3-0'))
            return ErrorMessage(403);

        $data = Organization::getAllorganizations();

        $total_count = count($data);

      /*   if($request->ajax()){
            return  view('organization.include.organizations_grid', compact('data'));
        } */

        return view('organization.index', compact('data','total_count'));

    }


    public function search ( Request $request ) {

        $data = Organization::filter_search();
        $total_count = count($data);


        $returnHTML = view('organization.include.organizations_grid', compact('data','total_count'))->render();

        return response()->json([
            'status' => 200,
            'html' => $returnHTML
            ]);

    }




    //Add function starts here
    public function add(Request $request){
        if(!checkPersonPermission('add-organization-3-0'))
            return ErrorMessage(403);
        $v = Validator::make($request->all(), [
            'organization_name' => 'required',
            ],[
            'organization_name.required'=>'Please provide Organization name',
            ]); // Validation ends here

            if ($v->fails())
            { return response()->json([
            'status' => 400,
            'message' => $v->getMessageBag()->toArray()
            ]); }

            if (Organization::where('name', '=', $request->organization_name)->exists()) {
            $errors = "Organization name already exists";
            return response()->json([
            'status' => 409,
            'message' => $errors
            ]);
            }

            try{

            $organization = new Organization();
            $organization->name = $request->organization_name;
            $organization->created_by = Auth::user()->id;
            $organization->save();

            $message = "Organization Added Successfully";
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

    //Get organization function starts here
    public function get_organization(Request $request){

        $id = $request->id;
        $data = Organization::where('id','=',$id)->first();
            echo json_encode($data);
              exit;

            }
    //Get organization function ends here

    //Update function starts here
    public function update_organization(Request $request){

        if(!checkPersonPermission('update-organization-3-0'))
            return ErrorMessage(403);
        $v = Validator::make($request->all(), [
            'organization_name' => 'required',
            ],[
            'organization_name.required'=>'Please provide Organization Name',
            ]); // Validation ends here

            if ($v->fails())
            { return response()->json([
            'status' => 400,
            'message' => $v->getMessageBag()->toArray()
            ]); }

            try{
            $organization = Organization::find($request->organization_id);
            $organization->name = $request->organization_name;
            $organization->update();

            $message = "Organization Updated Successfully";
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
    public function delete_organization(Request $request){
        if(!checkPersonPermission('delete-organization-3-0'))
            return ErrorMessage(403);
        try{
            $organization = Organization::find($request->id);
            $organization->deleted_by = Auth::user()->id;

            $organization->delete();

            $message = "Orgaization Deleted Successfully";
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
