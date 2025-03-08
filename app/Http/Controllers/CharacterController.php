<?php

namespace App\Http\Controllers;

use App\Service\RickAndMortyService;
use Inertia\Inertia;

class CharacterController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $characters = RickAndMortyService::index();

        return Inertia::render('characters/Index', [
            'characters' => $characters['results'],
            'pagination' => [
                'count' => $characters['info']['count'],
                'pages' => $characters['info']['pages'],
                'next' => $characters['info']['next'],
                'prev' => $characters['info']['prev'],
            ],
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $character = RickAndMortyService::show($id);

        if (isset($character['error'])) {
            return redirect()->route('characters.index')->with('error', $character['error']);
        }

        return Inertia::render('characters/Show', [
            'character' => $character,
        ]);
    }
}
