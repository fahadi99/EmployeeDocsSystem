<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Survey extends Model
{
    use SoftDeletes;
    //protected $table = 'survey';

    public static function getAll() {
        return $obj = self::orderby('id', 'desc')->get();
    }

    public static function getById($id) {
        return $obj = self::join('persons as p', 'p.id', 'surveys.created_by')
            ->select(['surveys.*', 'p.first_name', 'p.last_name'])
            ->where('surveys.id', $id)
            ->first($id);
    }

    public function add($request = false) {
        if($request == false)
            $request = request();

        $this->name = $request->name;
        $this->short_description = $request->short_description;
        $this->long_description = $request->long_description;
        $this->start_date = $request->start_date;
        $this->end_date = $request->end_date ? $request->end_date: null;
        $this->created_by = auth()->user()->id;


        $this->save();




    }

    public function getQuestions() {
        if(!isset($this->questions))
            $this->questions = SurveyQuestion::getAllByServeyId($this->id);

        return $this->questions;
    }


    public function updateData($request = false) {
        if($request == false)
            $request = request();

        $this->name = $request->name;
        $this->short_description = $request->short_description;
        $this->long_description = $request->long_description;
        $this->start_date = $request->start_date;
        $this->end_date = $request->end_date ? $request->end_date: null;


        $this->save();




    }

    public function sortQuestions($request = false) {
        if($request == false)
            $request = request();

        SurveyQuestion::sortQuestios($this->id, $request->questions);
    }


}
