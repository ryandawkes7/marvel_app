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

            <div class="max-w-2xl mx-auto">
                <div class="mt-1 relative flex items-center">
                    <input type="text" name="search" id="search" class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full pr-12 sm:text-sm border-gray-300 rounded-md" placeholder="Quick Search"/>
                    <div class="absolute inset-y-0 right-0 flex py-1.5 pr-1.5">
                        <button class="inline-flex items-center border border-red-300 bg-red-200 rounded px-2 text-sm font-sans font-medium text-white hover:bg-red-300 hover:border-red-400 transition-colors cursor-pointer hover:shadow">
                            <SearchCircleIcon class="h-5 w-5"></SearchCircleIcon>
                        </button>
                    </div>
                </div>
            </div>

            <div class="pb-12 sm:pb-16">
                <div class="relative">
                    <div class="absolute inset-0 h-1/2 bg-gray-50" />
                    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                        <div class="max-w-4xl mx-auto">
                            <dl class="sm:grid sm:grid-cols-4 gap-2">
                                <div class="flex flex-col bg-white p-6 text-center shadow rounded cursor-pointer transition-all hover:shadow-xl hover:bg-red-100">
                                    <dd class="order-1 text-2xl font-extrabold text-red-500">
                                        All
                                    </dd>
                                </div>
                                <div class="flex flex-col bg-white p-6 text-center shadow rounded cursor-pointer transition-all hover:shadow-xl hover:bg-red-100">
                                    <dd class="order-1 text-2xl font-extrabold text-red-500">
                                        By Saga
                                    </dd>
                                </div>
                                <div class="flex flex-col bg-white p-6 text-center shadow rounded cursor-pointer transition-all hover:shadow-xl hover:bg-red-100">
                                    <dd class="order-1 text-2xl font-extrabold text-red-500">
                                        MCU
                                    </dd>
                                </div>
                                <div class="flex flex-col bg-white p-6 text-center shadow rounded cursor-pointer transition-all hover:shadow-xl hover:bg-red-100">
                                    <dd class="order-1 text-2xl font-extrabold text-red-500">
                                        Non-MCU
                                    </dd>
                                </div>
                            </dl>
                        </div>
                    </div>
                </div>
            </div>

            <div class="px-5">
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
            movies: [],
            movie: {

            },
            pagination: {},
        }
    },
    components: {
        AppLayout,
        MovieList,
        SearchCircleIcon
    },
    created() {
        this.fetchMovies()
    },
    methods: {
        fetchMovies() {
            axios.get('/api/movies')
                .then(res => {
                    this.movies = res.data.data;
                })
        }
    }
}
</script>