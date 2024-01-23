<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;


class Votingtype extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'voting_types';

    protected $fillable = ['name', 'icon_path'];

    public static function getForSelect()
    {
        $data = self::orderBy('name','asc')->pluck('name','id');
        return $data;
    }


//     public static function filter_search(){

//         $request = request();

//         $query = self::query();



//         $name = (!empty($request->name)) ? $request->name :  null;

//         //Filter search starts here

//         if ( $name !== null ) {

//             $query->where('name', 'LIKE', "%{$name}%");

//         }



//         $searched_data = $query->get();

//         $data = [];



//         return $data;

//     }

//     public static function getAllvotings(){

//         $request = request();

//         $query = self::query();

//         $searched_data = $query->get();

//         $data = [];



//         return $data;

//     }

//     public static function getForSelect(){
//         $data = self::pluck('name','id');
//         return $data;
//     }

//     public static function addNew($name, $rtn = 'object') {
//         $obj = Votingtype::firstOrNew(['name' =>  $name]);
//         $obj->name = $name;

//         $obj->deleted_at = null;
//         $obj->created_by = Auth::user()->id;
//         $obj->save();
//         return $rtn == 'object' ? $obj : $obj->{$rtn} ;
//     }


//     public static function getOrSaveId($name) {
//         return is_numeric($name) == FALSE
//             ? Votingtype::addNew($name, 'id')
//             : $name;
//     }



//     // public function updateVotingPic($picture = "voting_icon", $save = true) {
//     //     $request = request();
//     //     $dir = self::getVotingImageDir();
//     //     $path = public_path() . '/' . $dir;

//     //     File::isDirectory($path) or File::makeDirectory($path, 0755, true, true);

//     //     if ($this->icon_path != '' && File::exists($dir . $this->icon_path)) {
//     //         File::delete($dir . $this->icon_path);
//     //     }

//     //     if ($request->voting_icon_remove && File::exists($dir . $this->icon_path)) {
//     //         File::delete($dir . $this->icon_path);
//     //         $this->icon_path = ''; // Update the icon_path attribute
//     //     } else {
//     //         if ($request->hasFile($picture)) {
//     //             $extension = $request->file($picture)->getClientOriginalExtension();
//     //             $fileName = strtolower(Str::slug($this->name) . "_" . time() . '_' . rand(1000, 9999) . '.' . $extension);

//     //             $request->file($picture)->move(self::getVotingImageDir(), $fileName);
//     //             $this->icon_path = $dir . $fileName; // Update the icon_path attribute with the full path
//     //         }
//     //     }

//     //     if ($save) {
//     //         $this->save();
//     //     }
//     // }

//     // public static function getVotingImageDir() {
//     //     return "uploads/voting/";
//     // }



}


