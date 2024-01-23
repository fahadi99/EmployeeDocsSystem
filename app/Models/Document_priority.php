<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Document_priority extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'id','name',
        'created_by','updated_by','deleted_by'
    ];
    protected $dates =['deleted_at'];
    protected $table = 'document_priorities';

    public static function getForSelect(){
        $data = self::orderBy('name','asc')->pluck('name','id');
        return $data;
    }


    public static function getOrSaveId($name) {
        return is_numeric($name) == FALSE
            ? Document_priority::addNew($name, 'id')
            : $name;
    }


    public static function addNew($name, $rtn = 'object') {
        $obj = Document_priority::firstOrNew(['name' =>  $name]);
        $obj->name = $name;
        $obj->deleted_at = null;
        $obj->created_by = Auth::user()->id;
        $obj->save();
        return $rtn == 'object' ? $obj : $obj->{$rtn} ;
    }



}
