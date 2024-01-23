<?php

namespace App\Models;

use Doctrine\DBAL\Schema\Schema;
use Illuminate\Database\Eloquent\Model;
use Auth;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class RightType extends Model
{
    use SoftDeletes;

    public static function getByParentID($id) {
        return self::where('status', 1)
            ->where('parent_id', $id)
            ->get();
    }

    public static function getByID($id) {
        return self::where('status', 1)
            ->where('id', $id)
            ->first();
    }


    public static function getParentList($id) {
        $data = [];
        do {
            $row = self::getByID($id);
            if($row) {
                $id = $row->parent_id;
                $data[] = $row;
            } else {
                break;
            }
        } while($row->parent_id > 0);
        return array_reverse($data);
    }

    public static function getBySlug($slug) {
        return self::where('status', 1)
            ->where('slug', $slug)
            ->first();
    }

    public static function getAllChildById($id) {
        return self::where('parent_id', $id)
            ->get();
    }


    public function saveForm($request = false) {

        $request = $request == false ? request() : $request;
        if(isset($request->auto) && $request->auto == true)
            $slug = makeSlug($request->name . ' auto');
        else
            $slug = makeSlug($request->name);

        $this->name = $request->name;
        $this->parent_id = $request->parent_id;
        $this->slug = $slug;
        $this->status = 1;
        $this->created_by = isset($request->memberId) ? $request->memberId : \Illuminate\Support\Facades\Auth::user()->id;
        return $this->save();
    }
}
