<?php

namespace App\Services\Document;

use Carbon\Carbon;
use App\Models\Domain;
use App\Models\Module;
use App\Models\Person;
use App\Models\Document;
use App\Models\Projects;
use App\Models\Department;
use App\Models\VotingType;
use App\Models\Designation;
use App\Models\DocumentTag;
use Illuminate\Support\Str;
use App\Models\DocumentData;
use App\Models\DocumentType;
use App\Models\Organization;
use App\Models\PersonDomain;
use App\Models\DocumentShare;
use App\Models\ModuleProject;
use App\Models\DocumentStatus;
use Illuminate\Validation\Rule;
use App\Models\DocumentCategory;
use App\Models\DocumentPriority;
use App\Models\Views\DocumentView;
use App\Models\DocumentCategoryRelation;
use Illuminate\Support\Facades\Validator;
use App\Models\File as DocumentUploadFile;
use Illuminate\Database\Eloquent\SoftDeletes;

class DocumentsService
{
    public static function mainPageListingByPersonId($request = false, $personId = false ) {
        if($request === false) {
            $request = request();

            if($personId === false) {

                    $personId = auth()->user()->id;
                    $filters['project'] = [];  //done
                    $project_id = $request->has('project') ? $request->get('project') : false;
                    if($project_id !== false) {
                        $filters['project'] = explode(',' , $project_id);
                        $filters['project'] = array_filter($filters['project'], fn($value) => !is_null($value) && $value !== '');
                    }

                    $filters['category'] = [];
                    $category_id = $request->has('category') ? $request->get('category') : false;
                    if($category_id !== false) {
                        $filters['category'] = explode(',' , $category_id);
                        $filters['category'] = array_filter($filters['category'], fn($value) => !is_null($value) && $value !== '');
                    }

                    $filters['voting_type'] = [];
                    $voting_type_id = $request->has('voting_type') ? $request->get('voting_type') : false;
                    if($voting_type_id !== false) {
                        $filters['voting_type'] = explode(',' , $voting_type_id);
                        $filters['voting_type'] = array_filter($filters['voting_type'], fn($value) => !is_null($value) && $value !== '');
                    }

                    $filters['department'] = [];
                    $department = $request->has('department') ? $request->get('department') : false;
                    if($department !== false) {
                        $filters['department'] = explode(',' , $department);
                        $filters['department'] = array_filter($filters['department'], fn($value) => !is_null($value) && $value !== '');
                    }

                    $filters['domain'] = [];
                    $domain = $request->has('domain') ? $request->get('domain') : false;
                    if($domain !== false) {
                        $filters['domain'] = explode(',' , $domain);
                        $filters['domain'] = array_filter($filters['domain'], fn($value) => !is_null($value) && $value !== '');
                    }

                    $filters['organization'] = [];
                    $organization = $request->has('organization') ? $request->get('organization') : false;
                    if($organization !== false) {
                        $filters['organization'] = explode(',' , $organization);
                        $filters['organization'] = array_filter($filters['organization'], fn($value) => !is_null($value) && $value !== '');
                    }

                    $filters['owner'] = [];
                    $owner_id = $request->has('owner') ? $request->get('owner') : false;
                    if($owner_id !== false) {
                        $filters['owner'] = explode(',' , $owner_id);
                        $filters['owner'] = array_filter($filters['owner'], fn($value) => !is_null($value) && $value !== '');
                    }

                    $filters['tagged_peron'] = [];
                    $tagged_peron_id = $request->has('tagged_peron') ? $request->get('tagged_peron') : false;
                    if($tagged_peron_id !== false) {
                        $filters['tagged_peron'] = explode(',' , $tagged_peron_id);
                        $filters['tagged_peron'] = array_filter($filters['tagged_peron'], fn($value) => !is_null($value) && $value !== '');
                    }

                    $filters['priority'] = [];
                    $priority_id = $request->has('priority') ? $request->get('priority') : false;
                    if($priority_id !== false) {
                        $filters['priority'] = explode(',' , $priority_id);
                        $filters['priority'] = array_filter($filters['priority'], fn($value) => !is_null($value) && $value !== '');
                    }

                    $filters['status'] = [];
                    $status_id = $request->has('status') ? $request->get('status') : false;
                    if($status_id !== false) {
                        $filters['status'] = explode(',' , $status_id);
                        $filters['status'] = array_filter($filters['status'], fn($value) => !is_null($value) && $value !== '');
                    }

                    $filters['s'] = "";
                    $filters['dateRangeStringValue'] = $request->has('dateRangeStringValue') ? $request->get('dateRangeStringValue') : false;
                    $queryText = $filters['s'] = $request->has('s') ? $request->get('s') : '';

                    $filters['page'] = $request->has('page') ? $request->get('page') : 1;
                    $filters['per_page'] = $request->has('per_page') ? $request->get('per_page') : 10;

                    $filters['feature'] = $request->has('feature') ? true : false;
                    $filters['unread'] = $request->has('unread') ? true : false;
                    $filters['my_documents'] = $request->has('my_documents') ? $request->my_documents : 0;

                    $personDepartmentId = auth()->user()->department_id;
                    $personOrganizationId = auth()->user()->organization_id;
                    $personDomain = PersonDomain::getCurrentByPersonId($personId);
                    isset($personDomain)? $personDomainId =  $personDomain->id : 0;


                    $documents = DocumentView::leftjoin('document_tags as dt','dt.document_id','documents_view.id')
                    ->leftjoin('persons as person','person.id','dt.person_id')
                    ->leftjoin('documents as d','d.id','documents_view.id')
                    ->leftjoin('document_starreds as ds','ds.document_id','documents_view.id')
                    ->leftjoin('document_data as dd','dd.document_id','documents_view.id')
                    ->select([
                        'documents_view.*',
                        'ds.id as starred',
                        'd.created_by as created_by'
                        ])
                        ->distinct('documents_view.id')
                        ->whereNull('d.deleted_at')
                        ->orderby('id', 'desc');

                    if(count($filters['project']) > 0) {
                        $projects = $filters['project'];
                        $documents->join('document_projects as dp', function($joint) use($projects){
                            $joint->on('documents_view.id', 'dp.document_id');
                            $joint->whereIn('dp.project_id', $projects);
                        });
                    }

                    /*if($filters['my_documents'] == 0) {

                        $documents->where('documents_view.domain_id',$personDomainId)
                                  ->orWhere('documents_view.department_id',$personDepartmentId)
                                  ->orWhere('documents_view.organization_id',$personOrganizationId);

                    } */

                    if($filters['my_documents'] == 1) {
                        $documents->where('d.created_by', $personId);
                    }

                    if($filters['my_documents'] == 2) {
                        $documents->where('dt.person_id',$personId);
                    }

                    if($filters['my_documents'] == 3) {

                        $documents->where('documents_view.domain_id',$personDomainId)
                        ->orWhere('documents_view.department_id',$personDepartmentId)
                        ->orWhere('documents_view.organization_id',$personOrganizationId);

                    }

                    if(count($filters['category']) > 0) {
                        $categories = $filters['category'];
                        $documents->join('document_categories_relation as dcr', function($joint) use($categories){
                            $joint->on('documents_view.id', 'dcr.document_id');
                            $joint->whereIn('dcr.category_id', $categories);
                        });
                    }

                    if(count($filters['owner']) > 0) {
                        $owners = $filters['owner'];
                        $documents->whereIn('documents_view.owner_id',$owners);
                    }

                    if(count($filters['priority']) > 0) {
                        $priority = $filters['priority'];
                        $documents->whereIn('documents_view.document_priority_id',$priority);
                    }

                    if(count($filters['status']) > 0) {
                        $status = $filters['status'];
                        $documents->whereIn('documents_view.document_status_id',$status);
                    }

                    if(count($filters['tagged_peron']) > 0) {
                        $tags = $filters['tagged_peron'];
                        $documents->whereIn('dt.person_id',$tags);
                    }

                    if(count($filters['voting_type']) > 0) {
                        $voting_types = $filters['voting_type'];
                        $documents->join('document_votes as dv', function($joint) use($voting_types){
                            $joint->on('documents_view.id', 'dv.document_id');
                            $joint->whereIn('dv.vote_type_id', $voting_types);
                        });
                    }

                    //conditional checks
                    if($filters['my_documents'] == 0)
                    {
                        if(count($filters['department']) > 0) {
                            $department = $filters['department'];
                            $documents->whereIn('documents_view.department_id',$department);
                        }

                        if(count($filters['domain']) > 0) {
                            $domain = $filters['domain'];
                            $documents->whereIn('documents_view.domain_id',$domain);
                        }

                        if(count($filters['organization']) > 0) {
                            $organization = $filters['organization'];
                            $documents->whereIn('documents_view.organization_id',$organization);
                        }
                    }

                    if ($filters['dateRangeStringValue']) {
                        $dates = explode("-",$filters['dateRangeStringValue']);
                        $fromDate = Carbon::parse($dates[0]);
                        $toDate = Carbon::parse($dates[1]);
                        $documents->whereBetween('documents_view.dated', [$fromDate, $toDate]);
                    }

                    $queryResults = false;
                    if($filters['s'] != false) {

                      /*  $data = DocumentData::search($queryText)->get();
                        $queryResults = $data->pluck('document_id')->toArray(); */

                       $documents->where(function($where) use ($queryText) {
                            $where->where('documents_view.subject', 'ILIKE', "%{$queryText}%");
                            $where->orWhere('documents_view.description', 'ILIKE', "%{$queryText}%");
                        });
                    }

                    if($queryResults != false) {
                        $documents->whereIn('documents_view.id',$queryResults);
                    }

                    if($filters['feature']) {
                        $documents->whereNotNull('ds.id');
                    }

                    return ['documents' => $documents->paginate($filters['per_page']), 'filters' => $filters];
            }
        }
    }

