<?php

namespace App\Models;

use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DocumentType extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'document_types';

    protected $fillable = [
        'name', 'icon_path'
    ];

    public static function getForSelect()
    {
        $data = self::orderBy('name','asc')->pluck('name','id');
        return $data;
    }

    // public static function filter_search(){

    //     $request = request();

    //     $query = self::query();

    //     $type = (!empty($request->type)) ? $request->type :  null;
    //     $order = (!empty($request->order)) ? $request->order :  null;


    //     $name = (!empty($request->name)) ? $request->name :  null;

    //     //Filter search starts here

    //     if ( $name !== null ) {

    //         $query->where('name', 'LIKE', "%{$name}%");

    //     }



    //     // if ( $type !== null ) {

    //     //     if( $type === 'Department' ) {

    //     //         $query->where('parent_id','=',0);

    //     //     }

    //     //     if( $type === 'Section' ) {

    //     //         $query->where('parent_id','!=',0);

    //     //     }

    //     // }



    //     //Filter search ends here

    //     //Sort order query starts here
    //     if ($order !== null) {

    //         if( $order === 'A - Z' ) {

    //             $query->orderBy('types.name');

    //         }elseif( $order === 'Z - A' ) {

    //             $query->orderBy('types.name', 'DESC');

    //         }elseif( $order === 'Recent added' ) {

    //             $query->latest('types.created_at');
    //         }

    //     }

    //     //Sort order query ends here

    //     $searched_data = $query->get();

    //     $data = [];

    //     // foreach($searched_data as $d) {

    //     //     $d->count =Person::leftjoin('types as typ', 'persons.document_id', '=', 'typ.id')
    //     //     ->where('typ.id',$d->id)
    //     //     ->count();

    //     //     $data[] = $d;
    //     // }

    //     return $data;

    // }

    // public static function getAlltypes(){

    //     $request = request();

    //     $query = self::query();

    //     $searched_data = $query->get();

    //     $data = [];

    //     // foreach($searched_data as $d) {

    //     //     $d->count =Person::leftjoin('types as typ', 'persons.document_id', '=', 'typ.id')
    //     //     ->where('typ.id',$d->id)
    //     //     ->count();

    //     //     $data[] = $d;
    //     // }

    //     return $data;

    // }

    // public static function getForSelect(){
    //     $data = self::pluck('name','id');
    //     return $data;
    // }

    public static function addNew($name, $rtn = 'object') {
         $obj = DocumentType::firstOrNew(['name' =>  $name]);
         $obj->name = $name;
         $obj->deleted_at = null;
         $obj->created_by = Auth::user()->id;
         $obj->save();
        return $rtn == 'object' ? $obj : $obj->{$rtn} ;
     }


     public static function getOrSaveId($name) {
        return is_numeric($name) == FALSE
            ? DocumentType::addNew($name, 'id')
            : $name;
    }


}
