<template>
    <app-layout>

    <div class="flex flex-col gap-8">
        <!-- Header -->
        <section class="flex justify-between items-center">
            <!-- Title -->
            <div class="font-bold leading-7 text-gray-900 sm:text-3xl sm:truncate">
                <h1>Characters</h1>
            </div>

            <!-- Create Character -->
            <div>
                <button type="button" @click="isCreateModalOpen = true" class="px-3 py-1 text-green-800 flex items-center gap-2 border border-green-500 transition-colors rounded-md bg-green-300 hover:bg-green-400">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" /></svg>
                    <span>Create Character</span>
                </button>
            </div>
        </section>

        <!-- Body -->
        <section>

            <!-- Character List -->
            <ul class="grid grid-cols-1 gap-6 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4">

                <!-- Boxes -->
                <li v-for="character in characters" :key="character.id" @click="showCharacter(character.id)"
                    class="col-span-1 flex flex-col text-center bg-white rounded-lg shadow divide-y divide-gray-200 border transition-all cursor-pointer hover:border-indigo-500 hover:shadow-xl"
                >
                    <div class="flex-1 flex flex-col p-8">

                        <!-- Image -->
                        <div class="w-32 h-32 flex-shrink-0 mx-auto bg-white rounded-full overflow-hidden shadow-lg">
                            <img class="object-contain min-w-full min-h-full"
                                :src="character.thumb_url ? character.thumb_url : 'https://images.unsplash.com/photo-1494790108377-be9c29b29330?ixlib=rb-1.2.1&ixqx=ZsrCV912yo&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=4&w=256&h=256&q=60'"
                            />
                        </div>

                        <!-- Alias -->
                        <h3 class="mt-6 text-gray-900 text-md font-semibold">{{character.alias}}</h3>

                        <!-- Real Name -->
                        <p class="text-gray-500 text-xs font-light">{{character.real_name}}</p>

                        <!-- Further Info -->
                        <dl class="mt-1 flex-grow flex flex-col justify-between">

                            <!-- Type -->
                            <dd class="text-gray-500 text-sm">{{character.type}}</dd>

                            <!-- Morality -->
                            <dd class="mt-3">
                                <span class="px-2 py-1 text-sm font-medium rounded-full capitalize"
                                    v-bind:class="
                                        (character.morality == 'hero') ? 'bg-green-100 text-green-800' :
                                        (character.morality == 'evil') ? 'bg-red-100 text-red-800' :
                                        (character.morality == 'neutral') ? 'bg-gray-100 text-gray-800' :
                                        (character.morality == 'anti-hero') ? 'bg-blue-100 text-blue-800' :
                                        (character.morality == 'anti-villain') ? 'bg-purple-100 text-purple-800' :
                                        'bg-black text-white'
                                    "
                                >
                                    {{character.morality}}
                                </span>
                            </dd>
                        </dl>
                    </div>
                </li>
            </ul>

        </section>

        <!-- Modal -->
        <section v-if="isCreateModalOpen" class="fixed z-10 inset-0 overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
            <div class="flex items-end justify-center min-h-screen h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
                <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true" @click="isCreateModalOpen = false"></div>

                <!-- Centering -->
                <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>

                <!-- Body -->
                <div class="inline-block h-5/6 align-bottom bg-white rounded-lg px-4 pt-5 pb-4 text-left overflow-y-scroll shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-7xl sm:w-full sm:p-6">
                    <div class="flex items-start">
                        <div class="mt-3 text-center sm:mt-0 sm:text-left w-full flex flex-col gap-4">

                            <!-- Title -->
                            <h3 class="text-lg leading-6 font-medium text-gray-900" id="modal-title">
                                Create New Character
                            </h3>

                            <!-- Form -->
                            <form class="rounded-xl px-2 py-4 w-full grid grid-cols-2 gap-8" @submit.prevent="createCharacter">

                                <!-- Left Side -->
                                <div class="col-span-1 flex flex-col gap-3">
                                    <!-- Alias * -->
                                    <div class="flex flex-col gap-1">
                                        <label for="alias">Alias</label>
                                        <input name="alias" type="text" required v-model="character.alias" autocomplete="off" class="rounded-md" placeholder="Character alias...">
                                    </div>

                                    <!-- Real Name -->
                                    <div class="flex flex-col gap-1">
                                        <label for="realName">Real Name</label>
                                        <input name="realName" type="text" v-model="character.real_name" autocomplete="off" class="rounded-md" placeholder="Character's real name (optional)...">
                                    </div>

                                    <!-- Sex * -->
                                    <div class="flex flex-col gap-1">
                                        <label for="sex">Sex</label>
                                        <select name="sex" v-model="character.sex" class="rounded-md text-black" required>
                                            <option disabled hidden value="0" selected>Select sex...</option>
                                            <option v-for="(sex, key) in sexTypes" :key="key" :value="sex" selected>{{capitalise(sex)}}</option>
                                        </select>
                                    </div>

                                    <!-- Image * -->
                                    <div class="flex flex-col gap-1">
                                        <label for="image">Image</label>
                                        <input name="image" type="text" required v-model="character.thumb_url" autocomplete="off" class="rounded-md" placeholder="Image URL..." id="helo-world">
                                    </div>

                                    <!-- Morality * -->
                                    <div class="flex flex-col gap-1">
                                        <label for="morality">Morality</label>
                                        <select name="morality" v-model="character.morality" class="rounded-md text-black" required>
                                            <option disabled hidden value="0" selected>Select morality...</option>
                                            <option v-for="(morality, key) in moralityTypes" :key="key" :value="morality" selected>{{capitalise(morality)}}</option>
                                        </select>
                                    </div>

                                    <!-- Character Type * -->
                                    <div class="flex flex-col gap-1" v-if="characterTypes.length > 0">
                                        <label for="type">Character Type</label>
                                        <select name="type" v-model="character.type_id" class="rounded-md text-black" required>
                                            <option disabled hidden selected value="0">Select type...</option>
                                            <option v-for="(type, key) in characterTypes" :key="key" :value="type.id" selected>{{type.type}}</option>
                                        </select>
                                    </div>
                                </div>

                                <!-- Right Side -->
                                <div class="col-span-1 flex flex-col gap-6">
                                    <!-- Character Skills * -->
                                    <div class="flex flex-col gap-2">
                                        <!-- Header -->
                                        <section>
                                            <label for="skills" class="block font-medium text-gray-700 whitespace-nowrap col-span-1 my-auto">Skills</label>
                                        </section>

                                        <!-- Body -->
                                        <section class="border border-gray-300 shadow-md rounded-md p-2 grid grid-cols-2 gap-4 max-h-48 overflow-y-scroll">
                                            <!-- Left Column -->
                                            <div v-for="skill in character.skills" :key="skill.id" class="col-span-2 flex flex-col pl-3">
                                                <div class="flex items-center justify-between">
                                                    <label for="durability">{{skill.title}}</label>
                                                    <input name="durability" v-model="skill.value" class="text-sm rounded-md w-16" type="number" max="10" min="0" step="1">
                                                </div>
                                            </div>

                                        </section>
                                    </div>

                                    <!-- Character Traits * -->
                                    <div class="flex flex-col gap-2">

                                        <!-- Header -->
                                        <section class="grid grid-cols-2 w-full">
                                            <!-- Title -->
                                            <label for="traits" class="block font-medium text-gray-700 whitespace-nowrap col-span-1 my-auto">Traits</label>

                                            <!-- Search Bar -->
                                            <div class="col-span-1 my-auto flex justify-between items-center rounded-md bg-gray-50 border-0 relative w-full">
                                                <input type="text" v-model="traitsSearch" class="w-full transition-colors border-0 bg-transparent rounded-md focus:bg-red-50 text-sm" placeholder="Search traits..." />
                                                <svg xmlns="http://www.w3.org/2000/svg" class="absolute right-2 my-auto h-4 w-4 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" /></svg>
                                            </div>
                                        </section>

                                        <!-- Body -->
                                        <section class="border border-gray-300 shadow-md rounded-md p-2 flex flex-col gap-2 max-h-48 overflow-y-scroll">
                                            <!-- Trait List -->
                                            <div v-if="traits.length > 0" class="flex flex-wrap gap-2">
                                                <span v-for="trait in traits" :key="trait.id" v-on="selectedTraitIds.includes(trait.id) ? {click: () => removeSelectedTrait(trait)} : {click: () => addSelectedTrait(trait)}" class="transition-colors px-2 py-0.5 rounded-full whitespace-nowrap cursor-pointer text-sm" :class="selectedTraitIds.includes(trait.id) ? 'bg-green-400 text-green-100 hover:bg-green-500' : 'bg-red-400 hover:bg-red-500 text-red-100'">
                                                    <div>{{trait.name}}</div>
                                                </span>
                                            </div>
                                            <div v-else class="flex justify-center py-3 bg-gray-50 text-gray-400 font-bold rounded-md w-full">
                                                No results found
                                            </div>
                                        </section>
                                    </div>

                                    <!-- Associated Movies * -->
                                    <div class="flex flex-col gap-2">
                                        <!-- Header -->
                                        <section class="grid grid-cols-2 w-full">
                                            <!-- Title -->
                                            <label for="movies" class="block font-medium text-gray-700 whitespace-nowrap col-span-1 my-auto">Associated Movies</label>
                                            
                                            <!-- Search Bar -->
                                            <div class="col-span-1 my-auto flex justify-between items-center rounded-md bg-gray-50 border-0 relative w-full">
                                                <input type="text" v-model="moviesSearch" class="w-full transition-colors border-0 bg-transparent rounded-md focus:bg-red-50 text-sm" placeholder="Search movies..." />
                                                <svg xmlns="http://www.w3.org/2000/svg" class="absolute right-2 my-auto h-4 w-4 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" /></svg>
                                            </div>
                                        </section>

                                        <!-- Body -->
                                        <section class="border border-gray-300 shadow-md rounded-md p-2 flex flex-col gap-2 max-h-48 overflow-y-scroll">
                                            <!-- Movie List -->
                                            <div v-if="movies.length > 0" class="flex flex-wrap gap-2">
                                                <span v-for="movie in movies" :key="movie.id" v-on="selectedMovieIds.includes(movie.id) ? {click: () => removeSelectedMovie(movie)} : {click: () => addSelectedMovie(movie)}" class="transition-colors px-2 py-0.5 rounded-full whitespace-nowrap cursor-pointer text-sm" :class="selectedMovieIds.includes(movie.id) ? 'bg-green-400 text-green-100 hover:bg-green-500' : 'bg-red-400 hover:bg-red-500 text-red-100'">
                                                    <div>{{movie.title}}</div>
                                                </span>
                                            </div>
                                            <!-- No Results -->
                                            <div v-else class="flex justify-center py-3 bg-gray-50 text-gray-400 font-bold rounded-md w-full">
                                                No results found
                                            </div>
                                        </section>
                                    </div>

                                </div>

                                <button type="submit" class="absolute transition-all top-4 right-4 px-3 py-1.5 bg-purple-400 rounded-md text-purple-50 hover:bg-purple-500 hover:shadow-md">Confirm</button>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

    </app-layout>
