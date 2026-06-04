<?php
// app/Http/Controllers/Client/ContactController.php
// (Même fichier pour client ET esthéticienne — même logique)

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\MessageContact;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ContactController extends Controller
{
    public function index(Request $request): View
    {
        $messages = MessageContact::where('user_id', $request->user()->id)
            ->orderByDesc('created_at')
            ->get();

        return view('client.contact.index', compact('messages'));
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'sujet'   => ['required', 'string', 'max:150'],
            'message' => ['required', 'string', 'min:10', 'max:2000'],
        ]);

        $msg = MessageContact::create([
            'user_id' => $request->user()->id,
            'sujet'   => $request->sujet,
            'message' => $request->message,
        ]);

        // Notifier l'admin
        try {
            $admin = User::where('role', 'admin')->first();
            $admin?->notifications()->create([
                'id'      => \Illuminate\Support\Str::uuid(),
                'type'    => 'nouveau_message_contact',
                'data'    => json_encode([
                    'message' => "📩 Nouveau message de {$request->user()->fullName()} : {$request->sujet}",
                ]),
                'read_at' => null,
            ]);
        } catch (\Exception $e) {}

        return back()->with('success', 'Votre message a été envoyé à l\'administration. Nous vous répondrons dans les plus brefs délais.');
    }
}
