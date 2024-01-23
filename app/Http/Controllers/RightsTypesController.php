<?php
namespace App\Http\Controllers;
use App\Models\Domain;
use App\Models\Right;
use App\Models\RightType;
use Illuminate\Support\Facades\Input;
use App\Data;
use Gate;
// use Auth;
use exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class RightsTypesController extends Controller
{

    public function __construct()
    {

    }
    /**
     * Show the profile for a given user.
     *
     * @param  int  $id
     * @return \Illuminate\View\View
     */
    public function index(Request $request, $id = 0)
    {
        $data = RightType::getByParentID($id);
        $parentList = RightType::getParentList($id);
        $rights = Right::getByParentId($id);

        return view('rights.types.index', compact('data', 'id', 'parentList', 'rights'));
    }

    public function add(Request $request){

        $v = Validator::make($request->all(), [
            'name' => 'required',
        ],[
            'name.required'=>'Please provide Name',
        ]);

        if ($v->fails()) {
            return response()->json([
                'status' => 400,
                'message' => $v->getMessageBag()->toArray()
                ]);
        }

        try{
            $slug = makeSlug($request->name);
            $alreadyExists = RightType::getBySlug($slug);
            if($alreadyExists) {
                return response()->json([
                    'status' => 400,
                    'message' => ['Name or Slug already exists']
                ]);
            }

            $rightType = new RightType();
            $rightType->saveForm();
            $message = "Type Added Successfully";
            return response()->json(['status' => 200,'message' => $message ]);

        }catch(Exception $e)  {
            $message =  $e->getMessage();
            return response()->json([
                'status' => 400,
                'message' => $message
            ]);
        }
        //Try catch ends here
    }

            public function edit($id){
                try{

                $rightType = RightType::find($id);
                $returnHTML = view('rights.types.ajax.update_right_type', compact('rightType'))->render();

                return response()->json([
                    'status' => 200,
                    'html' => $returnHTML
                    ]);

                } catch(Exception $e)  {
                $message =  $e->getMessage();
                return response()->json([
                    'status' => 400,
                    'message' => $message
                ]);
            }
        }

        public function update(Request $request){

            $v = Validator::make($request->all(), [
                'name' => 'required',
            ],[
                'name.required'=>'Please provide Name',
            ]); // Validation ends here

            if ($v->fails())
            { return response()->json([
            'status' => 400,
            'message' => $v->getMessageBag()->toArray()
            ]); }

                //try catch starts here
                try{
                $right_type = RightType::find($request->right_type_id);
                $right_type->name = $request->name;
                $right_type->update();

                $message = "Right Type Updated Successfully";
                return response()->json(['status' => 200,'message' => $message ]);

                    }catch(Exception $e)  {
                    $message =  $e->getMessage();
                    return response()->json([
                        'status' => 400,
                        'message' => $message
                    ]);
                }
                //Try catch ends here
        }


}
