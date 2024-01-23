<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        DB::statement("
            CREATE or REPLACE VIEW documents_view  AS
            SELECT

            doc.id, doc.subject, doc.description ,doc.short_description, doc.dated, doc.is_restricted,
            domain.id as domain_id ,domain.name as domain_name,
            department.id as department_id, department.name as department_name,
            organization.id as organization_id, organization.name as organization_name,
            owner.id as owner_id, owner.first_name as owner_first_name, owner.last_name as owner_last_name,
            document_status.id as document_status_id, document_status.name as document_status_name,
            project.id as project_id ,project.name as project_name,
            document_priority.id as document_priority_id ,document_priority.name as document_priority_name,
            document_type.id as document_type_id ,document_type.name as document_type_name, document_type.icon_path as document_type_icon,
            (select count(*) from document_comments dc where doc.id = dc.document_id) no_of_comments,
            (select count(*) from document_tags dt where doc.id = dt.document_id) no_of_persons,
            (select count(*) from document_files df where doc.id = df.document_id) no_of_files,
            (select count(*) from document_votes dv where doc.id = dv.document_id) no_of_votes

            FROM documents AS doc
            JOIN domains AS domain ON domain.id = doc.domain_id
            JOIN departments AS department ON department.id = doc.department_id
            JOIN organizations AS organization ON organization.id = doc.organization_id
            JOIN persons AS owner ON owner.id = doc.owner_id
            JOIN document_statuses AS document_status ON document_status.id = doc.document_status_id
            JOIN projects AS project ON project.id = doc.project_id
            JOIN document_priorities AS document_priority ON document_priority.id = doc.priority_id
            JOIN document_types AS document_type ON document_type.id = doc.document_type_id
        ");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement('DROP VIEW IF EXISTS documents_view');
    }
};
