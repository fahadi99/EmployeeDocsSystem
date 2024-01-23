<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Http\Request;
use Illuminate\Notifications\Notifiable;
use Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class Person extends Authenticatable
{
   use  Notifiable, SoftDeletes;

    protected $table = 'persons';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'email','phone','person_type', 'first_name','last_name','status'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    public $rights = '';


    public static function getSinglePersonDataUP(){

        $id = Auth::user()->id;
        $data = self::where('id','=',$id)->first();
        return $data;
    }

    public static function getForSelect2($type = 'all') {
        $data = self::orderby('first_name', 'asc')
            ->where('status', 1)
            ->get();

        $memberArray = [];
        foreach($data as $member) {
            $memberArray[] = ['id' => $member->id, 'full_name' => $member->first_name . " " . $member->last_name];
        }
        return $memberArray;
    }


    public static function find_person($id){
        return self::find($id);
    }

    public static function findByEmail($email){
        return self::where('email', $email)->first();
    }



    public static function filter_search(){

        $request = request();

        $query = self::query();

        $order = (!empty($request->order)) ? $request->order :  null;

        $name = (!empty($request->name)) ? $request->name :  null;

        $organization = (!empty($request->organization)) ? $request->organization :  null;

        $department = (!empty($request->department)) ? $request->department :  null;

        $designation = (!empty($request->designation)) ? $request->designation :  null;

        $status = (!empty($request->status)) ? $request->status :  null;


        if ( $status !== null ) {

            if( $status === 'Active' ) {
                 $query->where('persons.status','=',1);
            }

            if( $status === 'Inactive' ) {
                $query->where('persons.status','=',0);
            }
        }


        if ( $organization !== null ) {

            $query->where('persons.organization_id','=',$organization);

        }

        if ( $department !== null ) {

            $query->where('persons.department_id','=',$department);

        }

        if ( $designation !== null ) {

            $query->where('persons.designation_id','=',$designation);

        }


        if ( $name !== null ) {

            $names = explode(" ", $name);

            $query->where(function($query) use ($names) {
                $query->whereIn('first_name', $names);
                $query->orWhere(function($query) use ($names) {
                    $query->whereIn('last_name', $names);
                });
            });

        }

          //Sort order query starts here
          if ($order !== null) {

            if( $order === 'A - Z' ) {

                $query->orderBy('persons.first_name');

            }elseif( $order === 'Z - A' ) {

                $query->orderBy('persons.first_name', 'DESC');

            }elseif( $order === 'Recent added' ) {

                $query->latest('persons.created_at');
            }

        }
        //Sort order query ends here


        $data = $query->leftjoin('designations as des','des.id','=','persons.designation_id')
        ->select('persons.id as member_id',
            'persons.first_name as first_name',
            'persons.last_name as last_name',
            'des.name as designation',
            'persons.person_type as is_admin',
            'persons.email as email',
            'persons.phone as phone',
            'persons.status as status',
            'persons.picture as picture'
        )
        ->get();

        return $data;

    }

    public static function getPersonsList() {

        $request = request();

        $query = self::query();

        $data = $query->leftjoin('designations as des','des.id','=','persons.designation_id')
        ->select('persons.id as member_id',
            'persons.first_name as first_name',
            'persons.last_name as last_name',
            'des.name as designation',
            'persons.person_type as is_admin',
            'persons.email as email',
            'persons.phone as phone',
            'persons.status as status',
            'persons.picture as picture'
        )
        ->get();

        return $data;
    }

    public static function getSinglePersonData($id){
        $data = self::leftjoin('designations as des','des.id','=','persons.designation_id')
        ->select('persons.id as member_id','persons.first_name as first_name','persons.last_name as last_name','des.name as designation',
        'persons.email as email','persons.phone as phone','persons.status as status','persons.picture as picture')
        ->where('persons.id','=',$id)
        ->first();

        return $data;
    }

    public static function getDetailsforEdit($id){
        $data = self::
            leftjoin('person_domains as pd', function($joint){
                $joint->on('persons.id', 'pd.person_id');
                $joint->where('is_current', 1);
        })
        ->select(
                'persons.id',
                'picture',
                'phone',
                'email',
                'first_name',
                'last_name',
                'pd.domain_id as domain_id',
                'organization_id',
                'department_id',
                'designation_id',
                'person_type as is_admin'
        )->where('persons.id','=',$id)->first();
        return $data;
    }




    public function IsGeneralMember(){
        $roles = array('1','2','3'); //Member //Admin //Super Sdmin
        $person_type = Auth::user()->person_type;

        if (in_array($person_type, $roles)){
            return true;
        }else{
            return false;
        }
    }

    public function hasRoleAdminOrSuperAdmin(){
        $roles = array('2','3'); //Admin //Root
        $person_type = Auth::user()->person_type;

        if (in_array($person_type, $roles)){
            return true;
        }else{
            return false;
        }
      }

     public function hasRoleMember($role){
        if(Auth::user()->person_type === $role){
            return true;
        }else{
            return false;  }
      }

      public function hasRoleSuperAdmin($role){
        if(Auth::user()->person_type === $role){
            return true;
        }else{
            return false;  }
      }

      public function hasRoleAdmin($role){
        if(Auth::user()->person_type === $role){
            return true;
        }else{
            return false;  }
      }

      public function generatePassword($password = false, $save = false) {
        if( $password === false )
        $rn_password = strtolower(random_str(10));
        $hashed_random_password = Hash::make($rn_password);
        $this->password =  $hashed_random_password;

        if($save)
            $this->save();
        return [$rn_password, $hashed_random_password];
      }


      public function registration($request = false) {
          if($request == false)
              $request = request();

          $this->phone = $request->member_phone;
          $this->email = $request->email;
          $this->first_name = $request->first_name;
          $this->last_name = $request->last_name;
          $this->updateProfilePic();

          $this->designation_id = Designation::getOrSaveId($request->designation);
          $this->department_id = Department::getOrSaveId($request->department);
          $this->organization_id = Organization::getOrSaveId($request->organization);

//          $this->status = 1;
//          $this->person_type = 3;

          $this->save();
          if($request->domain)
              Domain::linkToPerson($this->id, $request->domain);
      }


    public static function addPerson($data) {

        $request = request();
        $person = new Person();
        $person->phone = $data['phone'];
        $person->email = $data['email'];
        $person->first_name = $data['first_name'];
        $person->last_name = $data['last_name'];
        $person->picture = "";
        $person->person_type = 1;


        $person->designation_id = Designation::getOrSaveId($data['designation']);
        $person->department_id = Department::getOrSaveId($data['department']);
        $person->organization_id = Organization::getOrSaveId('FDHL');
        $person->password = $data['encrypted_password'];
        $person->temp_password = $data['password'];
        $person->initial = $data['initial'];

        $person->emp_no = $data['num'];
        $person->contract_type = $data['contract_type'];
        $person->gender = $data['gender'];
        $person->doa = $data['doa'];

        $person->save();
        Domain::linkToPerson($person->id, $data['domain']);
        return $person;

    }

      public function updateViaAdmin() {
          $request = request();
          $this->phone = $request->member_phone;
          $this->email = $request->email;
          $this->first_name = $request->first_name;
          $this->last_name = $request->last_name;
          $this->picture = $this->updateProfilePic();
          $this->person_type = $request->person_type;

          $tags = $request->person_tags;
          PersonTagging::markDelete($this->id);
          if(count($tags) > 0) {
              foreach($tags as $tag) {
                  PersonTagging::addTag($tag, $this->id);
              }
          }
          PersonTagging::executeMarkDelete($this->id);


          Domain::linkToPerson($this->id, $request->domain);
          $this->designation_id = Designation::getOrSaveId($request->designation);
          $this->department_id = Department::getOrSaveId($request->department);
          $this->organization_id = Organization::getOrSaveId($request->organization);
          $this->save();

      }


    public static function getProfileImageDir() {
        return "uploads/members/";
    }

    public function updateProfilePic( $picture = 'profile_avatar', $save = true) {

        $request = request();
        $dir = self::getProfileImageDir();
        $path = public_path(). '/' . $dir;
        File::isDirectory($path) or File::makeDirectory($path, 0755, true, true);

        if ($this->picture != '' && File::exists($dir . $this->picture)) {
            File::delete($dir . $this->picture);
        }

        if ($request->profile_avatar_remove == 1 && File::exists($dir . $this->picture)) {
            File::delete($dir . $this->picture);
            $this->picture = '';
        } else {
            if($request->hasFile($picture)) {
                $extension = $request->file($picture)->getClientOriginalExtension();
                $FileName =  strtolower(Str::slug($this->first_name . "_" . $this->last_name) . "_" . time().'_'.rand(1000,9999).'.'.$extension);
                $request->file($picture)->move(self::getProfileImageDir(), $FileName);
                $this->picture = $FileName;
            } else {
                $this->picture = '';
            }
        }

        if($save)
            $this->save();
    }

    public static function getPermissionString($memberId) {
        $rights = PersonRight::getRightsByMemberId($memberId, false, false);
        $rtnString = '';

        if($rights->count() > 0) {
            foreach($rights as $right)
                $rtnString .= '|' . $right->slug . '-' . $right->type . '-' . $right->type_id . "|";
        }

        return $rtnString;
    }


    public function updatePerPage($spp) {
        $spp = $spp > 60 ? 60 : $spp;
        $this->defaultpageListing = $spp;
        $this->save();
    }
    public function updatePerRow($spr) {
        $spr = $spr > 12 ? 12 : $spr;
        $this->defaultColsNum = $spr;
        $this->save();
    }



}
