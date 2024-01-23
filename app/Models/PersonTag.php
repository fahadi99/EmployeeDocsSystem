<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;

class PersonTag extends Model
{
    use SoftDeletes;

    protected $fillable = ['tag_name'];

      public static function filter_search(){

        $request = request();

        $query = self::query();

       $order = (!empty($request->order)) ? $request->order :  null;

        $type = (!empty($request->type)) ? $request->type :  null;

        $name = (!empty($request->name)) ? $request->name :  null;

        //Filter search starts here

        if ( $name !== null ) {

            $query->where('tag_name', 'ILIKE', "%{$name}%");

        }


        //Filter search ends here

        //Sort order query starts here
        if ($order !== null) {

            if( $order === 'A - Z' ) {

                $query->orderBy('person_tags.tag_name');

            }elseif( $order === 'Z - A' ) {

                $query->orderBy('person_tags.tag_name', 'DESC');

            }elseif( $order === 'Recent added' ) {

                $query->latest('person_tags.created_at');
            }

        }
        //Sort order query ends here

        $searched_data = $query->get();

        $data = [];

        foreach($searched_data as $d) {

            $data[] = $d;
        }

        return $data;
      }

      public static function getAll(){

        $request = request();

        $query = self::query();

        $searched_data = $query->get();

        $data = [];

        foreach($searched_data as $d) {

            $data[] = $d;
        }

        return $data;

    }

    public static function getForSelect(){
        $data = self::where('status',1)->orderBy('tag_name','asc')->pluck('tag_name','id');
        return $data;
      }

    public static function addNew($name, $rtn = 'object') {
        $obj = PersonTag::firstOrNew(['tag_name' =>  $name]);
        $obj->tag_name = $name;
        $obj->deleted_at = null;
        $obj->created_by = Auth::user()->id;
        $obj->save();
        return $rtn == 'object' ? $obj : $obj->{$rtn} ;
    }

    public static function getOrSaveId($name) {
        return is_numeric($name) == FALSE
            ? PersonTag::addNew($name, 'id')
            : $name;
    }

}
