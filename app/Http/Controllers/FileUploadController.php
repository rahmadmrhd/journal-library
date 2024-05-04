<?php

namespace App\Http\Controllers;

use App\Models\Journal;
use Illuminate\Contracts\Support\ValidatedData;
use Illuminate\Http\Request;

class FileUploadController extends Controller
{
    public function upload(Request $request)
    {
        $validatedData = $request->validate([
            'file' => 'nullable|mimes:pdf|max:2048',
            'kategori' => 'nullable|in:klirens_etik,persetujuan_responden,dokumen_tambahan',
        ]);


        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $kategori = $request->input('kategori');
            $fileName = $kategori . '_' . time() . '.' . $file->getClientOriginalExtension();
            $file->storeAs('uploads/' . $kategori, $fileName);

            session()->flash('success', 'File Anda berhasil diupload.');
        } else {
            session()->flash('error', 'Silakan masukkan file Anda.');
        }

        Journal::create($validatedData);
        return redirect()->back();
    }
}
