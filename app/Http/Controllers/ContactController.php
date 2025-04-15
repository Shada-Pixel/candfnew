<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'message' => 'required|string'
        ]);

        // Here you can add code to send email, save to database, etc.
        // For now, we'll just redirect back with success message

        return back()->with('success', 'Thank you for your message. We will get back to you soon!');
    }
}
