<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use App\Data;
use Gate;
use exception;
use Illuminate\Support\Facades\Auth;
use App\Models\Department;
use Illuminate\Http\Request;

class DepartmentController extends Controller
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
        if(!checkPersonPermission('view-department-3-0'))
            return ErrorMessage(403);

        $data = Department::getAlldepartments();

        $total_count = count($data);
        //departments without parent

        $departments = Department::where('parent_id','=',0)->pluck('name','id');

        return view('department.index', compact('data','departments','total_count'));
    }


    public function search ( Request $request ) {

        $data = Department::filter_search();
        $total_count = count($data);


        $returnHTML = view('department.include.departments_grid', compact('data', 'total_count'))->render();

        return response()->json([
            'status' => 200,
            'html' => $returnHTML
            ]);
    }

    //Add function starts here
    public function add(Request $request){

        if(!checkPersonPermission('add-department-3-0'))
            return ErrorMessage(403);

        $v = Validator::make($request->all(), [
            'department_name' => 'required',
            ],[
            'department_name.required'=>'Please provide Department Name',
            ]); // Validation ends here

            if ($v->fails())
            { return response()->json([
            'status' => 400,
            'message' => $v->getMessageBag()->toArray()
            ]); }

            if (Department::where('name', '=', $request->department_name)->exists()) {
                $errors = "Department name already exists";
                return response()->json([
                'status' => 409,
                'message' => $errors
                ]);
             }

            try{

            $department = new Department();
            $department->name = $request->department_name;
            if($request->parent_id === null){
            $department->parent_id = 0;
            }else{
            $department->parent_id = 1;
            }
            $department->created_by = Auth::user()->id;
            $department->save();

            $message = "Department Added Successfully";
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
        $data = Department::where('id','=',$id)->first();
            echo json_encode($data);
              exit;
    }
    //Get department function ends here

    //Update function starts here
    public function update_department(Request $request){

        if(!checkPersonPermission('update-department-3-0'))
            return ErrorMessage(403);

        $v = Validator::make($request->all(), [
            'department_name' => 'required',
            ],[
            'department_name.required'=>'Please provide Department Name',
            ]); // Validation ends here

            if ($v->fails())
            { return response()->json([
            'status' => 400,
            'message' => $v->getMessageBag()->toArray()
            ]); }


            try{
            $department = Department::find($request->department_id);
            $department->name = $request->department_name;
            if($request->parent_id === null){
            $department->parent_id = 0;
            }else{
            $department->parent_id = 1;
            }
            $department->update();

            $message = "Department updated Successfully";
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

            if(!checkPersonPermission('delete-department-3-0'))
                return ErrorMessage(403);

            $department = Department::find($request->id);
            $department->deleted_by = Auth::user()->id;
            $department->delete();

            $message = "Department Deleted Successfully";
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
