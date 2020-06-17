<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class Image extends Model {

    public function imagable(){
        return $this->morphTo();
    }

    // var $uploadPath;
    public $allowedFileTypes = array(
        'image/jpg', 'image/jpeg', 'image/JPG', 'image/JPEG',
        'image/png', 'image/PNG', 'image/gif', 'image/GIF',
        'application/zip',
        'application/octet-stream',
        'application/x-zip-compressed',
        'audio/mpeg','audio/mp3',
        'application/pdf'
    ); 
    
    protected static function _check_file_type($fileData){
        return 'image';
    }

    public static function upload_file($fileData, $userId, $fileName = '', $modelName = '', $createThumb = false){
        $result['response'] = 'success';
        $filePath = 'public/uploads/'.$userId.'/'.$modelName;
        if($fileData && $userId && $modelName){
            if( !Storage::disk('local')->has($filePath) ){
                Storage::disk('local')->makeDirectory($filePath, 755, true);
            }
            $fileType = Image::_check_file_type($fileData);

            if($fileType) {
                switch($fileType) {
                    case 'image':
                        $decodedFile = \Image::make($fileData);
                        $extension = substr($decodedFile->mime, strpos($decodedFile->mime, '/')+1, strlen($decodedFile->mime));
                        $fileName = time().Image::sanitize($fileName).'.'.$extension; //url may get broken without sanitize
                        $fileName = str_replace(' ', '-', $fileName);

                        if( $decodedFile->save( storage_path('app/'.$filePath .'/'. $fileName) ) ){
                            $result['file_name'] = $fileName;

                            if ($createThumb) {
                                $createThumbResponse = Image::create_thumb($fileData, $filePath, $fileName);
                                
                                if($createThumbResponse['response']=='error'){
                                    $result['response'] = 'error';
                                    $result['message'] = 'File upload failed! Thumb creation failed.';
                                    @unlink( storage_path('app/'.$filePath .'/'. $fileName) );
                                }
                            }
                        }else{
                            $result['response'] = 'error';
                            $result['message'] = 'File upload failed!';
                        }
                    break;
    
                    case 'pdf':
                    break;
                }
            }else{
                $result['response'] = 'error';
                $result['message'] = 'Invalid file type! Uploaded file type is not supported';
            }            
        }else{
            $result['response'] = 'error';
            $result['message'] = 'File or user id or model name can not be empty';
        }        
        return $result;
    }

    public static function create_thumb($fileData, $filePath, $fileName, $width = 160, $height = 120) {

        $result['response'] = 'success';

        if( !Storage::disk('local')->has($filePath.'/thumbs') ){
            Storage::disk('local')->makeDirectory($filePath.'/thumbs', 0755, true);
        }

        $arr_image_details = getimagesize(storage_path('app/'.$filePath .'/'. $fileName));
        $original_width = $arr_image_details[0];
        $original_height = $arr_image_details[1];

        $widthHeightRatio = (1.0 * $original_width) / $original_height;

        if($original_height > $original_width && $width > $height){
            $tmpHeight = $height;
            $height = $width;
            $width = $tmpHeight;
        }

        $decodedFile = \Image::make($fileData)->resize($width, $height);
        if( !$decodedFile->save( storage_path('app/'.$filePath .'/thumbs'.'/'. $fileName) ) ){
            $result['response'] = 'error';
            $result['message'] = 'Thumb creation failed! Please try again.';
        }
        return $result;
    }

    public static function sanitize($string, $force_lowercase = false, $onlyAlphaNumeric = false) {
        $strip = array("~", "`", "!", "@", "#", "$", "%", "^", "&", "*", "(", ")", "=", "+", "[", "{", "]",
            "}", "\\", "|", ";", ":", "\"", "'", "&#8216;", "&#8217;", "&#8220;", "&#8221;", "&#8211;", "&#8212;",
            "â€”", "â€“", ",", "<", ">", "/", "?");
        $clean = trim(str_replace($strip, "", strip_tags($string)));
        $clean = preg_replace('/\s+/', "-", $clean);
        $clean = ($onlyAlphaNumeric) ? preg_replace("/[^a-zA-Z0-9]/", "", $clean) : $clean;
        return ($force_lowercase) ?
                (function_exists('mb_strtolower')) ?
                        mb_strtolower($clean, 'UTF-8') :
                        strtolower($clean) :
                $clean;
    }

    public static function save_image_from_description($description) {
        $pattern = '/<img.*?src=".*?"[^\>]+>/';
        preg_match_all($pattern, $description, $matches); 
        $matches = $matches[0]; 
        foreach($matches as $match){ 
            $exploded = explode(" ", $match);
            if(!empty($exploded) && isset($exploded[1])){
                $extension = substr($exploded[1], strpos($exploded[1], '/')+1, strpos($exploded[1], ';')-16);
                $encodedString = substr($exploded[1], strpos($exploded[1], ",")+1, -1);
            }

            $decodedString = base64_decode($encodedString);
            $fileName = Str::random().'.'.$extension;
            $path = public_path().'/testImage/'.$fileName; 
            $subStringedPath = substr($path, strpos($path, "/")+1);
            file_put_contents($subStringedPath, $decodedString);

            $widthInParcent = true;
            if(!empty($exploded)){
                for($i=0; $i<count($exploded); $i++){
                    if(strpos($exploded[$i], "width")){
                        $width = substr($exploded[$i+1], 0, strpos($exploded[$i+1], ';'));
                        if(strpos($width, '%')===false){
                            $widthInParcent = false;
                            $width = str_replace('px', '', $width);
                            break;
                        }else{
                            $width = str_replace('%', '', $width);
                            break;
                        }
                    }
                }
            }

            $imageDetails = getimagesize(public_path($subStringedPath));
            $originalWidth = $imageDetails[0];
            $originalHeight = $imageDetails[1];
            $ratio = $originalWidth / $originalHeight;
            $newWidth = ($width / 100) * $originalWidth;
            if($originalWidth > $originalHeight){
                $newHeight = $newWidth / $ratio;
            } else if($originalWidth < $originalHeight) {
                $newHeight = $newWidth / $ratio;
            } else {
                $newHeight = $newWidth;
            }

            $getExistingImage = file_get_contents($subStringedPath);
            $newImage = \Image::make($getExistingImage)->resize($newWidth, $newHeight);
            Storage::disk('public')->put("/testImage/".$fileName, (string) $newImage->encode());
            unlink($subStringedPath);
            $originalPath = public_path().'/storage/testImage/'.$fileName;
            $newPath = substr($originalPath, strpos($originalPath, "/"));
            $imageSource = str_replace($match, '<img src="'. $newPath .'" />', $match); 

            $replaceStringWithSource = str_replace($match, $imageSource, $description); 
            $description = $replaceStringWithSource;
        }
        return $description;
    }
               
}


