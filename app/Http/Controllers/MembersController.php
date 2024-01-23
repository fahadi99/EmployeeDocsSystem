<?php

namespace App\Http\Controllers;

// use Auth;
use Gate;
use App\Models\Domain;
use App\Models\Person;
use App\Models\PersonTag;
use App\Models\Department;
use App\Mail\send_password;
use App\Models\Designation;
use App\Models\Organization;
use Illuminate\Http\Request;
use App\Imports\MemberImport;
use App\Models\PersonTagging;
use Illuminate\Validation\Rule;
use exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;

class MembersController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index ( Request $request )
    {
        $data = Person::getPersonsList();

        $selectBoxes = [
            'domains' => Domain::getForSelect(),
            'organizations' => Organization::getForSelect(),
            'departments' => Department::getForSelect(),
            'designations' => Designation::getForSelect(),
        ];

        $total_count = count($data);

        /*  if($request->ajax()){
            return  view('member.include.members_grid', compact('data'));
        } */

        return view('member.index', compact('data','selectBoxes','total_count'));
    }

    public function search ( Request $request ) {

        $data = Person::filter_search();
        $total_count = count($data);

        $returnHTML = view('member.include.members_grid', compact('data','total_count'))->render();

        return response()->json([
            'status' => 200,
            'html' => $returnHTML
            ]);
    }

    public function import (Request $request) {

        $v = Validator::make($request->all(), [
            'file' => 'required|mimes:xlsx, xls',
            ],[
            'file.required'=>'Please provide import file',
            'file.mimes'=>'Please provide import file in proper format',
            ]);

            if ($v->fails())
            {
            //$errors = "Please provide Name or Designation name Already exists";
            return response()->json([
                'status' => 400,
                'message' => $v->getMessageBag()->toArray()
            ]);
            }

            try{

                $array = (new MemberImport())->toArray($request->file);
                foreach($array[0] as $row) {

                    $empTemp = explode('-', $row[1]);
                    $employee['num'] = $empTemp[0];

                    if(isset($empTemp[1]))
                        $employee['contract_type'] = $empTemp[1] == 'P' ? 'Permanent' : 'Contract';
                    else
                        $employee['contract_type'] = 'Contract';

                    $employee['gender'] = $row[2] == 'Miss.' ? 'Female' : 'Male';
                    $name = explode(' ', $row[3], 2);
                    $employee['first_name'] = $name[0];
                    $employee['last_name'] = isset($name[1]) ? $name[1] : '';
                    $employee['designation'] = $row[4];
                    $employee['doa'] = get_excel_date_to_MYSQL($row[5]);
                    $employee['department'] = $row[6];
                    $employee['phone'] = str_replace('-', '', $row[7]);
                    $employee['email'] = $row[8];
                    $employee['password'] = random_str(8);
                    $employee['encrypted_password'] = bcrypt($employee['password']);
                    $employee['domain'] = 1;
                    $employee['initial'] = $row[2];

                    if($employee['num'] == '')
                        exit;
                    $data = Person::addPerson($employee);
                }

                $message = "File Imported Successfully";
                return response()->json(['status' => 200,'message' => $message ]);

            } catch(Exception $e)  {
                $message =  $e->getMessage();
                return response()->json([
                    'status' => 400,
                    'message' => $message
                ]);
            }
    }

    //Add function starts here
    public function add(Request $request){
        $v = Validator::make($request->all(), [
            'member_phone' => ['required', 'string','min:11','max:14', 'regex:/\+(9[976]\d|8[987530]\d|6[987]\d|5[90]\d|42\d|3[875]\d|
            2[98654321]\d|9[8543210]|8[6421]|6[6543210]|5[87654321]|
            4[987654310]|3[9643210]|3[70]|7|1)\d{1,14}$/'],
            'email' => 'required|email:rfc,dns|unique:persons',
            'first_name' => 'required',
            'last_name' => 'required',
            'designation' => 'required',
            //'profile_avatar' => 'required|image|mimes:jpeg,png,jpg|max:2048'
            ],[
            'member_phone.required'=>'Please provide user phone number',
            'email.required'=>'Please provide user Email Address',
            'first_name.required'=>'Please provide user First Name',
            'last_name.required'=>'Please provide user Last Name',
            'designation.required'=>'Please provide user Designation',
            //'profile_avatar.required'=>'Please provide Profile Avatar',
            ]); // Validation ends here

            if ($v->fails())
            {
            //$errors = "Please provide Name or Designation name Already exists";
            return response()->json([
            'status' => 400,
            'message' => $v->getMessageBag()->toArray()
            ]);
            }

            if (Person::where('email', '=', $request->email)->exists()) {
                $error = "Member against provided email already exists";
                return response()->json([
                    'status' => 409,
                    'message' => $error
                ]);
            }

            //try catch starts here
            try{

                $person = new Person();

                $rtnPassword = $person->generatePassword();
                $person->registration();

                $message = 'This is randomly generated password by system please change it as soon as possible';
                $data = array(
                    'name' => $person->first_name,
                    'email' => $person->email,
                    'password' =>  $rtnPassword[0],
                    'message' => $message
                 );

                // Sending an Email
                $mail = $person->email;

                Mail::to($mail)->send(new send_password($data));

                $message = "Member added Successfully";
                return response()->json(['status' => 200,'message' => $message ]);

                } catch(Exception $e)  {
                    $message =  $e->getMessage();
                    return response()->json([
                        'status' => 400,
                        'message' => $message
                    ]);
                }
                //Try catch ends here
    }

    public function change_layout(Request $request, $status) {
        $person = Person::find(auth()->user()->id);
        $person->defaultLayout = $status;
        $person->save();
        return redirect()->to(url()->previous());

    }

    public function change_member_detail(Request $request) {
        if ($request->isMethod('get')){

            $data = Person::getSinglePersonDataUP();
            return view('member.detail', compact('data'));

        }else{

            if($request->has('member_id')){
                $id = $request->member_id;
            }

            $v = Validator::make($request->all(), [
                'member_phone' => ['required', 'string','min:11','max:14', 'regex:/\+(9[976]\d|8[987530]\d|6[987]\d|5[90]\d|42\d|3[875]\d|
                2[98654321]\d|9[8543210]|8[6421]|6[6543210]|5[87654321]|
                4[987654310]|3[9643210]|3[70]|7|1)\d{1,14}$/'],
                'email' => [
                    'required',
                    'email:rfc,dns',
                    Rule::unique('persons')->ignore($id),
                ],
                'first_name' => 'required',
                'last_name' => 'required',
                ],[
                'member_phone.required'=>'Please provide user phone number',
                'email.required'=>'Please provide user Email Address',
                'first_name.required'=>'Please provide user First Name',
                'last_name.required'=>'Please provide user Last Name',
                ]); // Validation ends here

                if ($v->fails())
                {
                //$errors = "Please provide Name or Designation name Already exists";
                return response()->json([
                'status' => 400,
                'message' => $v->getMessageBag()->toArray()
                ]);
                }


                //Try catch starts here
                try{


                $person  = Person::find($id);
                if ($request->has('profile_avatar')) {
                    $person->updateProfilePic();
                }

                $person->phone = $request->member_phone;
                $person->email = $request->email;
                $person->first_name = $request->first_name;
                $person->last_name = $request->last_name;
                $person->update();

                $message = "Member profile updated successfully";
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


    public function change_member_password(Request $request) {
        if ($request->isMethod('get')){

            $data = Person::getSinglePersonDataUP();
            return view('member.change_password', compact('data'));

        }else{

            $v = Validator::make($request->all(), [
                //'current_password' => 'required',
                'new_password' => 'required|different:current_password|min:6',
                'verify_password' => 'required|same:new_password'
                ],[
                'current_password.required'=>'Please provide your current password',
                'new_password.required'=>'Please provide your new password',
                'verify_password.required'=>'Please Type verify password'
                ]);

                if ($v->fails())
                {  return response()->json(['status' => 400,  'message' => $v->getMessageBag()->toArray()  ]); }

                //Try catch starts here
                try{

                    $person = Auth::user();
                    if(!(Hash::check($request->get('current_password'),$person->password))){
                        $errors = "Your provided password doesn't match with your current password,Please try again";
                        return response()->json([
                        'status' => 409,
                        'message' => $errors
                        ]);
                     }

                    $person = Auth::user();
                    $person->password = bcrypt($request->get('new_password'));
                    $person->save();

                    $message = "Password Changed Successfully";
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

    public function change_member_settings(Request $request,$id = false) {
        if ($request->isMethod('get')){

            $data = Person::getSinglePersonData($id);
            return view('member.settings', compact('data'));

        }else{

        }
    }

    public function change_admin_settings(Request $request,$id = false){
        if ($request->isMethod('get')){

            $data = Person::getSinglePersonData($id);
            return view('admin.members.settings', compact('data'));

        }else{

        }
    }


    public function change_admin_detail(Request $request, $id = false){
        if ($request->isMethod('get')){
            $selectBoxes = [
                'domains' => Domain::getForSelect(),
                'organizations' => Organization::getForSelect(),
                'departments' => Department::getForSelect(),
                'designations' => Designation::getForSelect(),
                'person_tags' => PersonTag::getForSelect(),
            ];
            $PersonEdit = Person::getDetailsforEdit($id);
            $personTags = PersonTagging::getInArray($id);


            $data = Person::getSinglePersonData($id);
            return view('admin.members.detail', compact('data','PersonEdit','selectBoxes', 'personTags'));
        }else{

            $v = Validator::make($request->all(), [
                'member_phone' => ['required', 'string','min:11','max:14', 'regex:/\+(9[976]\d|8[987530]\d|6[987]\d|5[90]\d|42\d|3[875]\d|
                2[98654321]\d|9[8543210]|8[6421]|6[6543210]|5[87654321]|
                4[987654310]|3[9643210]|3[70]|7|1)\d{1,14}$/'],
                'email' => [
                    'required',
                    'email:rfc,dns',
                     Rule::unique('persons')->ignore($id),
                ],
                'first_name' => 'required',
                'last_name' => 'required',
                'designation' => 'required',
                'domain' => 'required',
                'department' => 'required',
                'organization' => 'required',
                'person_type' => 'required',
                ],[
                'member_phone.required'=>'Please provide user phone number',
                'email.required'=>'Please provide user Email Address',
                'first_name.required'=>'Please provide user First Name',
                'last_name.required'=>'Please provide user Last Name',
                'designation.required'=>'Please provide user designation',
                'domain.required'=>'Please provide user domain',
                'department.required'=>'Please provide user department',
                'organization.required'=>'Please provide user organization',
                'person_type.required'=>'Please provide user type',
                ]); // Validation ends here

                if ($v->fails())
                {
                //$errors = "Please provide Name or Designation name Already exists";
                return response()->json([
                'status' => 400,
                'message' => $v->getMessageBag()->toArray()
                ]);
                }

                 //Try catch starts here
                 try{

                    if($request->has('member_id')){
                        $id = $request->member_id;
                    }

                    $person  = Person::find_person($id);
                    $person->updateViaAdmin();

                    $message = "Member profile updated Successfully";
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

    public function change_admin_password(Request $request, $id = false){
        if ($request->isMethod('get')){
            $data = Person::getSinglePersonData($id);
            return view('admin.members.change_password', compact('data'));
        }else{

            $v = Validator::make($request->all(), [
                'new_password' => 'required|min:6',
                'verify_password' => 'required|same:new_password'
                ],[
                'new_password.required'=>'Please provide your new password',
                'verify_password.required'=>'Please Type verify password'
                ]);

                if ($v->fails())
                {  return response()->json(['status' => 400,  'message' => $v->getMessageBag()->toArray()  ]); }

                 //Try catch starts here
                 try{

                    $person = Person::find($request->member_id);
                    $person->password = bcrypt($request->get('new_password'));
                    $person->save();

                    $message = "Password Changed Successfully";
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

    //Function to delete starts here

    public function destroy( $id ){
        try{

            $person = Person::find($id);
            $person->deleted_by = Auth::user()->id;
            $person->delete();

            $message = "User Deleted Successfully";
            return response()->json(['status' => 200,'message' => $message ]);

        } catch(Exception $e)  {
            $message =  $e->getMessage();
            return response()->json([
                'status' => 400,
                'message' => $message
            ]);
        }
    }
    //Function to delete ends here

    public function change_status(Request $request){
        //Try catch starts here
        try{
         $person  = Person::find($request->member_id);
         $person->status = $request->status;
         $person->update();

         $message = "Status Updated Successfully";
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
