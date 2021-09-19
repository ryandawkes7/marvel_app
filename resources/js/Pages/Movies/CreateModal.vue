<template>
    <section class="fixed z-10 inset-0 overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
        <div class="flex items-end justify-center min-h-screen h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
            <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true" @click="this.$emit('closeCreateModal')"></div>

            <!-- Centering -->
            <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>

            <!-- Body -->
            <div class="inline-block h-5/6 align-bottom bg-white rounded-lg px-4 pt-5 pb-4 text-left overflow-y-scroll shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-7xl sm:w-full sm:p-6">
                <div class="flex items-start">
                    <div class="mt-3 text-center sm:mt-0 sm:text-left w-full flex flex-col gap-4">

                        <!-- Title -->
                        <h3 class="text-lg leading-6 font-medium text-gray-900" id="modal-title">
                            Create New Movie
                        </h3>

                        <!-- Form -->
                        <form class="rounded-xl px-2 py-4 w-full grid grid-cols-2 gap-8" @submit.prevent="createMovie">

                            <!-- Left Side -->
                            <div class="col-span-1 flex flex-col gap-3">
                                <!-- Title * -->
                                <div class="flex flex-col gap-1 px-2">
                                    <label for="title">Title</label>
                                    <input name="title" type="text" required v-model="movie.title" autocomplete="off" class="rounded-md" placeholder="Movie title...">
                                </div>

                                <!-- Release Date * -->
                                <div class="flex flex-col gap-1 px-2">
                                    <label for="releaseDate">Release Date</label>
                                    <input name="releaseDate" type="date" v-model="movie.release_date" autocomplete="off" class="rounded-md">
                                </div>

                                <!-- In MCU * -->
                                <div class="flex flex-col gap-1 px-2">
                                    <label for="inMcu">In MCU?</label>
                                    <select name="inMcu" v-model="movie.in_mcu" class="rounded-md text-black" required>
                                        <!-- <option disabled hidden selected :value="0">Select option...<option> -->
                                            <option value="-1" disabled hidden>Select an option...</option>
                                            <option value="1">Yes</option>
                                            <option value="0">No</option>
                                    </select>
                                </div>

                                <!-- MCU Phase * -->
                                <div v-if="movie.in_mcu == 1" class="flex flex-col gap-1 px-2">
                                    <label for="mcuPhase">MCU Phase</label>
                                    <select name="mcuPhase" v-model="movie.mcu_phase_id" class="rounded-md text-black" required>
                                        <option value="0" disabled hidden>Select a phase...</option>
                                        <option v-for="phase in phases" :key="phase.id" :value="phase.id">{{phase.title}}</option>
                                    </select>
                                </div>

                                <!-- Characters * -->
                                <CharacterSearch ref="characterComponent"></CharacterSearch>
                            </div>

                            <!-- Right Side -->
                            <div class="col-span-1 flex flex-col gap-6">
                                
                                <!-- Directors * -->
                                <DirectorSearch ref="directorComponent"></DirectorSearch>

                                <!-- Sagas * -->
                                <SagaSearch ref="sagaComponent"></SagaSearch>

                                <!-- Posters * -->
                                <div class="flex flex-col gap-2">

                                    <!-- Header -->
                                    <section class="grid grid-cols-2 w-full">
                                        <!-- Title -->
                                        <label for="traits" class="block font-medium text-gray-700 whitespace-nowrap col-span-1 my-auto">Posters</label>
                                    </section>

                                    <!-- Body -->
                                    <section class="border border-gray-300 shadow-md rounded-md p-2 flex flex-col gap-4 max-h-80 overflow-y-scroll divide-y divide-gray-400">
                                        <!-- Input Area -->
                                        <div class="">

                                            <!-- Error Message -->
                                            <div v-if="posterError" class="text-red-500 pb-2">{{posterError}}</div>

                                            <div class="flex items-center gap-2 h-10">
                                                <!-- Input -->
                                                <input type="text" class="w-full h-full rounded-md" v-model="poster">

                                                <!-- Add -->
                                                <button type="button" @click="addPoster" class="transition-all hover:shadow-md text-white bg-purple-400 hover:bg-purple-500 h-full h-10 w-12 flex items-center justify-center rounded-md">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-11a1 1 0 10-2 0v2H7a1 1 0 100 2h2v2a1 1 0 102 0v-2h2a1 1 0 100-2h-2V7z" clip-rule="evenodd" /></svg>
                                                </button>
                                            </div>
                                        </div>


                                        <!-- Results -->
                                        <div v-if="posters.length > 0" class="pt-4 pb-0.5">
                                            <div class="grid grid-cols-4 gap-2 h-48">
                                                <div v-for="(poster, key) in posters" :key="key" class="h-full relative flex group mb-2">
                                                    <img :src="poster" alt="Broken Link" class="col-span-1 h-full object-cover">

                                                    <!-- Remove -->
                                                    <div @click="removePoster(poster)" class="transition-all cursor-pointer text-white opacity-0 group-hover:opacity-80 bg-gray-500 absolute inset-0 flex items-center justify-center">
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" /></svg>
                                                    </div>
                                                </div>
                                            </div>
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
</template>

<script>
    import CharacterSearch from '../Components/Search/CharacterSearch.vue';
    import DirectorSearch from '../Components/Search/DirectorSearch.vue';
    import SagaSearch from '../Components/Search/SagaSearch.vue';

    export default {
        components: {
            CharacterSearch,
            DirectorSearch,
            SagaSearch
        },
        data() {
            return {
                movie: {
                    title: '',
                    release_date: null,
                    in_mcu: '-1',
                    mcu_phase_id: 0,
                    characters: [],
                    directors: [],
                    posters: [],
                    sagas: [],
                },

                poster: null,
                posters: [],
                posterError: null
            }
        },

        methods: {
            createMovie: function() {
                this.movie.directors = this.$refs.directorComponent.selectedDirectors;
                this.movie.characters = this.$refs.characterComponent.selectedCharacters;
                this.movie.sagas = this.$refs.sagaComponent.selectedSagas;
                this.movie.posters = this.posters;

                axios.post('/api/movies', this.movie)
                    .then(res => {
                        this.$emit('closeCreateModal');
                    })
                    .catch(e => console.log(e));
            },

            /**
             * Adds a poster instance
             * 
             * @return {String}
             */
            addPoster: function() {
                console.log(this.posters);
                const regex = new RegExp('^https?://(?:[a-z0-9\-]+\.)+[a-z]{2,6}(?:/[^/#?]+)+\.(?:jpg|gif|png|jpeg)$');
                if (this.poster && regex.test(this.poster)) {
                    this.posters.push(String(this.poster));
                    this.posterError = null;
                    return this.poster = null;
                } else {
                    return this.posterError = "Please enter a valid image URL";
                }
            },

            /**
             * Removes a poster instance
             * 
             * @return {String}
             */
            removePoster: function(value) {
                const posterIndex = this.posters.indexOf(value);
                this.posters.splice(posterIndex, 1);
            },

            reinitialiseMovie: function() {
                return this.movie = {
                    title: '',
                    release_date: null,
                    in_mcu: '-1',
                    mcu_phase_id: 0,
                    characters: [],
                    directors: [],
                    posters: [],
                    sagas: [],
                }
            }
        },
        props: {
            isCreateModalOpen: {
                type: Boolean
            },
            phases: {
                type: Array
            }
        },
    }
</script>