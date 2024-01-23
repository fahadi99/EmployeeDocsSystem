<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Auth;

class DocumentStatus extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'document_statuses';

    protected $fillable = [
        'name',
        'type',
        'is_default',
        'created_by',
        'deleted_by',
        'updated_by',
    ];





    // public static function filterSearch()
    // {
    //     $request = request();
    //     $query = self::query();

    //     // Add filtering logic here, similar to the Organization model.

    //     // Sort order logic can also be added, similar to the Organization model.

    //     $searchedData = $query->get();

    //     // Add any additional processing if needed.

    //     return $searchedData;
    // }

    public static function filter_search(){

        $request = request();

        $query = self::query();

        $name = $request->name;
        $type = $request->type;
        $is_default = $request->is_default;
        $created_by = $request->created_by;
        $updated_by = $request->updated_by;

        // Filter search starts here
        if ( $name !== null ) {
            $query->where('name', 'LIKE', "%{$name}%");
        }

        if ($type) {
            $query->where('type', $type);
        }

        if ($is_default) {
            $query->where('is_default', $is_default);
        }

        if ($created_by) {
            $query->where('created_by', $created_by);
        }

        if ($updated_by) {
            $query->where('updated_by', $updated_by);
        }

        // You can add more filters as needed.

        return $query->get();
    }


    public static function getAllDocumentStatuses()
    {
        $request = request();
        $query = self::query();

        // Add any additional logic you need.

        $searchedData = $query->get();

        // Add any additional processing if needed.

        return $searchedData;
    }

    public static function getForSelect()
    {
        $data = self::orderBy('name','asc')->pluck('name','id');
        return $data;
    }

    public static function getStatuses()
    {
        $data = self::select('name', 'id')->get()->all();
        return $data;
    }

    public static function addNew($name, $type, $isDefault, $rtn = 'object')
    {
        $obj = DocumentStatus::firstOrNew(['name' => $name]);
        $obj->name = $name;
        $obj->type = $type;
        $obj->is_default = $isDefault;
        $obj->deleted_at = null;
        $obj->created_by = Auth::user()->id;
        $obj->save();
        return $rtn == 'object' ? $obj : $obj->{$rtn};
    }

    public static function getOrSaveId($name, $type, $isDefault)
    {
        return is_numeric($name) == FALSE
            ? DocumentStatus::addNew($name, $type, $isDefault, 'id')
            : $name;
    }
}
