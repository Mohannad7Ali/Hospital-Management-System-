<?php
namespace App\Traits ;

use App\Models\Image;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

trait ImageUploadTrait {

    public function VerifyAndStoreImage($request , $inputname , $foldername , $disk , $imageable_id , $imageable_type){

        if($request->hasfile($inputname)){

            if(!$request->file($inputname)->isValid()){
                //flash('Invalid Image !')->error()->important() ;
                return redirect()->back()->withInput() ;
            }

            $photo = $request->file($inputname) ;
            $name = Str::slug($request->input('name'));
            $filename = $name.'.'.$photo->getClientOriginalExtension() ;

            //insert image in database
            $image = new Image() ;
            $image->filename = $filename ;
            $image->imageable_id = $imageable_id;
            $image->imageable_type = $imageable_type;
            $image->save() ;

            //store image in disk

            return $photo->storeAs($foldername , $filename , $disk) ;

        }
        else{
            return null ;
        }
    }


    public function Delete_Attachment($disk , $path , $filename , $id) {
        $actually_path = $path.'/'.$filename ;
        Storage::disk($disk)->delete($actually_path);
        Image::where('imageable_id' ,$id)->delete();
    }
}
