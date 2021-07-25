<template>
    <app-layout>
        <div>Helo world</div>
    </app-layout>
</template>

<script>
import AppLayout from '@/Layouts/AppLayout';

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
        AppLayout
    },
    created() {
        this.fetchMovies()
    },
    methods: {
        fetchMovies() {
            axios.get('/api/movies')
                .then(res => {
                    this.movies = res.data.data;
                    console.log(this.movies);
                })
        }
    }
}
</script>