<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Auth;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class Right extends Model
{
    use SoftDeletes;

    public static function getByParentId($id) {
        $data =  self::where('right_types_id', $id)
            ->orderby('created_at', 'desc')
            ->where('status', 1);
        return $data->get();
    }

    public static function getBySlug($slug) {
        return self::where('status', 1)
            ->where('slug', $slug)
            ->first();
    }


    public function saveForm($request = false) {
        if($request == false)
            $request = request();

        if(isset($request->auto) && $request->auto == true)
            $slug = makeSlug($request->name . ' auto');
        else
            $slug = makeSlug($request->name);

        $this->name = $request->name;
        $this->right_types_id = $request->right_types_id;
        $this->slug = $slug;
        $this->status = 1;
        $this->created_by = isset($request->memberId) ? $request->memberId : \Illuminate\Support\Facades\Auth::user()->id;
        return $this->save();
    }

    public function changeParentForm() {
        $request = request();
        $newVal = $request->newVal;
        $slug = $request->slug;
        $type = $request->type;
        $type_id = $request->type_id;
        $member_id = $request->member_id;


        if($newVal === "true") {
            $right = PersonRight::firstOrNew(['slug'=>$slug, 'type' => $type,'type_id' => $type_id, 'person_id' => $member_id, 'is_current' => 1]);
            $right->start_date = Carbon::now()->toDateTimeString();
            $right->created_by = Auth::user()->id;
            $right->save();
        } else {
            $right = PersonRight::where('slug',$slug)
                ->where('type', $type)
                ->where('type_id', $type_id)
                ->where('person_id', $member_id)
                ->where('is_current', 1)
                ->first();
            if($right) {
                $right->is_current = 0;
                $right->end_date = Carbon::now()->toDateTimeString();
                $right->deleted_by = Auth::user()->id;
                $right->save();
                $right->delete();
            }

        }

        return true;

    }


}
