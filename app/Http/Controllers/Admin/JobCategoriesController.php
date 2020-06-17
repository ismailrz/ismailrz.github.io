<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\JobCategory; use Illuminate\Http\Request;

class JobCategoriesController extends Controller
{
    public function __construct() {
        $this->middleware('auth:api');
    }

    public function index()
    {
        $status = $this->get_status_list('common');
        $jobCategories = JobCategory::orderBy('id', 'desc')->get(); return compact('jobCategories', 'status');
    }


    public function store(Request $request)
    {
        $jobCategory = new JobCategory;
        $jobCategory->title = request('title');
        $jobCategory->descr = request('descr');
        $jobCategory->status = request('status');

        $jobCategory->save();

    }

    public function update(Request $request, JobCategory $jobCategory) {
        $jobCategory->title = request('title');
        $jobCategory->descr = request('descr');
        $jobCategory->status = request('status');
        
        $jobCategory->save();

    }


    public function destroy(JobCategory $jobCategory)
    {
        $jobCategory->delete();
    }
}
