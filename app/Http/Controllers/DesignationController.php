<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use App\Data;
use Gate;
// use Auth;
use exception;
use Illuminate\Support\Facades\Auth;
use App\Models\Designation;
use App\Models\Person;
use Illuminate\Http\Request;

class DesignationController extends Controller
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
        if(!checkPersonPermission('view-designation-3-0'))
            return ErrorMessage(403);

        $data = Designation::getAlldesignations();

        $total_count = count($data);

       /*     if($request->ajax()){
            return  view('designation.ajax.designations_grid', compact('data'));
        } */

        return view('designation.index', compact('data','total_count'));
    }



    public function search ( Request $request ) {

        $data = Designation::filter_search();
        $total_count = count($data);
        $returnHTML = view('designation.ajax.designations_grid', compact('data','total_count'))->render();

        return response()->json([
            'status' => 200,
            'html' => $returnHTML
            ]);

    }


        //Public function to add form data starts here
     public function add_designation(Request $request){

         if(!checkPersonPermission('add-designation-3-0'))
             return ErrorMessage(403);

            $v = Validator::make($request->all(), [
            'designation_name' => 'required',
            ],[
            'designation_name.required'=>'Please provide Designation Name',
            ]); // Validation ends here

            if ($v->fails())
            { return response()->json([
            'status' => 400,
            'message' => $v->getMessageBag()->toArray()
            ]); }


            if (Designation::where('name', '=', $request->designation_name)->exists()) {
                $errors = "Designation name already exists";
                return response()->json([
                'status' => 409,
                'message' => $errors
                ]);
             }


            try{

            $designation = new Designation();
            $designation->name = $request->designation_name;
            $designation->created_by = Auth::user()->id;
            $designation->save();

            $message = "Designation Added Successfully";
            return response()->json(['status' => 200,'message' => $message ]);

            }catch(Exception $e)  {
                $message =  $e->getMessage();
                return response()->json([
                    'status' => 400,
                    'message' => $message
                ]);
            }
        }
        //Public function to add form data ends here

        //Get the value of current designation
        //Starts here
        public function get_designation(Request $request){
        $id = $request->id;
        $data = Designation::where('id','=',$id)->first();
            echo json_encode($data);
              exit;
        }
        //Ends here

        //Update function starts here
        public function update_designation(Request $request){

            if(!checkPersonPermission('update-designation-3-0'))
                return ErrorMessage(403);

            $v = Validator::make($request->all(), [
            'designation_name' => 'required',
            ],[
            'designation_name.required'=>'Please provide Designation Name',
            ]); // Validation ends here

            if ($v->fails())
            {
            $errors = "Please provide the designation name";
            return response()->json([
            'status' => 400,
            'message' => $errors
            ]); }

          /*  if (Designation::where('name', '=', $request->designation_name)->where('deleted','=',0)->exists()) {
                $errors = "Designation name Already exists";
                return response()->json([
                'status' => 400,
                'message' => $errors
                ]);
             } */

            try{

            $designation = Designation::find($request->designation_id);
            $designation->name = $request->designation_name;
            $designation->update();

            $message = "Designation Updated Successfully";
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
            public function delete_designation(Request $request){
                try{

                    if(!checkPersonPermission('delete-designation-3-0'))
                        return ErrorMessage(403);

                    $designation = Designation::find($request->id);
                    $designation->deleted_by = Auth::user()->id;

                    $designation->delete();

                    $message = "Designation Deleted Successfully";
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
