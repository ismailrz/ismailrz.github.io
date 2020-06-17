<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Invitation;
use App\Models\Job;
use App\Models\User;
use App\Models\Comment;
use App\Models\Admin\JobCategory;
use App\Models\Admin\Organization;
use App\Models\Share;
use App\Models\Like;
use App\Notifications\ShareNotification;
use App\Notifications\CommentNotification;
use App\Notifications\LikeOnCommentNotification;
use App\Notifications\AdminNotificationOnCreation;
use Validator;
use DB;
class JobsController extends Controller
{
    public function get_jobs($userId, $jobTag, $jobCategoryId, $organizationId, $jobTypeId, $search){
        $conditions = [];
        if($jobCategoryId){
            $conditions[] = ['job_category_id', $jobCategoryId];
        }
        if($organizationId){
            $conditions[] = ['organization_id', $organizationId];
        }
        if($jobTypeId){
            $conditions[] = ['job_type_id', $jobTypeId];
        }
        if($search){
            $conditions[] = ['title', 'LIKE', "%{$search}%"];
        }
        if($jobTag == 'myJob'){
            $jobs = DB::table('jobs')->orderByRaw('application_deadline', 'DESC')
                ->join('job_user', function($join) use($userId) {
                    $join->on('jobs.id', '=', 'job_user.job_id')
                        ->where('user_id', $userId)
                        ->where('is_creator','=',1);
                })->join('organizations', function($join) {
                    $join->on('organizations.id', '=', 'jobs.organization_id');
                })
                ->leftJoin('likes', function($join) use($userId){
                    $join->on('jobs.id','=','likes.likeable_id')
                        ->where('likeable_type','=','App\Models\Job')
                        ->where('likes.user_id', $userId);
                })->select('jobs.*', 'organizations.name as organization_name', 'job_user.user_id as creator_id')
                ->where($conditions)->get();

        }elseif($jobTag == 'appliedJob'){

            $jobs = DB::table('jobs')->orderByRaw('application_deadline', 'DESC')
            ->join('job_user', function($join) use($userId) {
                $join->on('jobs.id', '=', 'job_user.job_id')
                    ->where('user_id', $userId)
                    ->where('is_applied','=', 1);
            })->join('organizations', function($join) {
                $join->on('organizations.id', '=', 'jobs.organization_id');
            })
            ->leftJoin('likes', function($join) use($userId){
                $join->on('jobs.id','=','likes.likeable_id')
                    ->where('likeable_type','=','App\Models\Job')
                    ->where('likes.user_id', $userId);
            })->select('jobs.*', 'organizations.name as organization_name', 'job_user.user_id as creator_id')
            ->where($conditions)->get();
        }else{

            $jobs = DB::table('jobs')->orderByRaw('application_deadline', 'DESC')
            ->join('organizations', function($join) {
                $join->on('organizations.id', '=', 'jobs.organization_id');
            })->join('job_user', function($join) use($userId) {
                $join->on('jobs.id', '=', 'job_user.job_id');
            })
            ->leftJoin('likes', function($join) use($userId){
                $join->on('jobs.id','=','likes.likeable_id')
                    ->where('likeable_type','=','App\Models\Job')
                    ->where('likes.user_id', $userId);
            })->select('jobs.*', 'organizations.name as organization_name', 'job_user.user_id as creator_id')
            ->where($conditions)->get();
        }

        return response()->json(['jobs' =>$jobs ]);
    }

    public function get_job_categories_organizations_types(){
        $statuses = $this->get_status_list('job');
        $jobTypes = $this->get_types('job_types');
        $jobCategories = JobCategory::where('status', 10)->pluck('title', 'id');
        $organizations = Organization::pluck('name', 'id');
        return response()->json(['jobCategories'=>$jobCategories, 'organizations' => $organizations, 'jobTypes' => $jobTypes, 'statuses' => $statuses]);
    }
    public function get_job_details($jobId){
        $job = Job::with(array('organization' => function($query){
            $query->select('id', 'name');
        }))->find($jobId);
        return response()->json($job);
    }

    public function controller_edit_job($jobId, $userId){
        $checkAdmin = User::find($userId)->where('role_id', '1')->where('status', '10')->count();
        if($checkAdmin>0){
            $job = Job::find($jobId);
        }else{
            $job = [];
        }
        return response()->json($job);
    }

    public function get_edit_job($jobId, $userId){
        $job = User::find($userId)->jobs()->where('job_id', $jobId)->where('is_creator', '=', 1)->first();
        return response()->json($job);
    }

