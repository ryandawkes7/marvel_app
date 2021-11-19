<template>
  <app-layout>
    <!-- Header -->
    <div class="flex flex-col gap-8">
        <section class="flex justify-between items-center">
            <!-- Title -->
            <div class="font-bold leading-7 text-gray-900 sm:text-3xl sm:truncate">
                <h1>Actors</h1>
            </div>

            <!-- Create Character -->
            <div>
                <button type="button" @click="isCreateModalOpen = true" class="px-3 py-1 text-green-800 flex items-center gap-2 border border-green-500 transition-colors rounded-md bg-green-300 hover:bg-green-400">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" /></svg>
                    <span>Create Actor</span>
                </button>
            </div>
        </section>

        <!-- Character List -->
        <ContentGrid
            :actors="actors"
        ></ContentGrid>

        <!-- Create Character Modal -->
        <CreateModal 
            v-if="isCreateModalOpen" 
            @closeCreateModal="isCreateModalOpen = false"
            @createdActor="fetchActors()"
        >
        </CreateModal>
    </div>
  </app-layout>
</template>

<script>
import AppLayout from '@/Layouts/AppLayout';
import { ref } from 'vue';
import ContentGrid from './ContentGrid.vue';
import CreateModal from './CreateModal.vue';

export default {
    created() {
        this.fetchActors();
    },
    setup() {
        const isCreateModalOpen = ref(false);

        return {
            isCreateModalOpen
        }
    },
    data() {
        return {
            actors: []
        }
    },
    components: {
        AppLayout,
        ContentGrid,
        CreateModal
    },
    methods: {
        /**
         * Fetches all actor instances
         * 
         * @return void
         */
        fetchActors: function() {
            axios.get(`/api/actors`)
                .then(res => {
                    this.actors = res.data.data
                    if (this.isCreateModalOpen) this.isCreateModalOpen = false; 
                })
                .catch(e => console.error(`Error fetching actors - ${e}`));
        }
    },
}
</script>

<style>

</style>