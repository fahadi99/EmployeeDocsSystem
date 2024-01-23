<?php

use App\Models\Person;
use App\Models\PersonRight;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\TypesController;
use App\Http\Controllers\SpacesController;
use App\Http\Controllers\DomainsController;
use App\Http\Controllers\MembersController;
use App\Http\Controllers\ModulesController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\ProjectsController;
use App\Http\Controllers\FileTypesController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\FileFieldsController;
use App\Http\Controllers\FolderFileController;
use App\Http\Controllers\PersonTagsController;
use App\Http\Controllers\DesignationController;
use App\Http\Controllers\VotingTypesController;
use App\Http\Controllers\GeneralPagesController;
use App\Http\Controllers\OrganizationController;
use App\Http\Controllers\ProjectTypesController;
use App\Http\Controllers\ProjectSpacesController;
use App\Http\Controllers\DocumentStatusController;
use App\Http\Controllers\DocumentPriorityController;
use App\Http\Controllers\DocumentCategoriesController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Documents\DocumentsController;
use App\Http\Controllers\Module\ModuleProjectsController;
use App\Http\Controllers\Documents\DocumentsSharedController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('/test',function () {

});

Route::get('excel-test', function () {
//    $data = Excel::import(new \App\Imports\MemberImport(), '');
//    d($data);

    $array = (new \App\Imports\MemberImport())->toArray('assets/f11-1.xlsx');


    foreach($array[0] as $row) {

        $empTemp = explode('-', $row[1]);



        $employee['num'] = $empTemp[0];

        if(isset($empTemp[1]))
            $employee['contract_type'] = $empTemp[1] == 'P' ? 'Permanent' : 'Contract';
        else
            $employee['contract_type'] = 'Contract';

        $employee['gender'] = $row[2] == 'Miss.' ? 'Female' : 'Male';
        $name = explode(' ', $row[3], 2);
        $employee['first_name'] = $name[0];
        $employee['last_name'] = isset($name[1]) ? $name[1] : '';
        $employee['designation'] = $row[4];
        $employee['doa'] = get_excel_date_to_MYSQL($row[5]);
        $employee['department'] = $row[6];
        $employee['phone'] = str_replace('-', '', $row[7]);
        $employee['email'] = $row[8];
        $employee['password'] = random_str(8);
        $employee['encrypted_password'] = bcrypt($employee['password']);
        $employee['domain'] = 1;
        $employee['initial'] = $row[2];

        if($employee['num'] == '')
            exit;
        $data = Person::addPerson($employee);

    }

});


Auth::routes();
Route::get('temp/session', function (\Illuminate\Http\Request $request){
    d(session()->all());
});

Route::get('d', function (\Illuminate\Http\Request $request){
$max_upload   = (ini_get('upload_max_filesize'));
$max_post     = (ini_get('post_max_size'));
$memory_limit = (int) (ini_get('memory_limit'));

echo ('$max_upload ' . $max_upload);
echo ('$max_post ' . $max_post);
echo ('$memory_limit ' . $memory_limit);

});

Route::get('read_csv/{id}/{start}/{end}', [SpacesController::class, 'read_csv']);
//Route::get('file/switch/location', [FolderFileController::class, 'switch_file_location'])->name('switch_file_location');
Route::get('update-search-data', [FolderFileController::class, 'update_search_data'])->name('update_all_search_data');
//Route::post('upload', [FolderFileController::class, 'upload_file'])->name('project.spaces.view.file.update');

//Password reset routs
Route::post('password/email', [ForgotPasswordController::class, 'forgot'])->name('forgot.password');
Route::post('password/reset', [ForgotPasswordController::class, 'reset'])->name('password.update');

// Public pages
Route::post('/terms-of-service', [App\Http\Controllers\GeneralPagesController::class, 'TermsOfService'])->name('terms.of.service');
Route::post('/privacy-policy', [App\Http\Controllers\GeneralPagesController::class, 'PrivacyPolicy'])->name('privacy.policy');
Route::get('/403', [HomeController::class, 'permissionDenied'])->name('permission.denied');
Route::get('/logout', [LoginController::class, 'logout'])->name('person.logout');

