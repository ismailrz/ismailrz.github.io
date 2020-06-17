<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\Policy;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use App\Models\Image;
use App\Models\Visitor;

class PoliciesController extends Controller
{
    public function view()
    {
        return view('policies.index');
    }

    
    public function index()
    {
        $statuses = $this->get_status_list('policy');
        $policies =  Policy::orderby('id', 'DESC')->paginate(5);
        return compact('policies', 'statuses');
    }

    public function store(Request $request)
    {
        // $this->validate($request, array(
        //     'title' => 'required|max:255',
        //     'unique_code'  => 'required|unique:policies',
        // ));
        $policy = new Policy;
        $policy->title = $request->title;

        // $description = $request->descr;
        $description = Image::save_image_from_description($request->descr);
        //  dd($description);
        // $pattern = '/<img.*?src=".*?"[^\>]+>/';
        // preg_match_all($pattern, $description, $matches); 
        // $matches = $matches[0]; 
        // foreach($matches as $match){ 
        //     $exploded = explode(" ", $match);
        //     if(!empty($exploded) && isset($exploded[1])){
        //         $extension = substr($exploded[1], strpos($exploded[1], '/')+1, strpos($exploded[1], ';')-16);
        //         $encodedString = substr($exploded[1], strpos($exploded[1], ",")+1, -1);
        //     }

        //     $decodedString = base64_decode($encodedString);
        //     $fileName = Str::random().'.'.$extension;
        //     $path = public_path().'/testImage/'.$fileName; 
        //     $subStringedPath = substr($path, strpos($path, "/")+1);
        //     file_put_contents($subStringedPath, $decodedString);

        //     $widthInParcent = true;
        //     if(!empty($exploded)){
        //         for($i=0; $i<count($exploded); $i++){
        //             if(strpos($exploded[$i], "width")){
        //                 $width = substr($exploded[$i+1], 0, strpos($exploded[$i+1], ';'));
        //                 if(strpos($width, '%')===false){
        //                     $widthInParcent = false;
        //                     $width = str_replace('px', '', $width);
        //                     break;
        //                 }else{
        //                     $width = str_replace('%', '', $width);
        //                     break;
        //                 }
        //             }
        //         }
        //     }

        //     $imageDetails = getimagesize(public_path($subStringedPath));
        //     $originalWidth = $imageDetails[0];
        //     $originalHeight = $imageDetails[1];
        //     $ratio = $originalWidth / $originalHeight;
        //     $newWidth = ($width / 100) * $originalWidth;
        //     if($originalWidth > $originalHeight){
        //         $newHeight = $newWidth / $ratio;
        //     } else if($originalWidth < $originalHeight) {
        //         $newHeight = $newWidth / $ratio;
        //     } else {
        //         $newHeight = $newWidth;
        //     }

        //     $getExistingImage = file_get_contents($subStringedPath);
        //     $newImage = \Image::make($getExistingImage)->resize($newWidth, $newHeight);
        //     Storage::disk('public')->put("/testImage/".$fileName, (string) $newImage->encode());
        //     unlink($subStringedPath);
        //     $originalPath = public_path().'/storage/testImage/'.$fileName;
        //     $newPath = substr($originalPath, strpos($originalPath, "/"));
        //     $imageSource = str_replace($match, '<img src="'. $newPath .'" />', $match); 

        //     $replaceStringWithSource = str_replace($match, $imageSource, $description); 
        //     $description = $replaceStringWithSource;
        // }

        $policy->descr = $description;        
        $policy->unique_code = $request->unique_code;
        $policy->user_id = $request->user_id;
        $policy->applicable_from = $request->applicable_from;
        $policy->status = $request->status;
        $policy->save();             
        $result['response'] = "success";						
        $result['message'] = "successfully added";
        return response()->json($result);
    }

    public function show(Policy $policy_index)
    {
        $statuses = $this->get_status_list('policy');
        return compact ('policy_index', 'statuses');
    }

    public function update(Request $request, Policy $policy_index)
    {
        $policy_index->title = $request->title;
        $description = Image::save_image_from_description($request->descr);
        $policy_index->descr = $description;
        $policy_index->applicable_from = $request->applicable_from;
        $policy_index->status = $request->status;
        $policy_index->update();
        $result['response'] = "success";						
        $result['message'] = "successfully added";
        return response()->json($result);
    }

    public function destroy(Policy $policy_index)
    {
        $policy_index->delete();
    }
}
