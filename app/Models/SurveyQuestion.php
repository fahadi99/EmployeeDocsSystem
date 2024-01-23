<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SurveyQuestion extends Model
{
    use SoftDeletes;

    public static function getAllByServeyId($surveyId) {
        return self::where('survey_id', $surveyId)->orderby('sort_order', 'asc')->get();
    }

    public function getAllOptions() {
        if(!isset($this->options))
            $this->options = SurveryQuestionOptions::getAllByQuestionId($this->id);
        return $this->options;
    }

    public function add($id, $request = false) {
        if($request == false)
            $request = request();

        $this->survey_id = $id;
        $this->question = $request->question;
        $this->additional_info = $request->additional_info;
        $this->is_optional = $request->is_optional;
        $this->status = true;

        $lastSortOrder = SurveyQuestion::getLastSurveyOrder($id) + 1;
        $this->type = $request->type;



        $this->sort_order = $lastSortOrder;

        $this->created_by = auth()->user()->id;
        $this->save();


        if($request->type == 'single' || $request->type == 'multiple') {
            SurveryQuestionOptions::addQuestionByQuestionId($this->id, $request->question_options);
        }
    }

    public function getLastSurveyOrder($id) {
        $obj =  self::where('survey_id', $id)->orderby('sort_order', 'desc')->first();

        if($obj)
            return $obj->sort_order;
        else
            return -1;

    }

    public static function deleteQuestion($questionId) {
        $question = self::find($questionId);
        if($questionId) {
            $question->deleted_by = auth()->user()->id;
            $question->delete();
        }
    }

    public static function sortQuestios($questionId, $questions) {
        foreach($questions as $key=>$q) {
            self::where('id', $q)->update(['sort_order'=> $key]);
        }
    }
}
