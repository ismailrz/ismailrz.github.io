<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Answer;
use App\Models\Question;
use App\Models\User;
use DB;
use App\Models\Image;

class AnswersController extends Controller
{
    // public function __construct() {
    //     $this->middleware('auth:api');
    // }

    public function view() {
        return view('answers.index');
    }

    public function store(Request $request, $id) {
        $answer = new Answer;
        $description = Image::save_image_from_description($request->answer);
        $answer->answer = $description;
        $answer->question_id = $id;
        $answer->user_id = $request->user_id;
        $answer->status = $request->status;
        $answer->save();
        $user = User::find($request->user_id);
        $user->total_answers += 1;
        $user->update();

        // $status = $answer->status;
        if($answer->status == "10"){
            $question = Question::find($id);
            $question->total_answer += 1;
            $question->update(); 
        }       
        $result['response'] = "success";						
        $result['message'] = "Successfully added";
        return response()->json($result);
    }

    // public function get_my_answer($id) {
    //     $statuses = $this->get_status_list('answer');
    //     $answer = Answer::find($id);
    //     return compact('answer', 'statuses');
    // }

    public function update_my_answer(Request $request, $id) {
        $answer = Answer::find($id);
        $description = Image::save_image_from_description($request->answer);
        $answer->answer = $description;
        $answer->status = $request->status;
        $answer->update();
        $result['response'] = "success";						
        $result['message'] = "Successfully updated";
        return response()->json($result);
    }

    public function delete_answer($id){
        $answer = Answer::find($id);
        $answer->delete();
    }
    
    public function get_user_answers(Request $request){
        $userId = $request->userId;
        $categoryId = $request->categoryId;
        $page = $request->page;
        $limit = $request->limit;
        if($categoryId == 0){
            $answers = Answer::with('user','question')->where('user_id',$userId)->get();
            // $answers =  DB::table('answers') 
            //     ->join('questions', 'answers.question_id', 'questions.id')
            //     ->join('users', function($join) use($userId) {
            //         $join->on('answers.user_id', '=', 'users.id');
            //     })
            //     ->select('answers.*','questions.title','users.id','users.name','users.profile_picture')
            //     ->where('user_id', $userId)
            //     ->orderBy('answers.up_vote','DESC') 
            //     ->orderBy('answers.down_vote','ASC')
            //     ->paginate($limit);
        } else {
            $answers = Answer::where('user_id',$userId)->with('user')
            ->with(['question' => function ($query) use ($categoryId){
                $query->where('question_category_id','=',$categoryId);
            }])
            ->get();

            // $answers = DB::table('answers')
            //     ->join('questions', function($join) use($categoryId) {
            //         $join->on('answers.question_id', '=', 'questions.id')->select('questions.id','questions.title')->where('question_category_id', $categoryId);
            //     })
            //     ->join('users', function($join) use($userId) {
            //         $join->on('answers.user_id', '=', 'users.id')->select('users.id','users.name','users.profile_picture');
            //     })
            //     ->select('answers.*','questions.title')
            //     ->where('user_id',$userId)
            //     ->orderBy('answers.up_vote','DESC')
            //     ->orderBy('answers.down_vote','ASC')
            //     ->paginate($limit);
        }                       
      return response()->json(['answers' => $answers]);
    }    

    public function accept_answer(Request $request, $id, $userId) { 
        $answer = Answer::find($id);
        $questionId = $answer->question_id;
        $answerAccept = $answer->is_accepted;
        // dd($answerAccept);
        // foreach($answer as $data){
        //     $questionId = $data->question_id;
            
        // }
        $questionUserId = Question::select('created_by')->where('id', $questionId)->get();
        if($questionUserId){
            $questionUserId = $questionUserId[0]->created_by;
        }
        if($userId == $questionUserId && $answerAccept == 0){
            $answer->is_accepted = $request->is_accepted + 1;
            $answer->update();
            $result['response'] = "success";						
            $result['message'] = "Your answer is accepted successfully";
            return response()->json($result);
        }
    }
}
