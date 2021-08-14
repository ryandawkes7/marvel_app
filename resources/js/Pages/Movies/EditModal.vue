<template>
    <div class="fixed z-10 inset-0 overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
        <div class="flex items-end justify-center min-h-screen h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
            <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true"></div>

            <!-- Centering -->
            <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>

            <!-- Body -->
            <div class="inline-block h-5/6 align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:w-full max-w-7xl">
                <div class="h-full flex overflow-hidden bg-white">

                    <!-- Menu (Mobile) -->
                    <div class="fixed inset-0 flex z-40 lg:hidden" role="dialog" aria-modal="true">
                        <div class="fixed inset-0 bg-gray-600 bg-opacity-75" aria-hidden="true"></div>
                        <div class="relative flex-1 flex flex-col max-w-xs w-full bg-white focus:outline-none">
                            <!-- Close Sidebar -->
                            <div class="absolute top-0 right-0 -mr-12 pt-2">
                                <button type="button" class="ml-1 flex items-center justify-center h-10 w-10 rounded-full focus:outline-none focus:ring-2 focus:ring-inset focus:ring-white">
                                    <span class="sr-only">Close sidebar</span>
                                    <svg class="h-6 w-6 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                    </svg>
                                </button>
                            </div>

                            <!-- Section Buttons -->
                            <div class="flex-1 h-0 pt-5 pb-4 overflow-y-auto">
                                <div class="flex-shrink-0 flex items-center px-4">
                                <img class="h-8 w-auto" src="https://tailwindui.com/img/logos/workflow-logo-indigo-600-mark-gray-900-text.svg" alt="Workflow">
                                </div>
                                <nav aria-label="Sidebar" class="mt-5">
                                <div class="px-2 space-y-1">
                                    <a href="#" class="bg-gray-100 text-gray-900 group flex items-center px-2 py-2 text-base font-medium rounded-md">
                                    <svg class="text-gray-500 mr-4 h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                                    </svg>
                                    Dashboard
                                    </a>

                                    <a href="#" class="text-gray-600 hover:bg-gray-50 hover:text-gray-900 group flex items-center px-2 py-2 text-base font-medium rounded-md">
                                    <!-- Heroicon name: outline/calendar -->
                                    <svg class="text-gray-400 group-hover:text-gray-500 mr-4 h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>
                                    Calendar
                                    </a>

                                    <a href="#" class="text-gray-600 hover:bg-gray-50 hover:text-gray-900 group flex items-center px-2 py-2 text-base font-medium rounded-md">
                                    <!-- Heroicon name: outline/user-group -->
                                    <svg class="text-gray-400 group-hover:text-gray-500 mr-4 h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                                    </svg>
                                    Teams
                                    </a>

                                    <a href="#" class="text-gray-600 hover:bg-gray-50 hover:text-gray-900 group flex items-center px-2 py-2 text-base font-medium rounded-md">
                                    <!-- Heroicon name: outline/search-circle -->
                                    <svg class="text-gray-400 group-hover:text-gray-500 mr-4 h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16l2.879-2.879m0 0a3 3 0 104.243-4.242 3 3 0 00-4.243 4.242zM21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    Directory
                                    </a>

                                    <a href="#" class="text-gray-600 hover:bg-gray-50 hover:text-gray-900 group flex items-center px-2 py-2 text-base font-medium rounded-md">
                                    <!-- Heroicon name: outline/speakerphone -->
                                    <svg class="text-gray-400 group-hover:text-gray-500 mr-4 h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z" />
                                    </svg>
                                    Announcements
                                    </a>

                                    <a href="#" class="text-gray-600 hover:bg-gray-50 hover:text-gray-900 group flex items-center px-2 py-2 text-base font-medium rounded-md">
                                    <!-- Heroicon name: outline/map -->
                                    <svg class="text-gray-400 group-hover:text-gray-500 mr-4 h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7" />
                                    </svg>
                                    Office Map
                                    </a>
                                </div>
                                </nav>
                            </div>
                        </div>

                        <div class="flex-shrink-0 w-14" aria-hidden="true">
                        <!-- Force sidebar to shrink to fit close icon -->
                        </div>
                    </div>

                    <!-- Sidebar (Desktop) -->
                    <div class="hidden lg:flex lg:flex-shrink-0">
                        <div class="flex flex-col w-64">
                            <!-- Sidebar Component -->
                            <div class="flex flex-col h-0 flex-1 border-r border-gray-200 bg-gray-100">
                                <div class="flex-1 flex flex-col pt-5 pb-4 overflow-y-auto">

                                    <!-- Title -->
                                    <div class="flex-shrink-0 px-4 flex items-center">
                                        <h2 class="h-8 w-auto font-bold text-xl">Edit Movie</h2>
                                    </div>

                                    <!-- Section Buttons -->
                                    <nav class="mt-5 flex-1" aria-label="Sidebar">
                                        <div class="px-2 space-y-1">
                                            <button v-for="item in navigationItems" :key="item.name" @click="changeEditSection(item)" :class="[item.current ? 'bg-indigo-50 text-indigo-700 hover:text-indigo-700 hover:bg-indigo-100 border-none' : 'text-gray-900 hover:text-gray-900 hover:bg-gray-50', 'group rounded-md px-3 py-2 flex items-center text-sm font-medium w-full']">
                                                <component :is="item.icon" :class="[item.current ? 'text-indigo-500 group-hover:text-indigo-500' : 'text-gray-400 group-hover:text-gray-500', 'flex-shrink-0 -ml-1 mr-3 h-6 w-6']" aria-hidden="true" />
                                                <span class="truncate">{{ item.name }}</span>
                                            </button>
                                        </div>
                                    </nav>

                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Main -->
                    <div class="flex flex-col min-w-0 flex-1 overflow-hidden h-full">

                        <!-- Mobile -->
                        <div class="lg:hidden">
                            <div class="flex items-center justify-between bg-gray-50 border-b border-gray-200 px-4 py-1.5">
                                <div>
                                    <img class="h-8 w-auto" src="https://tailwindui.com/img/logos/workflow-mark-indigo-600.svg" alt="Workflow">
                                </div>
                                <div>
                                    <button type="button" class="-mr-3 h-12 w-12 inline-flex items-center justify-center rounded-md text-gray-500 hover:text-gray-900">
                                        <span class="sr-only">Open sidebar</span>
                                        <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" /></svg>
                                    </button>
                                </div>
                            </div>
                        </div>

                        <!-- Body -->
                        <div class="flex-1 relative z-0 flex overflow-hidden h-full">
                            <main class="flex-1 relative z-0 overflow-y-auto focus:outline-none xl:order-last">
                                <div class="absolute inset-0">
                                    <div class="px-4 sm:px-6 md:px-0">
                                        <div class="space-y-6 sm:px-6 lg:px-0 lg:col-span-9">
                                            <PosterModal @fetchMovie="fetchMovie" :posters="movie.posters" :movie_id="movie.id" v-if="isPoster"></PosterModal>
                                        </div>
                                    </div>
                                </div>
                            </main>
                        </div>
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
    data() {
        return {
            navigationItems: [
                { id: 1, name: 'Details', icon: UserCircleIcon, current: true},
                { id: 2, name: 'Posters', icon: BookOpenIcon, current: false},
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