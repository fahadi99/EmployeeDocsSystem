<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use App\Data;
use App\Models\DocumentType;
use Gate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Exception;

class TypesController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }


    public function index(Request $request)
    {
        if(!checkPersonPermission('view-type-3-0'))
            return ErrorMessage(403);

        $data = DocumentType::all();

        $total_count = count($data);

        return view('document_types.index', compact('data','total_count'));
    }

    public function search( Request $request ) {
        $query = $request->input('name');
        $order = $request->input('order');
        $data = DocumentType::where('name', 'ilike', "%$query%");
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
        $returnHTML = view('document_types.include.types_grid', compact('data','total_count'))->render();
        return response()->json([
            'status' => 200,
            'html' => $returnHTML
            ]);
    }

    //Add function starts here
    public function add(Request $request)
    {
        if (!checkPersonPermission('add-type-3-0')) {
            return ErrorMessage(403);
        }

        $v = Validator::make($request->all(), [
            'type_name' => 'required',
            'type_icon' => 'image|mimes:png,jpg,jpeg',
        ], [
            'type_name.required' => 'Please provide Document Type Name',
            // 'voting_icon.required' => 'Please upload a valid image for the voting icon.',
        ]);

        if ($v->fails()) {
            return response()->json([
                'status' => 400,
                'message' => $v->getMessageBag()->toArray(),
            ]);
        }

        if (DocumentType::where('name', '=', $request->type_name)->exists()) {
            $errors = "Document type name already exists";
            return response()->json([
                'status' => 409,
                'message' => $errors,
            ]);
        }

        try {
            // Ensure 'images' directory exists
            $imagesDirectory = public_path('images');
            if (!file_exists($imagesDirectory)) {
                mkdir($imagesDirectory, 0777, true);
            }

            // Proceed with your existing code
            $type = new DocumentType();
            $type->name = $request->type_name;
            $type->created_by = Auth::user()->id;
            $type->save();

            // Handle image upload
            if ($request->hasFile('icon_path')) {
                $imageName = time().'.'.$request->icon_path->extension();
                $request->icon_path->move($imagesDirectory, $imageName);

                // Update the icon_path after saving the model
                $type->icon_path = $imageName;
                $type->save();
            }

            // Uncomment this line if you want to debug the request data
            // dd($request->all());

            $message = "Document Type Added Successfully";
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

    //Get deatment function starts here
    public function get_type(Request $request){
        $id = $request->id;
        $data = DocumentType::where('id','=',$id)->first();
            echo json_encode($data);
              exit;
    }
    //Get voting function ends here

    //Update function starts here
    public function update_type(Request $request){

        if(!checkPersonPermission('update-type-3-0'))
            return ErrorMessage(403);

        $v = Validator::make($request->all(), [
            'type_name' => 'required',
            'type_icon' => 'image|mimes:png,jpg,jpeg',
            ],[
            'type_name.required'=>'Please provide Document Type Name',
            ]); // Validation ends here

            if ($v->fails())
            { return response()->json([
            'status' => 400,
            'message' => $v->getMessageBag()->toArray()
            ]); }


            try{
            $type = DocumentType::find($request->type_id);
            $imagesDirectory = public_path('images');
            if (!file_exists($imagesDirectory)) {
                mkdir($imagesDirectory, 0777, true);
            }

            $type->name = $request->type_name;

            $type->update();

            // Handle image upload
            if ($request->hasFile('icon_path')) {
                $imageName = time().'.'.$request->icon_path->extension();
                $request->icon_path->move($imagesDirectory, $imageName);

                // Update the icon_path after saving the model
                $type->icon_path = $imageName;
                $type->update();
            }

            $message = "Document Type Updated Successfully";
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
    public function delete_type(Request $request){
        try{

            if(!checkPersonPermission('delete-type-3-0'))
                return ErrorMessage(403);

            $type = DocumentType::find($request->id);
            $type->deleted_by = Auth::user()->id;
            $type->delete();

            $message = "Document Type Deleted Successfully";
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
