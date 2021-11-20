<template>
    <section class="fixed z-10 inset-0 overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
        <div class="flex items-end justify-center min-h-screen h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
            <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true" @click="this.$emit('closeCreateModal')"></div>

            <!-- Centering -->
            <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>

            <!-- Body -->
            <div class="inline-block align-bottom bg-white rounded-lg px-4 pt-5 pb-4 text-left overflow-y-scroll shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-2xl sm:w-full sm:p-6">
                <div class="flex items-start">
                    <div class="mt-3 text-center sm:mt-0 sm:text-left w-full flex flex-col gap-4">

                        <!-- Title -->
                        <h3 class="text-lg leading-6 font-medium text-gray-900" id="modal-title">
                            Create New TV Show
                        </h3>

                        <!-- Form -->
                        <form class="rounded-xl py-4 w-full grid grid-cols-12 gap-y-3 text-sm" @submit.prevent="createShow">

                            <div class="grid grid-cols-10 gap-x-4 col-span-12">

                                <!-- Title * -->
                                <div class="flex flex-col gap-1 col-span-6">
                                    <label for="title">Title</label>
                                    <input name="title" type="text" required v-model="show.title" autocomplete="off" class="rounded-md text-sm" placeholder="TV Show title...">
                                </div>

                                <!-- Episode Count * -->
                                <div class="flex flex-col gap-1 col-span-2">
                                    <label for="episode_count">Total Episodes</label>
                                    <input type="number" name="episode_count" id="episode_count" v-model="show.episode_count" class="rounded-md text-sm" placeholder="No. of episodes..." step="1" />
                                </div>
                                
                                <!-- Season Count * -->
                                <div class="flex flex-col gap-1 col-span-2">
                                    <label for="season_count">Total Seasons</label>
                                    <input type="number" name="season_count" id="season_count" v-model="show.season_count" class="rounded-md text-sm" placeholder="No. of seasons..." step="1" />
                                </div>
                            </div>
                            
                            <!-- Logo URL * -->
                            <div class="flex flex-col gap-1 col-span-12">
                                <label for="logo_url">Logo URL</label>
                                <input type="text" name="logo_url" id="logo_url" v-model="show.logo_url" class="rounded-md text-sm" placeholder="Series Logo URL..."/>
                            </div>
                            
                            <!-- Description * -->
                            <div class="flex flex-col gap-1 col-span-12">
                                <label for="description">Description</label>
                                <textarea rows="2" type="text" name="description" id="description" v-model="show.description" class="rounded-md text-sm" placeholder="Description..."/>
                            </div>
                            
                            <div class="grid grid-cols-4 col-span-12 gap-x-4">
                                <!-- In MCU * -->
                                <div class="flex flex-col gap-1 col-span-1">
                                    <label for="in_mcu">In MCU</label>
                                    <input type="checkbox" name="in_mcu" id="in_mcu" v-model="show.in_mcu" class="rounded-md" />
                                </div>
                                
                                <!-- MCU Phase ID * -->
                                <div class="flex flex-col gap-1 col-span-3" v-if="show.in_mcu">
                                    <label for="in_mcu">In MCU</label>
                                    <select name="mcu_phase" id="mcu_phase" class="rounded-md inline-flex w-auto text-sm">
                                        <option value="1">Phase 1</option>
                                        <option value="2">Phase 2</option>
                                        <option value="3">Phase 3</option>
                                        <option value="4">Phase 4</option>
                                    </select>
                                </div>
                            </div>

                            <!-- Release Date * -->
                            <div class="flex flex-col gap-1 col-span-12">
                                <label for="releaseDate">Release Date</label>
                                <input name="releaseDate" type="date" v-model="show.release_date" autocomplete="off" class="rounded-md text-sm">
                            </div>

                            <!-- Action Button -->
                            <div class="col-span-12 flex items-center justify-end">
                                <button type="submit" class="transition-all px-3 py-1.5 bg-purple-400 rounded-md text-purple-50 hover:bg-purple-500 hover:shadow-md">Confirm</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>

<script>
export default {
    data() {
        return {
            show: {
                title: null,
                episode_count: 0,
                season_count: 0,
                logo_url: null,
                description: null,
                in_mcu: 0,
                mcu_phase_id: null,
                release_date: null
            },

            error: {
                title: null,
                episode_count: null,
                season_count: null,
                logo_url: null,
                description: null,
                in_mcu: null,
                mcu_phase_id: null,
                release_date: null
            }
        }
    },

    methods: {
        /**
         * Creates a show instance
         *
         * @return void
         */
        createShow: function() {
            axios.post('/api/tv-shows', this.show)
                .then(() => this.$emit('closeCreateModal'))
                .catch(e => {
                    // Assign value to error object
                    if (e.response) {
                        for (const [key, value] of Object.entries(e.response.data.message)) {
                            if (key in this.error) {
                                this.error[key] = value[0];
                            }
                        }
                    }
                });
        },

        /**
         * Resets show object back to default
         *
         * @return object
         */
        resetShow: function() {
            return this.show = {
                title: null,
                episode_count: 0,
                season_count: 0,
                logo_url: null,
                description: null,
                in_mcu: 0,
                mcu_phase_id: null,
                release_date: null
            }
        }
    },
    props: ['isCreateModalOpen'],
}
</script>