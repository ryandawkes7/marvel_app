<template>
    <app-layout>
        <div class="bg-gray-50 flex flex-col gap-4 shadow-lg rounded-lg overflow-hidden">

            <!-- Header -->
            <section>
                <!-- Title & Search -->
                <div class="bg-red-500 py-6 flex flex-col gap-4">
                    <!-- Title -->
                    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                        <div class="max-w-4xl mx-auto text-center">
                            <h2 class="text-3xl font-extrabold text-red-100 sm:text-4xl">
                                Movies
                            </h2>
                        </div>
                    </div>
                </div>

                <!-- Options -->
                <div class="w-full bg-red-400 text-white px-4 py-4 flex flex-col justify-center">

                    <!-- Search & Create -->
                    <div class="flex items-center justify-between">
                        <!-- Search -->
                        <div class="max-w-2xl">
                            <div class="mt-1 relative flex items-center">
                                <input type="text" name="search_movies" v-model="movieSearchTerm" class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full pr-12 sm:text-sm border-gray-300 text-black rounded-md" placeholder="Quick Search"/>
                                <div class="absolute inset-y-0 right-0 flex py-1.5 pr-1.5">
                                    <button class="inline-flex items-center bg-red-400 rounded px-2 text-sm font-sans font-medium text-white hover:bg-red-600 hover:border-red-400 transition-colors cursor-pointer hover:shadow">
                                        <SearchCircleIcon class="h-5 w-5"></SearchCircleIcon>
                                    </button>
                                </div>
                            </div>
                        </div>

                        <!-- Create Movie -->
                        <div>
                            <button @click="isCreateModalOpen = true" class="px-3 py-1.5 text-white hover:text-red-500 font-bold border border-white rounded-md transition-all hover:shadow-md bg-red-500 hover:bg-gray-50 flex items-center gap-1.5">
                                Create Movie
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-11a1 1 0 10-2 0v2H7a1 1 0 100 2h2v2a1 1 0 102 0v-2h2a1 1 0 100-2h-2V7z" clip-rule="evenodd" /></svg>
                            </button>
                        </div>
                    </div>

                    <!-- Filters -->
                    <div class="w-full bg-red-400 text-white flex justify-between items-center">
                        <div class="flex flex-col gap-1 rounded-md">
                            <div class="flex gap-4">

                                <!-- In MCU -->
                                <div class="flex flex-col justify-center gap-1">
                                    <label for="in_mcu" class="font-bold">Universe</label>
                                    <select name="in_mcu" v-model="universeFilter" class="transition-colors rounded-md bg-transparent hover:bg-red-600 focus:bg-red-600 border border-red-100">
                                        <option v-for="(value, key) in universeValues" :key="key" :value="key">{{value}}</option>
                                    </select>
                                </div>

                                <!-- MCU Phase (Grayed out if In MCU == false) -->
                                <div class="flex flex-col justify-center gap-1">
                                    <label for="mcu_phase" class="font-bold">MCU Phase</label>
                                    <select name="mcu_phase" class="transition-colors rounded-md bg-transparent border" :class="universeFilter == 1 ? 'bg-transparent hover:bg-red-600 focus:bg-red-600 border-red-100' : 'bg-red-900 border-red-800 line-through cursor-not-allowed opacity-75 text-red-800' " v-model="phaseFilter" :disabled="universeFilter == 1 ? false : true " >
                                        <option value="0">All</option>
                                        <option v-for="phase in allPhases" :key="phase.id" :value="phase.id">{{phase.title}}</option>
                                    </select>
                                </div>

                                <!-- Saga -->
                                <div class="flex flex-col justify-center gap-1">
                                    <label for="saga" class="font-bold">Saga</label>
                                    <select name="saga" class="transition-colors rounded-md bg-transparent hover:bg-red-600 focus:bg-red-600 border border-red-100" v-model="sagaFilter">
                                        <option value="0">All</option>
                                        <option v-for="saga in sagas" :key="saga.id" :value="saga.id">{{saga.title}}</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <!-- Sorting -->
                        <div class="flex flex-col gap-1 justify-center p-2 rounded-md">
                            <label for="sort_by" class="font-bold">Sort By</label>
                            <select name="sort_by" class="transition-colors rounded-md bg-transparent hover:bg-red-600 focus:bg-red-600 border border-red-100" v-model="sortBy">
                                <option value="1">Name (A-Z)</option>
                                <option value="2">Name (Z-A)</option>
                                <option value="3">Release Date (Old-New)</option>
                                <option value="4">Release Date (New-Old)</option>
                            </select>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Body -->
            <section class="flex flex-col gap-4">
                <!-- Search Results -->
                <div class="text-gray-500 text-sm px-5 text-right">
                    Showing {{movies.length}} results
                </div>

                <!-- Movie List -->
                <div class="px-5 pb-5">
                    <MovieList v-if="this.movies.length > 0" v-bind:movies="this.movies"></MovieList>
                </div>
            </section>

            <div v-if="isCreateModalOpen">
                <CreateModal @closeCreateModal="isCreateModalOpen = false" :phases="allPhases"></CreateModal>
            </div>

        </div>
    </app-layout>
</template>

<script>
import AppLayout from '@/Layouts/AppLayout';
import { SearchCircleIcon } from '@heroicons/vue/solid';
import MovieList from './MovieList.vue';
import { ref } from 'vue';
import CreateModal from './CreateModal.vue';

