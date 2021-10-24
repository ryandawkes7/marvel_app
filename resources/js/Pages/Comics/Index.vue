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
                                Comics
                            </h2>
                        </div>
                    </div>
                </div>

                <!-- Options -->
                <div class="w-full bg-red-400 text-white px-4 py-4 flex flex-col gap-y-2 justify-center">

                    <!-- Search & Create -->
                    <div class="flex items-center justify-between">
                        <!-- Search -->
                        <div class="max-w-2xl">
                            <div class="mt-1 relative flex items-center">
                                <input type="text" name="search_movies" v-model="comicSearchTerm" class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full pr-12 sm:text-sm border-gray-300 text-black rounded-md" placeholder="Quick Search"/>
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
                                Create Comic
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-11a1 1 0 10-2 0v2H7a1 1 0 100 2h2v2a1 1 0 102 0v-2h2a1 1 0 100-2h-2V7z" clip-rule="evenodd" /></svg>
                            </button>
                        </div>
                    </div>

                    <!-- Filters -->
                    <div class="w-full bg-red-400 text-white flex justify-between items-center">
                        <div class="flex flex-col gap-1 rounded-md">
                            <div class="flex gap-4">

                                <!-- Writers -->
                                <div class="flex flex-col justify-center gap-1">
                                    <label for="mcu_phase" class="font-bold">Writers</label>
                                    <select name="mcu_phase" class="transition-colors rounded-md bg-transparent border border-red-100 hover:bg-red-600 focus:bg-red-600" v-model="writerFilter">
                                        <option value="0">All</option>
                                        <option v-for="writer in allWriters" :key="writer.id" :value="writer.id">{{writer.name}}</option>
                                    </select>
                                </div>

                            </div>
                        </div>
                    </div>

                </div>
            </section>

            <!-- Body -->
            <section class="flex flex-col gap-4">
                <!-- Search Results -->
                <div class="text-gray-500 text-sm px-5 text-right">
                    Showing {{comics.length}} results
                </div>

                <!-- Movie List -->
                <div class="px-5 pb-5">
                    <ComicList v-if="this.comics.length > 0" v-bind:comics="this.comics"></ComicList>
                </div>
            </section>

            <div v-if="isCreateModalOpen">
                <CreateModal @closeCreateModal="isCreateModalOpen = false"></CreateModal>
            </div>

        </div>
    </app-layout>
</template>

<script>
import AppLayout from '../../Layouts/AppLayout.vue';
import ComicList from './ComicList.vue';
import CreateModal from './Components/CreateModal.vue';
import { SearchCircleIcon } from '@heroicons/vue/solid';
import { ref } from 'vue';
export default {
    setup() {
        const isCreateModalOpen = ref(false);
        return {
            isCreateModalOpen
        }
    },
    data() {
        return {
            allComics: [],
            allWriters: [],
            comics: [],
            comicSearchTerm: null,

            writers: [],
            writerFilter: 0,

            sortBy: 1,
            pagination: {},
        }
    },
    components: {
        AppLayout,
        CreateModal,
        ComicList,
        SearchCircleIcon
    },
    created() {
        this.fetchComics(),
        this.fetchWriters()
    },
    methods: {
        /**
         * Fetches all movies
         */
        fetchComics: function () {
            axios.get('/api/comics')
                .then(res => {
                    this.allComics = res.data.data;
                    this.comics = res.data.data;
                })
                .catch(e => console.log(`Error fetching comics: ${e}`));
        },
        
        /**
         * Fetches all writers
         */
        fetchWriters: function () {
            axios.get('/api/comic-writers')
                .then(res => {
                    this.allWriters = res.data.data;
                    this.writers = res.data.data;
                })
                .catch(e => console.log(`Error fetching writers: ${e}`));
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
         * Searches through comcis via the search term provided
         */
        searchComics: function() {
            let results = [];
            for (let i = 0; i < this.allComics.length; i++) {
                const search = this.filter(this.allComics[i].title, this.comicSearchTerm);
                if (search == true) results.push(this.allComics[i]);
            }
            this.comics = results;
        },
    },
    watch: {
        /**
         * Watches for changes on movieSearchTerm variable; runs function if changed
         */
        comicSearchTerm: function() {
            this.searchComics();
        },

        /**
         * Filters comics by the specified writer
         *
         * @param {Integer} value 
         */
        writerFilter: function (value) {
            const comics = this.allComics;
            this.comicFilter = 0;

            if (value == 0) {
                this.comics = this.allComics;
            } else {
                let filteredComics = [];
                comics.forEach(el => {
                    el.writers.filter(writer => {
                        if (writer.id == value) filteredComics.push(el);
                    });
                });
                this.comics = filteredComics;
            }
        },
    }
}
</script>