<?php
// Create a service class (DocumentPriorityService.php)
namespace App\Services;

use App\Models\Document_priority;

class DocumentPriorityService
{
    public function index()
    {
        if(!checkPersonPermission('view-document_priority-3-0'))
        return ErrorMessage(403);

        $data = Document_priority::all();
        $total_count = $data->count();

        $departments = Document_priority::pluck('name', 'id');

        return compact('data', 'departments', 'total_count');
    }

}
