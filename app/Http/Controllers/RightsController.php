<?php
namespace App\Http\Controllers;
use App\Models\Domain;
use App\Models\Person;
use App\Models\Project;
use App\Models\ProjectSpaces;
use App\Models\Right;
use App\Models\RightType;
use App\Models\Space;
use Illuminate\Support\Facades\Input;
use App\Data;
use Gate;
// use Auth;
use exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class RightsController extends Controller
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
    }

    public function add(Request $request){

        $v = Validator::make($request->all(), [
            'name' => 'required',
        ],[
            'name.required'=>'Please provide Name',
        ]); // Validation ends here

        if ($v->fails()) { return response()->json([
            'status' => 400,
            'message' => $v->getMessageBag()->toArray()
            ]);
        }

        try{

            $slug = makeSlug($request->name);
            $alreadyExists = Right::getBySlug($slug);
            if($alreadyExists) {
                return response()->json([
                    'status' => 400,
                    'message' => ['Name or Slug already exists']
                ]);
            }

            $right = new Right();
            $right->saveForm();
            $message = "Right Added Successfully";
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

    public function manageProjectRights(Request $request, $memberId, $parentSlug, $projectId) {
        $data = Person::getSinglePersonData($memberId);
        $data->personRights = Person::getPermissionString($memberId);

        if($parentSlug == 'projects-auto') {
            $type = 1;
            $typeId = $projectId;
            $project = Project::getProjectPermissions($memberId, $projectId);
            $projectSpaces = ProjectSpaces::getAllMemberProject($memberId, $projectId);
            $topParent = RightType::getBySlug($parentSlug);

            if ($topParent) {
                $topParent['rights'] = Right::getByParentId($topParent->id);
                $children = RightType::getAllChildById($topParent->id);
                $tmp = [];
                $i = 0;
                foreach ($children as $child) {
                    $tmp[$i] = $child;
                    $tmp[$i]['rights'] = Right::getByParentId($child->id);
                    if ($child->slug == 'spaces-auto') {
                        $tmp[$i]['child'] = ProjectSpaces::getAllMemberProject($memberId, $projectId);
                    }
                    $nestedChild = RightType::getAllChildById($child->id);
                    $tmp2 = [];
                    $j = 0;
                    foreach ($nestedChild as $nc) {
                        $tmp2[$j] = $nc;
                        $tmp2[$j]['rights'] = Right::getByParentId($nc->id);
                        $j++;
                    }
                    $tmp[$i]['subChild'] = $tmp2;
                    $i++;
                    $topParent['child'] = $tmp;
                }
            }
        }
        return view('admin.members.permissions', compact('data', 'topParent', 'project', 'type', 'typeId', 'projectSpaces'));
    }

    public function manageTypeRights(Request $request, $memberId, $parentSlug) {
        $data = Person::getSinglePersonData($memberId);
        $data->personRights = Person::getPermissionString($memberId);

        if($parentSlug == 'spaces-main') {
            $type = 4;
            $tabs = Space::get_file_spaces();
            $tabs[0] = 'All Spaces';
        }

        $topParent = RightType::getBySlug($parentSlug);

        if($topParent) {
            $topParent['rights'] = Right::getByParentId($topParent->id);
            $children = RightType::getAllChildById($topParent->id);
            $tmp = [];
            $i = 0;
            foreach ($children as $child) {
                $tmp[$i] = $child;
                $tmp[$i]['rights'] = Right::getByParentId($child->id);
                if ($child->slug == 'spaces-auto') {
                    $tmp[$i]['child'] = ProjectSpaces::getAllMemberProject($memberId, $projectId);
                }
                $nestedChild = RightType::getAllChildById($child->id);
                $tmp2 = [];
                $j = 0;
                foreach ($nestedChild as $nc) {
                    $tmp2[$j] = $nc;
                    $tmp2[$j]['rights'] = Right::getByParentId($nc->id);
                    $j++;
                }
                $tmp[$i]['subChild'] = $tmp2;
                $i++;
                $topParent['child'] = $tmp;
            }

            return view('admin.members.type_permissions', compact('data', 'topParent', 'tabs', 'type'));
        }
    }




    public function manageBasicRights(Request $request, $memberId, $parentSlug) {
        $data = Person::getSinglePersonData($memberId);
        $data->personRights = Person::getPermissionString($memberId);

        if(true) {
            $topParent = RightType::getBySlug($parentSlug);

            if ($topParent) {
                $topParent['rights'] = Right::getByParentId($topParent->id);
                $children = RightType::getAllChildById($topParent->id);
                $tmp = [];
                $i = 0;
                foreach ($children as $child) {
                    $tmp[$i] = $child;
                    $tmp[$i]['rights'] = Right::getByParentId($child->id);
                    $nestedChild = RightType::getAllChildById($child->id);
                    $tmp2 = [];
                    $j = 0;
                    foreach ($nestedChild as $nc) {
                        $tmp2[$j] = $nc;
                        $tmp2[$j]['rights'] = Right::getByParentId($nc->id);
                        $j++;
                    }
                    $tmp[$i]['subChild'] = $tmp2;
                    $i++;
                    $topParent['child'] = $tmp;
                }
                //d($topParent);
                return view('admin.members.basic_permissions', compact('data', 'topParent'));
            }
        }
    }


    public function parentUpdate (Request $request) {
        $right = new Right();
        $rtn = $right->changeParentForm();

        return response()->json([
            'status' => 200,
            'message' => "Permission Updated.",
        ]);


    }



}