    public function formValidation($requestAll, $skipped = true, $id = false)
    {
        if ($id === false) {

            $validationArray = [
                'subject' => 'required',
                'short_description' => 'required',
                'description' => 'required',
                'dated' => 'required',
                'organization_id' => 'required',
                'department_id' => 'required',
                'domain_id' => 'required',
                'project_id' => 'required',
                'document_type_id' => 'required',
                'document_priority_id' => 'required',
                'document_status_id' => 'required',
                //'is_restricted' => 'required',
            ];
        } elseif ($id !== false) {
            $validationArray = [
                'subject' => 'required',
                'short_description' => 'required',
                'description' => 'required',
                'dated' => 'required',
                'organization_id' => 'required',
                'department_id' => 'required',
                'domain_id' => 'required',
                'project_id' => 'required',
                'document_type_id' => 'required',
                'document_priority_id' => 'required',
                'document_status_id' => 'required',
                //'is_restricted' => 'required',
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
                'subject.required' => 'Please Provide subject',
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

    //First step

    public function formValidationAddBasicData($requestAll, $skipped = true, $id = false)
    {
        if ($id === false) {

            $validationArray = [
                'subject' => 'required',
                'dated' => 'required',
                'document_file' => ['required', 'file', 'mimes:jpg,jpeg,png,doc,docx,csv.xlsx,pdf,gif,ppt,bmp,tiff', 'max:20000'],
                'document_type_id' => 'required',
                'document_priority_id' => 'required',
                'document_status_id' => 'required',
                'categories' => 'required',
                //is_restricted' => 'required',
            ];
        } elseif ($id !== false) {
            $validationArray = [
                'subject' => 'required',
                'dated' => 'required',
                'document_type_id' => 'required',
                'document_priority_id' => 'required',
                'document_status_id' => 'required',
                'categories' => 'required',
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
                'subject.required' => 'Please Provide subject',
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


    public function addBasicData ($request = false) {

        if ($request === false) {
            $request = request();
        }

        $valid = $this->formValidationAddBasicData($request->all(), 'status');

        if ($valid === true) {

            $obj = new Document;
            $obj->subject = $request->subject;
            $obj->dated = Carbon::parse($request->dated);
            $obj->project_id = $request->project_id;
            $obj->owner_id = auth()->user()->id;
            $obj->document_status_id = DocumentStatus::getOrSaveId($request->document_status_id,'start',1);

            if ($request->has('is_restricted')) {
                if ($request->is_restricted == 'on') {
                    $obj->is_restricted = true;
                } else {
                    $obj->is_restricted = false;
                }
            } else {
                $obj->is_restricted = false;
            }

            $obj->priority_id = DocumentPriority::getOrSaveId($request->document_priority_id);
            $obj->document_type_id = DocumentType::getOrSaveId($request->document_type_id);
            $obj->created_by = auth()->user()->id;
            $obj->organization_id = null;
            $obj->domain_id = null;
            $obj->project_id = null;
            $obj->department_id = null;
            $obj->save();

            if($request->has('categories')) {
                $categories = $request->categories;
                foreach ($categories as $category) {
                    $document_category = new DocumentCategoryRelation;
                    $document_category->AddDocumentCategory($obj->id, $category);
                }
            }

            $document_id = $obj->id;
            if ($request->hasFile('document_file')) {
                $file = $request->document_file;
                DocumentUploadFile::uploadAllFiles( $file, $document_id );
            }

            return response()->json([
              'id' => $document_id,
              'status' => 200,
              'message' => 'Basic data has been added successfully.',
            ]);

        } else {
            return $valid;
        }

    }

    public function updateBasicData ($request = false) {
        if ($request === false) {
            $request = request();
        }

        $document_id = $request->document_id;
        $valid = $this->formValidationAddBasicData($request->all(), 'status',  $document_id);

        if ($valid === true) {

            $obj = Document::find($document_id);
            if ($obj) {

            $obj->subject = $request->subject;
            $obj->dated = Carbon::parse($request->dated);
            $obj->priority_id = DocumentPriority::getOrSaveId($request->document_priority_id);
            $obj->document_type_id = DocumentType::getOrSaveId($request->document_type_id);
            $obj->document_status_id = DocumentStatus::getOrSaveId($request->document_status_id,'start',1);

            DocumentCategoryRelation::where('document_id',$document_id)->delete();
            if($request->has('categories')) {
                $categories = $request->categories;
                foreach ($categories as $category) {
                    $document_category = new DocumentCategoryRelation;
                    $document_category->updateDocumentCategory($document_id, $category);
                }
            }

            if ($request->has('is_restricted')) {
                if ($request->is_restricted == 1) {
                    $obj->is_restricted = true;
                } else {
                    $obj->is_restricted = false;
                }
            } else {
                $obj->is_restricted = false;
            }

            $obj->update();
        }

        return response()->json([
            'status' => 200,
            'message' => 'Basic data has been updated successfully.',
        ]);

        } else {
            return $valid;
        }
    }

    public function formValidationAddDetails($requestAll, $skipped = true, $id = false) {
        if ($id === false) {

            $validationArray = [
                'details_document_id' => 'required',
                'short_description' => 'required|nullable',
                'description' => 'required|nullable',
                'organization_id' => 'required|nullable',
                'department_id' => 'required|nullable',
                'domain_id' => 'required|nullable',
                'project_id' => 'required|nullable',
            ];
        } elseif ($id !== false) {
            $validationArray = [
                'document_id' => 'required',
                'short_description' => 'required|nullable',
                'description' => 'required|nullable',
                'organization_id' => 'required|nullable',
                'department_id' => 'required|nullable',
                'domain_id' => 'required|nullable',
                'project_id' => 'required|nullable',
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
                'short_description.required' => 'Please Provide short description',
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

    //Second Step
    public function addDetails ($request = false) {

        if ($request === false) {
            $request = request();
        }

        $valid = $this->formValidationAddDetails($request->all(), 'status');

        if ($valid === true) {

            $document_id = $request->details_document_id;
            $obj = Document::find($document_id);

            if ($obj) {
                $obj->short_description = $request->short_description;
                $obj->description = $request->description;
                $obj->organization_id = Organization::getOrSaveId($request->organization_id);
                $obj->domain_id = $request->domain_id;
                $obj->project_id = $request->project_id;
                $obj->department_id = Department::getOrSaveId($request->department_id);
                $obj->update();
            }


            return response()->json([
            'status' => 200,
            'message' => 'Details have been added successfully.',
        ]);

        } else {
            return $valid;
        }
    }

    public function updateDetails ($request = false) {
        if ($request === false) {
            $request = request();
        }

        $document_id = $request->document_id;
        $valid = $this->formValidationAddDetails($request->all(), 'status',  $document_id);

        if ($valid === true) {

            $obj = Document::find($document_id);
            if ($obj) {
                $obj->short_description = $request->short_description;
                $obj->description = $request->description;
                $obj->organization_id = Organization::getOrSaveId($request->organization_id);
                $obj->domain_id = $request->domain_id;
                $obj->project_id = $request->project_id;
                $obj->department_id = Department::getOrSaveId($request->department_id);
                $obj->update();
            }

        return response()->json([
            'status' => 200,
            'message' => 'Details data has been updated successfully.',
        ]);

        } else {
            return $valid;
        }
    }


    public function formValidationAddAssignees($requestAll, $skipped = true, $id = false) {
        if ($id === false) {

            $validationArray = [
                'assignees_document_id' => 'required',
                'users' => 'required|nullable',
            ];
        } elseif ($id !== false) {
            $validationArray = [
                'assignees_document_id' => 'required',
                'users' => 'required|nullable',
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
                'assignees_document_id' => 'required',
                'users.required' => 'Please Provide Assignees',
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

    //Third step
    public function addAssignees ($request = false) {
        if ($request === false) {
            $request = request();
        }

        $valid = $this->formValidationAddAssignees($request->all(), 'status');

        if ($valid === true) {

            $document_id = $request->assignees_document_id;
            if ($request->has('users')) {
                $users = $request->users;
                foreach ($users as $user) {
                    $document_tag = new DocumentTag;
                    $document_tag->tagDocument($document_id, $user);
                }
            }

            return response()->json([
            'status' => 200,
            'message' => 'Assignees have been added successfully.',
        ]);

        } else {
            return $valid;
        }
    }


    public function updateAssignees ($request = false) {
        if ($request === false) {
            $request = request();
        }

        $document_id = $request->assignees_document_id;
        $valid = $this->formValidationAddAssignees($request->all(), 'status',  $document_id);

        DocumentTag::where('document_id',$document_id)->delete();
        if ($valid === true) {

            if ($request->has('users')) {
                $users = $request->users;
                foreach ($users as $user) {
                    $document_tag = new DocumentTag;
                    $document_tag->updateTag($document_id, $user);
                }
            }

        return response()->json([
            'status' => 200,
            'message' => 'Assignees data has been updated successfully.',
        ]);

        } else {
            return $valid;
        }
    }

    public function addForm($request = false)
    {
        if ($request === false) {
            $request = request();
        }

        $valid = $this->formValidation($request->all(), 'status');

        if ($valid === true) {

            $obj = new Document;
            $obj->subject = $request->subject;
            $obj->short_description = $request->short_description;
            $obj->description = $request->description;
            $obj->dated = Carbon::parse($request->dated);
            $obj->organization_id = Organization::getOrSaveId($request->organization_id);
            $obj->domain_id = $request->domain_id;
            $obj->project_id = $request->project_id;
            $obj->department_id = Department::getOrSaveId($request->department_id);
            $obj->owner_id = auth()->user()->id;
            $obj->document_status_id = DocumentStatus::getOrSaveId($request->document_status_id,'start',1);

            if ($request->has('is_restricted')) {
                $obj->is_restricted = $request->is_restricted;
            } else {
                $obj->is_restricted = 0;
            }

            $obj->priority_id = DocumentPriority::getOrSaveId($request->document_priority_id);
            $obj->document_type_id = DocumentType::getOrSaveId($request->document_type_id);
            $obj->created_by = auth()->user()->id;
            $obj->save();

            if ($request->has('users')) {
                $users = $request->users;
                foreach ($users as $user) {
                    $document_tag = new DocumentTag;
                    $document_tag->tagDocument($obj->id, $user);
                }
            }

            if($request->has('categories')) {
                $categories = $request->categories;
                foreach ($categories as $category) {
                    $document_category = new DocumentCategoryRelation;
                    $document_category->AddDocumentCategory($obj->id, $category);
                }
            }

            return response()->json([
                'status' => 200,
                'message' => 'Document has been created successfully.',
            ]);
        } else {
            return $valid;
        }
    }


    public function formValidationForUploadFile($requestAll, $skipped = true, $id = false)
    {
            $validationArray = [
                'id' => 'required',
                'files.*' => ['required', 'file', 'mimes:jpg,jpeg,png,doc,docx,csv.xlsx,pdf,gif,ppt,bmp,tiff', 'max:20000'],
            ];

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
                'id.required' => 'Please Provide Document',
                'files.*.required' => 'Please Provide files to upload them',
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

    public function formValidationShareDocument($requestAll, $skipped = true, $id = false)
    {
            $validationArray = [
                'document_id' => 'required',
                'permissions' => 'required',
                'duration_type' => 'required',
            ];

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
                'document_id.required' => 'Please Provide Document',
                'permissions.required' => 'Please Provide Document Permissions',
                'duration_type.required' => 'Please Provide Document Duration type',
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


    public function shareDocument ($request = false) {
        if ($request === false) {
            $request = request();
        }

        $valid = $this->formValidationShareDocument($request->all(), 'status');

        if ($valid === true) {

            $url_hash = random_str(12);
            $now = Carbon::now();
            $url_hash = genSSH512($now);
            $shared_till = Carbon::parse($now);

            switch ($request->duration_type) {
                case 'hour':
                    $shared_till->addHours(1);
                    break;

                case 'day':
                    $shared_till->addDays(1);
                    break;

                case 'month':
                    $shared_till->addMonths(6);
                    break;
            }

            $permissions = $request->permissions;
            $permission_string='';
            foreach ($permissions as $x => $per) {
                $permission_string .=  $per.'_';
            }

            $document_share = new DocumentShare;
            $document_share->document_id = $request->document_id;
            $document_share->url_hash = $url_hash;
            $document_share->shared_till = $shared_till;
            $document_share->duration_type = $request->duration_type;
            $document_share->duration_value = 1;
            $document_share->permission_string = $permission_string;
            $document_share->created_by = auth()->user()->id;
            $document_share->save();
            $shared_document_url = route('documents.shared_document_link', ['slug' => $document_share->url_hash]);

            $message = 'Document shared created successfully.';

            return response()->json([
                'status' => 200,
                'url' => $shared_document_url,
                'message' => $message,
            ]);


        } else {
        return $valid;
        }

    }


    public function uploadFiles ($request = false) {

        if ($request === false) {
            $request = request();
        }

        $document_id = $request->id;
        if ($request->hasFile('file')) {
            $file = $request->file;
            DocumentUploadFile::uploadAllFiles( $file, $document_id );
        }
    }


    public static function getSelectBoxes () {

        $selectBoxes = [
            'projects' => ModuleProject::getEDocsRelatedProjects(),
            'all_projects' => Projects::getForSelect(),
            'modules' => Module::getAllModules(),
            'categories' => DocumentCategory::getForSelect(),
            'voting_types' => VotingType::getForSelect(),
            'persons' => Person::getForSelect2(),
            'domains' => Domain::getForSelect(),
            'organizations' => Organization::getForSelect(),
            'departments' => Department::getForSelect(),
            'designations' => Designation::getForSelect(),
            'document_types' => DocumentType::getForSelect(),
            'document_priorities' => DocumentPriority::getForSelect(),
            'document_statuses' => DocumentStatus::getForSelect(),
            'priorities' => DocumentPriority::getPriorities(),
            'statuses' => DocumentStatus::getStatuses(),
        ];


        //getPriorities

        return $selectBoxes;

    }

}
