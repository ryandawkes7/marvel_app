<template>
    <!-- Movie Details View -->
    <form method="POST" class="h-full">
        <div class="sm:overflow-hidden h-full relative">

            <!-- Content -->
            <div class="bg-white py-5 px-4 min-h-full max-h-full overflow-y-scroll space-y-6">
                
                <!-- Heading -->
                <div>
                    <h3 class="text-lg leading-6 font-medium text-gray-900">Movie Details</h3>
                    <p class="mt-1 text-sm text-gray-500">Edit the details for this movie.</p>
                </div>
                
                <hr>

                <div class="bg-white">
                    <div class="grid grid-cols-6 gap-6">

                        <!-- Title -->
                        <div class="lg:col-span-4 sm:col-span-6">
                            <label for="title" class="block text-sm font-medium text-gray-700">Title</label>
                            <input type="text" v-model="movie.title" name="title" id="title" autocomplete="off" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                        </div>

                        <!-- Directors -->
                        <div class="lg:col-span-4 sm:col-span-6">
                            <label for="director" class="block text-sm font-medium text-gray-700">Directors</label>

                            <div class="border border-gray-300 shadow-md rounded-md p-2 flex flex-wrap gap-2">
                                <span v-for="director in directors" :key="director.id" v-on="movieDirectorIds.includes(director.id) ? {click: () => removeSelectedDirector(director)} : {click: () => addSelectedDirector(director)}" class="transition-colors px-2 py-0.5 rounded-full whitespace-nowrap cursor-pointer text-sm" :class="movieDirectorIds.includes(director.id) ? 'bg-green-400 text-green-100 hover:bg-green-500 ' : 'bg-red-400 hover:bg-red-500 text-red-100'">
                                    {{director.name}}
                                </span>
                            </div>
                        </div>

                        <!-- Release Date -->
                        <div class="lg:col-span-4 sm:col-span-6">
                            <label for="release_date" class="block text-sm font-medium text-gray-700">Release Date</label>
                            <input type="date" v-model="movie.release_date" name="release_date" id="release_date" autocomplete="off" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                        </div>

                        <!-- In MCU (Toggle) -->
                        <div class="col-span-4 flex items-baseline align-bottom gap-2">
                            <label for="in_mcu" class="block text-sm font-medium text-gray-700">In MCU?</label>
                            <input type="checkbox" v-model="movie.in_mcu" @click="toggleInMcu" :checked="movie.in_mcu ? true : false" name="in_mcu" id="in_mcu" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block shadow-sm sm:text-sm border-gray-300 rounded-md">
                        </div>

                        <!-- MCU Phase (Only Visible if In MCU is True) -->
                        <div class="col-span-4 sm:col-span-6 lg:col-span-4" v-if="movie.in_mcu = true">
                            <label for="mcu_phase" class="block text-sm font-medium text-gray-700">MCU Phase</label>
                            <select v-model="selectedPhase" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                <option v-for="phase in phases" :key="phase.id" :value="phase.id" :selected="phase.id == selectedPhase">{{ phase.title }}</option>
                            </select>
                        </div>

                        <!-- Associated Saga -->
                        <div class="col-span-4 sm:col-span-4">
                            <label for="saga" class="block text-sm font-medium text-gray-700">Associated Saga</label>

                            <div class="border border-gray-300 shadow-md rounded-md p-2 flex flex-wrap gap-2">
                                <span v-for="saga in sagas" :key="saga.id" v-on="movieSagaIds.includes(saga.id) ? {click: () => removeSelectedSaga(saga)} : {click: () => addSelectedSaga(saga)}" class="transition-colors px-2 py-0.5 rounded-full whitespace-nowrap cursor-pointer text-sm" :class="movieSagaIds.includes(saga.id) ? 'bg-green-400 text-green-100 hover:bg-green-500 ' : 'bg-red-400 hover:bg-red-500 text-red-100'">
                                    {{saga.title}}
                                </span>
                            </div>
                        </div>

                        <!-- Action Buttons -->
                        <div class="absolute bottom-5 right-5 flex gap-2 mt-auto">
                            <!-- Cancel -->
                            <button type="button" class="px-5 py-2 transition-all bg-white border border-gray-300 rounded-md hover:bg-gray-50 hover:shadow" @click="this.$emit('closeEditModal')">Cancel</button>

                            <!-- Save -->
                            <button type="button" class="px-5 py-2 transition-all bg-gray-300 border border-gray-400 rounded-md hover:bg-gray-400 hover:shadow" @click="updateMovie()">Save</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</template>

