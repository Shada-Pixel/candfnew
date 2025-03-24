<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class NoticeController extends Controller
{

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
        // Validate the request
        $request->validate([
            'notice' => 'required|mimes:pdf|max:2048',
        ]);

        // Get the uploaded file
        $file = $request->file('notice');

        // Store the file
        $filename = $file->getClientOriginalName(); // Use the original file name
        $file->storeAs('public/notices', $filename);

        // Redirect with success message
        return redirect()->route('adminnotices')->with('success', 'Notice uploaded successfully.');
    }

    public function destroy($filename)
    {
        $path = storage_path('app/public/notices/' . $filename);

        if (!file_exists($path)) {
            abort(404, 'File not found.');
        }

        unlink($path);

        return redirect()->route('adminnotices')->with('success', 'Notice deleted successfully.');
    }

    public function adminnotice()
    {
        // Get all PDF files from the directory
        $files = glob(storage_path('app/public/notices/*.pdf'));

        // Extract only the filenames
        $notices = collect($files)
            ->map(function ($file) {
                return basename($file);
            });

        return view('admin.notices.index', compact('notices'));
    }
}
