<template>
    <!-- Poster View -->
    <form v-on:submit.prevent="submitProfileForm" method="POST">
        <div class="sm:overflow-hidden relative">

            <!-- Content -->
            <div class="bg-white py-5 px-4 min-h-full space-y-6">

                <!-- Heading -->
                <div>
                    <h3 class="text-lg leading-6 font-medium text-gray-900">Posters</h3>
                    <p class="mt-1 text-sm text-gray-500">Add and remove posters for this movie.</p>
                </div>

                <!-- File Upload -->
                <div class="col-span-1">
                    <button type="button" class="flex items-center gap-2 transition-colors bg-purple-500 text-white px-3 py-2 rounded-md shadow hover:bg-purple-600" @click="this.toggleAddModal" >
                        <PlusIcon class="h-5 w-5"></PlusIcon>
                        Add New Poster
                    </button>
                </div>

                <hr>

                <!-- Input Fields -->
                <div class="grid grid-cols-1 gap-6 mt-4">
                    
                    <!-- Existing Posters Preview -->
                    <div class="col-span-6 sm:col-span-3 flex flex-col gap-3">
                        <label for="first_name" class="block text-sm font-medium text-gray-700">Existing Posters</label>
                        <ul role="list" class="grid grid-cols-1 gap-4 sm:grid-cols-2 md:grid-cols-4">

                            <!-- Grid Items -->
                            <li v-for="poster in posters" :key="poster.id" class="group col-span-1 flex flex-col text-center bg-white rounded-lg shadow divide-y divide-gray-200">
                                <div class="flex-1 flex flex-col relative">

                                    <!-- Poster -->
                                    <img class="flex-shrink-0 mx-auto rounded-md min-h-full min-w-full" :src="poster.image_url" alt="">

                                    <!-- Click to Enlarge -->
                                    <div @click="toggleEnlargeModal(poster.id, poster.image_url)" class="group transition-colors flex items-center justify-center absolute inset-0 bg-transparent hover:bg-gray-300 opacity-75 rounded-md cursor-pointer">
                                        <div class="bg-transparent opacity-0 flex flex-col justify-center items-center group-hover:opacity-100">
                                            <!-- Icon -->
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-gray-700" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 8V4m0 0h4M4 4l5 5m11-1V4m0 0h-4m4 0l-5 5M4 16v4m0 0h4m-4 0l5-5m11 5l-5-5m5 5v-4m0 4h-4" /></svg>
                                            <!-- Subheading -->
                                            <h3 class="text-gray-700 font-bold text-lg">Click to enlarge</h3>
                                        </div>
                                    </div>

                                    <!-- Delete Button -->
                                    <button type="button" @click="toggleDeleteModal(poster)" class="group absolute transition-all -top-2.5 -right-2.5 p-1 bg-white rounded-full border-2 border-gray-300 shadow hover:shadow-lg hover:bg-gray-100">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 transition-colors text-gray-500 group-hover:text-gray-600" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg>
                                    </button>
                                </div>
                            </li>

                            <!-- Empty Posters Array -->
                            <li v-if="posters.length <= 0" class="col-span-3 bg-gray-100 py-5 flex flex-col text-center rounded-lg shadow">
                                <h3 class="text-xl font-bold text-gray-900">No posters found for this movie</h3>
                            </li>
                        </ul>
                    </div>

                </div>
            </div>
        </div>
    </form>

    <!-- Add Poster Modal -->
    <div class="fixed z-10 inset-0 overflow-y-auto h-full" aria-labelledby="add-poster" role="dialog" aria-modal="true" v-if="isAddModalOpen">
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

                                <!-- Action Buttons -->
                                <div class="px-4 py-3 bg-gray-50 text-right sm:px-6 flex gap-2 items-center justify-end">
                                    <button type="button" @click="toggleAddModal" class="transition-all bg-gray-500 border border-transparent rounded-md shadow-sm py-2 px-4 inline-flex justify-center text-sm font-medium text-white hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-700">
                                        Cancel
                                    </button>
                                    <button type="submit" class="transition-all bg-indigo-600 border border-transparent rounded-md shadow-sm py-2 px-4 inline-flex justify-center text-sm font-medium text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
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

    <!-- Delete Poster Modal -->
    <div class="fixed z-10 inset-0 overflow-y-auto h-full" aria-labelledby="delete-poster" role="dialog" aria-modal="true" v-if="isDeleteModalOpen">
        <div class="flex items-end justify-center min-h-full pt-4 px-4 pb-20 text-center sm:block sm:p-0">
            <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true"></div>
            
            <div class="fixed inset-10 flex justify-center items-center">
                <div class="inline-block align-bottom text-left overflow-hidden transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full sm:p-6">
                    <div>
                        <form v-on:submit.prevent="deletePoster()" method="POST" >
                            <input type="hidden" name="_token" :value="csrf">
                            <div class="shadow sm:rounded-md sm:overflow-hidden">

                                <!-- Content -->
                                <div class="bg-white py-6 px-4 space-y-6 sm:p-6">

                                    <!-- Heading -->
                                    <div>
                                        <h3 class="text-lg leading-6 font-medium text-gray-900">Remove Poster</h3>
                                        <p class="mt-1 text-sm text-gray-500">Are you sure you would like to remove this poster?</p>
                                    </div>

                                    <!-- Input Fields -->
                                    <div class="grid grid-cols-1">

                                        <!-- File Upload -->
                                        <div class="col-span-1 flex">
                                            <img :src="this.selected_poster.image_url" alt="Poster" class="m-auto h-96 rounded-md shadow">
                                        </div>
                                        

                                    </div>
                                </div>

                                <!-- Action Buttons -->
                                <div class="px-4 py-3 bg-gray-50 text-right sm:px-6 flex gap-2 items-center justify-end">
                                    <button type="button" @click="toggleDeleteModal" class="transition-all bg-gray-500 border border-transparent rounded-md shadow-sm py-2 px-4 inline-flex justify-center text-sm font-medium text-white hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-700">
                                        Cancel
                                    </button>
                                    <button type="submit" class="transition-all bg-indigo-600 border border-transparent rounded-md shadow-sm py-2 px-4 inline-flex justify-center text-sm font-medium text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                        Confirm
                                    </button>
                                </div>

                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Enlarged Image -->
    <div class="fixed z-20 inset-0 overflow-y-auto h-full" aria-labelledby="enlarged_image" role="dialog" aria-modal="true" v-if="isEnlargeModalOpen">
        <div class="flex items-end justify-center min-h-full pt-4 px-4 pb-20 text-center sm:block sm:p-0">
            <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true"></div>
            
            <div class="fixed inset-10 flex justify-center items-center">
                <div class="flex justify-center items-center overflow-hidden transform transition-all h-full sm:w-full py-2">

                    <!-- Close Button -->
                    <button @click="toggleEnlargeModal" class="absolute top-0 right-0">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 transition-colors text-gray-300 hover:text-gray-200" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg>
                    </button>

                    <!-- Left Arrow -->
                    <button v-if="posters.length > 1" @click="previousPoster()" class="h-full transition-all bg-purple-700 opacity-50 hover:opacity-75 rounded-tl-lg rounded-bl-lg">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-purple-300 opacity-100 z-20" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd" /></svg>
                    </button>

                    <!-- Image -->
                    <img class="object-cover min-h-full" :src="this.selected_poster.image_url" alt="Movie Poster" />

                    <!-- Right Arrow -->
                    <button v-if="posters.length > 1" @click="nextPoster()" class="h-full transition-all bg-purple-700 opacity-50 hover:opacity-75 rounded-tr-lg rounded-br-lg">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-purple-300 opacity-100 z-20" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" /></svg>
                    </button>
                </div>
            </div>
        </div>
    </div>

