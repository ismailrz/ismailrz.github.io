<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\Post;
use App\Models\Event;
use App\Models\Job;

class FeedsController extends Controller
{
   public function __construct(){
     // $this->middleware('auth:api');
   }

   public function get_feeds(Request $request){
      $userId = $request->id;
      $limit = $request->limit;
      $page = $request->page;
      $statuses = $this->get_status_list('post_visibility_status');
      $posts = Post::get_posts($userId, $limit, $page);
      $events = Event::get_events($userId, $limit, $page);
      $jobs = Job::get_jobs($userId, $limit, $page);
      return response()->json(['posts' => $posts, 'events' => $events, 'jobs' => $jobs, 'statuses' => $statuses]);
   }
}