// Members Routes
Route::middleware([\App\Http\Middleware\CheckUserLoggin::class])->group(function () {

    Route::get('/', [HomeController::class, 'index'])->name('home');
    Route::get('/home', [HomeController::class, 'index'])->name('home2');
    Route::get('set/layout/{status}', [MembersController::class, 'change_layout'])->name('member.layout.set');


    //Member profile basic operations routes
    Route::prefix('members')->group(function () {

        Route::match(['get', 'post'], 'settings', [MembersController::class, 'change_member_settings'])->name('change_member.settings');
        Route::match(['get', 'post'], 'profile', [MembersController::class, 'change_member_detail'])->name('change_member.detail');
        Route::match(['get', 'post'], 'change-password', [MembersController::class, 'change_member_password'])->name('change_member.password');

        Route::get('/', [MembersController::class, 'index'])->name('member.index');
        Route::post('/add', [MembersController::class, 'add'])->name('member.add');
        Route::post('/import', [MembersController::class, 'import'])->name('member.import');


        Route::delete('/delete/{id}', [MembersController::class, 'destroy'])->name('member.delete');
        Route::post('/change-status', [MembersController::class, 'change_status'])->name('change_member.status');

        //Filter search starts here
        Route::get('/search', [MembersController::class, 'search'])->name('members.search');

    });
    Route::get('move/projects', [ProjectsController::class, 'index_move'])->name('project.index.move');
    Route::middleware([\App\Http\Middleware\CheckProjectPermission::class])->group(function () {
        Route::get('projects/{project_id}/spaces', [ProjectsController::class, 'spaces'])->name('project.spaces');
        Route::get('move/projects/{project_id}/spaces', [ProjectsController::class, 'spaces_move'])->name('project.spaces.move');

        Route::middleware([\App\Http\Middleware\CheckSpacePermission::class])->group(function () {


            Route::get('projects/{project_id}/spaces/{space_id}', [SpacesController::class, 'initial'])->name('project.spaces.initial');
            Route::get('move/projects/{project_id}/spaces/{space_id}', [SpacesController::class, 'initial_move'])->name('project.spaces.initial.move');

            Route::get('projects/{project_id}/spaces/{space_id}/{folder_id}', [SpacesController::class, 'detail'])->name('project.spaces.details');

            Route::post('projects/{project_id}/spaces/{space_id}/{folder_id}/empty', [SpacesController::class, 'empty_folder'])->name('project.spaces.empty.folder');


            Route::post('projects/{project_id}/spaces/{space_id}/{folder_id}/bulkupdate/filetypes', [SpacesController::class, 'bulk_update_file'])->name('project.spaces.details.bulkupdate');
            Route::post('projects/{project_id}/spaces/{space_id}/{folder_id}/singleupdate/filetypes', [SpacesController::class, 'single_update_file'])->name('project.spaces.details.singleupdate');


            Route::get('projects/{project_id}/spaces/{space_id}/{folder_id}/action/{type}', [SpacesController::class, 'link_action'])->name('project.spaces.archive');


            Route::get('move/projects/{project_id}/spaces/{space_id}/{folder_id}', [SpacesController::class, 'detail_move'])->name('project.spaces.details.move');

            Route::get('projects/{project_id}/spaces/{space_id}/{folder_id}/folders', [SpacesController::class, 'get_folders'])->name('project.spaces.get.folder');
            Route::get('projects/{project_id}/spaces/{space_id}/{folder_id}/files', [SpacesController::class, 'get_files'])->name('project.spaces.get.file');
            Route::post('projects/{project_id}/spaces/{space_id}/{folder_id}/folder', [SpacesController::class, 'add_folder'])->name('project.spaces.add.folder');
            Route::post('projects/{project_id}/spaces/{space_id}/{folder_id}/file', [FolderFileController::class, 'add_file'])->name('project.spaces.add.file');
            Route::post('projects/{project_id}/spaces/{space_id}/{folder_id}/files', [FolderFileController::class, 'add_files'])->name('project.spaces.add.files');

            Route::get('projects/{project_id}/spaces/{space_id}/{folder_id}/file/{file_id}', [FolderFileController::class, 'view_file'])->name('project.spaces.view.file');
            Route::get('projects/{project_id}/spaces/{space_id}/{folder_id}/bulk/file', [FolderFileController::class, 'detail_bulk'])->name('project.spaces.details.bulk');

            Route::patch('projects/{project_id}/spaces/{space_id}/{folder_id}/file/{file_id}/bulk', [FolderFileController::class, 'detail_bulk'])->name('project.spaces.details.bulk.update');

            Route::get('projects/{project_id}/spaces/{space_id}/{folder_id}/file/{file_id}/form', [FolderFileController::class, 'view_file_form'])->name('project.spaces.view.file_form');

            Route::get('projects/{project_id}/spaces/{space_id}/{folder_id}/file/{file_id}/move', [FolderFileController::class, 'move_file_start'])->name('project.spaces.move.file_start');
            Route::post('projects/{project_id}/spaces/{space_id}/{folder_id}/file/bulk/move', [FolderFileController::class, 'move_file_start'])->name('project.spaces.move.file_start2');
            Route::get('projects/{project_id}/spaces/{space_id}/{folder_id}/move/{type}', [FolderFileController::class, 'switch_file_location'])->name('project.spaces.switch_file_location');

            Route::post('projects/{project_id}/spaces/{space_id}/{folder_id}/file/{file_id}/file', [FolderFileController::class, 'upload_file'])->name('project.spaces.view.file.update');
            Route::get('projects/{project_id}/spaces/{space_id}/{folder_id}/file/{file_id}/{type}', [FolderFileController::class, 'view_file_detail'])->name('project.spaces.view.file.detail');
            Route::patch('projects/{project_id}/spaces/{space_id}/{folder_id}/file/{file_id}', [FolderFileController::class, 'update_file'])->name('project.spaces.update.file.patch');
            Route::post('projects/{project_id}/spaces/{space_id}/{folder_id}/file/{file_id}', [FolderFileController::class, 'update_file'])->name('project.spaces.update.file');
            Route::get('projects/{project_id}/spaces/{space_id}/{folder_id}/file/{file_id}/filetype/{file_type_id}/values', [FolderFileController::class, 'getValues'])->name('project.spaces.get.file.values');
        });
    });



    Route::prefix('domains')->group(function(){
        Route::get('/', [DomainsController::class, 'index'])->name('domains.index');
        Route::post('/add', [DomainsController::class, 'add'])->name('domins.add');
        Route::get('/{id}/edit', [DomainsController::class, 'edit'])->name('domains.edit');
        Route::post('/update', [DomainsController::class, 'update'])->name('domains.update');
        Route::delete('{id}/delete/', [DomainsController::class, 'destroy'])->name('domains.delete');
//Routes for domains ends here
    });

    Route::prefix('departments')->group(function(){
        Route::get('/', [DepartmentController::class, 'index'])->name('departments.index');
        Route::post('/add', [DepartmentController::class, 'add'])->name('departments.add');
        Route::get('/get/{id}', [DepartmentController::class, 'get_department'])->name('departments.get');
        Route::post('/update', [DepartmentController::class, 'update_department'])->name('departments.update');
        Route::delete('/delete/{id}', [DepartmentController::class, 'delete_department'])->name('departments.delete');
        //Routes for department ends here
        Route::get('/search', [DepartmentController::class, 'search'])->name('departments.search');
    });

    Route::prefix('document_priority')->group(function(){
        Route::get('/', [DocumentPriorityController::class, 'index'])->name('document_priority.index');
        Route::post('/add', [DocumentPriorityController::class, 'add'])->name('document_priority.add');
        Route::get('/get/{id}', [DocumentPriorityController::class, 'get_department'])->name('document_priority.get');
        Route::post('/update', [DocumentPriorityController::class, 'update_department'])->name('document_priority.update');
        Route::delete('/delete/{id}', [DocumentPriorityController::class, 'delete_department'])->name('document_priority.delete');
        //Routes for department ends here
        Route::get('/search', [DocumentPriorityController::class, 'search'])->name('document_priority.search');
    });


    // Designation Routes
    Route::prefix('designations')->group(function(){
        Route::get('/', [DesignationController::class, 'index'])->name('designations.index');
        Route::post('/add', [DesignationController::class, 'add_designation'])->name('designations.add');
        Route::get('/get_designation/{id}', [DesignationController::class, 'get_designation'])->name('designation.get');
        Route::post('/update_designation', [DesignationController::class, 'update_designation'])->name('designations.update');
        Route::delete('/delete/{id}', [DesignationController::class, 'delete_designation'])->name('designations.delete');
        //Routes for designations ends here
        Route::get('/search', [DesignationController::class, 'search'])->name('designations.search');
    });

// Department Routes


    Route::prefix('organizations')->group(function(){
        Route::get('/', [OrganizationController::class, 'index'])->name('organizations.index');
        Route::post('/add', [OrganizationController::class, 'add'])->name('organizations.add');
        Route::get('/get/{id}', [OrganizationController::class, 'get_organization'])->name('organizations.get');
        Route::post('/update', [OrganizationController::class, 'update_organization'])->name('organizations.update');
        Route::delete('/delete/{id}', [OrganizationController::class, 'delete_organization'])->name('organizations.delete');
        //Fiter search
        //Routes for designations ends here
        Route::get('/search', [OrganizationController::class, 'search'])->name('organizations.search');
    });

    //Modules Routes
    Route::prefix('module')->group(function(){
        Route::get('/', [ModulesController::class, 'index'])->name('module.index');
        Route::post('/add', [ModulesController::class, 'add'])->name('module.add');
        Route::get('/get/{id}', [ModulesController::class, 'get_module'])->name('module.get');
        Route::post('/update', [ModulesController::class, 'update_module'])->name('module.update');
        Route::delete('/delete/{id}', [ModulesController::class, 'delete_module'])->name('module.delete');
        //Fiter search
        //Routes for designations ends here
        Route::get('/search', [ModulesController::class, 'search'])->name('module.search');
    });

    Route::prefix('person-tags')->group(function(){
        Route::get('/', [\App\Http\Controllers\PersonTagsController::class, 'index'])->name('person.tags.index');
        Route::post('/add', [\App\Http\Controllers\PersonTagsController::class, 'add'])->name('person.tags.add');
        Route::get('/get/{id}', [\App\Http\Controllers\PersonTagsController::class, 'get'])->name('person.tags.get');
        Route::post('/update', [\App\Http\Controllers\PersonTagsController::class, 'update'])->name('person.tags.update');
        Route::delete('/delete/{id}', [\App\Http\Controllers\PersonTagsController::class, 'delete'])->name('person.tags.delete');
        //Fiter search
        //Routes for designations ends here
        Route::get('/search', [PersonTagsController::class, 'search'])->name('person.tags.search');
    });

    // voting routes
    Route::prefix('votings')->group(function(){
        Route::get('/', [VotingTypesController::class, 'index'])->name('voting.index');
        Route::post('/add', [VotingTypesController::class, 'add'])->name('votings.add');
        Route::get('/get/{id}', [VotingTypesController::class, 'get_voting'])->name('votings.get');
        Route::post('/update', [VotingTypesController::class, 'update_voting'])->name('votings.update');
        Route::delete('/delete/{id}', [VotingTypesController::class, 'delete_voting'])->name('votings.delete'); // Corrected the controller name
        //Routes for department ends here
        Route::get('/search', [VotingTypesController::class, 'search'])->name('votings.search');
    });


    //Projects
    Route::prefix('projects')->group(function(){
        Route::get('/', [ProjectsController::class, 'index'])->name('projects.index');
        Route::post('/add', [ProjectsController::class, 'add'])->name('projects.add');
        Route::get('/{id}/edit', [ProjectsController::class, 'edit'])->name('projects.edit');
        Route::post('/update', [ProjectsController::class, 'update'])->name('projects.update');
        Route::delete('{id}/delete/', [ProjectsController::class, 'destroy'])->name('projects.delete');
//Routes for  Projects ends here
    });

//Project Types
    Route::prefix('project-types')->group(function(){
        Route::get('/', [ProjectTypesController::class, 'index'])->name('project-types.index');
        Route::post('/add', [ProjectTypesController::class, 'add'])->name('project-types.add');
        Route::get('/{id}/edit', [ProjectTypesController::class, 'edit'])->name('project-types.edit');
        Route::post('/update', [ProjectTypesController::class, 'update'])->name('project-types.update');
        Route::delete('{id}/delete/', [ProjectTypesController::class, 'destroy'])->name('project-types.delete');
        //Routes for Project Types ends here
    });

    //Spaces
    Route::prefix('spaces')->group(function(){
        Route::get('/', [SpacesController::class, 'index'])->name('spaces.index');
        Route::post('/add', [SpacesController::class, 'add'])->name('spaces.add');
        Route::get('/{id}/edit', [SpacesController::class, 'edit'])->name('spaces.edit');
        Route::post('/update', [SpacesController::class, 'update'])->name('spaces.update');
        Route::delete('{id}/delete/', [SpacesController::class, 'destroy'])->name('spaces.delete');
//Routes for Spaces ends here
    });

    Route::prefix('project-spaces')->group(function(){
        Route::get('/', [ProjectSpacesController::class, 'index'])->name('project_spaces.index');
        Route::post('/add', [ProjectSpacesController::class, 'add'])->name('project_spaces.add');
    });

    Route::prefix('file-fields')->group(function(){
        Route::get('/', [FileFieldsController::class, 'index'])->name('file_fields.index');
        Route::post('/add', [FileFieldsController::class, 'add'])->name('file_fields.add');
        Route::get('/{id}/edit', [FileFieldsController::class, 'edit'])->name('file_fields.edit');
        Route::post('/update', [FileFieldsController::class, 'update'])->name('file_fields.update');
        Route::delete('{id}', [FileFieldsController::class, 'destroy'])->name('file_fields.delete');
    });

    Route::prefix('file-types')->group(function(){
        Route::get('/', [FileTypesController::class, 'index'])->name('file_types.index');
        Route::get('/{id}/fields', [FileTypesController::class, 'fields'])->name('file_types.field');
        Route::post('/{id}/fields', [FileTypesController::class, 'fields_update'])->name('file_types.field.update');
        Route::post('/add', [FileTypesController::class, 'add'])->name('file_types.add');
        Route::get('/{id}/edit', [FileTypesController::class, 'edit'])->name('file_types.edit');
        Route::post('/update', [FileTypesController::class, 'update'])->name('file_types.update');
        Route::delete('{id}/delete/', [FileTypesController::class, 'destroy'])->name('file_types.delete');
    });

});

