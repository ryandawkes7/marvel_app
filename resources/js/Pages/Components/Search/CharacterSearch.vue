<template>
    <div class="flex flex-col gap-2 bg-gray-50 py-2 px-3 rounded-md">
        <!-- Header -->
        <section class="grid grid-cols-2 w-full">
            <!-- Title -->
            <label for="characters" class="block font-medium text-gray-700 whitespace-nowrap col-span-1 my-auto font-bold">Characters</label>

            <!-- Search Bar -->
            <div class="col-span-1 my-auto flex justify-between items-center rounded-md bg-gray-100 border-0 relative w-full">
                <input type="text" v-model="characterSearch" class="w-full transition-colors border-0 bg-transparent rounded-md focus:bg-red-50 text-sm" placeholder="Search characters..." />
                <svg xmlns="http://www.w3.org/2000/svg" class="absolute right-2 my-auto h-4 w-4 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" /></svg>
            </div>
        </section>

        <!-- Body -->
        <section class="border border-gray-300 rounded-md p-2 flex flex-col gap-2 max-h-48 overflow-y-scroll">
            <!-- Trait List -->
            <div v-if="characters.length > 0" class="flex flex-wrap gap-2">
                <span v-for="character in characters" :key="character.id" v-on="selectedCharacterIds.includes(character.id) ? {click: () => removeSelectedCharacter(character)} : {click: () => addSelectedCharacter(character)}" class="transition-colors px-2 py-0.5 rounded-full whitespace-nowrap cursor-pointer text-sm" :class="selectedCharacterIds.includes(character.id) ? 'bg-green-400 text-green-100 hover:bg-green-500' : 'bg-red-400 hover:bg-red-500 text-red-100'">
                    <div>{{character.alias}}</div>
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
            allCharacters: [],
            characters: [],
            characterSearch: null,
            selectedCharacters: [],
        }
    },
    computed: {
        selectedCharacterIds: function() {
            const idArray = [];
            for (let i = 0; i < this.selectedCharacters.length; i++) {
                idArray.push(this.selectedCharacters[i].id);
            }
            return idArray;
        },
    },
    created() {
        this.fetchCharacters()
    },
    methods: {
        /**
         * Fetches all characters
         */
        fetchCharacters: function() {
            axios.get('/api/characters')
                .then(res => {
                    this.allCharacters = res.data.data
                    this.characters = res.data.data
                })
                .catch(e => console.log(e));
        },

        /**
         * Adds specified character to selectedCharacters arrays
         *
         * @param {Object} character to be added
         */
        addSelectedCharacter: function(character) {
            this.selectedCharacters.push(character)
        },

        /**
         * Remove specified character from selectedCharacter array
         *
         * @param {Object} character to be removed
         */
        removeSelectedCharacter: function(character) {
            const characterIndex = this.selectedCharacters.findIndex(item => item.id == character.id);
            this.selectedCharacters.splice(characterIndex, 1);
        },

        /**
         * Searches through characters
         *
         * @return {Array} of searched characters
         */
        searchCharacters: function() {
            let results = [];
            for (let i = 0; i < this.allCharacters.length; i++) {
                const search = this.filter(this.allCharacters[i].alias, this.characterSearch);
                if (search == true) {
                    results.push(this.allCharacters[i]);
                }
            }
            return this.characters = results;
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
        characterSearch: function() {
            this.searchCharacters();
        },
    }
}
</script>