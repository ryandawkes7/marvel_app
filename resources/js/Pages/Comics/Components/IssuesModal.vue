<template>
    <!-- Comic Details View -->
    <form method="POST" class="h-full">
        <div class="sm:overflow-hidden h-full relative">

            <!-- Content -->
            <div class="bg-white py-5 px-4 min-h-full max-h-full overflow-y-scroll space-y-4">
                
                <!-- Heading -->
                <div>
                    <h3 class="text-lg leading-6 font-medium text-gray-900">Comic Issues</h3>
                    <p class="mt-1 text-sm text-gray-500">Add and remove issues against this comic book.</p>
                </div>
                
                <hr>

                <div class="bg-white">
                    <div class="grid grid-cols-6 gap-4">

                        <!-- Existing Issues -->
                        <div class="col-span-6 flex flex-col gap-y-2">

                            <!-- Heading -->
                            <div class="flex justify-between items-center">
                                <!-- Title -->
                                <label for="writer" class="block text-md font-bold text-gray-900">Existing Issues</label>
                            </div>

                            <!-- Body -->
                            <div class="border border-gray-100 rounded-md overflow-x-scroll shadow-inner py-2 px-4">

                                <ul class="flex gap-x-4 py-2 mr-4" v-if="comic.comic_issues.length > 0">
                                    <li v-for="issue in comic.comic_issues" :key="issue.id" class="flex flex-col gap-y-2 items-center rounded-lg shadow-md bg-gray-50 px-6 py-2 relative">
                                        <!-- Delete Button -->
                                        <button class="absolute -top-2 -right-2 rounded-full" @click.prevent="deleteIssue(issue.id)">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 transition-colors text-gray-400 hover:text-gray-500" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" /></svg>
                                        </button>

                                        <!-- Issue Number -->
                                        <div class="text-xs text-center">
                                            <span class="whitespace-nowrap">Issue No.: {{issue.issue_number}}</span>
                                        </div>

                                        <!-- Comic Cover -->
                                        <div class="h-32 w-20 flex items-center justify-center">
                                            <img class="max-h-full object-contain" :src="issue.covers[0] ? issue.covers[0].cover_url : null" alt="Cover">
                                        </div>

                                        <!-- Volume Number -->
                                        <div class="text-xs text-center" v-if="issue.volume_number">
                                            <span class="whitespace-nowrap">Volume No.: {{issue.volume_number}}</span>
                                        </div>
                                        
                                        <!-- Release Date -->
                                        <div class="text-xs text-center" v-if="issue.release_date">
                                            <span class="whitespace-nowrap">Release Date: {{issue.release_date}}</span>
                                        </div>
                                    </li>
                                </ul>
                                <div v-else class="text-gray-300 flex flex-col items-center justify-center py-5">
                                    <span class="text-lg italic font-bold">No issues found for {{comic.title}}</span>
                                    <span class="text-sm italic">Create the first issue for this comic below</span>
                                </div>
                            </div>
                        </div>

                        <hr class="col-span-6">

                        <!-- Add New Issue -->
                        <div class="col-span-6 flex flex-col gap-y-2">

                            <form id="new_issue_form" @submit.prevent="addNewIssue">
                                <!-- Heading -->
                                <div class="flex justify-between items-center">
                                    <!-- Title -->
                                    <label for="writer" class="block text-md font-bold text-gray-900">Add New Issue</label>
                                    
                                    <!-- Action Buttons -->
                                    <button type="submit" class="transition-all bg-green-50 border border-green-100 text-gray-700 flex gap-1 items-center px-2 py-1 rounded-lg hover:bg-green-100 hover:shadow-md">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-green-500" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-11a1 1 0 10-2 0v2H7a1 1 0 100 2h2v2a1 1 0 102 0v-2h2a1 1 0 100-2h-2V7z" clip-rule="evenodd" /></svg>
                                        <span>Add Issue</span>
                                    </button>
                                </div>

                                <!-- Body -->
                                <div class="flex flex-col gap-y-2">
                                    <!-- Title -->
                                    <div class="lg:col-span-4 sm:col-span-6">
                                        <label for="title" class="block text-sm font-medium text-gray-700">Title</label>
                                        <input v-model="newIssue.title" type="text" name="title" id="title" autocomplete="off" placeholder="Enter issue title..." class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                    </div>
                                    
                                    <!-- Description -->
                                    <div class="lg:col-span-4 sm:col-span-6">
                                        <label for="title" class="block text-sm font-medium text-gray-700">Description</label>
                                        <input v-model="newIssue.description" type="text" name="title" id="title" autocomplete="off" placeholder="Enter issue description..." class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                    </div>

                                    <!-- Issue No. -->
                                    <div class="lg:col-span-4 sm:col-span-6">
                                        <label for="issue_no" class="block text-sm font-medium text-gray-700">Issue Number</label>
                                        <input v-model="newIssue.issue_number" type="number" required step="1" name="issue_no" id="issue_no" autocomplete="off" placeholder="1" min="0" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                    </div>
                                    
                                    <!-- Volume No. -->
                                    <div class="lg:col-span-4 sm:col-span-6">
                                        <label for="volume_no" class="block text-sm font-medium text-gray-700">Volume Number</label>
                                        <input v-model="newIssue.volume_number" type="number" step="1" name="volume_no" id="volume_no" autocomplete="off" placeholder="1" min="0" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                    </div>

                                    <!-- Release Date -->
                                    <div class="lg:col-span-4 sm:col-span-6">
                                        <label for="release_date" class="block text-sm font-medium text-gray-700">Release Date</label>
                                        <input v-model="newIssue.release_date" type="date" required name="release_date" id="release_date" autocomplete="off" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                    </div>
                                    
                                    <!-- Cover Image Input -->
                                    <div class="lg:col-span-4 sm:col-span-6 flex flex-col justify-center relative">
                                        <label for="comic_cover" class="block text-sm font-medium text-gray-700">Issue Cover Image</label>
                                        <input v-model="cover_url" type="text" name="comic_cover" id="comic_cover" autocomplete="off" placeholder="Enter URL for cover..." class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">

                                        <!-- Is Variant -->
                                        <div class="absolute right-1 flex items-center justify-end gap-x-8 whitespace-nowrap" style="bottom: 0.1875rem;">
                                            <label class="relative flex gap-x-2 items-center justify-center cursor-pointer group" for="is_variant" @click.prevent="toggleIsVariant">
                                                <span class="text-sm text-blue-400 transition-all group-hover:underline">Is Variant?</span>
                                                <span class="cursor-pointer border-2 border-blue-200 shadow-inner transition-all h-6 w-6 rounded-full flex items-center justify-center" :class="is_variant ? 'bg-blue-500' : 'bg-blue-200'">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-blue-200 transition-opacity" :class="is_variant ? 'opacity-100' : 'opacity-0'" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" /></svg>
                                                </span>
                                            </label>

                                            <!-- Action Button -->
                                            <button type="button" @click.prevent="addCoverImage" class="flex items-center text-green-50 my-auto px-2 py-1 rounded-md gap-x-2 transition-colors bg-green-400 hover:bg-green-500 hover:shadow-md">
                                                <span>Add</span>
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" clip-rule="evenodd" /></svg>
                                            </button>
                                        </div>

                                    </div>
                                    <span v-if="coverError" class="text-red-500 text-sm">Invalid URL for cover image</span>

                                    <!-- Variant Issue -->
                                    <div class="lg:col-span-4 sm:col-span-6" v-if="is_variant">
                                        <label for="variant_issue" class="block text-sm font-medium text-gray-700">Variant ID</label>
                                        <input v-model="variant_issue" type="text" name="variant_issue" id="variant_issue" autocomplete="off" :required="is_variant ? true : false" placeholder="Enter variant issue ID..." class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                    </div>
                                    <span v-if="variantError && is_variant" class="text-red-500 text-sm">Variant ID must be specified</span>

                                    <!-- Cover Images -->
                                    <div v-if="newIssue.comic_covers.length > 0" class="lg:col-span-4 sm:col-span-6 grid grid-cols-6 gap-2 relative bg-gray-100 rounded-md py-4 px-2">
                                        <div v-for="(image, key) in newIssue.comic_covers" :key="key" class="col-span-1">
                                            <div class="col-span-1 object-cover relative">
                                                <img class="max-w-full rounded-md" :src="image.cover_url" alt="Broken Image Link">

                                                <!-- Delete Button -->
                                                <button class="absolute -top-2 -right-2 rounded-full" @click.prevent="removeCoverImage(image)">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 transition-colors text-gray-400 hover:text-gray-500" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" /></svg>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </form>
