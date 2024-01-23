<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\PersonTag;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use App\Data;
use Gate;
// use Auth;
use App\Models\Designation;
use App\Models\Person;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use exception;

class PersonTagsController extends Controller
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
        if(!checkPersonPermission('view-person-tags-3-0'))
            return ErrorMessage(403);

        $data = PersonTag::getAll();

        $total_count = count($data);

       /*     if($request->ajax()){
            return  view('designation.ajax.designations_grid', compact('data'));
        } */

        return view('person_tags.index', compact('data','total_count'));
    }



    public function search ( Request $request ) {

        $data = PersonTag::filter_search();
        $total_count = count($data);

        $returnHTML = view('person_tags.ajax.person_tags_grid', compact('data','total_count'))->render();

        return response()->json([
            'status' => 200,
            'html' => $returnHTML
            ]);

    }


        //Public function to add form data starts here
     public function add(Request $request){

         if(!checkPersonPermission('add-person-tags-3-0'))
             return ErrorMessage(403);

            $v = Validator::make($request->all(), [
            'tag_name' => 'required',
            ],[
            'tag_name.required'=>'Please provide Tag name',
            ]); // Validation ends here

            if ($v->fails())
            { return response()->json([
            'status' => 400,
            'message' => $v->getMessageBag()->toArray()
            ]); }


            if (PersonTag::where('tag_name', '=', $request->tag_name)->exists()) {
                $errors = "Person Tag name Already exists";
                return response()->json([
                'status' => 409,
                'message' => $errors
                ]);
             }


            try{

            $obj = new PersonTag();
            $obj->tag_name = $request->tag_name;
            $obj->created_by = Auth::user()->id;
            $obj->save();

            $message = "Person Tag Added Successfully";
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
        public function get(Request $request){
        $id = $request->id;
        $data = PersonTag::where('id','=',$id)->first();
            echo json_encode($data);
              exit;
        }
        //Ends here

        //Update function starts here
        public function update(Request $request){

            if(!checkPersonPermission('update-person-tags-3-0'))
                return ErrorMessage(403);

            $v = Validator::make($request->all(), [
            'tag_name' => 'required',
            ],[
            'tag_name.required'=>'Please provide Tag name',
            ]); // Validation ends here

            if ($v->fails())
            {
            $errors = "Please provide the tag name";
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

            $obj = PersonTag::find($request->tags_id);
            $obj->tag_name = $request->tag_name;
            $obj->update();

            $message = "Person tag Updated Successfully";
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
            public function delete(Request $request){
                try{

                    if(!checkPersonPermission('delete-person-tags-3-0'))
                        return ErrorMessage(403);

                    $obj = PersonTag::find($request->id);
                    $obj->deleted_by = Auth::user()->id;

                    $obj->delete();

                    $message = "Personal Tag Deleted Successfully";
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
