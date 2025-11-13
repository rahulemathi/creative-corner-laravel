<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;
use App\Mail\ContactFormMail;

class ContactController extends Controller
{
    public function send(Request $request)
    {
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:20',
            'subject' => 'required|string|in:general,order,product,support,feedback',
            'message' => 'required|string|min:10|max:1000',
        ]);

        $contactData = [
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'phone' => $request->phone,
            'subject' => $request->subject,
            'message' => $request->message,
        ];

        try {
            // Send email to admin
            Mail::to('manhitha.memories@gmail.com')->send(new ContactFormMail($contactData));
            
            // Return JSON response for AJAX or redirect for regular form submission
            if ($request->expectsJson()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Thank you for your message! We\'ll get back to you within 24 hours.'
                ]);
            }

            return redirect()->back()->with('success', 'Thank you for your message! We\'ll get back to you within 24 hours.');
            
        } catch (\Exception $e) {
            Log::error('Contact form error: ' . $e->getMessage());
            
            if ($request->expectsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Sorry, there was an error sending your message. Please try again or contact us directly.'
                ], 500);
            }

            return redirect()->back()
                ->with('error', 'Sorry, there was an error sending your message. Please try again or contact us directly.')
                ->withInput();
        }
    }
}