    public function add_job_comment(Request $request){
        $result['response'] = 'success';
        $validator = Validator::make($request->all(), [
            'user_id' => 'required',
            'commentable_id' => 'required',
            'comment' => 'required',
        ]);
        if ($validator->fails()) {
            $result['response'] = 'error';
            $result['message'] = $validator->errors();
            return response()->json($result);
        }
        $commentResponse = Comment::generic_method_for_comment($request->user_id, $request->commentable_id, 'App\Models\Job',$request->comment);
       if($commentResponse['response'] == 'success'){
        
            $job = Job::join('job_user', function($join) {
                $join->on('jobs.id', '=', 'job_user.job_id');
            })->select('jobs.*', 'jobs.id as job_id', 'job_user.user_id as creator_id')->find($request->commentable_id);
                
            if($job->creator_id != $request->user_id){
                $to = User::find($job->creator_id);
                $from = User::find($request->user_id);
                $from['notification_type'] = 'Job';
                $from['type_id'] = $job->id;
                $to->notify(new CommentNotification($from));
            }

           if(!empty($job)){
                $job->total_comments++;
                if(!$job->update()){
                    $result['response'] = 'error';
                    $result['message'] = 'Comment Failed!';
                }
           }else{
                Comment::where('user_id',$request->user_id)->where('commentable_id',$request->commentable_id)->where('commentable_type','App\Models\Job')->orderBy('id',"DESC")->first()->delete();
                $result['response'] = 'error';
                $result['message'] = 'Comment Failed!';
           }
       }else{
            $result['response'] = 'error';
            $result['message'] = 'Comment Failed!';
       }
       return response()->json($result);
    }
    public function update_job_comment(Request $request){
        $result['response'] = 'success';
        $validator = Validator::make($request->all(), [
            'commentId' => 'required',
            'comment' => 'required',
        ]);
        if ($validator->fails()) {
            $result['response'] = 'error';
            $result['message'] = $validator->errors();
            return response()->json($result);
        }
        $comment = Comment::find($request->commentId);
        if(!empty($comment)){
            $comment->comment = $request->comment;
            if(!$comment->update()){
                $result['response'] = 'error';
                $result['message'] = 'Comment update failed! Please try again';
            }
        }else{
            $result['response'] = 'error';
            $result['message'] = 'Comment update failed! Please try again';
        }
       return response()->json($result);
    }
    public function delete_job_comment($commentId){
        $result['response'] = 'success';
        $comment = Comment::find($commentId);
        if(!$comment->delete()){
            $result['response'] = 'error';
            $result['message'] = 'Comment delete failed! Please try again';
        }
        return response()->json($result);
    }
    public function get_job_comments($jobId,$userId){
        $jobComments = Comment::with(['user:id,name,profile_picture','likes' => function ($query) use ($userId) {
            $query->where('user_id', $userId);
        }])
        ->where('commentable_id',$jobId)->where('commentable_type','App\Models\Job')
        ->orderBy('created_at','DESC')->get();
        return compact("jobComments");
    }
    public function unlike_job(Request $request){
        $validator = Validator::make($request->all(), [
            'user_id' => 'required',
            'likeable_id' => 'required',
        ]);
        if ($validator->fails()) {
            $result['response'] = 'error';
            $result['message'] = $validator->errors();
            return response()->json($result);
        }
        $likeResponse =  Like::generic_unlike_method($request->user_id, $request->likeable_id, 'App\Models\Job');
        if($likeResponse['response'] = 'success'){
            $job = Job::find($request->likeable_id);
            $job->total_likes--;
            if($job->update()){
                $result['response'] = 'success';
                $result['message'] = "unlike has been successfull!";
            }else{
                $result['response'] = 'error';
                $result['message'] = 'Sorry, unlike failed! Please try again.';
            }
        }else{
            $result['response'] = 'error';
            $result['message'] = 'Sorry, unlike failed! Please try again.';
        }
        return response()->json($result);
    }
    public function like_job(Request $request){
        $validator = Validator::make($request->all(), [
            'user_id' => 'required',
            'likeable_id' => 'required',
        ]);
        if ($validator->fails()) {
            $result['response'] = 'error';
            $result['message'] = $validator->errors();
            return response()->json($result);
        }
        $likeResponse =  Like::generic_like_method($request->user_id, $request->likeable_id, 'App\Models\Job');
        if($likeResponse['response'] = 'success'){
            $job = Job::find($request->likeable_id);
            $job->total_likes++;
            if($job->update()){
                $result['response'] = 'success';
                $result['message'] = "Liked has been successfull!";
            }else{
                $result['response'] = 'error';
                $result['message'] = 'Sorry, Liked failed! Please try again.';
            }
        }else{
            $result['response'] = 'error';
            $result['message'] = 'Sorry, Liked failed! Please try again.';
        }
        return response()->json($result);
    }
    public function unlike_job_comment(Request $request){
        $validator = Validator::make($request->all(), [
            'user_id' => 'required',
            'likeable_id' => 'required',
        ]);
        if ($validator->fails()) {
            $result['response'] = 'error';
            $result['message'] = $validator->errors();
            return response()->json($result);
        }
        $likeResponse =  Like::generic_unlike_method($request->user_id, $request->likeable_id, 'App\Models\Comment');
        if($likeResponse['response'] = 'success'){
            $comment = Comment::find($request->likeable_id);
            $comment->total_likes--;
            if($comment->update()){
                $result['response'] = 'success';
                $result['message'] = "unlike has been successfull!";
            }else{
                $result['response'] = 'error';
                $result['message'] = 'Sorry, unlike failed! Please try again.';
            }
        }else{
            $result['response'] = 'error';
            $result['message'] = 'Sorry, unlike failed! Please try again.';
        }
        return response()->json($result);
    }
    public function like_job_comment(Request $request){
        $validator = Validator::make($request->all(), [
            'user_id' => 'required',
            'likeable_id' => 'required',
        ]);
        if ($validator->fails()) {
            $result['response'] = 'error';
            $result['message'] = $validator->errors();
            return response()->json($result);
        }
        $likeResponse =  Like::generic_like_method($request->user_id, $request->likeable_id, 'App\Models\Comment');
        if($likeResponse['response'] = 'success'){
            $comment= Comment::find($request->likeable_id);
            $comment->total_likes++;
            if($comment->update()){
                $result['response'] = 'success';
                $result['message'] = "Like successfull!";
                if($comment->user_id != $request->user_id){
                    $to = User::find($comment->user_id);
                    $from = User::find($request->user_id);
                    $from['notification_type'] = 'Job';
                    $from['type_id'] = $job->id;
                    $to->notify(new LikeOnCommentNotification($from));
                }
            }else{
                $result['response'] = 'error';
                $result['message'] = 'Sorry, Like failed! Please try again.';
            }
        }else{
            $result['response'] = 'error';
            $result['message'] = 'Sorry, Like failed! Please try again.';
        }
        return response()->json($result);
    }

