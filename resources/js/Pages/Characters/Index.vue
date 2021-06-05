<template>
    <app-layout>

        <!-- Title -->
        <div class="font-bold leading-7 text-gray-900 mb-5 sm:text-3xl sm:truncate">
            <h1>Characters</h1>
        </div>

        <!-- Grid -->
        <ul class="grid grid-cols-1 gap-6 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4">

            <!-- Boxes -->
            <li v-for="character in characters" :key="character.id" @click="showCharacter(character.id)"
                class="col-span-1 flex flex-col text-center bg-white rounded-lg shadow divide-y divide-gray-200 border transition-all cursor-pointer hover:border-indigo-500 hover:shadow-xl"
            >
                <div class="flex-1 flex flex-col p-8">

                    <!-- Image -->
                    <img class="w-32 h-32 flex-shrink-0 mx-auto bg-white rounded-full" 
                         :src="character.thumb_url ? character.thumb_url : 'https://images.unsplash.com/photo-1494790108377-be9c29b29330?ixlib=rb-1.2.1&ixqx=ZsrCV912yo&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=4&w=256&h=256&q=60'"
                    />

                    <!-- Alias -->
                    <h3 class="mt-6 text-gray-900 text-md font-semibold">{{character.alias}}</h3>

                    <!-- Real Name -->
                    <p class="text-gray-500 text-xs font-light">{{character.real_name}}</p>

                    <!-- Further Info -->
                    <dl class="mt-1 flex-grow flex flex-col justify-between">

                        <!-- Type -->
                        <dd class="text-gray-500 text-sm">{{character.type}}</dd>

                        <!-- Morality -->
                        <dd class="mt-3">
                            <span class="px-2 py-1 text-sm font-medium rounded-full capitalize"
                                v-bind:class="
                                    (character.morality == 'hero') ? 'bg-green-100 text-green-800' :
                                    (character.morality == 'evil') ? 'bg-red-100 text-red-800' :
                                    (character.morality == 'neutral') ? 'bg-gray-100 text-gray-800' :
                                    (character.morality == 'anti-hero') ? 'bg-blue-100 text-blue-800' :
                                    (character.morality == 'anti-villain') ? 'bg-purple-100 text-purple-800' :
                                    'bg-black text-white'
                                "
                            >
                                {{character.morality}}
                            </span>
                        </dd>
                    </dl>
                </div>
            </li>
        </ul>

    </app-layout>
</template>

<script>
import AppLayout from '@/Layouts/AppLayout';
    export default {
        data() {
            return {
                characters: [],
                character: {
                    id: '',
                    alias: '',
                    real_name: '',
                    sex: '',
                    thumb_url: '',
                    morality: '',
                    type_id: ''
                },
                character_id: '',
                pagination: {},
                edit: false
            }
        },
        components: {
            AppLayout,
        },
        created() {
            this.fetchCharacters();
        },
        methods: {
            fetchCharacters() {
                fetch('api/characters')
                    .then(res => res.json())
                    .then(res => {
                        this.characters = res.data;
                    })
            },
            showCharacter(id) {
                window.location.href = `/characters/${id}`;
            }
        },
    }
</script>