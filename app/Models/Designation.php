<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;

class Designation extends Model
{
    use SoftDeletes;

    protected $fillable = ['name'];

      public static function filter_search(){

        $request = request();

        $query = self::query();

       $order = (!empty($request->order)) ? $request->order :  null;

        $type = (!empty($request->type)) ? $request->type :  null;

        $name = (!empty($request->name)) ? $request->name :  null;

        //Filter search starts here

        if ( $name !== null ) {

            $query->where('name', 'ILIKE', "%{$name}%");

        }

        if ( $type !== null ) {


            if( $type === 'Has Users' ) {

                $query->whereIn('id', function ($query) {
                    $query->select('designation_id')->from('persons');
                });
            }

            if( $type === 'No User' ) {

                $query->whereNotIn('id', function ($query) {
                    $query->select('designation_id')->from('persons');
                });

            }

        }

        //Filter search ends here

        //Sort order query starts here
        if ($order !== null) {

            if( $order === 'A - Z' ) {

                $query->orderBy('designations.name');

            }elseif( $order === 'Z - A' ) {

                $query->orderBy('designations.name', 'DESC');

            }elseif( $order === 'Recent added' ) {

                $query->latest('designations.created_at');
            }

        }
        //Sort order query ends here

        $searched_data = $query->get();

        $data = [];

        foreach($searched_data as $d) {

            $d->count =Person::leftjoin('designations as des', 'persons.designation_id', '=', 'des.id')
            ->where('des.id',$d->id)
            ->count();

            $data[] = $d;
        }

        return $data;
      }

      public static function getAlldesignations(){

        $request = request();

        $query = self::query();

        $searched_data = $query->get();

        $data = [];

        foreach($searched_data as $d) {

            $d->count =Person::leftjoin('designations as des', 'persons.designation_id', '=', 'des.id')
            ->where('des.id',$d->id)
            ->count();

            $data[] = $d;
        }

        return $data;

    }

    public static function getForSelect(){
        $data = self::where('status',1)->orderBy('name','asc')->pluck('name','id');
        return $data;
      }

    public static function addNew($name, $rtn = 'object') {
        $obj = Designation::firstOrNew(['name' =>  $name]);
        $obj->name = $name;
        $obj->deleted_at = null;
        $obj->created_by = Auth::user()->id;
        $obj->save();
        return $rtn == 'object' ? $obj : $obj->{$rtn} ;
    }

    public static function getOrSaveId($name) {
        return is_numeric($name) == FALSE
            ? Designation::addNew($name, 'id')
            : $name;
    }

}
