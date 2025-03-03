<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\Response;

class NoticeController extends Controller
{
    public function indexo()
    {
        // Debug the files in the directory
        $files = Storage::files('public/notices');
        dd($files); // Check the output

        // Map the files to get only the filenames
        $notices = collect($files)
            ->map(function ($file) {
                return basename($file);
            });

        return view('notices.index', compact('notices'));
    }

    public function index()
    {
        // Get all PDF files from the directory
        $files = glob(storage_path('app/public/notices/*.pdf'));

        // Extract only the filenames
        $notices = collect($files)
            ->map(function ($file) {
                return basename($file);
            });

        return view('notices.index', compact('notices'));
    }


    public function show($filename)
    {
        // Path to the PDF file
        $path = storage_path('app/public/notices/' . $filename);

        // Check if the file exists
        if (!file_exists($path)) {
            abort(404, 'File not found.');
        }

        // For viewing the PDF in the browser
        return response()->file($path);

        // For downloading the PDF
        // return response()->download($path);
    }



    public function store(Request $request)
    {
        $request->validate([
            'notice' => 'required|mimes:pdf|max:2048',
        ]);

        $file = $request->file('notice');
        $filename = $file->getClientOriginalName();
        $file->storeAs('public/notices', $filename);

        return redirect()->route('notices.index')->with('success', 'Notice uploaded successfully.');
    }
}