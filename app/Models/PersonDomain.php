<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PersonDomain extends Model
{
    use SoftDeletes;

    public static function getCurrentByPersonId($personId) {
        return self::where('person_id', $personId)
            ->where('is_current', 1)
            ->first();
    }

    

}
