<template>
    <section class="fixed z-10 inset-0 overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
        <div class="flex items-end justify-center min-h-screen h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
            <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true" @click="this.$emit('closeDeleteModal')"></div>

            <!-- Centering -->
            <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>

            <!-- Body -->
            <div class="inline-block align-bottom bg-white rounded-lg px-4 pt-5 pb-4 text-left overflow-y-scroll shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-2xl sm:w-full sm:p-6">
                <div class="flex items-start">
                    <div class="mt-3 text-center sm:mt-0 sm:text-left w-full flex flex-col gap-4">

                        <!-- Title -->
                        <h3 class="text-lg leading-6 font-medium text-gray-900" id="modal-title">
                            Delete Actor
                        </h3>

                        <!-- Form -->
                        <form 
                            class="rounded-xl px-2 py-4 w-full grid grid-cols-1 gap-8" 
                            @submit.prevent="deleteActor()"
                        >
                            <p>Are you sure you would like to delete {{actor.name}}?</p>

                            <!-- Action Buttons -->
                            <div class="col-span-1 grid grid-cols-2 gap-x-4">
                                <!-- Cancel -->
                                <button 
                                    type="button" 
                                    @click="this.$emit('closeDeleteModal')" 
                                    class="px-3 py-1.5 bg-gray-400 rounded-md text-gray-50 hover:bg-gray-500 hover:shadow-md"
                                >
                                    Cancel
                                </button>

                                <!-- Confirm -->
                                <button 
                                    type="submit" 
                                    class="px-3 py-1.5 bg-purple-400 rounded-md text-purple-50 hover:bg-purple-500 hover:shadow-md"
                                >
                                    Confirm
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
            error: ""
        }
    },
    components: {
        BookOpenIcon,
        UserCircleIcon
    },
    methods: {
        /**
         * Deletes the current character instance
         *
         * @return void
         */
        deleteActor: function() {
            axios.delete(`/api/actors/${this.actor.id}`)
                .then(() => window.location.href = `/actors`)
                .catch(e => this.error = e);
        },
    },
    props: [
        'actor'
    ]
}
</script>