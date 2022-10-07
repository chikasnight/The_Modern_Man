<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Picture;
use Illuminate\Support\Facades\Hash;

class PictureController extends Controller
{
    public function picture(Request $request){
        //validate request body
        $request->validate([
            'image' => ['mimes:png,jpeg,gif,bmp', 'max:2048','required']
            

          
        ]);

        //get the image
        $image = $request->file('image');
        //$image_path = $image->getPathName();
 
        // get original file name and replace any spaces with _
        // example: ofiice card.png = timestamp()_office_card.pnp
        $filename = time()."_".preg_replace('/\s+/', '_', strtolower($image->getClientOriginalName()));
 
        // move image to temp location (tmp disk)
        $tmp = $image->storeAs('uploads/original', $filename, 'tmp');
 
 
        //upload picture
        $picture = Picture::create([
            'image'=> $filename,
            'disk'=> config('site.upload_disk')
           
            
        ]);

        //dispacth job to handle image manipulation
        //$this->dispatch(new UploadImage($picture));

        //return cuccess response

        return response()->json([
            'success'=> true,
            'message'=>'successfully uploaded a picture',
            'data' =>[
                'user'=> $user

            ]
        ]);
    }
    public function editPicture(Request $request, $pictureId){
        $request->validate([
            'image' => ['mimes:png,jpeg,gif,bmp', 'max:2048'],
            
    
        ]);
        
        $picture = Picture::find($pictureId);
        if(!$picture) {
            return response() ->json([
                'success' => false,
                'message' => 'picture not found'
            ]);
    
        }
        $this->authorize('update',$picture);
    
    
        $picture-> image = $request->image;
        $picture->save();
        return response() ->json([
            'success' => true,
            'message' => 'picture updated'
        ]);
    }
}