</template>

<script>
import { ref } from 'vue';
import axios from 'axios';
import { PlusIcon, XIcon } from '@heroicons/vue/solid';
import ValidationErrors from '../Components/ValidationErrors.vue';

export default {
    components: { PlusIcon, ValidationErrors, XIcon },
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
                image_url: '',
                user_id: 0,
            },
            selected_poster: {
                id: null,
                image_url: ''
            },
            validationErrors: ''
        }
    },
    methods: {
        /**
         * Create new poster instance
         */
        addPoster: function() {
            axios.post(`/api/posters`, { image: this.new_poster.image_url, movie_id: this.movie_id })
                .then(res => {
                    this.toggleAddModal();
                    this.$emit('fetchMovie');
                })
                .catch(e => {
                    if (e.response && e.response.status == 422) { this.validationErrors = e.response.data.errors }
                    else console.log(e);
                })
        },

        /**
         * Delete a poster instance
         */
        deletePoster: function() {
            axios.delete(`/api/posters/${this.selected_poster.id}`)
                .then(res => {
                    this.toggleDeleteModal();
                    this.$emit('fetchMovie');
                })
                .catch(e => {
                    if (e.response && e.response.status == 422) { this.validationErrors = e.response.data.errors }
                    else console.log(e);
                })
        },

        /**
         * Fetch next poster from posters array. If last item, loop back to start
         */
        nextPoster: function() {
            let index;
            for (let poster of this.posters) {
                if (this.selected_poster.id == poster.id) index = this.posters.indexOf(poster);
            }

            if (index >= 0 && index < this.posters.length - 1) {
                this.selected_poster.id = this.posters[index + 1]['id'];
                this.selected_poster.image_url = this.posters[index + 1]['image_url'];
            } else if(index >= this.posters.length - 1) {
                this.selected_poster.id = this.posters[0]['id'];
                this.selected_poster.image_url = this.posters[0]['image_url'];
            }
        },

                /**
         * Fetch next poster from posters array. If last item, loop back to start
         */
        previousPoster: function() {
            let index;
            for (let poster of this.posters) {
                if (this.selected_poster.id == poster.id) index = this.posters.indexOf(poster);
            }

            if (index > 0 && index <= this.posters.length - 1) {
                this.selected_poster.id = this.posters[index - 1]['id'];
                this.selected_poster.image_url = this.posters[index - 1]['image_url'];
            } else if (index == 0) {
                const final_item = this.posters.length - 1;
                this.selected_poster.id = this.posters[final_item]['id'];
                this.selected_poster.image_url = this.posters[final_item]['image_url'];
            }
        },

        /**
         * Reset selected_poster params
         */
        resetSelectedPoster: function() {
            this.selected_poster.id = null;
            this.selected_poster.image_url = '';
        },

        /**
         * Toggles modal for adding poster
         */
        toggleAddModal: function() {
            this.isAddModalOpen = !this.isAddModalOpen;
        },

        /**
         * Toggles modal for deleting a poster
         *
         * @param {Object} poster 
         */
        toggleDeleteModal: function(poster) {
            if (this.isDeleteModalOpen) {
                this.isDeleteModalOpen = false;
                this.resetSelectedPoster();
            } else {
                this.selected_poster.id = poster.id;
                this.selected_poster.image_url = poster.image_url;
                this.isDeleteModalOpen = true;
            }
        },

        /**
        * Toggles modal for enlarged image
        *
        * @param {String} poster_id 
        * @param {String} poser_image_url
        */
        toggleEnlargeModal: function(poster_id, poster_image_url) {
            if (this.isEnlargeModalOpen) {
                this.isEnlargeModalOpen = false;
                this.resetSelectedPoster();
            } else {
                this.selected_poster.id = poster_id;
                this.selected_poster.image_url = poster_image_url;
                this.isEnlargeModalOpen = true;
            };
        },
    },
    props: {
        posters: { type: Array },
        movie_id: { type: Number }
    },
    setup() {
        const isAddModalOpen = ref(false);
        const isDeleteModalOpen = ref(false);
        const isEnlargeModalOpen = ref(false);
        return { isAddModalOpen, isDeleteModalOpen, isEnlargeModalOpen }
    }
}
</script>