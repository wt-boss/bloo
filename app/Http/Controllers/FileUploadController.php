<?php

namespace App\Http\Controllers;

use App\Cv;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use League\CommonMark\Block\Element\Document;

class FileUploadController extends Controller
{
    public function fileUpload()
    {
        return view('fileUpload');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function cv(Request $request)
    {
      
        
            $this->validate($request, [

                'filename' => 'required',
                'filename.*' => 'mimes:doc,pdf,docx,zip'

        ]);
        
        
        if($request->hasfile('filename'))
         {

            foreach($request->file('filename') as $file)
            {
                $name=$file->getClientOriginalName();
                $file->move(public_path().'/files/', $name);  
                $data[] = $name;  
            }
         }

         $file= new Cv();
         $file->name_cv = $request->name_cv;
         $file->filename=json_encode($data);
         
         
        
        $file->save();

        return back()->with('success', 'Your files has been successfully added');
    
    }
}
