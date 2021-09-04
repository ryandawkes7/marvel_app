<template>
    <app-layout>
        <!-- Header -->
        <header class="max-w-3xl mx-auto px-4 sm:px-6 lg:max-w-7xl lg:px-8 mb-4 flex">
            <Menu as="div" class="relative inline-block text-left ml-auto">
                <div>
                    <MenuButton class="inline-flex justify-center w-full rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-gray-100 focus:ring-indigo-500">
                        Options
                        <ChevronDownIcon class="-mr-1 ml-2 h-5 w-5" aria-hidden="true" />
                    </MenuButton>
                </div>

                <!-- Menu Items -->
                <transition enter-active-class="transition ease-out duration-100" enter-from-class="transform opacity-0 scale-95" enter-to-class="transform opacity-100 scale-100" leave-active-class="transition ease-in duration-75" leave-from-class="transform opacity-100 scale-100" leave-to-class="transform opacity-0 scale-95">
                    <MenuItems class="origin-top-right absolute right-0 mt-2 w-56 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5 focus:outline-none">
                        <div class="py-1">

                            <!-- Edit Character -->
                            <MenuItem>
                                <button @click="setIsEditModalOpen(true)" class="flex items-center block px-4 py-2 text-sm gap-2 w-full" ref="editButtonRef">
                                    <PencilIcon class="w-5 h-5 text-gray-500" />
                                    <p class="text-gray-900">Edit</p>
                                </button>
                            </MenuItem>

                            <!-- Delete Character -->
                            <MenuItem>
                                <button @click="toggleDeleteModal()" class="flex items-center block px-4 py-2 text-sm gap-2 w-full" ref="deleteButtonRef">
                                    <TrashIcon class="w-5 h-5 text-gray-500"/>
                                    <p class="text-gray-900">Delete</p>
                                </button>
                            </MenuItem>
                        </div>
                    </MenuItems>
                </transition>
            </Menu>
        </header>

        <!-- Body -->
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:max-w-7xl lg:px-8">
            <div class="grid grid-cols-1 gap-4 items-start lg:grid-cols-3 lg:gap-8">

                <!-- Left column -->
                <div class="grid grid-cols-1 gap-4 lg:col-span-2">

                    <!-- Description panel -->
                    <section aria-labelledby="profile-overview-title">
                        <div class="rounded-lg bg-white overflow-hidden shadow">
                            <div class="bg-white p-6">
                                <div class="sm:flex sm:items-center sm:justify-between">
                                    <div class="sm:flex sm:space-x-5">
                                        <div class="flex-shrink-0">
                                            <div class="relative">
                                                <div class="w-20 h-20 flex-shrink-0 mx-auto bg-white rounded-full overflow-hidden shadow-lg">
                                                    <img class="object-contain min-w-full min-h-full"
                                                        :src="movie.image ? movie.image : 'https://images.unsplash.com/photo-1494790108377-be9c29b29330?ixlib=rb-1.2.1&ixqx=ZsrCV912yo&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=4&w=256&h=256&q=60'"
                                                    />
                                                </div>
                                                <div class="group absolute -top-1 -right-1 rounded-lg overflow-hidden bg-gray-200 cursor-pointer transition-colors flex p-0.5 hover:bg-red-100" @click="isPosterModalOpen = true">
                                                    <ArrowsExpandIcon class="h-6 w-6 text-white m-auto" stroke="#000000"/>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="mt-4 sm:mt-0 sm:pt-1 sm:text-left flex flex-col justify-center">
                                            <p class="text-xl font-bold text-gray-900 sm:text-2xl">{{movie.title}}</p>
                                            <p class="text-gray-400 font-light sm:text-md">Director: {{movie.director}}</p>
                                        </div>
                                    </div>
                                    <div class="mt-5 flex justify-center sm:mt-0">
                                        <a href="#" class="flex justify-center items-center px-4 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50">
                                            View profile
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="border-t border-gray-200 bg-gray-50 grid grid-cols-1 divide-y divide-gray-200 sm:grid-cols-3 sm:divide-y-0 sm:divide-x">
                                <div  class="px-6 py-5 text-sm font-medium text-center">
                                    <span class="text-gray-900">Stat Value</span>
                                    {{ ' ' }}
                                    <span class="text-gray-600">Stat Label</span>
                                </div>
                            </div>
                        </div>
                    </section>

                    <!-- Skill Grid -->
                    <!-- <SkillGrid :alias="character.alias" :skills="character.skills"></SkillGrid> -->
                </div>

                <!-- Right column -->
                <div class="grid grid-cols-1 gap-4">
                
                    <section aria-labelledby="skill-grid">
                        <div class="rounded-lg bg-white overflow-hidden shadow">

                            <!-- Contents -->
                            <div class="p-6">

                                <!-- Title -->
                                <h2 class="text-base font-medium text-gray-900" id="announcements-title">Section</h2>

                                <!-- Grid -->
                                <div class="flex flex-col">
                                    <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                                        <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                                            <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                                                <div class="block border border-gray-100">
                                                </div>
                            
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Action Button -->
                                <div class="mt-6">
                                    <a href="#" class="w-full flex justify-center items-center px-4 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50">
                                        View all
                                    </a>
                                </div>
                            </div>
                        </div>
                    </section>

                    <!-- Recent Hires -->
                    <section aria-labelledby="recent-hires-title">
                        <div class="rounded-lg bg-white overflow-hidden shadow">
                            <div class="p-6">
                                <h2 class="text-base font-medium text-gray-900" id="recent-hires-title">Recent Hires</h2>
                                <div class="flow-root mt-6">
                                    <ul class="-my-5 divide-y divide-gray-200">
                                        <li class="py-4">
                                            <div class="flex items-center space-x-4">
                                                <div class="flex-shrink-0">
                                                    <img class="h-8 w-8 rounded-full"  alt="" />
                                                </div>
                                                <div class="flex-1 min-w-0">
                                                    <p class="text-sm font-medium text-gray-900 truncate">
                                                        Name
                                                    </p>
                                                    <p class="text-sm text-gray-500 truncate">
                                                        @handle
                                                    </p>
                                                </div>
                                                <div>
                                                    <a class="inline-flex items-center shadow-sm px-2.5 py-0.5 border border-gray-300 text-sm leading-5 font-medium rounded-full text-gray-700 bg-white hover:bg-gray-50">
                                                        View
                                                    </a>
                                                </div>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                                <div class="mt-6">
                                <a href="#" class="w-full flex justify-center items-center px-4 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50">
                                    View all
                                </a>
                            </div>
                        </div>
                    </div>
                    </section>
                </div>
            </div>
        </div>


        <!-- Poster Modal -->
        <div class="fixed z-10 inset-0 overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true" v-if="isPosterModalOpen">
            <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
                <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true" @click="setIsPosterModalOpen(false)"></div>

                <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
                <div class="inline-block align-bottom overflow-hidden shadow-xl transform transition-all sm:align-middle sm:max-w-md sm:max-h-screen sm:w-full">
                    <img class="max-h-screen "
                        :src="movie.image ? movie.image : 'https://images.unsplash.com/photo-1494790108377-be9c29b29330?ixlib=rb-1.2.1&ixqx=ZsrCV912yo&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=4&w=256&h=256&q=60'"
                    />
                </div>
            </div>
        </div>

        <!-- Edit Modal -->
        <EditModal @fetchMovie="fetchMovie" @closeEditModal="setIsEditModalOpen(false)" :movie="movie" v-if="isEditModalOpen && movie.id != null"></EditModal>

        <SuccessBanner ref="successBanner" :message="'Character successfully updated'"></SuccessBanner>
        
    </app-layout>
