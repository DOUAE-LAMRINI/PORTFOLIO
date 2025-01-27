<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ContactMessage;

class ContactController extends Controller
{
    public function dashboard()
    {
        $contacts = ContactMessage::all();
        return view('admin.dashboard', compact('contacts'));
    }

    public function index()
    {
        return view('home.index');
    }

    public function CFM(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'message' => 'required|string',
        ]);

        ContactMessage::create([
            'name' => $request->name,
            'email' => $request->email,
            'message' => $request->message,
        ]);

        return redirect()->back()->with('success', 'Thank you! We have received your message.');
    }
}