</template>

<script>
import CreateIssueModal from './CreateIssueModal.vue';

export default {
    components: {
        CreateIssueModal
    },
    data() {
        return {
            allWriters: [],
            writers: [],
            writerSearch: null,
            selectedWriters: this.comic.writers,

            // Props on the selected comic 
            comicWriters: this.comic.writers,

            newIssue: {
                comic_book_id: this.comic.id,
                title: "",
                description: "",
                issue_number: null,
                volume_number: null,
                release_date: "",
                comic_covers: []
            },

            coverError: false,
            cover_url: null,
            is_variant: false,
            variantError: false,
            variant_issue: null,
        }
    },
    computed: {
        comicWriterIds: function() {
            const id_array = [];
            for (let i = 0; i < this.comic.writers.length; i++) {
                id_array.push(this.comic.writers[i].id);
            }
            return id_array;
        },
    },
    created() {
        this.fetchWriters();
    },
    methods: {
        /**
         * Emit up to parent to re-fetch comic model instance
         * 
         * @return {String}
         */
        fetchComic: function () {
            return this.$emit('fetchComic');
        },

        /**
         * Adds specified writer to the selectedWriters array
         *
         * @param {Object} writer 
         */
        addSelectedWriter: function(writer) {
            this.selectedWriters.push(writer);
        },

        /**
         * Removes specified writer from the selectedWriters array
         *
         * @param {Object} writer 
         */
        removeSelectedWriter: function(writer) {
            const writer_index = this.selectedWriters.findIndex(item => item.id == writer.id);
            this.selectedWriters.splice(writer_index, 1);
        },


        /**
         * Filters writers according to the search term provided
         */
        searchWriters: function() {
            let results = [];
            for (let i = 0; i < this.allWriters.length; i++) {
                const search = this.filter(this.allWriters[i].name, this.writerSearch);
                if (search == true) {
                    results.push(this.allWriters[i]);
                }
            }
            this.writers = results;
        },

        /**
         * Filters strings via a provided search term
         *
         * @param {String} text item to search against 
         * @param {String} searchString term to search for
         * @return {Bool}
         */
        filter: function(text, searchString) {
            const regexStr = '(?=.*' + searchString.split(/\,|\s/).join(')(?=.*') + ')';
            const searchRegEx = new RegExp(regexStr, 'gi');
            return text.match(searchRegEx) !== null;
        },

        /**
         * Fetch all writers
         */
        fetchWriters: function() {
            axios.get('/api/comic-writers')
                .then(res => {
                    this.allWriters = res.data.data;
                    this.writers = res.data.data;
                    const comicWriters = [];

                    for (let i = 0; i < this.comic.writers.length; i++) {
                        comicWriters.push(this.comic.writers[i]);
                    }

                })
                .catch(e => console.error(`Error: ${e}`));
        },

        /**
         * Updates comic instance
         */
        updateComic: function() {
            this.comic.writers = this.selectedWriters;

            axios.put(`/api/comics/${this.comic.id}`, this.comic)
                .then(res => {
                    this.fetchWriters();
                    this.$emit('closeEditModal');
                })
                .catch(e => {
                    if (e.response && e.response.status == 422) { this.validationErrors = e.response.data.errors }
                    else console.log(e);
                })
        },

        /**
         * Adds new comic issue against comic book
         *
         * @return void
         */
        addNewIssue: function() {
            axios.post(`/api/comics/${this.comic.id}/issues`, this.newIssue)
                .then(res => {
                    console.log(res);
                    this.fetchComic();
                    this.resetIssueInputFields();
                })
                .catch(e => console.error(`Error: ${e}`));
        },

        /**
         * Delete request on an issue instance
         *
         * @param integer issue_id 
         * @return void
         */
        deleteIssue: function(issue_id) {
            axios.delete(`/api/comics/${this.comic.id}/issues/${issue_id}`)
                .then(res => {
                    console.log(res);
                    this.fetchComic();
                })
                .catch(e => console.error(`Error: ${e}`));
        },

        /**
         * Adds new cover image to issue
         *
         * @return void
         */
        addCoverImage: function()
        {
            // Validate cover URL
            const regex = new RegExp('(https?:\/\/.*\.(?:png|jpg))', 'i');
            if (!this.cover_url || !this.cover_url.match(regex)) return this.coverError = true;
            if (this.is_variant && this.variant_issue == null) return this.variantError = true;
            
            this.newIssue.comic_covers.push({ 
                'cover_url': this.cover_url,
                'is_variant': this.is_variant,
                'variant_issue': this.variant_issue
            });
            this.cover_url = null;
            this.is_variant = false;
            this.variant_issue = null;
            this.coverError = false;
            this.variantError = false;
        },

        /**
         * Removes cover image from new issue
         *
         * @param array selected 
         * @return void
         */
        removeCoverImage: function (selected) {
            const covers = this.newIssue.comic_covers;
            return covers.splice(covers.indexOf(selected), 1);
        },


        /**
         * Toggles whether new issue cover is a variant cover or not
         *
         * @return bool
         */
        toggleIsVariant: function () {
            return this.is_variant = !this.is_variant;
        },

        /**
         * Resets issue input fields to initial state
         *
         * @return object
         */
        resetIssueInputFields: function () {
            this.cover_url = null;
            this.is_variant = false;
            this.variant_issue = null;
            return this.newIssue = {
                comic_book_id: this.comic.id,
                title: "",
                description: "",
                issue_number: null,
                volume_number: null,
                release_date: "",
                comic_covers: []
            }
        }
    },
    props: {
        comic: {
            type: [Array, Object],
            required: true
        }
    },
    watch: {
        /**
         * Watches for changes on writerSearch variable; runs function if changed
         */
        writerSearch: function() {
            this.searchWriters();
        },
    }
}
</script>