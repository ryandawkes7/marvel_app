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
                                TV Shows
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
                                <input type="text" name="search_movies" v-model="showSearchTerm" class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full pr-12 sm:text-sm border-gray-300 text-black rounded-md" placeholder="Quick Search"/>
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
                                Create TV Show
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-11a1 1 0 10-2 0v2H7a1 1 0 100 2h2v2a1 1 0 102 0v-2h2a1 1 0 100-2h-2V7z" clip-rule="evenodd" /></svg>
                            </button>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Body -->
            <section class="flex flex-col gap-4">
                <!-- Search Results -->
                <div class="text-gray-500 text-sm px-5 text-right">
                    Showing {{shows.length}} results
                </div>

                <!-- Movie List -->
                <div class="px-5 pb-5">
                    <ContentGrid 
                        v-if="this.shows.length > 0" 
                        :shows="this.shows"
                    ></ContentGrid>
                </div>
            </section>

            <!-- Create Modal -->
            <div v-if="isCreateModalOpen">
                <CreateModal 
                    @closeCreateModal="fetchShows()"
                ></CreateModal>
            </div>

        </div>
    </app-layout>
</template>

<script>
import AppLayout from '../../Layouts/AppLayout.vue';
import ContentGrid from './ContentGrid.vue';
import CreateModal from './CreateModal.vue';
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
            shows: [],
            showSearchTerm: null,

            sortBy: 1,
            pagination: {},
        }
    },
    components: {
        AppLayout,
        CreateModal,
        ContentGrid,
        SearchCircleIcon
    },
    created() {
        this.fetchShows();
    },
    methods: {
        /**
         * Fetches all TV Shows
         * 
         * @return void
         */
        fetchShows: function () {
            axios.get('/api/tv-shows')
                .then(res => {
                    this.shows = res.data.data;
                    if (this.isCreateModalOpen) this.isCreateModalOpen = false;
                })
                .catch(e => console.log(`Error fetching TV Shows - ${e}`));
        },

        /**
         * Filters strings via a provided search term
         *
         * @param string text item to search against 
         * @param string searchString term to search for
         * @return bool
         */
        filter: function(text, searchString) {
            const regexStr = '(?=.*' + searchString.split(/\,|\s/).join(')(?=.*') + ')';
            const searchRegEx = new RegExp(regexStr, 'gi');
            return text.match(searchRegEx) !== null;
        },

        /**
         * Searches through TV Shows via the search term provided
         * 
         * @return void
         */
        searchShows: function() {
            let results = [];
            for (let i = 0; i < this.shows.length; i++) {
                const search = this.filter(this.shows[i].title, this.showSearchTerm);
                if (search == true) results.push(this.shows[i]);
            }
            this.shows = results;
        },
    },
    watch: {
        /**
         * Watches for changes on showSearchTerm variable; runs function if changed
         */
        showSearchTerm: function() {
            this.searchShows();
        }
    }
}
</script>