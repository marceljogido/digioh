<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactFormSubmitted;
use Illuminate\Support\Facades\Log;

class ContactController extends Controller
{
	public function store(Request $request)
	{
        $validated = $request->validate([
            'name' => ['required','string','max:100','min:2'],
            'email' => ['required','email','max:150'],
            'subject' => ['nullable','string','max:150'],
            'message' => ['required','string','min:10'],
            'website' => ['nullable','string','max:100'], // honeypot
        ]);

        if ($request->filled('website')) {
            return back()->with('flash_success', 'Terima kasih!');
        }

        Message::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'subject' => $validated['subject'] ?? null,
            'message' => $validated['message'],
            'ip' => $request->ip(),
            'hp' => '',
        ]);

        // Send Email Notification
        try {
            $recruitEmail = setting('contact_email') ?? config('mail.from.address');
            if ($recruitEmail) {
                Mail::to($recruitEmail)->send(new ContactFormSubmitted($validated));
            }
        } catch (\Exception $e) {
            Log::error('Contact Form Email Failed: ' . $e->getMessage());
        }

        return back()->with('flash_success', 'Pesan berhasil dikirim. Terima kasih!');
	}
}


