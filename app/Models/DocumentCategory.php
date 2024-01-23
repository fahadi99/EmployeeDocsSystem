<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Auth;

class DocumentCategory extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'document_categories';

    protected $fillable = [
        'name'
    ];

    public static function filterSearch(){

        $request = request();

        $query = self::query();

        $order = (!empty($request->order)) ? $request->order : null;
        $name = (!empty($request->name)) ? $request->name : null;

        // Filter search starts here
        if ($name !== null) {
            $query->where('name', 'ILIKE', "%{$name}%");
        }

        // Sort order query starts here
        if ($order !== null) {
            if ($order === 'A - Z') {
                $query->orderBy('name');
            } elseif ($order === 'Z - A') {
                $query->orderBy('name', 'DESC');
            } elseif ($order === 'Recent added') {
                $query->latest('created_at');
            }
        }
        // Sort order query ends here

        $searchedData = $query->get();
        return $searchedData;
    }

    public static function getAllDocumentCategories(){

        $request = request();
        $query = self::query();
        $searchedData = $query->get();

        return $searchedData;
    }


    public static function getForSelect(){
       $data = self::orderBy('name','asc')->pluck('name','id');
        return $data;
    }

    public static function addNew($name, $rtn = 'object') {
        $obj = new DocumentCategory();
        $obj->name = $name;
        $obj->created_by = Auth::user()->id;
        $obj->save();
        return $rtn == 'object' ? $obj : $obj->{$rtn};
    }

    public static function getOrSaveId($name) {
        return is_numeric($name) == FALSE
            ? DocumentCategory::addNew($name, 'id')
            : $name;
    }

}



