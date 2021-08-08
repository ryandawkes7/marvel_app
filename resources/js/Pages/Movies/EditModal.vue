<template>

<div class="fixed z-10 inset-0 overflow-y-auto max-h-screen" aria-labelledby="modal-title" role="dialog" aria-modal="true">
    <div class="flex items-end justify-center max-h-screen text-center sm:block mx-4 sm:p-0">
        <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true"></div>

        <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>

        <div class="inline-block max-h-screen h-100 align-bottom bg-white rounded-lg px-4 pt-5 pb-4 text-left overflow-hidden shadow-xl transform transition-all sm:align-middle sm:max-w-7xl sm:w-full sm:p-6">
            <div class="bg-white overflow-hidden flex">

            <!-- Sidebar -->
            <div class="hidden md:flex md:flex-shrink-0">
                <div class="w-64 flex flex-col">
                    <div class="border-r border-gray-200 pt-5 pb-4 flex flex-col flex-grow overflow-y-auto">

                        <!-- Title -->
                        <div class="flex-shrink-0 px-4 flex items-center">
                            <h2 class="h-8 w-auto font-bold text-xl">Edit Movie</h2>
                        </div>

                        <!-- Sub-Page Links -->
                        <div class="flex-grow mt-5 flex flex-col">
                            <nav class="flex-1 bg-white px-2 space-y-1">

                                <!-- Pages -->
                                <button v-for="item in navigationItems" :key="item.name" @click="changeEditSection(item)" :class="[item.current ? 'bg-indigo-50 text-indigo-700 hover:text-indigo-700 hover:bg-indigo-100 border-none' : 'text-gray-900 hover:text-gray-900 hover:bg-gray-50', 'group rounded-md px-3 py-2 flex items-center text-sm font-medium w-full']">
                                    <component :is="item.icon" :class="[item.current ? 'text-indigo-500 group-hover:text-indigo-500' : 'text-gray-400 group-hover:text-gray-500', 'flex-shrink-0 -ml-1 mr-3 h-6 w-6']" aria-hidden="true" />
                                    <span class="truncate">{{ item.name }}</span>
                                </button>

                            </nav>
                        </div>
                    </div>
                </div>
            </div>
            
            <!--  Body -->
            <div class="flex-1 max-w-4xl mx-auto w-0 flex flex-col md:px-8 xl:px-0">

                <!-- Open Sidebar Button (Mobile) -->
                <button class="border-r border-gray-200 px-4 text-gray-500 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-indigo-500 md:hidden">
                    <span class="sr-only">Open sidebar</span>
                    <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h7" /></svg>
                </button>

                <!-- Viewport -->
                <main class="flex-1 relative overflow-y-auto focus:outline-none">
                    <div class="px-4 py-6 sm:px-6 md:px-0">
                        <div class="space-y-6 sm:px-6 lg:px-0 lg:col-span-9">
                            <PosterModal @fetchMovie="fetchMovie" :posters="movie.posters" :movie_id="movie.id" v-if="isPoster"></PosterModal>
                        </div>
                    </div>
                </main>
            </div>
            </div>
        </div>
    </div>
</div>

</template>

<script>
import { ref } from 'vue';
import { BookOpenIcon, UserCircleIcon } from '@heroicons/vue/solid';
import DetailsModal from './DetailsModal.vue';
import PosterModal from './PosterModal.vue';

export default {
    components: {
        BookOpenIcon,
        DetailsModal,
        PosterModal,
        UserCircleIcon
    },
    created() {
        console.log(`Movie:`);
        console.log(this.movie.posters);
    },
    data() {
        return {
            navigationItems: [
                { id: 1, name: 'Details', icon: UserCircleIcon, current: true},
                { id: 2, name: 'Poster', icon: BookOpenIcon, current: false},
            ],
        }
    },
    methods: {
        changeEditSection(section) {
            let activeSection = '';

            const setSection = (section) => {
            section.current = true;
            activeSection = section;
            }

            this.navigationItems.forEach(item => {
            item.id != section.id ? item.current = false : setSection(item);
            });

            switch(activeSection.id) {
            case 1:
                this.isDetails = true;
                this.isPoster = false;
            case 2: 
                this.isDetails = false;
                this.isPoster = true;
                break;
            }
        },
        fetchMovie() {
            this.$emit('fetchMovie');
        }
    },
    props: {
        movie: {
            type: Object
        }
    },
    setup() {
        // Modals
        const isEditModalOpen = ref(false);

        const isDetails = ref(true);
        const isPoster = ref(false);

        return {
            isEditModalOpen, 
            isDetails, 
            isPoster,
        }
    }
}
</script>