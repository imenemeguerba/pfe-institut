<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Services\FideliteService;
use Illuminate\Http\Request;
use Illuminate\View\View;

class FideliteController extends Controller
{
    public function index(Request $request): View
    {
        $client = $request->user();
        $infos  = FideliteService::infos($client);

        return view('client.fidelite.index', compact('infos', 'client'));
    }
}
