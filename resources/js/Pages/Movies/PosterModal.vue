<template>
    <!-- Poster View -->
    <form v-on:submit.prevent="submitProfileForm" method="POST">
        <div class="shadow sm:rounded-md sm:overflow-hidden">

            <!-- Content -->
            <div class="bg-white py-6 px-4 space-y-6 sm:p-6">

                <!-- Heading -->
                <div>
                    <h3 class="text-lg leading-6 font-medium text-gray-900">Posters</h3>
                    <p class="mt-1 text-sm text-gray-500">Add and remove posters for this movie.</p>
                </div>

                <!-- Input Fields -->
                <div class="grid grid-cols-1 gap-6">

                    <!-- File Upload -->
                    <div class="col-span-1">
                        <label for="poster_url" class="block text-sm font-medium text-gray-700">Poster URL</label>
                        <button type="button" class="bg-purple-500 text-white px-3 py-1 rounded-md shadow hover:bg-purple-600" @click="this.toggleModal" >Add Poster</button>
                    </div>
                    
                    <!-- Existing Posters Preview -->
                    <div class="col-span-6 sm:col-span-3 flex flex-col gap-3">
                        <label for="first_name" class="block text-sm font-medium text-gray-700">Existing Posters</label>
                        <ul role="list" class="grid grid-cols-1 gap-6 sm:grid-cols-2 md:grid-cols-3">

                            <!-- Grid Items -->
                            <li v-for="poster in posters" :key="poster.id" class="col-span-1 flex flex-col text-center bg-white rounded-lg shadow divide-y divide-gray-200">
                                <div class="flex-1 flex flex-col p-2">
                                    <img class="flex-shrink-0 mx-auto rounded-md" :src="poster.image_url" alt="">
                                </div>
                            </li>

                            <!-- Empty Posters Array -->
                            <li v-if="!posters" class="col-span-3 bg-gray-100 py-5 flex flex-col text-center rounded-lg shadow">
                                <h3 class="text-xl font-bold text-gray-900">No posters found for this movie</h3>
                            </li>
                        </ul>
                    </div>

                </div>
            </div>

            <!-- Save -->
            <div class="px-4 py-3 bg-gray-50 text-right sm:px-6">
                <button type="submit" class="bg-indigo-600 border border-transparent rounded-md shadow-sm py-2 px-4 inline-flex justify-center text-sm font-medium text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    Save
                </button>
            </div>

        </div>
    </form>

    <!-- Add Poster Modal -->
    <div class="fixed z-10 inset-0 overflow-y-auto h-full" aria-labelledby="modal-title" role="dialog" aria-modal="true" v-if="isModalOpen">
        <div class="flex items-end justify-center min-h-full pt-4 px-4 pb-20 text-center sm:block sm:p-0">
            <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true"></div>
            
            <div class="fixed inset-10 flex justify-center items-center">
                <div class="inline-block align-bottom text-left overflow-hidden transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full sm:p-6">
                    <div>
                        <form v-on:submit.prevent="addPoster" method="POST">
                            <div class="shadow sm:rounded-md sm:overflow-hidden">

                                <!-- Content -->
                                <div class="bg-white py-6 px-4 space-y-6 sm:p-6">

                                    <!-- Input Fields -->
                                    <div class="grid grid-cols-1">

                                        <!-- File Upload -->
                                        <div class="col-span-1">
                                            <label for="poster_url" class="block text-md font-medium">Poster URL</label>
                                            <input v-model="new_poster.image_url" required type="text" name="poster_url" id="poster_url" tabindex="-1" class="mt-1 block min-w-xl w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" />
                                            <ValidationErrors :errors="validationErrors" v-if="validationErrors"></ValidationErrors>
                                        </div>
                                        

                                    </div>
                                </div>

                                <!-- Save -->
                                <div class="px-4 py-3 bg-gray-50 text-right sm:px-6">
                                    <button type="submit" class="bg-indigo-600 border border-transparent rounded-md shadow-sm py-2 px-4 inline-flex justify-center text-sm font-medium text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                        Save
                                    </button>
                                </div>

                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import { ref } from 'vue';
import axios from 'axios';
import ValidationErrors from '../Components/ValidationErrors.vue';

export default {
    components: { ValidationErrors },
    computed: {
        validationErrors() {
            let errors = Object.values(this.errors);
            errors = errors.flat();
            return errors;
        }  
    },
    data() {
        return {
            new_poster: {
                movie_id: this.movie_id,
                image_url: 'hello world',
                user_id: 0,
            },
            validationErrors: ''
        }
    },
    methods: {
        toggleModal: function() {
            this.isModalOpen = !this.isModalOpen
        },
        addPoster: function() {
            axios.post(`/api/posters`, { image: this.new_poster.image_url, movie_id: this.movie_id })
                .then(res => console.log(res))
                .catch(e => {
                    if (e.response.status = 422) { this.validationErrors = e.response.data.errors }
                })
        }
    },
    props: {
        posters: {
            type: Array
        },
        movie_id: {
            type: Number
        }
    },
    setup() {
        const isModalOpen = ref(false);
        return {
            isModalOpen
        }
    }
}
</script>