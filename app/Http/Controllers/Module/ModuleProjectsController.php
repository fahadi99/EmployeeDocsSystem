<?php

namespace App\Http\Controllers\Module;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\Module\ModuleProjectsService;

class ModuleProjectsController extends Controller
{
    public function addModuleProject (Request $request) {
          //dd($request->all());
          $obj = new ModuleProjectsService();
          return $obj->addForm();
    }
}
