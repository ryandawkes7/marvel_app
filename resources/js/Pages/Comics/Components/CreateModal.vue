<template>
    <section class="fixed z-10 inset-0 overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
        <div class="flex items-end justify-center min-h-screen h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
            <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true" @click="this.$emit('closeCreateModal')"></div>

            <!-- Centering -->
            <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>

            <!-- Body -->
            <div class="inline-block h-5/6 align-bottom bg-white rounded-lg px-4 pt-5 pb-4 text-left overflow-y-scroll shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-7xl sm:w-full sm:p-6">
                <div class="flex items-start">
                    <div class="mt-3 text-center sm:mt-0 sm:text-left w-full flex flex-col gap-4">

                        <!-- Title -->
                        <h3 class="text-lg leading-6 font-medium text-gray-900" id="modal-title">
                            Create New Comic
                        </h3>

                        <!-- Form -->
                        <form class="rounded-xl px-2 py-4 w-full grid grid-cols-2 gap-8" @submit.prevent="createComic">

                            <!-- Left Side -->
                            <div class="col-span-1 flex flex-col gap-3">
                                <!-- Title * -->
                                <div class="flex flex-col gap-1 px-2">
                                    <label for="title">Title</label>
                                    <input name="title" type="text" required v-model="comic.title" autocomplete="off" class="rounded-md" placeholder="Comic title...">
                                </div>
                                <!-- Title * -->
                                <div class="flex flex-col gap-1 px-2">
                                    <label for="title">Description</label>
                                    <textarea name="description" id="description" v-model="comic.description" cols="10" rows="1" class="rounded-md" placeholder="Comic description..."></textarea>
                                </div>

                                <!-- Release Date * -->
                                <div class="flex flex-col gap-1 px-2">
                                    <label for="releaseDate">Release Date</label>
                                    <input name="releaseDate" type="date" v-model="comic.release_date" autocomplete="off" class="rounded-md">
                                </div>
                            </div>

                            <!-- Right Side -->
                            <div class="col-span-1 flex flex-col gap-6">
                                
                                <!-- Directors * -->
                                <WriterSearch ref="writerComponent"></WriterSearch>

                                <!-- Sagas * -->
                                <CharacterSearch ref="characterComponent"></CharacterSearch>
                            </div>

                            <!-- Action Button -->
                            <button type="submit" class="absolute transition-all top-4 right-4 px-3 py-1.5 bg-purple-400 rounded-md text-purple-50 hover:bg-purple-500 hover:shadow-md">Confirm</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>

<script>
    import CharacterSearch from '../../Components/Search/CharacterSearch.vue';
    import WriterSearch from '../../Components/Search/WriterSearch.vue';

    export default {
        components: {
            CharacterSearch,
            WriterSearch,
        },
        data() {
            return {
                comic: {
                    title: '',
                    description: '',
                    release_date: null,
                    writers: [],
                    characters: []
                },
            }
        },

        methods: {

            /**
             * Creates a comic instance
             *
             * @return void
             */
            createComic: function() {
                this.comic.writers = this.$refs.writerComponent.selectedWriters;
                this.comic.characters = this.$refs.characterComponent.selectedCharacters;

                axios.post('/api/comics', this.comic)
                    .then(res => {
                        this.$emit('closeCreateModal');
                    })
                    .catch(e => console.log(e));
            },

            reinitialiseComic: function() {
                return this.comic = {
                    title: '',
                    description: '',
                    release_date: '',
                    writers: [],
                    characters: ''
                }
            }
        },
        props: {
            isCreateModalOpen: {
                type: Boolean
            },
        },
    }
</script>