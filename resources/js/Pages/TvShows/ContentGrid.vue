<template>
    <ul class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-4">
        <li 
            v-for="show in this.shows" 
            :key="show.id" 
            @click="showTvShow(show.id)" 
            class="group col-span-1 grid grid-cols-4 box-border bg-white rounded-lg overflow-hidden shadow divide-y divide-gray-200 transition-all hover:bg-red-50 hover:shadow-lg cursor-pointer"
        >
            <div class="col-span-3 flex items-center justify-between p-6 space-x-6">
                <div class="flex-1 truncate">
                    <div class="flex items-center space-x-3">

                        <!-- Title -->
                        <h3 class="text-gray-900 text-sm font-medium truncate">
                            {{ show.title }}
                        </h3>
                    </div>

                    <!-- Release Date -->
                    <span class="flex-shrink-0 inline-block px-2 py-0.5 text-green-800 text-xs font-medium bg-green-100 rounded-full">
                        {{ show.release_date }}
                    </span>
                </div>
            </div>

            <!-- Logo -->
            <div class="col-span-1 bg-gray-300 flex-shrink-0 transition-all group-hover:bg-red-500">
                <img class="min-h-full transition-all object-cover group-hover:my-1" v-if="show.logo_url" :src="show.logo_url"/>
            </div>
        </li>
  </ul>
</template>

<script>
import { MailIcon, PhoneIcon } from '@heroicons/vue/solid';

export default {
    components: {
        MailIcon,
        PhoneIcon
    },
    created() {
        this.sortShows('title');
    },
    methods: {
        setShows: function() {
            if (this.shows) return this.shows;
        },
        sortShows: function (key) {
            this.shows.sort((a, b) => {
                if (a[key] > b[key]) return 1;
                if (b[key] > a[key]) return -1;
                return 0;
            });
        },
        showTvShow: function (id) {
            window.location.href = `/tv-shows/${id}`;
        }
    },
    props: ['shows']
}
</script>
