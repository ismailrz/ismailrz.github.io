<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\PostCategory;
use Illuminate\Http\Request;

class PostCategoriesController extends Controller
{
    public function __construct(){
        $this->middleware('auth:api');
    }
    
    public function view()
    {
        return view('post-categories.index');
    }

    public function index()
    {
        $status = $this->get_status_list('common');
        
        $postCategories =  PostCategory::orderBy('id', 'desc')->paginate(5);

        foreach ($postCategories as $key => $value) {            
            $postCategories[$key]->status = $status[$value->status];
        }
        
        return compact('postCategories', 'status');
        //dd($status);
    }

    public function store(Request $request)
    {
        return PostCategory::create($request->all());
    }

    public function show(PostCategory $postCategory)
    {
        return $postCategory;
    }

    public function update(Request $request, PostCategory $postCategory)
    {
        $postCategory->update($request->all());
        return $postCategory;
    }

    public function destroy(PostCategory $postCategory)
    {
        $postCategory->delete();
        return 204;
    }

}
