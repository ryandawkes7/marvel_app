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
                                <!-- Header Area -->
                                <div class="sm:flex sm:items-center sm:justify-between">

                                    <!-- Image & Headings -->
                                    <div class="sm:flex sm:space-x-5 w-full">
                                        <!-- Movie Image -->
                                        <div class="flex-shrink-0">
                                            <div class="relative">

                                                <!-- Comic Image -->
                                                <div class="w-20 h-20 flex-shrink-0 mx-auto bg-white rounded-full overflow-hidden shadow-lg">
                                                    <img class="object-cover min-w-full min-h-full max-h-full max-w-full"
                                                        :src="comic.covers.length > 0 ? comic.covers[0].cover_url : 'https://images.unsplash.com/photo-1494790108377-be9c29b29330?ixlib=rb-1.2.1&ixqx=ZsrCV912yo&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=4&w=256&h=256&q=60'"
                                                    />
                                                </div>

                                                <!-- Click to Expand -->
                                                <div class="group absolute -top-1 -right-1 rounded-lg overflow-hidden bg-gray-200 cursor-pointer transition-colors flex p-0.5 hover:bg-red-100" v-if="comic.covers.length > 0" @click="isCoverModalOpen = true">
                                                    <ArrowsExpandIcon class="h-6 w-6 text-white m-auto" stroke="#000000"/>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Headings -->
                                        <div class="mt-4 sm:mt-0 sm:pt-1 sm:text-left flex flex-col gap-y-1 justify-center w-full">

                                            <!-- Title -->
                                            <p class="text-xl font-bold text-gray-900 sm:text-2xl">{{comic.title}}</p>

                                            <!-- Writers -->
                                            <div class="w-full flex items-center gap-x-2" v-if="comic.writers.length >= 1">
                                                <!-- Heading -->
                                                <span class="text-gray-400 font-light sm:text-md" v-if="comic.writers.length > 1">
                                                    Writers:
                                                </span> 
                                                <span class="text-gray-400 font-light sm:text-md" v-else>
                                                    Writer:
                                                </span>

                                                <!-- Writers -->
                                                <div v-for="(writer, index) in comic.writers" :key="index" class="flex gap-x-1 flex-wrap">
                                                    <span class="transition-colors transition-shadow bg-red-50 text-red-400 rounded-md hover:bg-red-100 hover:shadow-md px-2 py-0.5">
                                                        {{writer.name}}
                                                    </span>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                    <div class="mt-5 flex justify-center sm:mt-0">
                                        <a href="#" class="flex justify-center items-center px-4 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 whitespace-nowrap">
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

                    <!-- Comic Issues -->
                    <section aria-labelledby="comic_issues">
                        <div class="rounded-lg bg-gray-200 overflow-hidden shadow divide-y divide-gray-200 sm:divide-y-0 sm:grid sm:grid-cols-1 sm:gap-px">
                            <div class="rounded-lg relative group bg-white p-6 flex flex-col gap-4">

                                <!-- Heading -->
                                <div class="flex flex-col">

                                    <!-- Title -->
                                    <div class="flex justify-between">
                                        <h3 class="text-lg font-medium">
                                            Comic Issues
                                        </h3>
                                        <ExternalLinkIcon class="h-5 w-5" />
                                    </div>

                                    <!-- Subheading -->
                                    <p class="text-sm text-gray-500">
                                        Take a look at all of the issues for this comic below.
                                    </p>
                                </div>

                                <!-- Grid -->
                                <div class="flex flex-col">
                                    <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                                        <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                                            <div class="overflow-hidden border-b border-gray-200 rounded-lg">
                                                <div class="block border border-gray-100">

                                                    <!-- Issues -->
                                                    <div class="grid grid-cols-4">
                                                        <div v-for="issue in comic.comic_issues" :key="issue.id" class="col-span-1 gap-x-4 py-4 px-4">
                                                            <div class="flex flex-col items-center justify-center bg-gray-100 rounded-lg gap-y-2 py-2">

                                                                <!-- Cover Image -->
                                                                <div class="flex h-40 w-auto">
                                                                    <img class="object-cover mx-auto" :src="issue.covers.length > 0 ? issue.covers[0].cover_url : null" alt="Issue Cover" />
                                                                </div>

                                                                <!-- Issue Number -->
                                                                <p class="text-wrap capitalize">
                                                                    Issue No. {{issue.issue_number}}
                                                                </p>

                                                                <!-- Title (Nullable) -->
                                                                <div v-if="issue.title" class="col-span-9 rounded min-h-5 px-2 my-auto">
                                                                    {{issue.title}}
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>

                <!-- Right column -->
                <div class="grid grid-cols-1 gap-4">
                
                    <!-- Characters -->
                    <section aria-labelledby="characters_list">
                        <div class="rounded-lg bg-white overflow-hidden shadow">

                            <!-- Contents -->
                            <div class="px-6 py-4 flex flex-col gap-y-4">

                                <!-- Title -->
                                <h2 class="text-base font-medium text-gray-900" id="announcements-title">
                                    Characters
                                </h2>

                                <!-- Character List -->
                                <div class="flex flex-col">
                                    <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                                        <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                                            <div class="overflow-hidden sm:rounded-lg">

                                                <!-- Characters -->
                                                <div class="grid grid-cols-2 gap-x-4 gap-y-3">
                                                    <div v-for="character in characters" :key="character.id" class="col-span-1 flex flex-col justify-center gap-y-2 bg-gray-100 rounded-lg px-2 py-3">
                                                        <div class="h-24 w-20 flex mx-auto items-center justify-center rounded-md overflow-hidden">
                                                            <img class="object-cover" :src="character.thumb_url" alt="Character" />
                                                        </div>
                                                        <span class="text-md font-bold text-center float-none">{{ character.alias }}</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>

                    <!-- Issues -->
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

        <!-- Cover Modal -->
        <div class="fixed z-20 inset-0 overflow-y-auto h-full" aria-labelledby="enlarged_image" role="dialog" aria-modal="true" v-if="isCoverModalOpen">
            <div class="flex items-end justify-center min-h-full pt-4 px-4 pb-20 text-center sm:block sm:p-0">
                <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true"></div>

                <div class="fixed inset-10 flex justify-center items-center">
                    <div class="flex justify-center items-center overflow-hidden transform transition-all h-full sm:w-full py-2">

                        <!-- Close Button -->
                        <button @click="setIsCoverModalOpen(false)" class="absolute top-0 right-0 group">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 transition-all text-gray-300 group-hover:text-gray-200" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg>
                        </button>

                        <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
                        <img class="object-cover min-h-full" :src="comic.covers.length > 0 ? comic.covers[0].cover_url : null"/>
                    </div>
                </div>
            </div>
        </div>

        <!-- Edit Modal -->
        <!-- <EditModal @fetchComic="fetchComic" @closeEditModal="setIsEditModalOpen(false)" :comic="comic" v-if="isEditModalOpen && comic.id != null"></EditModal> -->

        <SuccessBanner ref="successBanner" :message="'Comic successfully updated'"></SuccessBanner>
        
    </app-layout>
