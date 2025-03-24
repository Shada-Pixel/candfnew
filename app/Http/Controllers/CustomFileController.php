<?php

namespace App\Http\Controllers;

use App\Models\CustomFile;
use App\Http\Requests\StoreCustomFileRequest;
use App\Http\Requests\UpdateCustomFileRequest;

class CustomFileController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Retrieve all CustomFile records from the database
        $customFiles = CustomFile::all();

        // Return a view with the list of CustomFiles
        return view('admin.customfiles.index', compact('customFiles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Return a view to display the form for creating a new CustomFile
        return view('admin.customfiles.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCustomFileRequest $request)
    {
        // Define the path to the Excel file in the public folder
        $filePath = public_path('your-file.xlsx');

        // Check if the file exists
        if (!file_exists($filePath)) {
            return redirect()->back()->with('error', 'File not found in the public folder.');
        }

        // Use Maatwebsite Excel to read the file
        $data = \Maatwebsite\Excel\Facades\Excel::toArray([], $filePath);

        // Loop through the data and save it to the database
        foreach ($data[0] as $row) {
            CustomFile::create([
                'column1' => $row[0], // Replace 'column1' with your actual database column name
                'column2' => $row[1], // Replace 'column2' with your actual database column name
                // Add more columns as needed
            ]);
        }

        // Redirect back with a success message
        return redirect()->route('customfiles.index')->with('success', 'Data imported successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(CustomFile $customFile)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(CustomFile $customFile)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCustomFileRequest $request, CustomFile $customFile)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CustomFile $customFile)
    {
        //
    }
}
