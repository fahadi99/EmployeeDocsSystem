<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PersonGroupData extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'person_group_data';

    protected $fillable = [
        'group_id','person_id'
    ];
}
