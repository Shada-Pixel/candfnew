<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Mail\ContactFormSubmitted;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'message' => 'required|string'
        ]);

        $contact = Contact::create($validated);

        // Send email to user
        Mail::to($contact->email)->send(new ContactFormSubmitted($contact));

        return response()->json([
            'message' => 'Thank you for contacting us. We will get back to you soon.'
        ]);
    }

    public function index()
    {
        $this->authorize('viewAny', Contact::class);
        $contacts = Contact::latest()->paginate(10);
        return view('admin.contacts.index', compact('contacts'));
    }

    public function show(Contact $contact)
    {
        $this->authorize('view', Contact::class);
        $contact->update(['is_read' => true]);
        return view('admin.contacts.show', compact('contact'));
    }

    public function destroy(Contact $contact)
    {
        $this->authorize('delete', Contact::class);
        $contact->delete();
        return redirect()->route('contacts.index')->with('success', 'Contact message deleted successfully');
    }
}
