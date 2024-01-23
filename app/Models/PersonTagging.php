<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;

class PersonTagging extends Model
{
    use SoftDeletes;

    protected $table = 'person_tagging';
    protected $fillable = ['person_id', 'tag_id'];


    public static function markDelete($personId, $flag = 1) {
        self::where('person_id', $personId)->update(['mark_delete' => $flag]);
    }

    public static function executeMarkDelete($personId) {
        self::where('person_id', $personId)->where('mark_delete', 1)->delete();

    }

    public static function addTag($tag, $person_id) {
        if(is_numeric($tag)) {
            $id = $tag;
        } else {
            $id = PersonTag::addNew($tag, 'id');
        }

        $personTagging = PersonTagging::firstOrNew(['person_id' =>  $person_id, 'tag_id' => $id ]);

        $personTagging->person_id = $person_id;
        $personTagging->tag_id = $id;
        $personTagging->mark_delete = false;
        $personTagging->created_by = auth()->user()->id;
        $personTagging->save();
    }

    public static function getInArray($personId) {
        return self::where('person_id', $personId)->pluck('tag_id');
    }
}
