<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Projects;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Services\Document\DocumentsService;
use SebastianBergmann\CodeCoverage\Report\Xml\Project;

class ProjectController extends Controller
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
        if(!checkPersonPermission('view-projects-3-0'))
            return ErrorMessage(403);

        $data = Projects::all();
        $selectBoxes = DocumentsService::getSelectBoxes();

        $total_count = count($data);
        return view('projects.index', compact('data','total_count','selectBoxes'));
    }


    //Search Code

    public function search( Request $request ) {

        $query = $request->input('name');
        $order = $request->input('order');
        $data = Projects ::where('name', 'ilike', "%$query%");

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
        $returnHTML = view('projects.include.projects_grid', compact('data','total_count'))->render();
        return response()->json([
            'status' => 200,
            'html' => $returnHTML
            ]);
    }

    //Add function starts here
    public function add(Request $request){

        if(!checkPersonPermission('add-projects-3-0'))
            return ErrorMessage(403);

        $v = Validator::make($request->all(), [
            'projects_name' => 'required',
            ],[
            'projects_name.required'=>'Please provide project name',
            ]); // Validation ends here

            if ($v->fails())
            { return response()->json([
            'status' => 400,
            'message' => $v->getMessageBag()->toArray()
            ]); }

            if (Projects::where('name', '=', $request->projects_name)->exists()) {
                $errors = "Project name already exists";
                return response()->json([
                'status' => 409,
                'message' => $errors
                ]);
             }

            try{

            $projects = new Projects();
            $projects->name = $request->projects_name;
            $projects->created_by = Auth::user()->id;
            $projects->save();

            $message = "Project Added Successfully";
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

    //Get projects function starts here
    public function get_projects(Request $request){
        $id = $request->id;
        $data = Projects::where('id','=',$id)->first();
            echo json_encode($data);
              exit;
    }
    //Get projects function ends here

    //Update function starts here
    public function update_projects(Request $request){

        if(!checkPersonPermission('update-projects-3-0'))
            return ErrorMessage(403);

        $v = Validator::make($request->all(), [
            'projects_name' => 'required',
            ],[
            'projects_name.required'=>'Please provide project name',
            ]); // Validation ends here

            if ($v->fails())
            { return response()->json([
            'status' => 400,
            'message' => $v->getMessageBag()->toArray()
            ]); }


            try{
            $projects = Projects::find($request->projects_id);
            $projects->name = $request->projects_name;
            $projects->update();

            $message = "Project Updated Successfully";
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
    public function delete_projects(Request $request){
        try{

            if(!checkPersonPermission('delete-projects-3-0'))
                return ErrorMessage(403);

            $projects = Projects::find($request->id);
            $projects->deleted_by = Auth::user()->id;
            $projects->delete();

            $message = "Project Deleted Successfully";
            return response()->json(['status' => 200,'message' => $message ]);

            }catch(Exception $e)  {
                $message =  $e->getMessage();
                return response()->json([
                    'status' => 400,
                    'message' => $message
                ]);
            }
    }
}
