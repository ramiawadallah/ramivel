<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\File;
use Storage;

class Upload extends Controller
{
    public function delete($id){
        $file = File::find($id);
        if(!empty($file)){
            Storage::delete($file->full_file);
            $file->delete();
        }
    }

    public function upload($data=[]){

    	if(in_array('new_name', $data)){
	    	$new_name = $data['new_name'] === null ?time():$data['new_name'];
	    }

    	if(request()->hasFile($data['file']) && $data['upload_type'] == 'single'){
    		Storage::has($data['delete_file'])?Storage::delete($data['delete_file']):'';
    		return request()->file($data['file'])->store($data['path']);
    	}
    	elseif(request()->hasFile($data['file']) && 'files' == $data['upload_type']){

    		$file 		= request()->file($data['file']); 
    		
    		$size  		= $file->getSize();
    		$mime_type  = $file->getMimeType();
    		$name 		= $file->getClientOriginalName();
    		$hashname 	= $file->hashName();

    		$file->store($data['path']);
    		return File::create([
     			'name' 			=> $name ,
				'size' 			=> $size,
				'file' 			=> $hashname,
				'path' 			=> $data['path'],
				'full_file' 	=> $data['path']. '/' . $hashname ,
				'mime_type' 	=> $mime_type,
				'file_type' 	=> $data['file_type'],
				'relation_id' 	=> $data['relation_id'],
    		]);
 			return $add->id;
    	}
    }
}