Route::get('projects/filetype/{file_type_id}/values', [FolderFileController::class, 'getValuesEmpty'])->name('project.spaces.get.file.values.empty');

// Routes for only Admin and Root
Route::middleware([\App\Http\Middleware\CheckUserAdminRole::class])->group(function () {

    Route::match(['get', 'post'], 'admin/members/{id}/settings',[MembersController::class, 'change_admin_settings'])->name('change_admin.settings');
    Route::match(['get', 'post'], 'admin/members/{id}/profile',[MembersController::class, 'change_admin_detail'])->name('change_admin.detail');
    Route::match(['get', 'post'], 'admin/members/{id}/change-password',[MembersController::class, 'change_admin_password'])->name('change_admin.password');
    Route::get('rights/types/{id?}',[\App\Http\Controllers\RightsTypesController::class, 'index'])->name('right.types');
    Route::post( 'rights/types/add',[\App\Http\Controllers\RightsTypesController::class, 'add'])->name('right.types.add');
    Route::get('rights/types/{id}/edit', [\App\Http\Controllers\RightsTypesController::class, 'edit'])->name('right.types.edit');
    Route::post('rights/types/update', [\App\Http\Controllers\RightsTypesController::class, 'update'])->name('right-types.update');
    Route::post( 'rights/add',[\App\Http\Controllers\RightsController::class, 'add'])->name('right.add');
    Route::post( 'rights/parent/update',[\App\Http\Controllers\RightsController::class, 'parentUpdate'])->name('right.parent.update');
    Route::get( 'admin/members/{id}/permissions/{parentSlug}/{projectId}',[\App\Http\Controllers\RightsController::class, 'manageProjectRights'])->name('manageProjectRights');
    Route::get( 'admin/members/{id}/basic_permissions/{parentSlug}',[\App\Http\Controllers\RightsController::class, 'manageBasicRights'])->name('manageBasicRights');
    Route::get( 'admin/members/{id}/type-permissions/{parentSlug}',[\App\Http\Controllers\RightsController::class, 'manageTypeRights'])->name('manageTypeRights');

});

