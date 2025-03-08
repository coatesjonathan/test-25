<?php

namespace App\Service;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;

class RickAndMortyService
{
    /**
     * Get all characters
     *
     * @param int $page
     * @return array
     */
    public static function index($page = 1)
    {
        return Cache::remember("characters_page_{$page}", 60, function () use ($page) {
            $response = Http::get(config('services.rickandmorty.base_url') . "/character", ['page' => $page]);

            return $response->json();
        });
    }

    /**
     * Get a character by id
     *
     * @param int $id
     * @return array
     */
    public static function show($id)
    {
        $response = Cache::remember("character_{$id}", 60, function () use ($id) {
            return Http::get(config('services.rickandmorty.base_url') . "/character/{$id}");
        });

        if ($response->failed()) {
            return ['error' => 'Character not found'];
        }

        return $response->json();
    }
}
