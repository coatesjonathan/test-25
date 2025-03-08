<script setup lang="ts">
import { Head } from '@inertiajs/vue3';
import Character from '@/partials/Character.vue';

const props = defineProps({
    characters: Object,
    pagination: Array,
})
</script>

<template>
    <Head>
        <title>Rick and Morty Characters</title>
    </Head>
    
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6 p-6">
        <Character 
            v-for="character in characters"
            :key="character.id"
            :character="character"
        />
    </div>
</template>
