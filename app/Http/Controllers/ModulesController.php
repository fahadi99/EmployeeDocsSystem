<?php

namespace App\Http\Controllers;

// use Auth;
use exception;
use Illuminate\Support\Facades\Auth;
use Gate;
use App\Data;
// use Exception;
use App\Models\Module;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;

class ModulesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        if(!checkPersonPermission('view-module-3-0'))
            return ErrorMessage(403);

        $data = Module::all();
        $total_count = count($data);

        return view('module.index', compact('data','total_count'));

    }

    public function search( Request $request ) {
        $query = $request->input('name');
        $order = $request->input('order');
        $data = Module ::where('name', 'ilike', "%$query%");
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

        $returnHTML = view('module.include.module_grid', compact('data','total_count'))->render();
        return response()->json([
            'status' => 200,
            'html' => $returnHTML
            ]);
    }

    //Add function starts here
    public function add(Request $request){
        if(!checkPersonPermission('add-module-3-0'))
            return ErrorMessage(403);
        $v = Validator::make($request->all(), [
            'module_name' => 'required',
            ],[
            'module_name.required'=>'Please provide Module Name',
            ]); // Validation ends here

            if ($v->fails())
            { return response()->json([
            'status' => 400,
            'message' => $v->getMessageBag()->toArray()
            ]); }

            if (Module::where('name', '=', $request->module_name)->exists()) {
            $errors = "Module name already exists";
            return response()->json([
            'status' => 409,
            'message' => $errors
            ]);
            }

            try{

            $module = new Module();
            $module->name = $request->module_name;
            $module->created_by = Auth::user()->id;
            $module->save();

            $message = "Module Added Successfully";
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

    //Get module function starts here
    public function get_module(Request $request){

        $id = $request->id;
        $data = Module::where('id','=',$id)->first();
            echo json_encode($data);
              exit;

            }
    //Get module function ends here

    //Update function starts here
    public function update_module(Request $request){

        if(!checkPersonPermission('update-module-3-0'))
            return ErrorMessage(403);
        $v = Validator::make($request->all(), [
            'module_name' => 'required',
            ],[
            'module_name.required'=>'Please provide Module Name',
            ]); // Validation ends here

            if ($v->fails())
            { return response()->json([
            'status' => 400,
            'message' => $v->getMessageBag()->toArray()
            ]); }

            try{
            $module = Module::find($request->module_id);
            $module->name = $request->module_name;
            $module->update();

            $message = "Module updated Successfully";
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
    public function delete_module(Request $request){
        if(!checkPersonPermission('delete-module-3-0'))
            return ErrorMessage(403);
        try{
            $module = Module::find($request->id);
            $module->deleted_by = Auth::user()->id;

            $module->delete();

            $message = "Module Deleted Successfully";
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
