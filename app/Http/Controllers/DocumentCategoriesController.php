<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use App\Data;
use Gate;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\DocumentCategory;
use Exception;


class DocumentCategoriesController extends Controller
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
        if(!checkPersonPermission('view-categories-3-0'))
            return ErrorMessage(403);

        // $data = DocumentCategory::getAlldocumentcategories();

        $data = DocumentCategory::all();

        $total_count = count($data);
        // departments without parent

        // $categories = DocumentCategory::where('parent_id','=',0)->pluck('name','id');

        return view('document_categories.index', compact('data'/*,'departments',*/,'total_count'));
    }


    public function search( Request $request ) {
        $query = $request->input('name');
        $order = $request->input('order');
        $data = DocumentCategory::where('name', 'ilike', "%$query%");
        // Add order conditions based on the $order value
        if ($order !== null) {
            if ($order === 'A - Z') {
                $data->orderBy('name'); // Assuming 'name' is the column you want to order by.
            } elseif ($order === 'Z - A') {
                $data->orderBy('name', 'DESC');
            } elseif ($order === 'Recent added') {
                $data->latest(); // This assumes 'created_at' is the timestamp column.
            }
        }
        $data = $data->get();
        $total_count = count($data);
        $returnHTML = view('document_categories.include.categories_grid', compact('data','total_count'))->render();
        return response()->json([
            'status' => 200,
            'html' => $returnHTML
            ]);
    }
    //Add function starts here
    public function add(Request $request){

        if(!checkPersonPermission('add-categories-3-0'))
            return ErrorMessage(403);

        $v = Validator::make($request->all(), [
            'categories_name' => 'required',
            ],[
            'categories_name.required'=>'Please provide Categories Name',
            ]); // Validation ends here

            if ($v->fails())
            { return response()->json([
            'status' => 400,
            'message' => $v->getMessageBag()->toArray()
            ]); }

            if (DocumentCategory::where('name', '=', $request->categories_name)->exists()) {
                $errors = "Categories name already exists";
                return response()->json([
                'status' => 409,
                'message' => $errors
                ]);
             }

            try{

            $categories = new DocumentCategory();
            $categories->name = $request->categories_name;

            $categories->created_by = Auth::user()->id;
            $categories->save();

            $message = "Category Added Successfully";
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
    public function get_categories(Request $request){
        $id = $request->id;
        $data = DocumentCategory::where('id','=',$id)->first();
            echo json_encode($data);
              exit;
    }
    //Get department function ends here

    //Update function starts here
    public function update_categories(Request $request){

        if(!checkPersonPermission('update-categories-3-0'))
            return ErrorMessage(403);

        $v = Validator::make($request->all(), [
            'categories_name' => 'required',
            ],[
            'categories_name.required'=>'Please provide Categories Name',
            ]); // Validation ends here

            if ($v->fails())
            { return response()->json([
            'status' => 400,
            'message' => $v->getMessageBag()->toArray()
            ]); }


            try{
            $categories = DocumentCategory::find($request->categories_id);
            $categories->name = $request->categories_name;
            // if($request->parent_id === null){
            // $categories->parent_id = 0;
            // }else{
            // $categories->parent_id = 1;
            // }
            $categories->update();

            $message = "Categories updated Successfully";
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
    public function delete_categories(Request $request){
        try{

            if(!checkPersonPermission('delete-categories-3-0'))
                return ErrorMessage(403);

            $categories = DocumentCategory::find($request->id);
            $categories->deleted_by = Auth::user()->id;
            $categories->delete();

            $message = "Category Deleted Successfully";
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
