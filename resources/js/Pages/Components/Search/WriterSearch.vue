<template>
    <div class="flex flex-col gap-2 bg-gray-50 py-2 px-3 rounded-md">
        <!-- Header -->
        <section class="grid grid-cols-2 w-full">
            <!-- Title -->
            <label for="writers" class="block text-gray-700 whitespace-nowrap col-span-1 my-auto font-bold">Writers</label>

            <!-- Search Bar -->
            <div class="col-span-1 my-auto flex justify-between items-center rounded-md bg-gray-100 border-0 relative w-full">
                <input type="text" v-model="writerSearch" class="w-full transition-colors border-0 bg-transparent rounded-md focus:bg-red-50 text-sm" placeholder="Search writers..." />
                <svg xmlns="http://www.w3.org/2000/svg" class="absolute right-2 my-auto h-4 w-4 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" /></svg>
            </div>
        </section>

        <!-- Body -->
        <section class="border border-gray-300 rounded-md p-2 flex flex-col gap-2 max-h-48 overflow-y-scroll">
            <!-- Trait List -->
            <div v-if="writers.length > 0" class="flex flex-wrap gap-2">
                <span v-for="writer in writers" :key="writer.id" v-on="selectedWriterIds.includes(writer.id) ? {click: () => removeSelectedWriter(writer)} : {click: () => addSelectedWriter(writer)}" class="transition-colors px-2 py-0.5 rounded-full whitespace-nowrap cursor-pointer text-sm" :class="selectedWriterIds.includes(writer.id) ? 'bg-green-400 text-green-100 hover:bg-green-500' : 'bg-red-400 hover:bg-red-500 text-red-100'">
                    <div>{{writer.name}}</div>
                </span>
            </div>
            <div v-else class="flex justify-center py-3 bg-gray-50 text-gray-400 font-bold rounded-md w-full">
                No results found
            </div>
        </section>
    </div>
</template>

<script>
export default {
    data() {
        return {
            allWriters: [],
            writers: [],
            writerSearch: null,
            selectedWriters: [],
        }
    },
    computed: {
        selectedWriterIds: function() {
            const idArray = [];
            for (let i = 0; i < this.selectedWriters.length; i++) {
                idArray.push(this.selectedWriters[i].id);
            }
            return idArray;
        },
    },
    created() {
        this.fetchWriters()
    },
    methods: {
        /**
         * Fetches all writers
         */
        fetchWriters: function() {
            axios.get('/api/comic-writers')
                .then(res => {
                    this.allWriters = res.data.data
                    this.writers = res.data.data
                })
                .catch(e => console.log(e));
        },

        /**
         * Adds specified writer to selectedWriters arrays
         *
         * @param {Object} writer to be added
         */
        addSelectedWriter: function(writer) {
            this.selectedWriters.push(writer)
        },

        /**
         * Remove specified writer from selectedWriter array
         *
         * @param {Object} writer to be removed
         */
        removeSelectedWriter: function(writer) {
            const writerIndex = this.selectedWriters.findIndex(item => item.id == writer.id);
            this.selectedWriters.splice(writerIndex, 1);
        },

        /**
         * Searches through writers
         *
         * @return {Array} of searched writers
         */
        searchWriters: function() {
            let results = [];
            for (let i = 0; i < this.allWriters.length; i++) {
                const search = this.filter(this.allWriters[i].name, this.writerSearch);
                if (search == true) {
                    results.push(this.allWriters[i]);
                }
            }
            return this.writers = results;
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
    },
    watch: {
        writerSearch: function() {
            this.searchWriters();
        },
    }
}
</script>