</template>

<script>
import AppLayout from '@/Layouts/AppLayout';
import { ref } from 'vue';
import { Dialog, DialogOverlay, DialogTitle, Menu, MenuButton, MenuItem, MenuItems, TransitionChild, TransitionRoot } from '@headlessui/vue';
import { BookOpenIcon, ChevronDownIcon, FilmIcon, PencilIcon, TrashIcon, UserCircleIcon, UserGroupIcon } from '@heroicons/vue/solid'
import { ArrowsExpandIcon } from '@heroicons/vue/solid'
// import EditModal from './EditModal.vue';
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
        // EditModal,
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
    created() {
        const id = this.fetchId();

        // Fetch comic data
        axios.get(`/api/comics/${id}`)
        .then(res => {
            const data = res.data.data;
            this.comic = data;
            this.comic.comic_issues.forEach(issue => {
                issue.characters.forEach(character => {
                    this.characters.push(character);
                })
            });
        })
    },
    data() {
        return {
            comic: {
                comic_issues: [],
                covers: [],
                created_at: null,
                description: null,
                id: null,
                release_date: null,
                title: null,
                updated_at: null,
                writers: []
            },
            characters: [],
        }
    },
    methods: {
        fetchId() {
            return window.location.href.split('/').pop();
        },

        fetchComic() {
            const id = this.fetchId();

            // Fetch comic data
            axios.get(`/api/comics/${id}`)
            .then(res => {
                const data = res.data.data;
                this.comic = data;
            })
        },
    },
    setup() {
        const isCoverModalOpen = ref(false);
        const isEditModalOpen = ref(false);

        return {
            isCoverModalOpen,
            setIsCoverModalOpen(value) {
                isCoverModalOpen.value = value;
            },
            isEditModalOpen,
            setIsEditModalOpen(value) {
                isEditModalOpen.value = value;
            }
        }
    },
    watch: {
    }
}
</script>