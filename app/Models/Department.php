<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;

class Department extends Model
{
    use SoftDeletes;

    protected $fillable = ['name', 'deleted'];

    public static function filter_search(){

        $request = request();

        $query = self::query();

        $order = (!empty($request->order)) ? $request->order :  null;

        $members = (!empty($request->members)) ? $request->members :  null;

        $type = (!empty($request->type)) ? $request->type :  null;

        $name = (!empty($request->name)) ? $request->name :  null;

        //Filter search starts here

        if ( $name !== null ) {

            $query->where('name', 'ILIKE', "%{$name}%");

        }

        if ( $type !== null ) {

            if( $type === 'Department' ) {

                $query->where('parent_id','=',0);

            }

            if( $type === 'Section' ) {

                $query->where('parent_id','!=',0);

            }

        }

        if ( $members !== null ) {


            if( $members === 'Has Users' ) {

                $query->whereIn('id', function ($query) {
                    $query->select('department_id')->from('persons');
                });
            }

            if( $members === 'No User' ) {

                $query->whereNotIn('id', function ($query) {
                    $query->select('department_id')->from('persons');
                });

            }

        }

        //Filter search ends here

        //Sort order query starts here
        if ($order !== null) {

            if( $order === 'A - Z' ) {

                $query->orderBy('departments.name');

            }elseif( $order === 'Z - A' ) {

                $query->orderBy('departments.name', 'DESC');

            }elseif( $order === 'Recent added' ) {

                $query->latest('departments.created_at');
            }

        }
        //Sort order query ends here

        $searched_data = $query->get();

        $data = [];

        foreach($searched_data as $d) {

            $d->count =Person::leftjoin('departments as dep', 'persons.department_id', '=', 'dep.id')
            ->where('dep.id',$d->id)
            ->count();

            $data[] = $d;
        }

        return $data;

    }

    public static function getAlldepartments(){

        $request = request();

        $query = self::query();

        $searched_data = $query->get();

        $data = [];

        foreach($searched_data as $d) {

            $d->count =Person::leftjoin('departments as dep', 'persons.department_id', '=', 'dep.id')
            ->where('dep.id',$d->id)
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
        $obj = Department::firstOrNew(['name' =>  $name]);
        $obj->name = $name;
        $obj->deleted_at = null;
        $obj->created_by = Auth::user()->id;
        $obj->save();
        return $rtn == 'object' ? $obj : $obj->{$rtn} ;
    }


    public static function getOrSaveId($name) {
        return is_numeric($name) == FALSE
            ? Department::addNew($name, 'id')
            : $name;
    }


}
