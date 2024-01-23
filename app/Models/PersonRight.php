<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PersonRight extends Model
{
    use SoftDeletes;
    protected $fillable = ['slug', 'type', 'type_id', 'person_id', 'is_current'];

    public static function getRightsByMemberId($memberId, $type = false, $typeId = false) {
        $data = self::where('is_current', 1)
            ->where('person_id', $memberId);
        if($type)
            $data = $data->where('type', $type);
        if($type)
            $data = $data->where('type_id', $typeId);

        return $data->get();
    }

    public static function getRightString($memberId) {
        $rights = self::getRightsByMemberId($memberId);
        $rtnString = '';
        if($rights->count() > 0) {
            foreach ($rights as $right) {
                $rtnString .= '|'. $right->slug . '-' . $right->type . '-' . $right->type_id . '|';
            }
        }
        return $rtnString;
    }
}
