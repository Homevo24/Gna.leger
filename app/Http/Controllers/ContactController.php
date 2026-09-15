<?php

namespace App\Http\Controllers;

use App\Mail\ContactReceived;
use App\Models\ContactMessage;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Throwable;

class ContactController extends Controller
{
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email'],
            'message' => ['required', 'string', 'max:2000'],
        ]);

        $contactMessage = ContactMessage::create($validated);

        try {
            Mail::to(config('mail.contact_notification_email'))->send(new ContactReceived($contactMessage));
        } catch (Throwable $e) {
            Log::error('Échec de l\'envoi de la notification de contact.', [
                'contact_message_id' => $contactMessage->id,
                'exception' => $e->getMessage(),
            ]);
        }

        return redirect()
            ->route('articles-contact')
            ->with('status', 'Message envoyé.');
    }
}
