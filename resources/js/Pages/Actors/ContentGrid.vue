<template>
    <!-- Character List -->
    <ul class="grid grid-cols-1 gap-6 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4">
        <!-- Boxes -->
        <li
            v-for="actor in actors"
            :key="actor.id"
            @click="show(actor.id)"
            class="col-span-1 flex flex-col text-center bg-white rounded-lg shadow divide-y divide-gray-200 border transition-all cursor-pointer hover:border-indigo-500 hover:shadow-xl"
        >
            <div class="flex-1 flex flex-col p-8">
                <!-- Image -->
                <div class="w-32 h-32 flex-shrink-0 mx-auto bg-white rounded-full overflow-hidden shadow-lg">
                    <img class="object-contain min-w-full min-h-full"
                        :src="actor.image_url
                            ? actor.image_url
                            : 'https://images.unsplash.com/photo-1494790108377-be9c29b29330?ixlib=rb-1.2.1&ixqx=ZsrCV912yo&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=4&w=256&h=256&q=60'"
                    />
                </div>

                <!-- Alias -->
                <h3 class="mt-6 text-gray-900 text-md font-semibold">
                    {{ actor.name }}
                </h3>

                <!-- Real Name -->
                <p class="text-gray-500 text-xs font-light">
                    {{ actor.dob }}
                </p>
            </div>
        </li>
    </ul>
</template>

<script>
export default {
    props: [
        'actors'
    ],
    methods: {
        /**
         * Redirects to show page
         *
         * @param integer character_id 
         * @return object
         */
        show(id) {
            return window.location.href = `/actors/${id}`;
        },
    },
};
</script>

<style>
</style>