    public function share_job(Request $request){
        $result['response'] = 'success';
        $validator = Validator::make($request->all(), [
            'user_id' => 'required',
            'shareable_id' => 'required',
        ]);
        if ($validator->fails()) {
            $result['response'] = 'error';
            $result['message'] = $validator->errors();
            return response()->json($result);
        }
        $description = $request->comment."\n".url("/")."/job-details/".$request->shareable_id;
        $shareResponse =  Share::generic_method_for_share($request->user_id, $request->shareable_id, 'App\Models\Job',$description);
        if($shareResponse['response'] == 'error'){
            return response()->json($shareResponse);
        }else{
            $result['message'] ="Shared success!";
            if($request->owner_id != $request->user_id){
                $to = User::find($request->owner_id);
                $from = User::find($request->user_id);
                $from['notification_type'] = 'Job';
                $from['type_id'] = $request->shareable_id;
                $to->notify(new ShareNotification($from));
            }
        }
        return response()->json($result);
    }

    public function create_job(Request $request, $userId) {
        $result['response'] = 'success';
        $validator = Validator::make($request->all(), [
            'title' => 'required|min:5|max:255',
            'job_type_id' => 'required',
            'job_category_id' => 'required',
            'organization_id' => 'required',
            'maximum_experience' => 'gte:minimum_experience',
            'maximum_age' => 'gte:minimum_age',
            'job_location' => 'required',
            'total_vacancy' => 'required|numeric',
            'application_deadline' => 'required|date|after:today',
            'salary_range' => 'required',
        ]);
        if ($validator->fails()) {
            $result['response'] = 'error';
            $result['errors'] = $validator->errors();
            return response()->json($result);
        }

        $job = new Job();
        $job->title = $request->title;
        $job->job_type_id = $request->job_type_id;
        $job->job_category_id = $request->job_category_id;
        $job->organization_id = $request->organization_id;
        $job->job_location = $request->job_location;
        $job->total_vacancy = $request->total_vacancy;
        $job->application_deadline = $request->application_deadline;
        $job->salary_range = $request->salary_range;
        $job->minimum_experience = $request->minimum_experience;
        $job->maximum_experience = $request->maximum_experience;
        $job->minimum_age = $request->minimum_age;
        $job->maximum_age = $request->maximum_age;
        $job->preferred_gender = $request->preferred_gender;
        $job->responsibilities = $request->responsibilities;
        $job->requirements = $request->requirements;
        $job->other_benefits = $request->other_benefits;
        $job->special_instruction = $request->special_instruction;
        $job->total_flag = 0;
        $job->is_featured = 0;
        if($request->status){
            $job->status = $request->status;
        }else{
            $job->status = 20;
        }
        $job->total_views = 1;
        if($job->save()){
            $job->users()->attach($userId, ['is_creator'=> 1 ]);
            $from = User::find($request->userId);
            $from['notification_type'] = 'Job';
                $from['type_id'] = $job->id;
            $admins = User::where('role_id', '1')->where('status', '10')->get();
            foreach($admins as $admin){
                $admin->notify(new AdminNotificationOnCreation($from));
            }

        }else{
            $result['response'] = 'error';
            $result['message'] = 'Sorry, new job creation failed! Please try again.';
        }
        return response()->json($result);
    }

