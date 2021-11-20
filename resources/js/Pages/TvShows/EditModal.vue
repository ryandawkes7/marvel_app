<template>
    <section class="fixed z-10 inset-0 overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
        <div class="flex items-end justify-center min-h-screen h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
            <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true" @click="this.$emit('closeEditModal')"></div>

            <!-- Centering -->
            <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>

            <!-- Body -->
            <div class="inline-block align-bottom bg-white rounded-lg px-4 pt-5 pb-4 text-left overflow-y-scroll shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-2xl sm:w-full sm:p-6">
                <div class="flex items-start">
                    <div class="mt-3 text-center sm:mt-0 sm:text-left w-full flex flex-col gap-4">

                        <!-- Title -->
                        <h3 class="text-lg leading-6 font-medium text-gray-900" id="modal-title">
                            Edit TV Show
                        </h3>

                        <!-- Form -->
                        <form class="rounded-xl py-4 w-full grid grid-cols-1 gap-8 text-sm" @submit.prevent="updateShow">

                            <div class="col-span-1 grid grid-cols-12 gap-y-3">

                                <div class="col-span-12 grid grid-cols-10 gap-x-4">
                                    <!-- Title * -->
                                    <div class="flex flex-col gap-1 col-span-6">
                                        <label for="title">Title</label>
                                        <input name="title" type="text" required v-model="editableShow.title" autocomplete="off" class="rounded-md text-sm" :class="error.title ? 'bg-red-100' : 'bg-white'" placeholder="TV show title...">
                                        <span class="text-red-500" v-if="error.title">{{error.title}}</span>
                                    </div>
                                    
                                    <!-- Episode Count * -->
                                    <div class="flex flex-col gap-1 col-span-2">
                                        <label for="episodeCount">Total Episodes</label>
                                        <input name="episodeCount" type="number" step="1" required v-model="editableShow.episode_count" autocomplete="off" class="rounded-md text-sm" :class="error.episode_count ? 'bg-red-100' : 'bg-white'" placeholder="No. of episodes...">
                                        <span class="text-red-500" v-if="error.season_count">{{error.season_count}}</span>
                                    </div>
                                    
                                    <!-- Season Count * -->
                                    <div class="flex flex-col gap-1 col-span-2">
                                        <label for="seasonCount">Total Seasons</label>
                                        <input name="seasonCount" type="number" step="1" required v-model="editableShow.season_count" autocomplete="off" class="rounded-md text-sm" :class="error.season_count ? 'bg-red-100' : 'bg-white'" placeholder="No. of seasons...">
                                        <span class="text-red-500" v-if="error.season_count">{{error.season_count}}</span>
                                    </div>
                                </div>

                                <!-- Logo URL * -->
                                <div class="flex flex-col gap-1 col-span-12">
                                    <label for="logo_url">Logo URL</label>
                                    <input type="text" name="logo_url" v-model="editableShow.logo_url" class="rounded-md text-sm" :class="error.logo_url ? 'bg-red-100' : 'bg-white'" autocomplete="off" required placeholder="TV show logo...">
                                    <span class="text-red-500" v-if="error.logo_url">{{error.logo_url}}</span>
                                </div>
                                
                                <!-- Description * -->
                                <div class="flex flex-col gap-1 col-span-12">
                                    <label for="description">Description</label>
                                    <textarea name="description" type="text" v-model="editableShow.description" autocomplete="off" class="rounded-md text-sm" :class="error.description ? 'bg-red-100' : 'bg-white'" placeholder="TV show description..."></textarea>
                                    <span class="text-red-500" v-if="error.description">{{error.description}}</span>
                                </div>
                                
                                <div class="col-span-12 grid grid-cols-4 gap-x-4">
                                    <!-- In MCU * -->
                                    <div class="flex flex-col gap-1 col-span-1">
                                        <label for="inMcu">In MCU?</label>
                                        <input name="inMcu" type="checkbox" v-model="editableShow.in_mcu" autocomplete="off" class="rounded-md text-sm" :class="error.in_mcu ? 'bg-red-100' : 'bg-white'">
                                        <span class="text-red-500" v-if="error.in_mcu">{{error.in_mcu}}</span>
                                    </div>

                                    <!-- MCU Phase * -->
                                    <div class="flex flex-col gap-1 col-span-3" v-if="editableShow.mcu_phase_id">
                                        <label for="inMcu">MCU Phase</label>
                                        <select class="rounded-md text-sm">
                                            <option value="1">Phase 1</option>
                                            <option value="2">Phase 2</option>
                                            <option value="3">Phase 3</option>
                                            <option value="4">Phase 4</option>
                                        </select>
                                        <span class="text-red-500" v-if="error.mcu_phase_id">{{error.mcu_phase_id}}</span>
                                    </div>
                                </div>
                                

                                <!-- Release Date * -->
                                <div class="flex flex-col gap-1 col-span-6">
                                    <label for="release_date">Release Date</label>
                                    <input name="release_date" type="date" v-model="editableShow.release_date" autocomplete="off" class="rounded-md text-sm" :class="error.release_date ? 'bg-red-100' : 'bg-white'" required>
                                    <span class="text-red-500" v-if="error.release_date">{{error.release_date}}</span>
                                </div>
                            </div>

                            <div class="w-full flex items-center justify-end">
                                <button type="submit" class="px-3 py-1.5 bg-purple-400 rounded-md text-purple-50 hover:bg-purple-500 hover:shadow-md">
                                    Save
                                </button>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>

<script>
import { BookOpenIcon, UserCircleIcon } from '@heroicons/vue/solid';

export default {
    data() {
        return {
            editableShow: {
                title: this.show.title,
                episode_count: this.show.episode_count,
                season_count: this.show.season_count,
                logo_url: this.show.logo_url,
                description: this.show.description,
                in_mcu: this.show.in_mcu,
                mcu_phase_id: this.show.mcu_phase_id,
                release_date: this.show.release_date,
            },

            error: {
                episode_count: null,
                season_count: null,
                logo_url: null,
                description: null,
                in_mcu: null,
                mcu_phase_id: null,
                release_date: null,
            }
        }
    },
    components: {
        BookOpenIcon,
        UserCircleIcon
    },
    methods: {
        /**
         * Updates the current TV Show instance
         *
         * @return void
         */
        updateShow: function() {
            axios.put(`/api/tv-shows/${this.show.id}`, this.editableShow)
                .then(() => this.$emit('updatedShow'))
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
         * Emit up to parent to re-fetch TV Show model instance
         * 
         * @return string
         */
        fetchShow() {
            return this.$emit('fetchShow');
        }
    },
    props: [
        'show'
    ]
}
</script>