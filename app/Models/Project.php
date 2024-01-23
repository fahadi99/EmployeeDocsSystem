<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Project extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'projects';

    public static function getForSelect()
    {
        $data = self::orderBy('name','asc')->pluck('name','id');
        return $data;
    }

}
