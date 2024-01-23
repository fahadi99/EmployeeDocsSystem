<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Auth;

class Module extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'modules';

    protected $fillable = [
        'name'
    ];

    public static function getAllModules()
    {
        return self::select('name', 'id')->get()->all();
    }
}