Route::prefix('survey')->group(function() {
    Route::get('/', [\App\Http\Controllers\SurveyController::class, 'index'])->name('survey.index');
    Route::post('/add', [\App\Http\Controllers\SurveyController::class, 'add'])->name('survey.add');
    Route::post('/update/{id}', [\App\Http\Controllers\SurveyController::class, 'update'])->name('survey.update');

    Route::delete('/delete/{id}', [\App\Http\Controllers\SurveyController::class, 'destroy'])->name('survey.delete');
    Route::post('/change-status', [\App\Http\Controllers\SurveyController::class, 'change_status'])->name('change_survey.status');
    Route::get('detail/{id}', [\App\Http\Controllers\SurveyController::class, 'detail'])->name('survey.detail');
    Route::get('{id}', [\App\Http\Controllers\SurveyController::class, 'get'])->name('survey.get');

    Route::get('questions/{id}', [\App\Http\Controllers\SurveyController::class, 'questions'])->name('survey.questions');
    Route::get('questions/{id}/sort', [\App\Http\Controllers\SurveyController::class, 'questions_sort'])->name('survey.questions.sort');
    Route::post('questions/{id}/sort', [\App\Http\Controllers\SurveyController::class, 'questions_sort_update'])->name('survey.questions.sort.update');

    Route::post('questions/{id}', [\App\Http\Controllers\SurveyController::class, 'questions_add'])->name('survey.question.add');
    Route::delete('{id}/question/delete/{questionId}', [\App\Http\Controllers\SurveyController::class, 'destroy_question'])->name('survey.question.delete');

});

