<template>
    <app-layout>
        <div class="bg-gray-50 pt-12 sm:pt-16 flex flex-col gap-4 shadow-lg rounded-lg">

            <!-- Headings -->
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="max-w-4xl mx-auto text-center">
                    <!-- Title -->
                    <h2 class="text-3xl font-extrabold text-gray-900 sm:text-4xl">
                        How would you like to search?
                    </h2>

                    <!-- Subtitle -->
                    <p class="mt-3 text-xl text-gray-500 sm:mt-4">
                        Begin typing a movie in the search bar or select a category from below
                    </p>
                </div>
            </div>

            <!-- Search -->
            <div class="max-w-2xl mx-auto">
                <div class="mt-1 relative flex items-center">
                    <input type="text" name="search_movies" v-model="movieSearchTerm" class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full pr-12 sm:text-sm border-gray-300 rounded-md" placeholder="Quick Search"/>
                    <div class="absolute inset-y-0 right-0 flex py-1.5 pr-1.5">
                        <button class="inline-flex items-center border border-red-300 bg-red-200 rounded px-2 text-sm font-sans font-medium text-white hover:bg-red-300 hover:border-red-400 transition-colors cursor-pointer hover:shadow">
                            <SearchCircleIcon class="h-5 w-5"></SearchCircleIcon>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Filters -->
            <div class="px-4">
                <div class="w-full bg-red-500 text-white rounded-md py-2 px-4 flex justify-between items-center">
                    <!-- Filters -->
                    <div class="flex flex-col gap-1 p-2 border border-white rounded-md">
                        <!-- Title -->
                        <h3>Filters</h3>

                        <div class="flex gap-4">
                            <!-- In MCU -->
                            <!-- In MCU, Not In MCU, Show All -->
                            <div class="flex items-center gap-2">
                                <label>Universe</label>
                                <div class="rounded-md overflow-hidden divide-x divide-gray-300 flex items-center text-black">
                                    <button v-for="(value, key) in universeValues" :key="key" @click="universeFilter = key" class="transition-colors py-1 px-2" :class="key == universeFilter ? 'bg-purple-300 hover:bg-purple-400' : 'bg-gray-50 hover:bg-gray-200'">
                                        {{value}}
                                    </button>
                                </div>
                            </div>

                            <!-- MCU Phase (Grayed out if In MCU == false) -->
                            <div class="flex items-center gap-2">
                                <label>MCU Phase</label>
                                <select class="text-black" :class="universeFilter == 1 ? 'bg-white' : 'bg-gray-300 cursor-not-allowed opacity-75' " v-model="phaseFilter" :disabled="universeFilter == 1 ? false : true ">
                                    <option value="0">All</option>
                                    <option v-for="phase in allPhases" :key="phase.id" :value="phase.id">{{phase.title}}</option>
                                </select>
                            </div>

                            <!-- Saga -->
                            <div class="flex items-center gap-2">
                                <label>Saga</label>
                                <select class="text-black" v-model="sagaFilter">
                                    <option value="0">All</option>
                                    <option v-for="saga in sagas" :key="saga.id" :value="saga.id">{{saga.title}}</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <!-- Sorting -->
                    <div class="flex gap-2 items-center p-2 border border-white rounded-md">
                        <!-- Title -->
                        <h3>Sort By:</h3>

                        <select class="text-black" v-model="sortBy">
                            <option value="1">Name (A-Z)</option>
                            <option value="2">Name (Z-A)</option>
                            <option value="3">Release Date (Old-New)</option>
                            <option value="4">Release Date (New-Old)</option>
                        </select>
                    </div>
                </div>
            </div>

            <!-- Subheading -->
            <div class="text-gray-500 text-sm px-5 text-right">
                Showing {{movies.length}} results
            </div>

            <!-- Movie List -->
            <div class="px-5 pb-5">
                <MovieList v-if="this.movies.length > 0" v-bind:movies="this.movies"></MovieList>
            </div>
            
        </div>
    </app-layout>
</template>

<script>
import AppLayout from '@/Layouts/AppLayout';
import { SearchCircleIcon } from '@heroicons/vue/solid';
import MovieList from './MovieList.vue';

export default {
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