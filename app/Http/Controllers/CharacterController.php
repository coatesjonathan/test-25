<?php

namespace App\Http\Controllers;

use App\Service\RickAndMortyService;
use Illuminate\Http\Request;
use Inertia\Inertia;

class CharacterController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $request->validate([
            'page' => 'integer|min:1',
            'name' => 'nullable|string',
            'status' => 'nullable|string',
            'species' => 'nullable|string',
            'type' => 'nullable|string',
            'gender' => 'nullable|string',
        ]);
        
        $characters = RickAndMortyService::index(
            $request->get('page', 1),
            $request->only([
                'name', 
                'status', 
                'species',
                'type',
                'gender'
            ])
        );

        return Inertia::render('characters/Index', [
            'characters' => isset($characters['results']) ? $characters['results'] : [],
            'filters' => $request->only([
                'name', 
                'status', 
                'species',
                'type',
                'gender'
            ]),
            'pagination' => [
                'current' => (int)$request->get('page', 1),
                'count' => isset($characters['info']) ? $characters['info']['count'] : 1,
                'pages' => isset($characters['info']) ? $characters['info']['pages'] : 1,
                'next' => isset($characters['info']) ? (int)str_replace(config('services.rickandmorty.base_url')."/character?page=", "", $characters['info']['next']) : 0,
                'prev' => isset($characters['info']) ? (int)str_replace(config('services.rickandmorty.base_url')."/character?page=", "", $characters['info']['prev']) : 0,
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
            abort(404, $character['error']);
        }

        return Inertia::render('characters/Show', [
            'character' => $character,
        ]);
    }
}
