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
                            Edit Actor
                        </h3>

                        <!-- Form -->
                        <form class="rounded-xl px-2 py-4 w-full grid grid-cols-1 gap-8" @submit.prevent="updateActor">

                            <div class="col-span-1 flex flex-col gap-3">
                                <!-- Name * -->
                                <div class="flex flex-col gap-1 px-2">
                                    <label for="title">Name</label>
                                    <input name="title" type="text" required v-model="editableActor.name" autocomplete="off" class="rounded-md" :class="error.name ? 'bg-red-100' : 'bg-white'" placeholder="Actor name...">
                                    <span class="text-red-500" v-if="error.name">{{error.name}}</span>
                                </div>

                                <!-- DOB * -->
                                <div class="flex flex-col gap-1 px-2">
                                    <label for="dob">Date of Birth</label>
                                    <input name="dob" type="date" v-model="editableActor.dob" autocomplete="off" class="rounded-md" :class="error.dob ? 'bg-red-100' : 'bg-white'" required>
                                    <span class="text-red-500" v-if="error.dob">{{error.dob}}</span>
                                </div>

                                <!-- Image * -->
                                <div class="flex flex-col gap-1 px-2">
                                    <label for="image_url">Image</label>
                                    <input type="text" name="image_url" v-model="editableActor.image_url" class="rounded-md" :class="error.image_url ? 'bg-red-100' : 'bg-white'" autocomplete="off" required placeholder="Actor Image...">
                                    <span class="text-red-500" v-if="error.image_url">{{error.image_url}}</span>
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
            editableActor: {
                name: this.actor.name,
                dob: this.actor.dob,
                image_url: this.actor.image_url
            },

            error: {
                name: null,
                dob: null,
                image_url: null
            }
        }
    },
    components: {
        BookOpenIcon,
        UserCircleIcon
    },
    methods: {
        /**
         * Updates the current character instance
         *
         * @return void
         */
        updateActor: function() {
            axios.put(`/api/actors/${this.actor.id}`, this.editableActor)
                .then(res => {
                    this.$emit('updatedActor')
                })
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
         * Emit up to parent to re-fetch actor model instance
         * 
         * @return string
         */
        fetchActor() {
            return this.$emit('fetchActor');
        }
    },
    props: [
        'actor'
    ]
}
</script>