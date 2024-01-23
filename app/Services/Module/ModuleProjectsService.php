<?php

namespace App\Services\Module;

use App\Models\ModuleProject;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;

/**
 * Class ModuleProjectsService.
 */
class ModuleProjectsService
{

    public function formValidation($requestAll, $skipped = true, $id = false)
    {
        if ($id === false) {
            $validationArray = [
                'project_id' => [
                    'required'
                ],
                'modules' => 'required',
            ];
        } elseif ($id !== false) {
            $validationArray = [
                'project_id' => [
                    'required'
                ],
                'modules' => 'required',
            ];
        }

        if ($skipped !== true) {
            if (is_array($skipped)) {
                foreach ($skipped as $temp) {
                    unset($validationArray[$temp]);
                }
            } else {
                unset($validationArray[$skipped]);
            }
        }

        $v = Validator::make($requestAll, $validationArray,
            [
                'project_id.required' => 'Please Provide project',
                'modules.required' => 'Please Provide modules',
            ]
        );

        if ($v->fails()) {
            return response()->json([
                'status' => 400,
                'message' => $v->getMessageBag()->toArray(),
            ]);
        } else {
            return true;
        }
    }

    public function addForm($request = false)
    {
        if ($request === false) {
            $request = request();
        }

        $valid = $this->formValidation($request->all(), 'status');

        if ($valid === true) {

            $modules = $request->modules;

            foreach ($modules as $module) {
                $matchThese = ['project_id'=>$request->project_id,'module_id'=>$module];
                ModuleProject::updateOrCreate($matchThese,['created_by'=>auth()->user()->id]);
            }

            return response()->json([
                'status' => 200,
                'message' => 'Module Project has been created successfully.',
            ]);
        } else {
            return $valid;
        }
    }
}
