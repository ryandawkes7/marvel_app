<template>
    <div class="flex flex-col gap-2 bg-gray-50 py-2 px-3 rounded-md">
        <!-- Header -->
        <section class="grid grid-cols-2 w-full">
            <!-- Title -->
            <label for="movies" class="block font-medium text-gray-700 whitespace-nowrap col-span-1 my-auto font-bold">Director(s)</label>
            
            <!-- Search Bar -->
            <div class="col-span-1 my-auto flex justify-between items-center rounded-md bg-gray-100 border-0 relative w-full">
                <input type="text" v-model="directorSearch" class="w-full transition-colors border-0 bg-transparent rounded-md focus:bg-red-50 text-sm" placeholder="Search directors..." />
                <svg xmlns="http://www.w3.org/2000/svg" class="absolute right-2 my-auto h-4 w-4 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" /></svg>
            </div>
        </section>

        <!-- Body -->
        <section class="border border-gray-300 rounded-md p-2 flex flex-col gap-2 max-h-48 overflow-y-scroll">
            <!-- Movie List -->
            <div v-if="directors.length > 0" class="flex flex-wrap gap-2">
                <span v-for="director in directors" :key="director.id" v-on="selectedDirectorIds.includes(director.id) ? {click: () => removeSelectedDirector(director)} : {click: () => addSelectedDirector(director)}" class="transition-colors px-2 py-0.5 rounded-full whitespace-nowrap cursor-pointer text-sm" :class="selectedDirectorIds.includes(director.id) ? 'bg-green-400 text-green-100 hover:bg-green-500' : 'bg-red-400 hover:bg-red-500 text-red-100'">
                    <div>{{director.name}}</div>
                </span>
            </div>
            <!-- No Results -->
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
            allDirectors: [],
            directors: [],
            directorSearch: null,
            selectedDirectors: [],
        }
    },
    computed: {
        selectedDirectorIds: function() {
            const idArray = [];
            for (let i = 0; i < this.selectedDirectors.length; i++) {
                idArray.push(this.selectedDirectors[i].id);
            }
            return idArray;
        }
    },
    created() {
        this.fetchDirectors()
    },
    methods: {
        /**
         * Fetches all directors
         */
        fetchDirectors: function() {
            axios.get('/api/directors')
                .then(res => {
                    const data = res.data.data.sort((a,b) => {
                        if (a.name > b.name) return 1;
                        if (a.name < b.name) return -1;
                        return 0;
                    })
                    this.allDirectors = data;
                    this.directors = data
                })
        },

        /**
         * Adds specified director to selectedDirectors arrays
         *
         * @param {Object} director to be added
         */
        addSelectedDirector: function(director) {
            this.selectedDirectors.push(director)
        },

        /**
         * Remove specified director from selectedDirector array
         *
         * @param {Object} director to be removed
         */
        removeSelectedDirector: function(director) {
            const directorIndex = this.selectedDirectors.findIndex(item => item.id == director.id);
            this.selectedDirectors.splice(directorIndex, 1);
        },

        /**
         * Searches through directors
         *
         * @return {Array} of searched directors
         */
        searchDirectors: function() {
            let results = [];
            for (let i = 0; i < this.allDirectors.length; i++) {
                const search = this.filter(this.allDirectors[i].name, this.directorSearch);
                if (search == true) {
                    results.push(this.allDirectors[i]);
                }
            }
            return this.directors = results;
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
        directorSearch: function() {
            this.searchDirectors();
        }
    }
}
</script>