</template>

<script>
    import AppLayout from '@/Layouts/AppLayout';
    import { ref } from 'vue';
    import axios from 'axios';

    export default {
        setup() {
            const isCreateModalOpen = ref(false);

            return {
                isCreateModalOpen
            }
        },
        computed: {
            selectedTraitIds: function() {
                const idArray = [];
                for (let i = 0; i < this.selectedTraits.length; i++) {
                    idArray.push(this.selectedTraits[i].id);
                }

                return idArray;
            },
            selectedMovieIds: function() {
                const idArray = [];
                for (let i = 0; i < this.selectedMovies.length; i++) {
                    idArray.push(this.selectedMovies[i].id);
                }

                return idArray;
            }
        },
        data() {
            return {
                characters: [],
                character: {
                    id: '',
                    alias: '',
                    real_name: '',
                    sex: 0,
                    thumb_url: '',
                    morality: 0,
                    type_id: 0,
                    skills: [
                        {id: 1, title: "Durability", value: 0},
                        {id: 2, title: "Energy Projection", value: 0},
                        {id: 3, title: "Fighting Skills", value: 0},
                        {id: 4, title: "Intelligence", value: 0},
                        {id: 5, title: "Speed", value: 0},
                        {id: 6, title: "Strength", value: 0},
                    ],
                    movies: [],
                    traits: []
                },

                characterTypes: [],
                moralityTypes: [
                    'anti-hero',
                    'anti-villain',
                    'evil',
                    'hero',
                    'neutral',
                    'unknown'
                ],
                sexTypes: [
                    'female',
                    'male',
                    'none',
                    'unknown'
                ],

                allTraits: [],
                traits: [],
                traitsSearch: null,
                selectedTraits: [],
                
                allMovies: [],
                movies: [],
                moviesSearch: null,
                selectedMovies: [],

                pagination: {},
                edit: false
            }
        },
        components: {
            AppLayout,
        },
        created() {
            this.fetchCharacters(),
            this.fetchTypes(),
            this.fetchTraits(),
            this.fetchMovies()
        },
        methods: {

            initialCharacterState: function() {
                return this.character = {
                    id: '',
                    alias: '',
                    real_name: '',
                    sex: 0,
                    thumb_url: '',
                    morality: 0,
                    type_id: 0,
                    skills: [
                        {id: 1, title: "Durability", value: 0},
                        {id: 2, title: "Energy Projection", value: 0},
                        {id: 3, title: "Fighting Skills", value: 0},
                        {id: 4, title: "Intelligence", value: 0},
                        {id: 5, title: "Speed", value: 0},
                        {id: 6, title: "Strength", value: 0},
                    ],
                    movies: [],
                    traits: []
                }
            },

            /**
             * Fetches all characters
             *
             * @return {Object}
             */
            fetchCharacters() {
                fetch('api/characters')
                    .then(res => res.json())
                    .then(res => {
                        this.characters = res.data;
                    })
            },

            /**
             * Fetches all character types and capitalises the type names
             */
            fetchTypes: function() {
                axios.get('/api/character-types')
                    .then(res => {
                        this.characterTypes = res.data.data;

                        // Capitalises the type names
                        this.characterTypes.forEach(el => el.type = el.type.charAt(0).toUpperCase() + el.type.slice(1));
                    })
                    .catch(e => console.log(e));
            },

            /**
             * Fetches all traits
             */
            fetchTraits: function() {
                axios.get('/api/traits')
                    .then(res => {
                        // Sort traits by name
                        const traits = res.data.data.sort((a, b) => {
                            if (a.name < b.name) return -1; 
                            if (a.name > b.name) return 1; 
                            return 0;
                        });
                        this.allTraits = traits;
                        this.traits = traits;
                    })
                    .catch(e => console.log(e));
            },

            fetchMovies: function() {
                axios.get('/api/movies')
                    .then(res => {
                        // Sort traits by name
                        const movies = res.data.data.sort((a, b) => {
                            if (a.title < b.title) return -1; 
                            if (a.title > b.title) return 1; 
                            return 0;
                        });
                        this.allMovies = movies;
                        this.movies = movies;
                    })
                    .catch(e => console.log(e));
            },

            /**
             * Redirects to character show page
             *
             * @param {Integer} character_id 
             * @return {Object}
             */
            showCharacter(character_id) {
                return window.location.href = `/characters/${character_id}`;
            },

            /**
             * Creates new character instance
             *
             * @return void
             */
            createCharacter: function() {
                this.character.traits = this.selectedTraits;
                this.character.movies = this.selectedMovies;
                axios.post('/api/characters', this.character)
                    .then(res => {
                        this.fetchCharacters();
                        this.isCreateModalOpen = false;
                        return this.initialCharacterState();
                    })
                    .catch(e => console.log(e));
            },

            /**
             * Adds specified trait to selectedTraits arrays
             *
             * @param {Object} trait to be added
             */
            addSelectedTrait: function(trait) {
                this.selectedTraits.push(trait)
            },

            /**
             * Remove specified trait from selectedTraits array
             *
             * @param {Object} trait to be removed
             */
            removeSelectedTrait: function(trait) {
                const traitIndex = this.selectedTraits.findIndex(item => item.id == trait.id);
                this.selectedTraits.splice(traitIndex, 1);
            },

            /**
             * Adds specified movie to selectedMovies arrays
             *
             * @param {Object} movie to be added
             */
            addSelectedMovie: function(movie) {
                this.selectedMovies.push(movie)
            },

            /**
             * Remove specified movie from selectedMovies array
             *
             * @param {Object} movie to be removed
             */
            removeSelectedMovie: function(movie) {
                const movieIndex = this.selectedMovies.findIndex(item => item.id == movie.id);
                this.selectedMovies.splice(movieIndex, 1);
            },

            /**
             * Searches through traits
             *
             * @return {Array} of searched traits
             */
            searchTraits: function() {
                let results = [];
                for (let i = 0; i < this.allTraits.length; i++) {
                    const search = this.filter(this.allTraits[i].name, this.traitsSearch);
                    if (search == true) {
                        results.push(this.allTraits[i]);
                    }
                }
                return this.traits = results;
            },

            /**
             * Searches through movies
             *
             * @return {Array} of searched movies
             */
            searchMovies: function() {
                let results = [];
                for (let i = 0; i < this.allMovies.length; i++) {
                    const search = this.filter(this.allMovies[i].title, this.moviesSearch);
                    if (search == true) {
                        results.push(this.allMovies[i]);
                    }
                }
                return this.movies = results;
            },

            /**
             * Capitalises first character in string
             *
             * @param {String} string to be capitalised
             * @return {String}
             */
            capitalise: function(string) {
                return string.charAt(0).toUpperCase() + string.slice(1);
            },

            /**
             * Filters strings via a provided search term
             *
             * @param {String} text item to search against 
             * @param {String} searchString term to search for
             * @return {Bool}
             */
            filter: function(text, searchString) {
                const regexStr = '(?=.*' + searchString.split(/\,|\s/).join(')(?=.*') + ')';
                const searchRegEx = new RegExp(regexStr, 'gi');
                return text.match(searchRegEx) !== null;
            },
        },
        watch: {
            traitsSearch: function() {
                this.searchTraits();
            },
            moviesSearch: function() {
                this.searchMovies();
            }
        }
    }
</script>