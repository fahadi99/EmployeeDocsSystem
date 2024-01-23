<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ModuleProject extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'module_projects';

    protected $fillable = [
        'project_id','module_id','created_by'
    ];

    public static function getEDocsRelatedProjects () {

         $e_docs_module_id = config('settings.e_docs.module_id');
         $data = self::leftjoin('projects as p','p.id','module_projects.project_id')
                       ->where('module_id',$e_docs_module_id)
                       ->distinct('p.id')
                       ->pluck('p.name','p.id')
                       ->toArray();

         return $data;
    }
}