</template>

<script>
import AppLayout from '@/Layouts/AppLayout';
import { ref } from 'vue';
import { Dialog, DialogOverlay, DialogTitle, Menu, MenuButton, MenuItem, MenuItems, TransitionChild, TransitionRoot } from '@headlessui/vue';
import { BookOpenIcon, ChevronDownIcon, FilmIcon, PencilIcon, TrashIcon, UserCircleIcon, UserGroupIcon } from '@heroicons/vue/solid'
import { ArrowsExpandIcon } from '@heroicons/vue/solid'
import EditModal from './EditModal.vue';
import SuccessBanner from '../Components/SuccessBanner.vue';

export default {
    components: {
        AppLayout,
        ArrowsExpandIcon,
        BookOpenIcon, 
        ChevronDownIcon,
        Dialog,
        DialogOverlay,
        DialogTitle,
        EditModal,
        FilmIcon,
        Menu,
        MenuButton,
        MenuItem,
        MenuItems,
        PencilIcon,
        SuccessBanner,
        TransitionChild,
        TransitionRoot,
        TrashIcon, 
        UserCircleIcon, 
        UserGroupIcon
    },
    async created() {
        const id = this.fetchId();

        // Fetch character data
        axios.get(`/api/movies/${id}`)
        .then(res => {
            const data = res.data.data;
            this.movie = data;
        })
    },
    data() {
        return {
            movie: Object
        }
    },
    methods: {
        fetchId() {
            return window.location.href.split('/').pop();
        },

        fetchMovie() {
            const id = this.fetchId();

            // Fetch character data
            axios.get(`/api/movies/${id}`)
            .then(res => {
                const data = res.data.data;
                this.movie = data;
            })
        },
    },
    setup() {
        const isPosterModalOpen = ref(false);
        const isEditModalOpen = ref(true);

        return {
            isPosterModalOpen,
            setIsPosterModalOpen(value) {
                isPosterModalOpen.value = value;
            },
            isEditModalOpen,
            setIsEditModalOpen(value) {
                isEditModalOpen.value = value;
            }
        }
    }
}
</script>