Route::prefix('document_categories')->group(function(){
    Route::get('/', [DocumentCategoriesController::class, 'index'])->name('document_categories.index');
    Route::post('/add', [DocumentCategoriesController::class, 'add'])->name('document_categories.add');
    Route::get('/get/{id}', [DocumentCategoriesController::class, 'get_categories'])->name('document_categories.get');
    Route::post('/update', [DocumentCategoriesController::class, 'update_categories'])->name('document_categories.update');
    Route::delete('/delete/{id}', [DocumentCategoriesController::class, 'delete_categories'])->name('document_categories.delete');
    Route::get('/search', [DocumentCategoriesController::class, 'search'])->name('document_categories.search');
});

Route::prefix('documents')->group(function() {

    Route::get('/', [DocumentsController::class, 'index'])->name('documents.index');
    Route::post('/', [DocumentsController::class, 'store'])->name('documents.add');

    Route::post('/add-basic-data', [DocumentsController::class, 'add_basic_data'])->name('documents.add_basic_data');
    Route::post('/add-details', [DocumentsController::class, 'add_details'])->name('documents.add_details');
    Route::post('/add-assignees', [DocumentsController::class, 'add_assignees'])->name('documents.add_assignees');

    Route::post('/update-basic-data', [DocumentsController::class, 'update_basic_data'])->name('documents.update_basic_data');
    Route::post('/update-details', [DocumentsController::class, 'update_details'])->name('documents.update_details');
    Route::post('/update-assignees', [DocumentsController::class, 'update_assignees'])->name('documents.update_assignees');
    Route::post('/share-document', [DocumentsController::class, 'share_document'])->name('documents.share_document');

    Route::post('/add-comment/{id}', [DocumentsController::class, 'add_comments'])->name('documents.add.comment');

    Route::get('/{id}/edit-document', [DocumentsController::class, 'edit_document'])->name('documents.edit');
    Route::get('/link/{slug}', [DocumentsController::class, 'shared_document_link'])->name('documents.shared_document_link');
    Route::get('/{id}/share-history', [DocumentsController::class, 'share_history'])->name('documents.share_history');
    Route::post('/{id}/file', [DocumentsController::class, 'add_file'])->name('documents.file.add');
    Route::get('/{id}/file/{file_id}', [DocumentsController::class, 'read_file'])->name('documents.file.read');
    Route::get('/{id}/starred', [DocumentsController::class, 'starred'])->name('documents.starred');
    Route::get('/{id}/status/{status}', [DocumentsController::class, 'change_status'])->name('document.change.status');
    Route::get('/shared/{slug}', [DocumentsSharedController::class, 'shared_document'])->name('document.shared_document');
    Route::post('/{id}/upload-audio', [DocumentsController::class, 'uploadAudio'])->name('documents.upload_audio');



    Route::delete('{id}/delete', [DocumentsController::class, 'delete_document'])->name('documents.delete');

});

