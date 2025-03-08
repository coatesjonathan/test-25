<script setup lang="ts">
import { Head } from '@inertiajs/vue3';
import { type Character } from '@/types';

const props = defineProps<{
    character: Character
}>();
</script>

<template>
    <Head>
        <title>{{ character.name }}</title>
    </Head>

    <div class="grid grid-cols-12">
        <figure class="col-span-4 relative">
            <img 
                class="w-full"
                :src="character.image" 
                :alt="character.name" 
                loading="lazy"
            />
        </figure>
        <article class="col-span-8 flex flex-col gap-4 p-4">
            <h1 class="text-3xl lg:text-5xl font-bold truncate">{{ character.name }}</h1>
            <div class="space-y-1">
                <p v-if="character.species">{{ `Species: ${character.species}` }}</p>
                <p v-if="character.origin">{{ `Origin: ${character.origin.name}` }}</p>
                <p v-if="character.episode && character.episode.length">{{ `Appears in ${character.episode.length} episodes` }}</p>
            </div>
        </article>
    </div>
</template>
