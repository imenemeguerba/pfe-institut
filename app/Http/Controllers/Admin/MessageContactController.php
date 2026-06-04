<?php
// app/Http/Controllers/Admin/MessageContactController.php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MessageContact;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class MessageContactController extends Controller
{
    public function index(Request $request): View
    {
        $filtre = $request->query('filtre', 'tous');

        $query = MessageContact::with('user')->orderByDesc('created_at');

        if ($filtre === 'non_lus')   $query->where('lu', false);
        if ($filtre === 'repondus')  $query->whereNotNull('reponse_admin');
        if ($filtre === 'en_attente') $query->whereNull('reponse_admin');

        $messages = $query->paginate(15)->withQueryString();

        $counts = [
            'tous'       => MessageContact::count(),
            'non_lus'    => MessageContact::where('lu', false)->count(),
            'en_attente' => MessageContact::whereNull('reponse_admin')->count(),
            'repondus'   => MessageContact::whereNotNull('reponse_admin')->count(),
        ];

        return view('admin.messages-contact.index', compact('messages', 'filtre', 'counts'));
    }

    public function show(MessageContact $messagesContact): View
    {
        // Marquer comme lu
        if (!$messagesContact->lu) {
            $messagesContact->update(['lu' => true]);
        }

        return view('admin.messages-contact.show', compact('messagesContact'));
    }

    public function repondre(Request $request, MessageContact $messagesContact): RedirectResponse
    {
        $request->validate([
            'reponse_admin' => ['required', 'string', 'min:5', 'max:2000'],
        ]);

        $messagesContact->update([
            'reponse_admin' => $request->reponse_admin,
            'repondu_at'    => now(),
        ]);

        // Notifier l'utilisateur
        try {
            $messagesContact->user->notifications()->create([
                'id'      => \Illuminate\Support\Str::uuid(),
                'type'    => 'reponse_contact',
                'data'    => json_encode([
                    'message' => "💬 L'administration a répondu à votre message : {$messagesContact->sujet}",
                ]),
                'read_at' => null,
            ]);
        } catch (\Exception $e) {}

        return back()->with('success', 'Réponse envoyée avec succès.');
    }

    public function destroy(MessageContact $messagesContact): RedirectResponse
    {
        $messagesContact->delete();
        return redirect()->route('admin.messages-contact.index')
            ->with('success', 'Message supprimé.');
    }
}
