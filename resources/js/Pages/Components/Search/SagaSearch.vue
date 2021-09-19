<template>
    <div class="flex flex-col gap-2 bg-gray-50 py-2 px-3 rounded-md">
        <!-- Header -->
        <section class="grid grid-cols-2 w-full">
            <!-- Title -->
            <label for="sagas" class="block font-medium text-gray-700 whitespace-nowrap col-span-1 my-auto font-bold">Associated Sagas</label>

            <!-- Search Bar -->
            <div class="col-span-1 my-auto flex justify-between items-center rounded-md bg-gray-100 border-0 relative w-full">
                <input type="text" v-model="sagaSearch" class="w-full transition-colors border-0 bg-transparent rounded-md focus:bg-red-50 text-sm" placeholder="Search sagas..." />
                <svg xmlns="http://www.w3.org/2000/svg" class="absolute right-2 my-auto h-4 w-4 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" /></svg>
            </div>
        </section>

        <!-- Body -->
        <section class="border border-gray-300 rounded-md p-2 flex flex-col gap-2 max-h-48 overflow-y-scroll">
            <!-- Trait List -->
            <div v-if="sagas.length > 0" class="flex flex-wrap gap-2">
                <span v-for="saga in sagas" :key="saga.id" v-on="selectedSagaIds.includes(saga.id) ? {click: () => removeSelectedSaga(saga)} : {click: () => addSelectedSaga(saga)}" class="transition-colors px-2 py-0.5 rounded-full whitespace-nowrap cursor-pointer text-sm" :class="selectedSagaIds.includes(saga.id) ? 'bg-green-400 text-green-100 hover:bg-green-500' : 'bg-red-400 hover:bg-red-500 text-red-100'">
                    <div>{{saga.title}}</div>
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
            allSagas: [],
            sagas: [],
            sagaSearch: null,
            selectedSagas: [],
        }
    },
    computed: {
        selectedSagaIds: function() {
            const idArray = [];
            for (let i = 0; i < this.selectedSagas.length; i++) {
                idArray.push(this.selectedSagas[i].id);
            }
            return idArray;
        },
    },
    created() {
        this.fetchSagas()
    },
    methods: {
        /**
         * Fetches all sagas
         */
        fetchSagas: function() {
            axios.get('/api/sagas')
                .then(res => {
                    const data = res.data.data.sort((a,b) => {
                        if (a.title > b.title) return 1;
                        if (a.title < b.title) return -1;
                        return 0;
                    })
                    this.allSagas = res.data.data
                    this.sagas = res.data.data
                })
                .catch(e => console.log(e));
        },

        /**
         * Adds specified saga to selectedSagas arrays
         *
         * @param {Object} saga to be added
         */
        addSelectedSaga: function(saga) {
            this.selectedSagas.push(saga)
        },

        /**
         * Remove specified saga from selectedSagas array
         *
         * @param {Object} saga to be removed
         */
        removeSelectedSaga: function(saga) {
            const sagaIndex = this.selectedSagas.findIndex(item => item.id == saga.id);
            this.selectedSagas.splice(sagaIndex, 1);
        },

        /**
         * Searches through sagas
         *
         * @return {Array} of searched sagas
         */
        searchSagas: function() {
            let results = [];
            for (let i = 0; i < this.allSagas.length; i++) {
                const search = this.filter(this.allSagas[i].title, this.sagaSearch);
                if (search == true) {
                    results.push(this.allSagas[i]);
                }
            }
            return this.sagas = results;
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
        sagaSearch: function() {
            this.searchSagas();
        },
    }
}
</script>