    public function update_job(Request $request, $userId) {

        $validator = Validator::make($request->all(), [
            'title' => 'required|min:5|max:255',
            'job_type_id' => 'required',
            'job_category_id' => 'required',
            'organization_id' => 'required',
            'maximum_experience' => 'gte:minimum_experience',
            'maximum_age' => 'gte:minimum_age',
            'job_location' => 'required',
            'total_vacancy' => 'required|numeric',
            'application_deadline' => 'required|date|after:today',
            'salary_range' => 'required',
        ]);
        if ($validator->fails()) {
            $result['response'] = 'error';
            $result['message'] = $validator->errors();
            return response()->json($result);
        }

        $job = Job::join('job_user', function($join) use($userId) {
            $join->on('jobs.id', '=', 'job_user.job_id');
        })->select('jobs.*', 'jobs.id as job_id', 'job_user.user_id as creator_id')->find($request->id);

        $job->title = $request->title;
        $job->job_type_id = $request->job_type_id;
        $job->job_category_id = $request->job_category_id;
        $job->organization_id = $request->organization_id;
        $job->job_location = $request->job_location;
        $job->total_vacancy = $request->total_vacancy;
        $job->application_deadline = $request->application_deadline;
        $job->salary_range = $request->salary_range;
        $job->minimum_experience = $request->minimum_experience;
        $job->maximum_experience = $request->maximum_experience;
        $job->minimum_age = $request->minimum_age;
        $job->maximum_age = $request->maximum_age;
        $job->preferred_gender = $request->preferred_gender;
        $job->responsibilities = $request->responsibilities;
        $job->requirements = $request->requirements;
        $job->other_benefits = $request->other_benefits;
        $job->special_instruction = $request->special_instruction;
        $job->total_flag = 0;
        $job->is_featured = 0;
        $job->status = 20;
        $job->total_views = 1;

        $checkAdmin = User::find($userId)->where('role_id', '1')->where('status', '10')->count();
        if($job->creator_id == $userId || $checkAdmin > 0 ){
            $job->save();
            $result['response'] = 'success';
        }else{
            $result['response'] = 'error';
            $result['message'] = 'You are no supposed to do that';
        }
        return response()->json($result);
    }


    public function job_apply(Request $request){
        $job = Job::find($request->jobId);
        $checkIfAlreadyApplied = $job->users()->where('user_id', $request->userId)->count();
        if($checkIfAlreadyApplied == 0){
            $applied = $job->users()->attach($request->userId, ['is_applied' => 1,'is_creator'=> 0, 'expected_salary' => $request->expectedSalary, 'cover_letter' => $request->coverLetter ]);
            $job->total_applicants = $job->total_applicants + 1;
            $job->save();
            $result['success'] = 'Successfully Applied';
        }else{
            $result['error'] = 'Already Applied';
        }

        return response()->json($result);
    }

    public function get_job_applicants($jobId){
        $job = Job::select('id', 'title', 'job_type_id', 'total_vacancy', 'salary_range', 'application_deadline', 'created_at')->where('id', $jobId)->first();
        $users = $job->users()->where('is_applied', 1)->get(array('users.id', 'name', 'profile_picture', 'email', 'phone'));
        return response()->json(['job' => $job, 'users' => $users]);
    }
    public function delete_job($userId, $jobId){
        $checkAdmin = User::find($userId)->where('role_id', '1')->where('status', '10')->count();
        $job = Job::join('job_user', function($join) use($userId) {
            $join->on('jobs.id', '=', 'job_user.job_id');
        })->select('jobs.*', 'jobs.id as job_id', 'job_user.user_id as creator_id')->find($jobId);
        if($job->creator_id == $userId || $checkAdmin>0){
            $job->delete();
            $result['response'] = 'success';
        }else{
            $result['response'] = 'error';
            $result['message'] = 'You are no supposed to do that';
        }
        return response()->json($result);
    }
}