<script>
export default {
    data() {
        return {
            phases: [],
            selectedPhase: this.movie.mcu_phase_id,

            directors: [],
            selectedDirectors: this.movie.directors,

            sagas: [],
            selectedSagas: this.movie.sagas,
            

            // Props on the selected movie 
            movieSagas: this.movie.sagas,
            movieDirectors: this.movie.directors,
        }
    },
    computed: {
        movieSagaIds: function() {
            const id_array = [];
            for (let i = 0; i < this.movie.sagas.length; i++) {
                id_array.push(this.movie.sagas[i].id);
            }
            return id_array;
        },
        movieDirectorIds: function() {
            const id_array = [];
            for (let i = 0; i < this.movie.directors.length; i++) {
                id_array.push(this.movie.directors[i].id);
            }
            return id_array;
        },
    },
    created() {
        this.fetchDirectors(),
        this.fetchPhases(),
        this.fetchSagas()
    },
    methods: {

        /**
         * Adds specified director to the selectedDirectors array
         *
         * @param {Object} director 
         */
        addSelectedDirector: function(director) {
            this.selectedDirectors.push(director);
        },

        /**
         * Removes specified director from the selectedDirectors array
         *
         * @param {Object} director 
         */
        removeSelectedDirector: function(director) {
            const director_index = this.selectedDirectors.findIndex(item => item.id == director.id);
            this.selectedDirectors.splice(director_index, 1);
        },

        /**
         * Adds specified saga to the selectedSagas array
         *
         * @param {Object} saga
         */
        addSelectedSaga: function(saga) {
            this.selectedSagas.push(saga);
            console.log(this.selectedSagas);
        },

        /**
         * Removes specified saga from selectedSagas array
         *
         * @param {Object} saga
         */
        removeSelectedSaga: function(saga) {
            const saga_index = this.selectedDirectors.findIndex(item => item.id == saga.id);
            this.selectedSagas.splice(saga_index, 1);
        },

        /**
         * Fetch all directors
         */
        fetchDirectors: function() {
            axios.get('/api/directors')
                .then(res => {
                    this.directors = res.data.data;
                    const movieDirectors = [];

                    for (let i = 0; i < this.movie.directors.length; i++) {
                        movieDirectors.push(this.movie.directors[i]);
                    }

                })
                .catch(e => console.log(e));
        },

        /**
         * Fetch all phases from table
         */
        fetchPhases: function () {
            axios.get('/api/phases')
                .then(res => {
                    this.phases = res.data.data;
                    this.selectedPhase = this.movie.phase.id;
                })
                .catch(e => console.log(e))
        },

        /**
         * Fetches all sagas. 
         * Also assigns the sagas that this movie belongs to into an array
         *
         * @return void
         */
        fetchSagas: function() {
            axios.get('/api/sagas')
                .then(res => {
                    this.sagas = res.data.data
                })
                .catch(e => console.log(e))
        },

        updateMovie: function() {
            this.movie.directors = this.selectedDirectors;
            this.movie.mcu_phase_id = this.selectedPhase;

            axios.patch(`/api/movies/${this.movie.id}`, this.movie )
                .then(res => {
                    this.$emit('closeEditModal');
                    console.log(this.movie.directors);
                })
                .catch(e => {
                    if (e.response && e.response.status == 422) { this.validationErrors = e.response.data.errors }
                    else console.log(e);
                })
        }

    },
    props: {
        movie: {
            type: [Array, Object],
            required: true
        }
    }
}
</script>