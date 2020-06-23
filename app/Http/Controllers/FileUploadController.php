<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
    public function fileUploadPost(Request $request)
    {
        $request->validate([

            'type_offre' => ['required', 'string', 'max:255'],
            'file' => 'required|mimes:pdf|max:2048',
        ]);

        $fileName = time().'.'.$request->file->extension();

        $request->file->move(public_path('uploads'), $fileName);
        dd($fileName);

        return back()
            ->with('success','You have successfully upload file.')
            ->with('file',$fileName);

    }
}
