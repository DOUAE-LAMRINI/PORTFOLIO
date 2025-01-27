<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Event;
use Illuminate\Auth\Events\Registered;


// Home Page

Route::get('/', function () {
    return view('home.index');
})->name('portfolio');

// Redirect newly registered users to the home page
Event::listen(Registered::class, function ($event) {
    $event->user->redirectTo = route('portfolio');
});

// Admin Dash

Route::middleware(['auth'])->get('/admin/dashboard', function () {
    // Check if the user is an admin
    if (Auth::user() && Auth::user()->user_type === 'admin') {
        // Fetch messages for the admin dashboard
        $messages = \App\Models\ContactMessage::all();
        return view('admin.dashboard', compact('messages'));
    } else {
        // If the user is not an admin, redirect them to the homepage
        return redirect()->route('portfolio');
    }
})->name('admin.dashboard');



// Contact

Route::get('/contact', function () {
    return view('home/contact');
});
Route::post('messages/contact_form', [ContactController::class, 'CFM'])->name('contact.form');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
