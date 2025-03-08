<script setup lang="ts">
import { type Character } from '@/types';
import { Link } from '@inertiajs/vue3';

defineProps<{
    character: Character;
}>();
</script>

<template>
    <div class="flex flex-col rounded-lg shadow-lg overflow-hidden">
        <figure class="relative">
            <Link 
                class="absolute top-0 left-0 w-full h-full block z-2"
                :href="route('character.show', { id: character.id })"></Link>
            <img 
                class="w-full"
                :src="character.image" 
                :alt="character.name" 
                loading="lazy"
            />
        </figure>
        <article class="flex flex-grow flex-col items-between justify-between gap-4 p-4">
            <h2 class="text-3xl font-bold truncate">
                <Link :href="route('character.show', { id: character.id })">{{ character.name }}</Link>
            </h2>
            <div class="space-y-1">
                <p v-if="character.species">{{ `Species: ${character.species}` }}</p>
                <p v-if="character.origin">{{ `Origin: ${character.origin.name}` }}</p>
                <p v-if="character.episode && character.episode.length">{{ `Appears in ${character.episode.length} episodes` }}</p>
            </div>
        </article>
    </div>
</template>
