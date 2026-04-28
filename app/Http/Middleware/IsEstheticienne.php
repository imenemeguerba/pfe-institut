<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class IsEstheticienne
{
    /**
     * Vérifie que l'utilisateur connecté est esthéticienne.
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!$request->user() || !$request->user()->isEstheticienne()) {
            abort(403, 'Accès réservé aux esthéticiennes.');
        }

        return $next($request);
    }
}
