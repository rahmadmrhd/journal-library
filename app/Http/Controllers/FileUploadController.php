<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FileUploadController extends Controller
{
    public function upload(Request $request)
    {
        if ($request->hasFile('file')) {

            session()->flash('success', 'File anda berhasil diupload');
        } else {
            session()->flash('error', 'Silahkan masukkan file anda');
        }

        return redirect()->back();
    }
}
