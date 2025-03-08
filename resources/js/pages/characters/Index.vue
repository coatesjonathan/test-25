<script setup lang="ts">
import { Head, router, Link } from '@inertiajs/vue3';
import Character from '@/partials/Character.vue';
import { type Pagination } from '@/types';
import { computed, reactive } from 'vue';

const props = defineProps<{
    characters: Record<string, any>,
    filters: Record<string, any>,
    pagination: Pagination,
}>();

const filters = reactive({
    page: 1,
    name: '',
    status: '',
    species: '',
    type: '',
    gender: '',
    ...props.filters
})

const filteredFilters = computed(() => {
    return Object.fromEntries(
        Object.entries(filters).filter(([key, value]) => value !== '')
    );
});

function filterCharacters() {
    router.get(route('home'), filteredFilters.value);
}

function resetFilters() {
    filters.page = 1;
    filters.name = '';
    filters.status = '';
    filters.species = '';
    filters.type = '';
    filters.gender = '';

    filterCharacters();
}
</script>

<template>
    <Head>
        <title>Rick and Morty Characters</title>
    </Head>
    
    <form 
        @submit.prevent="filterCharacters"
        method="GET" 
        :action="route('home')" 
        class="p-6 grid sm:grid-cols-2 md:grid-cols-4 gap-4">
        <input
            v-model="filters.name"
            type="text"
            name="name"
            placeholder="Search by name"
            class="p-2 border border-gray-300 rounded"
        />
        <select
            v-model="filters.status"
            name="status"
            class="p-2 border border-gray-300 rounded"
        >
            <option value="" disabled>Select status</option>
            <option value="alive">Alive</option>
            <option value="dead">Dead</option>
            <option value="unknown">Unknown</option>
        </select>
        <select
            v-model="filters.species"
            name="species"
            class="p-2 border border-gray-300 rounded"
        >
            <option value="" disabled>Select species</option>
            <option value="human">Human</option>
            <option value="alien">Alien</option>
            <option value="robot">Robot</option>
            <option value="mytholog">Mytholog</option>
            <option value="humanoid">Humanoid</option>
            <option value="poopybutthole">Poopybutthole</option>
            <option value="animal">Animal</option>
            <option value="cronenberg">Cronenberg</option>
            <option value="disease">Disease</option>
            <option value="unknown">Unknown</option>
        </select>
        <select
            v-model="filters.type"
            name="type"
            class="p-2 border border-gray-300 rounded"
        >
            <option value="" disabled>Select type</option>
            <option value="human">Human</option>
            <option value="alien">Alien</option>
            <option value="robot">Robot</option>
            <option value="mytholog">Mytholog</option>
            <option value="humanoid">Humanoid</option>
            <option value="poopybutthole">Poopybutthole</option>
            <option value="animal">Animal</option>
            <option value="cronenberg">Cronenberg</option>
            <option value="disease">Disease</option>
            <option value="unknown">Unknown</option>
        </select>
        <select
            v-model="filters.gender"
            name="gender"
            class="p-2 border border-gray-300 rounded"
        >
            <option value="" disabled>Select gender</option>
            <option value="female">Female</option>
            <option value="male">Male</option>
            <option value="genderless">Genderless</option>
            <option value="unknown">Unknown</option>
        </select>
        <button 
            type="submit" 
            class="p-2 bg-blue-500 text-white rounded">Search</button>
        <button 
            v-if="Object.keys(filteredFilters).length > 1"
            type="button" 
            @click="resetFilters" 
            class="p-2 bg-gray-300 text-gray-800 rounded">Reset</button>
    </form>
    
    <div 
        v-if="characters && characters.length"
        class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6 p-6">
        <Character 
            v-for="character in characters"
            :key="character.id"
            :character="character"
        />
    </div>
    <div v-else>
        <p class="p-6 text-center">No characters found</p>
    </div>

    <nav 
        v-if="pagination.pages > 1"
        class="flex items-center justify-between gap-4 p-6">
        <div class="flex items-center gap-4">
            <span>Page {{ pagination.current }} of {{ pagination.pages }}</span>
        </div>
        <div class="flex items-center justify-center gap-4">
            <Link 
                v-if="pagination.prev"
                :href="route('home', {
                    ...filteredFilters,
                    page: pagination.prev
                })"
                preserve-scroll
                class="p-2 bg-blue-500 text-white rounded">Previous</Link>
            <Link
                v-if="pagination.next"
                :href="route('home', {
                    ...filteredFilters,
                    page: pagination.next
                })"
                preserve-scroll
                class="p-2 bg-blue-500 text-white rounded">Next</Link>
        </div>
    </nav>
</template>
