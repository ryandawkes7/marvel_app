<template>
    <ul class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-4">
        <li v-for="movie in this.movies" :key="movie.id" @click="showMovie(movie.id)" class="group col-span-1 grid grid-cols-4 box-border bg-white rounded-lg overflow-hidden shadow divide-y divide-gray-200 transition-all hover:bg-red-50 hover:shadow-lg cursor-pointer">
            <div class="col-span-3 flex items-center justify-between p-6 space-x-6">
                <div class="flex-1 truncate">
                    <div class="flex items-center space-x-3">
                        <h3 class="text-gray-900 text-sm font-medium truncate">{{ movie.title }}</h3>
                    </div>
                    <p class="mt-1 text-gray-500 text-sm truncate">{{ movie.director }}</p>
                    <span class="flex-shrink-0 inline-block px-2 py-0.5 text-green-800 text-xs font-medium bg-green-100 rounded-full">{{ movie.release_date }}</span>
                </div>
            </div>
            <div class="col-span-1 bg-gray-300 flex-shrink-0 transition-all group-hover:bg-red-500">
                <img class="min-h-full transition-all object-cover group-hover:my-1" v-if="movie.posters.length > 0" :src="movie.posters[0].image_url" alt="" />
            </div>
        </li>
  </ul>
</template>

<script>
import { MailIcon, PhoneIcon } from '@heroicons/vue/solid'

export default {
    components: {
        MailIcon,
        PhoneIcon,
    },
    created() {
        this.sortMovies('title');
    },
    methods: {
        setMovies() {
            if (this.movies) return this.movies;
        },
        sortMovies(key) {
            this.movies.sort((a,b) => {
                if (a[key] > b[key]) return 1;
                if (b[key] > a[key]) return -1;
                return 0;
            });
        },
        showMovie(id) {
            window.location.href = `/movies/${id}`;
        }
    },
    props: {
        movies: {
            type: Object
        }
    }
}
</script>
