<template>
    <!-- Comic Details View -->
    <form method="POST" class="h-full">
        <div class="sm:overflow-hidden h-full relative">

            <!-- Content -->
            <div class="bg-white py-5 px-4 min-h-full max-h-full overflow-y-scroll space-y-6">
                
                <!-- Heading -->
                <div>
                    <h3 class="text-lg leading-6 font-medium text-gray-900">Comic Issues</h3>
                    <p class="mt-1 text-sm text-gray-500">Add and remove issues against this comic book.</p>
                </div>
                
                <hr>

                <div class="bg-white">
                    <div class="grid grid-cols-6 gap-6">

                        <!-- Issue List -->
                        <div class="col-span-6 flex flex-col gap-y-2">

                            <!-- Heading -->
                            <div class="flex justify-between items-center">
                                <!-- Title -->
                                <label for="writer" class="block text-sm font-medium text-gray-700">Current Issues</label>

                                <!-- Action Buttons -->
                                <button class="transition-all bg-green-50 border border-green-100 text-gray-700 flex gap-1 items-center px-2 py-1 rounded-lg hover:bg-green-100 hover:shadow-md">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-green-500" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-11a1 1 0 10-2 0v2H7a1 1 0 100 2h2v2a1 1 0 102 0v-2h2a1 1 0 100-2h-2V7z" clip-rule="evenodd" /></svg>
                                    <span>Add Issue</span>
                                </button>
                            </div>
                            <div class="border border-gray-100 rounded-md overflow-x-scroll shadow-inner py-2 px-4">

                                <ul class="flex gap-x-4 py-2 mr-4">
                                    <li v-for="issue in comic.comic_issues" :key="issue.id" class="flex flex-col gap-y-2 items-center rounded-lg shadow-md bg-gray-50 px-6 py-2 relative">
                                        <!-- Delete Button -->
                                        <button class="absolute -top-2 -right-2 rounded-full">
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
                            </div>
                        </div>

                        <!-- Title -->
                        <div class="lg:col-span-4 sm:col-span-6">
                            <label for="title" class="block text-sm font-medium text-gray-700">Title</label>
                            <input type="text" v-model="comic.title" name="title" id="title" autocomplete="off" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                        </div>
                        
                        <!-- Description -->
                        <div class="lg:col-span-4 sm:col-span-6">
                            <label for="title" class="block text-sm font-medium text-gray-700">Description</label>
                            <input type="text" v-model="comic.description" name="title" id="title" autocomplete="off" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                        </div>

                        <!-- Writers -->
                        <div class="lg:col-span-4 sm:col-span-6">
                            <label for="writer" class="block text-sm font-medium text-gray-700">Writers</label>

                            <div class="border border-gray-300 shadow-md rounded-md p-2 flex flex-col gap-2">
                                <!-- Search Bar -->
                                <div class="flex justify-between items-center w-full relative rounded-md bg-gray-50 border-0">
                                    <input type="text" v-model="writerSearch" class="w-full transition-colors border-0 bg-transparent rounded-md focus:bg-red-50" placeholder="Search writers..." />
                                    <svg xmlns="http://www.w3.org/2000/svg" class="absolute right-2 my-auto h-6 w-6 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" /></svg>
                                </div>

                                <!-- Names -->
                                <div v-if="writers.length > 0" class="flex flex-wrap gap-2">
                                    <span v-for="writer in writers" :key="writer.id" v-on="comicWriterIds.includes(writer.id) ? {click: () => removeSelectedWriter(writer)} : {click: () => addSelectedWriter(writer)}" class="transition-colors px-2 py-0.5 rounded-full whitespace-nowrap cursor-pointer text-sm" :class="comicWriterIds.includes(writer.id) ? 'bg-green-400 text-green-100 hover:bg-green-500 ' : 'bg-red-400 hover:bg-red-500 text-red-100'">
                                        <div>{{writer.name}}</div>
                                    </span>
                                </div>
                                <div v-else class="flex justify-center py-3 bg-gray-50 text-gray-400 font-bold rounded-md w-full">
                                    No results found
                                </div>
                            </div>
                        </div>

                        <!-- Release Date -->
                        <div class="lg:col-span-4 sm:col-span-6">
                            <label for="release_date" class="block text-sm font-medium text-gray-700">Release Date</label>
                            <input type="date" v-model="comic.release_date" name="release_date" id="release_date" autocomplete="off" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                        </div>

                        <!-- Action Buttons -->
                        <div class="absolute bottom-5 right-5 flex gap-2 mt-auto">
                            <!-- Cancel -->
                            <button type="button" class="px-5 py-2 transition-all bg-white border border-gray-300 rounded-md hover:bg-gray-50 hover:shadow" @click="this.$emit('closeEditModal')">Cancel</button>

                            <!-- Save -->
                            <button type="button" class="px-5 py-2 transition-all bg-gray-300 border border-gray-400 rounded-md hover:bg-gray-400 hover:shadow" @click="updateComic()">Save</button>
                        </div>
                    </div>
                </div>
            </div>

            <div v-if="isIssues" class="relative h-full">
                <IssuesModal @fetchComic="fetchComic" :comic="comic"></IssuesModal>
            </div>
            
        </div>
    </form>
</template>

<script>
export default {
    data() {
        return {
            allWriters: [],
            writers: [],
            writerSearch: null,
            selectedWriters: this.comic.writers,

            // Props on the selected comic 
            comicWriters: this.comic.writers,
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
        console.log(this.comic);
    },
    methods: {

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
                .catch(e => console.log(e));
        },

        /**
         * Updates comic instance
         */
        updateComic: function() {
            this.comic.writers = this.selectedWriters;

            axios.patch(`/api/comics/${this.comic.id}`, this.comic )
                .then(res => {
                    this.$emit('closeEditModal');
                })
                .catch(e => {
                    if (e.response && e.response.status == 422) { this.validationErrors = e.response.data.errors }
                    else console.log(e);
                })
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