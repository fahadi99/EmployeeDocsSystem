<?php

namespace App\Models;

use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DocumentPriority extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'document_priorities';

    protected $fillable = [
        'name'
    ];

    public static function getForSelect(){
        $data = self::orderBy('name','asc')->pluck('name','id');
        return $data;
    }

    public static function getPriorities()
    {
        $data = self::select('name', 'id')->get()->all();
        return $data;
    }

    public static function getOrSaveId($name) {
        return is_numeric($name) == FALSE
            ? DocumentPriority::addNew($name, 'id')
            : $name;
    }


    public static function addNew($name, $rtn = 'object') {
        $obj = DocumentPriority::firstOrNew(['name' =>  $name]);
        $obj->name = $name;
        $obj->deleted_at = null;
        $obj->created_by = Auth::user()->id;
        $obj->save();
        return $rtn == 'object' ? $obj : $obj->{$rtn} ;
    }



}
