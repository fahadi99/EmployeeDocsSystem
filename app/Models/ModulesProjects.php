<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ModulesProjects extends Model
{

    protected $fillable = [
        'project_id',
     'module_id',
     'updated_by',
      'created_by',
       'deleted_by'];
}
