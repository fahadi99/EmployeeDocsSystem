<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SurveryQuestionOptions extends Model
{
    use SoftDeletes;
    protected $table = 'survey_questions_options';

    public static function getAllByQuestionId($questionId) {
        return self::where('survey_question_id', $questionId)->orderby('id', 'asc')->get();
    }

    public static function addQuestionByQuestionId($questionId, $options) {
        foreach($options as $option) {
            $obj = new SurveryQuestionOptions();
            $obj->survey_question_id = $questionId;
            $obj->option_text = $option;
            $obj->created_by = auth()->user()->id;
            $obj->save();
        }


    }
}