export default {
    setup() {
        const isCreateModalOpen = ref(false);
        return {
            isCreateModalOpen
        }
    },
    data() {
        return {
            allMovies: [],
            allPhases: [],
            allSagas: [],

            movies: [],
            movieSearchTerm: null,

            sagas: [],

            universeFilter: 0,
            phaseFilter: 0,
            sagaFilter: 0,

            universeValues: { 0: 'All', 1: 'MCU', 2: 'Non-MCU'},

            sortBy: 1,

            pagination: {},
        }
    },
    components: {
        AppLayout,
        CreateModal,
        MovieList,
        SearchCircleIcon
    },
    created() {
        this.fetchMovies(),
        this.fetchPhases(),
        this.fetchSagas()
    },
    methods: {
        /**
         * Fetches all movies
         */
        fetchMovies() {
            axios.get('/api/movies')
                .then(res => {
                    this.allMovies = res.data.data;
                    this.movies = res.data.data;
                    console.log(this.movies[0]);
                })
        },

        /**
         * Fetches all phases
         */
        fetchPhases: function() {
            axios.get('/api/phases')
                .then(res => {
                    this.allPhases = res.data.data;
                })
                .catch(e => {
                    console.log(e);
                })
        },

        /**
         * Fetches all sagas
         */
        fetchSagas: function() {
            axios.get('/api/sagas')
                .then(res => {
                    const data = res.data.data.sort((a, b) => {
                        if (a.title < b.title) return -1;
                        if (a.title > b.title) return 1;
                        return 0;
                    })
                    this.allSagas = data;
                    this.sagas = data;
                })
                .catch(e => console.log(e));
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

        /**
         * Filters sagas based on the sagas available from each movie
         *
         * @return {Object}
         */
        filterSagas: function() {
            const sagaArray = [];
            for (let i = 0; i < this.movies.length; i++) {
                if (this.movies[i].sagas.length > 0) {
                    for (let j = 0; j < this.movies[i].sagas.length; j++) {
                        let object = sagaArray.findIndex(x => x.title == this.movies[i].sagas[j].title);
                        if (object == -1) sagaArray.push(this.movies[i].sagas[j]);
                    }
                }
            }
            this.sagas = sagaArray.sort((a, b) => {
                if (a.title < b.title) return -1;
                if (a.title > b.title) return 1;
                return 0;
            });
        },

        /**
         * Filters directors according to the search term provided
         */
        searchMovies: function() {
            let results = [];
            for (let i = 0; i < this.allMovies.length; i++) {
                const search = this.filter(this.allMovies[i].title, this.movieSearchTerm);
                if (search == true) results.push(this.allMovies[i]);
            }
            this.movies = results;
        },
    },
    watch: {
        /**
         * Watches for changes on movieSearchTerm variable; runs function if changed
         */
        movieSearchTerm: function() {
            this.searchMovies();
        },

        universeFilter: function(value) {
            const movies = this.allMovies;
            this.sagaFilter = 0;

            if (value == 0) {
                this.movies = this.allMovies;
                this.phaseFilter = 0;
            } else if (value == 1) {
                let inMcuMovies = []
                movies.filter(el => { if (el.in_mcu == 1) inMcuMovies.push(el) });
                this.movies = inMcuMovies;
                this.filterSagas();
            } else if (value == 2) {
                let nonMcuMovies = []
                movies.filter(el => { if (el.in_mcu == 0) nonMcuMovies.push(el) });
                this.movies = nonMcuMovies;
                this.phaseFilter = 0;
                this.filterSagas();
            }
        },

        /**
         * Filters movies by their phases
         *
         * @param {Integer} value 
         */
        phaseFilter: function (value) {
            const movies = this.allMovies;
            this.sagaFilter = 0;

            if (value == 0) {
                this.movies = this.allMovies;
            } else {
                let filteredMovies = [];
                movies.filter(el => { if (el.mcu_phase_id == value) filteredMovies.push(el) });
                this.movies = filteredMovies;
            }
            this.filterSagas();
        },

        /**
         * Filters movies by their sagas
         *
         * @param {Integer} value 
         */
        sagaFilter: function (value) {
            const movies = this.allMovies;

            if (value == 0) {
                this.movies = this.allMovies;
            } else {
                let filteredMovies = [];
                movies.filter(el => {
                    for (let i = 0; i < el.sagas.length; i++) {
                        if (el.sagas[i].id == value) filteredMovies.push(el);
                    }
                });
                this.movies = filteredMovies;
            }
        },

        sortBy: function(value) {
            const nameSorting = ['1', '2'];
            const releaseDateSorting = ['3', '4'];

            if (nameSorting.includes(value)) {
                this.movies = this.movies.sort((a, b) => {
                    if (a.title < b.title) return value == 1 ? -1 : 1;
                    if (a.title > b.title) return value == 1 ? 1 : -1;
                    return 0;
                });
            } else if (releaseDateSorting.includes(value)) {
                this.movies = this.movies.sort((a, b) => {
                    if (a.release_date < b.release_date) return value == 3 ? -1 : 1;
                    if (a.release_date > b.release_date) return value == 3 ? 1 : -1;
                    return 0;
                });
            }
        }
    }
}
</script>