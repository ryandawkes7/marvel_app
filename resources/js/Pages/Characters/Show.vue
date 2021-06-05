<template>
    <app-layout>
      <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:max-w-7xl lg:px-8">
        <div class="grid grid-cols-1 gap-4 items-start lg:grid-cols-3 lg:gap-8">

          <!-- Left column -->
          <div class="grid grid-cols-1 gap-4 lg:col-span-2">

            <!-- Description panel -->
            <section aria-labelledby="profile-overview-title">
              <div class="rounded-lg bg-white overflow-hidden shadow">
                <div class="bg-white p-6">
                  <div class="sm:flex sm:items-center sm:justify-between">
                    <div class="sm:flex sm:space-x-5">
                      <div class="flex-shrink-0">
                        <img class="mx-auto h-20 w-20 rounded-full"
                          :src="character.thumb_url ? character.thumb_url : 'https://images.unsplash.com/photo-1494790108377-be9c29b29330?ixlib=rb-1.2.1&ixqx=ZsrCV912yo&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=4&w=256&h=256&q=60'"
                        />
                      </div>
                      <div class="mt-4 text-center sm:mt-0 sm:pt-1 sm:text-left flex items-center">
                          <p class="text-xl font-bold text-gray-900 sm:text-2xl">{{character.alias}}</p>
                          <p v-if="character.real_name" class="text-xl text-gray-400 font-light ml-2 sm:text-2xl">// {{character.real_name}}</p>
                      </div>
                    </div>
                    <div class="mt-5 flex justify-center sm:mt-0">
                      <a href="#" class="flex justify-center items-center px-4 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50">
                        View profile
                      </a>
                    </div>
                  </div>
                </div>
                <div class="border-t border-gray-200 bg-gray-50 grid grid-cols-1 divide-y divide-gray-200 sm:grid-cols-3 sm:divide-y-0 sm:divide-x">
                  <div  class="px-6 py-5 text-sm font-medium text-center">
                    <span class="text-gray-900">Stat Vaule</span>
                    {{ ' ' }}
                    <span class="text-gray-600">Stat Label</span>
                  </div>
                </div>
              </div>
            </section>

            <!-- Actions panel -->
            <section aria-labelledby="quick-links-title">
              <div class="rounded-lg bg-gray-200 overflow-hidden shadow divide-y divide-gray-200 sm:divide-y-0 sm:grid sm:grid-cols-2 sm:gap-px">
                <h2 class="sr-only" id="quick-links-title">Quick links</h2>
                <div class="rounded-tl-lg rounded-tr-lg sm:rounded-tr-none sm:rounded-tr-lg sm:rounded-bl-lg rounded-bl-lg rounded-br-lg sm:rounded-bl-none relative group bg-white p-6 focus-within:ring-2 focus-within:ring-inset focus-within:ring-cyan-500">
                  <div>
                    <span class="rounded-lg inline-flex p-3 ring-4 ring-white">
                    </span>
                  </div>
                  <div class="mt-8">
                    <h3 class="text-lg font-medium">
                      <a class="focus:outline-none">
                        <!-- Extend touch target to entire panel -->
                        <span class="absolute inset-0" aria-hidden="true" />
                        Action Name
                      </a>
                    </h3>
                    <p class="mt-2 text-sm text-gray-500">
                      Doloribus dolores nostrum quia qui natus officia quod et dolorem. Sit repellendus qui ut at blanditiis et quo et molestiae.
                    </p>
                  </div>
                  <span class="pointer-events-none absolute top-6 right-6 text-gray-300 group-hover:text-gray-400" aria-hidden="true">
                    <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                      <path d="M20 4h1a1 1 0 00-1-1v1zm-1 12a1 1 0 102 0h-2zM8 3a1 1 0 000 2V3zM3.293 19.293a1 1 0 101.414 1.414l-1.414-1.414zM19 4v12h2V4h-2zm1-1H8v2h12V3zm-.707.293l-16 16 1.414 1.414 16-16-1.414-1.414z" />
                    </svg>
                  </span>
                </div>
              </div>
            </section>
          </div>

          <!-- Right column -->
          <div class="grid grid-cols-1 gap-4">
            <!-- Announcements -->
            <section aria-labelledby="announcements-title">
              <div class="rounded-lg bg-white overflow-hidden shadow">
                <div class="p-6">
                  <h2 class="text-base font-medium text-gray-900" id="announcements-title">Announcements</h2>
                  <div class="flow-root mt-6">
                    <ul class="-my-5 divide-y divide-gray-200">
                      <li v-for="announcement in announcements" :key="announcement.id" class="py-5">
                        <div class="relative focus-within:ring-2 focus-within:ring-cyan-500">
                          <h3 class="text-sm font-semibold text-gray-800">
                            <a :href="announcement.href" class="hover:underline focus:outline-none">
                              <!-- Extend touch target to entire panel -->
                              <span class="absolute inset-0" aria-hidden="true" />
                              {{ announcement.title }}
                            </a>
                          </h3>
                          <p class="mt-1 text-sm text-gray-600 line-clamp-2">
                            {{ announcement.preview }}
                          </p>
                        </div>
                      </li>
                    </ul>
                  </div>
                  <div class="mt-6">
                    <a href="#" class="w-full flex justify-center items-center px-4 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50">
                      View all
                    </a>
                  </div>
                </div>
              </div>
            </section>

            <!-- Recent Hires -->
            <section aria-labelledby="recent-hires-title">
              <div class="rounded-lg bg-white overflow-hidden shadow">
                <div class="p-6">
                  <h2 class="text-base font-medium text-gray-900" id="recent-hires-title">Recent Hires</h2>
                  <div class="flow-root mt-6">
                    <ul class="-my-5 divide-y divide-gray-200">
                      <li class="py-4">
                        <div class="flex items-center space-x-4">
                          <div class="flex-shrink-0">
                            <img class="h-8 w-8 rounded-full"  alt="" />
                          </div>
                          <div class="flex-1 min-w-0">
                            <p class="text-sm font-medium text-gray-900 truncate">
                              Name
                            </p>
                            <p class="text-sm text-gray-500 truncate">
                              @handle
                            </p>
                          </div>
                          <div>
                            <a class="inline-flex items-center shadow-sm px-2.5 py-0.5 border border-gray-300 text-sm leading-5 font-medium rounded-full text-gray-700 bg-white hover:bg-gray-50">
                              View
                            </a>
                          </div>
                        </div>
                      </li>
                    </ul>
                  </div>
                  <div class="mt-6">
                    <a href="#" class="w-full flex justify-center items-center px-4 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50">
                      View all
                    </a>
                  </div>
                </div>
              </div>
            </section>
          </div>
        </div>
      </div>
    </app-layout>
</template>

<script>
import AppLayout from '@/Layouts/AppLayout';
    export default {
        data() {
            return {
                character: {
                    alias: '',
                    real_name: '',
                    sex: '',
                    thumb_url: '',
                    morality: '',
                    type_id: ''
                },
                character_id: '',
                edit: false
            }
        },
        components: {
            AppLayout,
        },
        created() {
          this.fetchId();
        },
        methods: {
          fetchId() {
            const id = window.location.href.split('/').pop();
            fetch(`/api/characters/${id}`)
              .then(res => res.json())
              .then(res => {
                this.character = res.data[0]
              })
          },
        },
    }
</script>