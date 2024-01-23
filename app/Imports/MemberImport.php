<?php

namespace App\Imports;

use App\Models\Person;
use App\User;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\SkipsFailures;
use Maatwebsite\Excel\Concerns\ToModel;

class MemberImport implements ToModel
{
    /**
     * @param array $row
     *
     * @return User|null
     */

    private $data;

    use Importable,SkipsFailures;


    public function model(array $rows)
    {
        return $rows;

    }

    public function toRow($row) {



    }
}
