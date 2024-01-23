<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use App\Data;
use Gate;
use App\Models\VotingType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Exception;

class VotingTypesController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }


    public function index(Request $request)
    {
        if(!checkPersonPermission('view-voting-3-0'))
            return ErrorMessage(403);

        $data = VotingType::all();

        $total_count = count($data);

        return view('voting.index', compact('data','total_count'));
    }

    public function search( Request $request ) {
        $query = $request->input('name');
        $order = $request->input('order');
        $data = VotingType::where('name', 'ilike', "%$query%");
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
        $returnHTML = view('voting.include.votings_grid', compact('data','total_count'))->render();
        return response()->json([
            'status' => 200,
            'html' => $returnHTML
            ]);
    }

    //Add function starts here
    public function add(Request $request)
    {
        if (!checkPersonPermission('add-voting-3-0')) {
            return ErrorMessage(403);
        }

        $v = Validator::make($request->all(), [
            'voting_name' => 'required',
            'voting_icon' => 'image|mimes:png,jpg,jpeg',
        ], [
            'voting_name.required' => 'Please provide voting name',
            // 'voting_icon.required' => 'Please upload a valid image for the voting icon.',
        ]);

        if ($v->fails()) {
            return response()->json([
                'status' => 400,
                'message' => $v->getMessageBag()->toArray(),
            ]);
        }

        if (VotingType::where('name', '=', $request->voting_name)->exists()) {
            $errors = "Voting name already exists";
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
            $voting = new VotingType();
            $voting->name = $request->voting_name;
            $voting->created_by = Auth::user()->id;
            $voting->save();

            // Handle image upload
            if ($request->hasFile('icon_path')) {
                $imageName = time().'.'.$request->icon_path->extension();
                $request->icon_path->move($imagesDirectory, $imageName);

                // Update the icon_path after saving the model
                $voting->icon_path = $imageName;
                $voting->save();
            }

            // Uncomment this line if you want to debug the request data
            // dd($request->all());

            $message = "Voting Added Successfully";
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
    public function get_voting(Request $request){
        $id = $request->id;
        $data = VotingType::where('id','=',$id)->first();
            echo json_encode($data);
              exit;
    }
    //Get voting function ends here

    //Update function starts here
    public function update_voting(Request $request){

        if(!checkPersonPermission('update-voting-3-0'))
            return ErrorMessage(403);

        $v = Validator::make($request->all(), [
            'voting_name' => 'required',
            'voting_icon' => 'image|mimes:png,jpg,jpeg',
            ],[
            'voting_name.required'=>'Please provide voting name',
            ]); // Validation ends here

            if ($v->fails())
            { return response()->json([
            'status' => 400,
            'message' => $v->getMessageBag()->toArray()
            ]); }


            try{
            $voting = VotingType::find($request->voting_id);
            $imagesDirectory = public_path('images');
            if (!file_exists($imagesDirectory)) {
                mkdir($imagesDirectory, 0777, true);
            }

            $voting->name = $request->voting_name;

            $voting->update();

            // Handle image upload
            if ($request->hasFile('icon_path')) {
                $imageName = time().'.'.$request->icon_path->extension();
                $request->icon_path->move($imagesDirectory, $imageName);

                // Update the icon_path after saving the model
                $voting->icon_path = $imageName;
                $voting->update();
            }

            $message = "voting updated successfully";
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
    public function delete_voting(Request $request){
        try{

            if(!checkPersonPermission('delete-voting-3-0'))
                return ErrorMessage(403);

            $voting = VotingType::find($request->id);
            $voting->deleted_by = Auth::user()->id;
            $voting->delete();

            $message = "Voting Deleted Successfully";
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