Route::prefix('module_projects')->group(function(){
    Route::post('/add', [ModuleProjectsController::class, 'addModuleProject'])->name('module_projects.add');
});

Route::prefix('document_types')->group(function(){
    Route::get('/', [TypesController::class, 'index'])->name('document_types.index');
    Route::post('/add', [TypesController::class, 'add'])->name('document_types.add');
    Route::get('/get/{id}', [TypesController::class, 'get_type'])->name('document_types.get');
    Route::post('/update', [TypesController::class, 'update_type'])->name('document_types.update');
    Route::delete('/delete/{id}', [TypesController::class, 'delete_type'])->name('document_types.delete');
    Route::get('/search', [TypesController::class, 'search'])->name('document_types.search');
});

// Routes for  Projects
Route::prefix('projects')->group(function(){
    Route::get('/', [ProjectController::class, 'index'])->name('projects.index');
    Route::post('/add', [ProjectController::class, 'add'])->name('projects.add');
    Route::get('/get/{id}', [ProjectController::class, 'get_projects'])->name('projects.get');
    Route::post('/update', [ProjectController::class, 'update_projects'])->name('projects.update');
    Route::delete('/delete/{id}', [ProjectController::class, 'delete_projects'])->name('projects.delete');
    Route::get('/search', [ProjectController::class, 'search'])->name('projects.search');
});


Route::prefix('document-statuses')->group(function() {
    Route::get('/', [DocumentStatusController::class, 'index'])->name('document-statuses.index');
    Route::get('/create', [DocumentStatusController::class, 'create'])->name('document-statuses.create');
    Route::post('/store', [DocumentStatusController::class, 'add'])->name('document-statuses.store'); // Updated route name and function
    Route::get('/get/{id}', [DocumentStatusController::class, 'show'])->name('document-statuses.show');
    Route::get('/edit/{id}', [DocumentStatusController::class, 'edit'])->name('document-statuses.edit');
    Route::post('/update', [DocumentStatusController::class, 'update'])->name('document-statuses.update'); // Updated route name and function
    Route::delete('/delete/{id}', [DocumentStatusController::class, 'deleteDocumentStatus'])->name('document-statuses.destroy'); // Updated route name and function
    Route::get('/search', [DocumentStatusController::class, 'search'])->name('document-statuses.search');
});
