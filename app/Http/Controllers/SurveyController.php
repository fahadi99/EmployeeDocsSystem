<?php

namespace App\Http\Controllers;

use App\Mail\send_password;
use App\Models\Department;
use App\Models\Designation;
use App\Models\Domain;
use App\Models\Organization;
use App\Models\Person;
use App\Models\Survey;
use App\Models\SurveyQuestion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use exception;
use Illuminate\Support\Facades\Auth;

class SurveyController extends Controller
{
    public function index ( Request $request )
    {
        $data = Survey::getAll();



//        $selectBoxes = [
//            'domains' => Domain::getForSelect(),
//            'organizations' => Organization::getForSelect(),
//            'departments' => Department::getForSelect(),
//            'designations' => Designation::getForSelect(),
//        ];
//
        $total_count = count($data);

        /*  if($request->ajax()){
            return  view('member.include.members_grid', compact('data'));
        } */

        return view('survey.index', compact('data', 'total_count'));
    }


    public function detail(Request $request, $id) {
        $survey = Survey::getById($id);
        return view('survey.detail', compact('survey'));
    }

    public function questions(Request $request, $id) {
        $survey = Survey::getById($id);
        $survey->getQuestions();

        return view('survey.questions.index', compact('survey'));
    }

    public function questions_sort(Request $request, $id) {
        $survey = Survey::getById($id);
        $survey->getQuestions();
        return view('survey.questions.sort', compact('survey'));
    }


    public function questions_sort_update(Request $request, $id) {
        $survey = Survey::getById($id);
        if($survey) {
            $survey->sortQuestions();

            return response()->json([
                'status' => 200,
                'message' => "Questions Sorted"
            ]);
        }
    }






    public function add(Request $request){
        $v = Validator::make($request->all(), [
            'name' => 'required',
            'short_description' => 'required',
            'long_description' => 'required',
            'start_date' => 'required',
            //'profile_avatar' => 'required|image|mimes:jpeg,png,jpg|max:2048'
        ],[
            'name.required'=>'Please provide The Title',
            'short_description.required'=>'Please provide the short description',
            'long_description.required'=>'Please provide description',
            'start_date.required'=>'Please provide start date',

        ]); // Validation ends here

        if ($v->fails())
        {
            //$errors = "Please provide Name or Designation name Already exists";
            return response()->json([
                'status' => 400,
                'message' => $v->getMessageBag()->toArray()
            ]);
        }


        //try catch starts here
        try{

            $survey = new Survey();


            $survey->add();

            $message = "Survey Added Successfully";
            return response()->json(['status' => 200,'message' => $message ]);

        } catch(Exception $e)  {
            $message =  $e->getMessage();
            return response()->json([
                'status' => 400,
                'message' => $message
            ]);
        }
        //Try catch ends here
    }
    public function questions_add(Request $request, $id = false){
        if($id) {
            $v = Validator::make($request->all(), [
                'question' => 'required',
                'is_optional' => 'required',
                'type' => 'required',
                'question_options'     => 'required_if:type,single,multiple'
            ],[
                'question.required'=>'Question is required',
                'is_optional.required'=>'Question is mandatory or not',
                'type.required'=>'Question type is required',
                'question_options.required' => 'Question options are required'

            ]); // Validation ends here

            if ($v->fails())
            {
                //$errors = "Please provide Name or Designation name Already exists";
                return response()->json([
                    'status' => 400,
                    'message' => $v->getMessageBag()->toArray()
                ]);
            }


            //try catch starts here
            try{

                $surveyQuestion = new SurveyQuestion();
                $surveyQuestion->add($id);

                $message = "Question Added Successfully";
                return response()->json(['status' => 200,'message' => $message ]);

            } catch(Exception $e)  {
                $message =  $e->getMessage();
                return response()->json([
                    'status' => 400,
                    'message' => $message
                ]);
            }
            //Try catch ends here

        }
    }



    public function update(Request $request, $id = false){
        $v = Validator::make($request->all(), [
            'name' => 'required',
            'short_description' => 'required',
            'long_description' => 'required',
            'start_date' => 'required',
            //'profile_avatar' => 'required|image|mimes:jpeg,png,jpg|max:2048'
        ],[
            'name.required'=>'Please provide The Title',
            'short_description.required'=>'Please provide the short description',
            'long_description.required'=>'Please provide description',
            'start_date.required'=>'Please provide start date',

        ]); // Validation ends here

        if ($v->fails())
        {
            //$errors = "Please provide Name or Designation name Already exists";
            return response()->json([
                'status' => 400,
                'message' => $v->getMessageBag()->toArray()
            ]);
        }


        //try catch starts here
        try{

            $survey = Survey::getById($id);
            $survey->updateData();

            $message = "Survey Updated Successfully";
            return response()->json(['status' => 200,'message' => $message ]);

        } catch(Exception $e)  {
            $message =  $e->getMessage();
            return response()->json([
                'status' => 400,
                'message' => $message
            ]);
        }
        //Try catch ends here
    }




    public function get( $id ){
        try{

            $obj = Survey::find($id);

            return response()->json(['status' => 200,'survey' => $obj ]);

        } catch(Exception $e)  {
            $message =  $e->getMessage();
            return response()->json([
                'status' => 400,
                'message' => $message
            ]);
        }
    }

    public function destroy( $id ){
        try{

            $obj = Survey::find($id);
            $obj->deleted_by = auth()->user()->id;
            $obj->delete();

            $message = "Survey Deleted Successfully";
            return response()->json(['status' => 200,'message' => $message ]);

        } catch(Exception $e)  {
            $message =  $e->getMessage();
            return response()->json([
                'status' => 400,
                'message' => $message
            ]);
        }
    }

    public function destroy_question( $id, $questionId ){
        try{

            $obj = Survey::find($id);
            if($obj) {
                $surveyQuestion = SurveyQuestion::deleteQuestion($questionId);
                $message = "Survey Deleted Successfully";
                return response()->json(['status' => 200,'message' => $message ]);
            }

            return response()->json([
                'status' => 400,
                'message' => "Something went wrong",
            ]);

        } catch(Exception $e)  {
            $message =  $e->getMessage();
            return response()->json([
                'status' => 400,
                'message' => $message
            ]);
        }
    }



    public function change_status(Request $request){
        //Try catch starts here
        try{
            $person  = Survey::find($request->id);
            $person->status = $request->status;
            $person->update();

            $message = "Status Updated Successfully";
            return response()->json(['status' => 200,'message' => $message ]);

        }catch(Exception $e)  {
            $message =  $e->getMessage();
            return response()->json([
                'status' => 400,
                'message' => $message
            ]);
        }
    }


}
