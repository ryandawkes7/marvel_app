<template>
    <app-layout>

      <!-- Header -->
      <header class="max-w-3xl mx-auto px-4 sm:px-6 lg:max-w-7xl lg:px-8 mb-4 flex">
        <Menu as="div" class="relative inline-block text-left ml-auto">
          <div>
            <MenuButton class="inline-flex justify-center w-full rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-gray-100 focus:ring-indigo-500">
              Options
              <ChevronDownIcon class="-mr-1 ml-2 h-5 w-5" aria-hidden="true" />
            </MenuButton>
          </div>

          <!-- Menu Items -->
          <transition enter-active-class="transition ease-out duration-100" enter-from-class="transform opacity-0 scale-95" enter-to-class="transform opacity-100 scale-100" leave-active-class="transition ease-in duration-75" leave-from-class="transform opacity-100 scale-100" leave-to-class="transform opacity-0 scale-95">
            <MenuItems class="origin-top-right absolute right-0 mt-2 w-56 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5 focus:outline-none">
              <div class="py-1">

                <!-- Edit Character -->
                <MenuItem>
                  <button @click="isEditModalOpen = true" class="flex items-center block px-4 py-2 text-sm gap-2 w-full" ref="editButtonRef">
                    <PencilIcon class="w-5 h-5 text-gray-500" />
                    <p class="text-gray-900">Edit</p>
                  </button>
                </MenuItem>

                <!-- Delete Character -->
                <MenuItem>
                  <button @click="toggleDeleteModal()" class="flex items-center block px-4 py-2 text-sm gap-2 w-full" ref="deleteButtonRef">
                    <TrashIcon class="w-5 h-5 text-gray-500"/>
                    <p class="text-gray-900">Delete</p>
                  </button>
                </MenuItem>

              </div>
            </MenuItems>
          </transition>
        </Menu>
      </header>

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
                        <div class="w-20 h-20 flex-shrink-0 mx-auto bg-white rounded-full overflow-hidden shadow-lg">
                          <img class="object-contain min-w-full min-h-full"
                              :src="character.thumb_url ? character.thumb_url : 'https://images.unsplash.com/photo-1494790108377-be9c29b29330?ixlib=rb-1.2.1&ixqx=ZsrCV912yo&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=4&w=256&h=256&q=60'"
                          />
                        </div>
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

            <!-- Skill Grid -->
            <SkillGrid :alias="character.alias" :skills="character.skills"></SkillGrid>
          </div>

          <!-- Right column -->
          <div class="grid grid-cols-1 gap-4">
            
            <section aria-labelledby="skill-grid">
              <div class="rounded-lg bg-white overflow-hidden shadow">

                <!-- Contents -->
                <div class="p-6">

                  <!-- Title -->
                  <h2 class="text-base font-medium text-gray-900" id="announcements-title">Section</h2>

                  <!-- Grid -->
                  <div class="flex flex-col">
                    <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                      <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                        <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">

                          <div class="block border border-gray-100">
                          </div>
                          
                        </div>
                      </div>
                    </div>
                  </div>

                  <!-- Action Button -->
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

      <!-- Delete Modal -->
      <DeleteCharacterModal ref="deleteCharacterModal" :character="character"></DeleteCharacterModal>
      
      <!-- Edit Modal -->
      <TransitionRoot as="template" :show="isEditModalOpen">
        <Dialog as="div" static class="fixed z-10 inset-0 overflow-y-auto" @close="isEditModalOpen = false" :open="isEditModalOpen">
          <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
            <TransitionChild as="template" enter="ease-out duration-300" enter-from="opacity-0" enter-to="opacity-100" leave="ease-in duration-200" leave-from="opacity-100" leave-to="opacity-0">
              <DialogOverlay class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" />
            </TransitionChild>

            <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
            <TransitionChild as="template" enter="ease-out duration-300" enter-from="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" enter-to="opacity-100 translate-y-0 sm:scale-100" leave="ease-in duration-200" leave-from="opacity-100 translate-y-0 sm:scale-100" leave-to="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95">
              <div class="inline-block align-bottom bg-white rounded-lg px-4 pt-5 pb-4 text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle max-w-7xl sm:p-6">

                <!-- Panel Contents -->
                <div class="lg:grid lg:grid-cols-12 lg:gap-x-5">

                  <!-- Sidebar -->
                  <aside class="py-6 px-2 sm:px-6 lg:py-0 lg:px-0 lg:col-span-3">
                    <nav class="space-y-1">
                      <button v-for="item in navigationItems" :key="item.name" @click="changeEditSection(item)" :class="[item.current ? 'bg-indigo-50 text-indigo-700 hover:text-indigo-700 hover:bg-indigo-100 border-none' : 'text-gray-900 hover:text-gray-900 hover:bg-gray-50', 'group rounded-md px-3 py-2 flex items-center text-sm font-medium w-full']">
                        <component :is="item.icon" :class="[item.current ? 'text-indigo-500 group-hover:text-indigo-500' : 'text-gray-400 group-hover:text-gray-500', 'flex-shrink-0 -ml-1 mr-3 h-6 w-6']" aria-hidden="true" />
                        <span class="truncate">
                          {{ item.name }}
                        </span>
                      </button>
                    </nav>
                  </aside>

                  <!-- Form Contents -->
                  <div class="space-y-6 sm:px-6 lg:px-0 lg:col-span-9">
                    
                    <!-- Profile Form -->
                    <form v-on:submit.prevent="submitProfileForm" method="POST" v-if="isProfile">
                      <div class="shadow sm:rounded-md sm:overflow-hidden">

                        <!-- Body -->
                        <div class="bg-white py-6 px-4 space-y-6 sm:p-6">

                          <!-- Heading -->
                          <div>
                            <h3 class="text-lg leading-6 font-medium text-gray-900">Character Details</h3>
                            <p class="mt-1 text-sm text-gray-500">Edit the basic personal details for this character.</p>
                          </div>

                          <!-- Input Fields -->
                          <div class="grid grid-cols-6 gap-6">

                            <!-- Alias -->
                            <div class="col-span-6 sm:col-span-3">
                              <label for="first_name" class="block text-sm font-medium text-gray-700">Alias</label>
                              <input v-model.lazy="character.alias" type="text" name="alias" id="alias" tabindex="-1"
                                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" />
                            </div>

                            <!-- Real Name -->
                            <div class="col-span-6 sm:col-span-3">
                              <label for="last_name" class="block text-sm font-medium text-gray-700">Real Name</label>
                              <input v-model.lazy="character.real_name" type="text" name="real_name" id="real_name"
                                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" />
                            </div>

                            <!-- Sex -->
                            <div class="col-span-6 sm:col-span-4">
                              <label for="email_address" class="block text-sm font-medium text-gray-700">Sex</label>
                              <select v-model="this.character.sex" id="sex" name="sex" class="mt-1 block w-full bg-white border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm capitalize"
                              >
                                <option class="capitalize" v-for="sex in sexValues" :key="sex" :value="sex" :selected="this.character.sex">{{sex}}</option>
                              </select>
                            </div>
                            
                            <!-- Thumbnail -->
                            <div class="col-span-10 sm:col-span-10">
                              <label for="email_address" class="block text-sm font-medium text-gray-700">Thumbnail Image</label>
                              <input v-model.lazy="character.thumb_url" type="text" name="email_address" id="email_address"
                                  class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" 
                              />
                            </div>

                            <!-- Morality -->
                            <div class="col-span-6 sm:col-span-3">
                              <label for="country" class="block text-sm font-medium text-gray-700">Morality</label>
                              <select v-model="this.character.morality" id="morality" name="morality" class="mt-1 block w-full bg-white border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm capitalize">
                                <option class="capitalize" v-for="morality in moralityValues" :key="morality" :value="morality" :selected="this.character.morality">{{morality}}</option>
                              </select>
                            </div>
                            
                            <!-- Type -->
                            <div class="col-span-6 sm:col-span-3">
                              <label for="country" class="block text-sm font-medium text-gray-700">Type</label>
                              <select v-model="this.character.type_id" id="type" name="type" class="mt-1 block w-full bg-white border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm capitalize">
                                <option class="capitalize" v-for="type in typeValues" :key="type.id.toString()" :value="type.id.toString()" :selected="this.character.type.toString()">{{type.type}}</option>
                              </select>
                            </div>

                            <!-- Traits -->
                            <div class="col-span-12 max-w-xl">
                              <label for="traits" class="block text-sm font-medium text-gray-700">Traits</label>

                              <!-- Multiselect -->
                              <MultiSelect ref="multiSelectRef" :char_id="this.fetchId()"></MultiSelect>

                            </div>

                          </div>
                        </div>

                        <!-- Save -->
                        <div class="px-4 py-3 bg-gray-50 text-right sm:px-6">
                          <button type="submit" class="bg-indigo-600 border border-transparent rounded-md shadow-sm py-2 px-4 inline-flex justify-center text-sm font-medium text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            Save
                          </button>
                        </div>

                      </div>
                    </form>

                    <!-- Comics Form -->
                    <form action="#" method="POST" v-if="isComics">
                      <div class="shadow sm:rounded-md sm:overflow-hidden">
                        <div class="bg-white py-6 px-4 space-y-6 sm:p-6">
                          <div>
                            <h3 class="text-lg leading-6 font-medium text-gray-900">Comics</h3>
                            <p class="mt-1 text-sm text-gray-500">Use a permanent address where you can recieve mail.</p>
                          </div>

                          <div class="grid grid-cols-6 gap-6">
                            <div class="col-span-6 sm:col-span-3">
                              <label for="first_name" class="block text-sm font-medium text-gray-700">First name</label>
                              <input type="text" name="first_name" id="first_name" autocomplete="given-name" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" />
                            </div>

                            <div class="col-span-6 sm:col-span-3">
                              <label for="last_name" class="block text-sm font-medium text-gray-700">Last name</label>
                              <input type="text" name="last_name" id="last_name" autocomplete="family-name" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" />
                            </div>

                            <div class="col-span-6 sm:col-span-4">
                              <label for="email_address" class="block text-sm font-medium text-gray-700">Email address</label>
                              <input type="text" name="email_address" id="email_address" autocomplete="email" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" />
                            </div>

                            <div class="col-span-6 sm:col-span-3">
                              <label for="country" class="block text-sm font-medium text-gray-700">Country / Region</label>
                              <select id="country" name="country" autocomplete="country" class="mt-1 block w-full bg-white border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                <option>United States</option>
                                <option>Canada</option>
                                <option>Mexico</option>
                              </select>
                            </div>

                            <div class="col-span-6">
                              <label for="street_address" class="block text-sm font-medium text-gray-700">Street address</label>
                              <input type="text" name="street_address" id="street_address" autocomplete="street-address" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" />
                            </div>

                            <div class="col-span-6 sm:col-span-6 lg:col-span-2">
                              <label for="city" class="block text-sm font-medium text-gray-700">City</label>
                              <input type="text" name="city" id="city" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" />
                            </div>

                            <div class="col-span-6 sm:col-span-3 lg:col-span-2">
                              <label for="state" class="block text-sm font-medium text-gray-700">State / Province</label>
                              <input type="text" name="state" id="state" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" />
                            </div>

                            <div class="col-span-6 sm:col-span-3 lg:col-span-2">
                              <label for="postal_code" class="block text-sm font-medium text-gray-700">ZIP / Postal</label>
                              <input type="text" name="postal_code" id="postal_code" autocomplete="postal-code" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" />
                            </div>
                          </div>
                        </div>
                        <div class="px-4 py-3 bg-gray-50 text-right sm:px-6">
                          <button type="submit" class="bg-indigo-600 border border-transparent rounded-md shadow-sm py-2 px-4 inline-flex justify-center text-sm font-medium text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            Save
                          </button>
                        </div>
                      </div>
                    </form>

                    <!-- Teams Form -->
                    <form action="#" method="POST" v-if="isTeams">
                      <div class="shadow sm:rounded-md sm:overflow-hidden">
                        <div class="bg-white py-6 px-4 space-y-6 sm:p-6">
                          <div>
                            <h3 class="text-lg leading-6 font-medium text-gray-900">Teams</h3>
                            <p class="mt-1 text-sm text-gray-500">Provide basic informtion about the job. Be specific with the job title.</p>
                          </div>

                          <fieldset>
                            <legend class="text-base font-medium text-gray-900">By Email</legend>
                            <div class="mt-4 space-y-4">
                              <div class="flex items-start">
                                <div class="h-5 flex items-center">
                                  <input id="comments" name="comments" type="checkbox" class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300 rounded" />
                                </div>
                                <div class="ml-3 text-sm">
                                  <label for="comments" class="font-medium text-gray-700">Comments</label>
                                  <p class="text-gray-500">Get notified when someones posts a comment on a posting.</p>
                                </div>
                              </div>
                              <div>
                                <div class="flex items-start">
                                  <div class="h-5 flex items-center">
                                    <input id="candidates" name="candidates" type="checkbox" class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300 rounded" />
                                  </div>
                                  <div class="ml-3 text-sm">
                                    <label for="candidates" class="font-medium text-gray-700">Candidates</label>
                                    <p class="text-gray-500">Get notified when a candidate applies for a job.</p>
                                  </div>
                                </div>
                              </div>
                              <div>
                                <div class="flex items-start">
                                  <div class="h-5 flex items-center">
                                    <input id="offers" name="offers" type="checkbox" class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300 rounded" />
                                  </div>
                                  <div class="ml-3 text-sm">
                                    <label for="offers" class="font-medium text-gray-700">Offers</label>
                                    <p class="text-gray-500">Get notified when a candidate accepts or rejects an offer.</p>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </fieldset>
                          <fieldset class="mt-6">
                            <legend class="text-base font-medium text-gray-900">Push Notifications</legend>
                            <p class="text-sm text-gray-500">These are delivered via SMS to your mobile phone.</p>
                            <div class="mt-4 space-y-4">
                              <div class="flex items-center">
                                <input id="push_everything" name="push_notifications" type="radio" class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300" />
                                <label for="push_everything" class="ml-3">
                                  <span class="block text-sm font-medium text-gray-700">Everything</span>
                                </label>
                              </div>
                              <div class="flex items-center">
                                <input id="push_email" name="push_notifications" type="radio" class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300" />
                                <label for="push_email" class="ml-3">
                                  <span class="block text-sm font-medium text-gray-700">Same as email</span>
                                </label>
                              </div>
                              <div class="flex items-center">
                                <input id="push_nothing" name="push_notifications" type="radio" class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300" />
                                <label for="push_nothing" class="ml-3">
                                  <span class="block text-sm font-medium text-gray-700">No push notifications</span>
                                </label>
                              </div>
                            </div>
                          </fieldset>
                        </div>
                        <div class="px-4 py-3 bg-gray-50 text-right sm:px-6">
                          <button type="submit" class="bg-indigo-600 border border-transparent rounded-md shadow-sm py-2 px-4 inline-flex justify-center text-sm font-medium text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-600">
                            Save
                          </button>
                        </div>
                      </div>
                    </form>

                    <!-- Movies Form -->
                    <form action="#" method="POST" v-if="isMovies">
                      <div class="shadow sm:rounded-md sm:overflow-hidden">
                        <div class="bg-white py-6 px-4 space-y-6 sm:p-6">
                          <div>
                            <h3 class="text-lg leading-6 font-medium text-gray-900">Movies</h3>
                            <p class="mt-1 text-sm text-gray-500">Provide basic informtion about the job. Be specific with the job title.</p>
                          </div>

                          <fieldset>
                            <legend class="text-base font-medium text-gray-900">By Email</legend>
                            <div class="mt-4 space-y-4">
                              <div class="flex items-start">
                                <div class="h-5 flex items-center">
                                  <input id="comments" name="comments" type="checkbox" class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300 rounded" />
                                </div>
                                <div class="ml-3 text-sm">
                                  <label for="comments" class="font-medium text-gray-700">Comments</label>
                                  <p class="text-gray-500">Get notified when someones posts a comment on a posting.</p>
                                </div>
                              </div>
                              <div>
                                <div class="flex items-start">
                                  <div class="h-5 flex items-center">
                                    <input id="candidates" name="candidates" type="checkbox" class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300 rounded" />
                                  </div>
                                  <div class="ml-3 text-sm">
                                    <label for="candidates" class="font-medium text-gray-700">Candidates</label>
                                    <p class="text-gray-500">Get notified when a candidate applies for a job.</p>
                                  </div>
                                </div>
                              </div>
                              <div>
                                <div class="flex items-start">
                                  <div class="h-5 flex items-center">
                                    <input id="offers" name="offers" type="checkbox" class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300 rounded" />
                                  </div>
                                  <div class="ml-3 text-sm">
                                    <label for="offers" class="font-medium text-gray-700">Offers</label>
                                    <p class="text-gray-500">Get notified when a candidate accepts or rejects an offer.</p>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </fieldset>
                          <fieldset class="mt-6">
                            <legend class="text-base font-medium text-gray-900">Push Notifications</legend>
                            <p class="text-sm text-gray-500">These are delivered via SMS to your mobile phone.</p>
                            <div class="mt-4 space-y-4">
                              <div class="flex items-center">
                                <input id="push_everything" name="push_notifications" type="radio" class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300" />
                                <label for="push_everything" class="ml-3">
                                  <span class="block text-sm font-medium text-gray-700">Everything</span>
                                </label>
                              </div>
                              <div class="flex items-center">
                                <input id="push_email" name="push_notifications" type="radio" class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300" />
                                <label for="push_email" class="ml-3">
                                  <span class="block text-sm font-medium text-gray-700">Same as email</span>
                                </label>
                              </div>
                              <div class="flex items-center">
                                <input id="push_nothing" name="push_notifications" type="radio" class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300" />
                                <label for="push_nothing" class="ml-3">
                                  <span class="block text-sm font-medium text-gray-700">No push notifications</span>
                                </label>
                              </div>
                            </div>
                          </fieldset>
                        </div>
                        <div class="px-4 py-3 bg-gray-50 text-right sm:px-6">
                          <button type="submit" class="bg-indigo-600 border border-transparent rounded-md shadow-sm py-2 px-4 inline-flex justify-center text-sm font-medium text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-600">
                            Save
                          </button>
                        </div>
                      </div>
                    </form>
                    
                  </div>
                </div>
              </div>
            </TransitionChild>
          </div>
        </Dialog>
      </TransitionRoot>

      <SuccessBanner ref="successBanner" :message="'Character successfully updated'"></SuccessBanner>

    </app-layout>
</template>

<script>
    import AppLayout from '@/Layouts/AppLayout';
    import { ref } from 'vue';
    import { Dialog, DialogOverlay, DialogTitle, Menu, MenuButton, MenuItem, MenuItems, TransitionChild, TransitionRoot } from '@headlessui/vue';
    import { BookOpenIcon, ChevronDownIcon, FilmIcon, PencilIcon, TrashIcon, UserCircleIcon, UserGroupIcon } from '@heroicons/vue/solid'
    import { CheckIcon, ExternalLinkIcon } from '@heroicons/vue/outline';
    import MultiSelect from '../Components/MultiSelect.vue';
    import DeleteCharacterModal from '../Components/DeleteCharacterModal.vue';
    import SuccessBanner from '../Components/SuccessBanner.vue';
    import SkillGrid from './SkillGrid.vue';
    import axios from 'axios';

    export default {
        setup() {
            // Modals
            const isEditModalOpen = ref(false);

            const isProfile = ref(true);
            const isComics = ref(false);
            const isMovies = ref(false);
            const isTeams = ref(false);

            return {
                isEditModalOpen, 
                isProfile, 
                isComics, 
                isMovies, 
                isTeams
            }
        },
        data() {
            return {
                navigationItems: [
                { id: 1, name: 'Character Profile', icon: UserCircleIcon, current: true},
                { id: 2, name: 'Comics', icon: BookOpenIcon, current: false},
                { id: 3, name: 'Teams', icon: UserGroupIcon, current: false},
                { id: 4, name: 'Movies', icon: FilmIcon, current: false}
                ],
                character: {
                    alias: String,
                    real_name: String,
                    sex: String,
                    thumb_url: String,
                    morality: String,
                    type_id: Number.toString(),
                    type: String
                },
                character_id: '',
                edit: false,
                sexValues: [],
                moralityValues: [],
                typeValues: [],
                sharedItems: MultiSelect.data,
            };
        },
        components: {
            AppLayout,
            CheckIcon,
            ChevronDownIcon,
            DeleteCharacterModal,
            Dialog,
            DialogOverlay,
            DialogTitle,
            ExternalLinkIcon,
            Menu,
            MenuButton,
            MenuItem,
            MenuItems,
            MultiSelect,
            PencilIcon,
            SkillGrid,
            SuccessBanner,
            TransitionChild,
            TransitionRoot,
            TrashIcon
        },
        created() {
            this.fetchCharacter();
        },
        methods: {
            changeEditSection(section) {
                let activeSection = '';

                const setSection = (section) => {
                section.current = true;
                activeSection = section;
                }

                this.navigationItems.forEach(item => {
                item.id != section.id ? item.current = false : setSection(item);
                });

                switch(activeSection.id) {
                case 1:
                    this.isProfile = true;
                    this.isComics = false;
                    this.isTeams = false;
                    this.isMovies = false;
                case 2: 
                    this.isProfile = false;
                    this.isComics = true;
                    this.isTeams = false;
                    this.isMovies = false;
                    break;
                case 3:
                    this.isProfile = false;
                    this.isComics = false;
                    this.isTeams = true;
                    this.isMovies = false;
                    break;
                case 4:
                    this.isProfile = false;
                    this.isComics = false;
                    this.isTeams = false;
                    this.isMovies = true;
                    break;
                }
            },

            fetchId() {
                return window.location.href.split('/').pop();
            },

            // Character Methods 
            fetchCharacter() {
                const id = this.fetchId();

                // Fetch character data
                axios.get(`/api/characters/${id}`)
                .then(res => {
                    const data = res.data.data;
                    this.character = data.character;
                    this.moralityValues = data.morality;
                    this.sexValues = data.sex;

                    // Fetch type
                    axios.get(`/api/character-types`)
                    .then(res => {
                        const data = res.data.data;
                        this.typeValues = data;
                    });
                })
            },
            toggleDeleteModal: function() {
                this.$refs.deleteCharacterModal.toggleModal();
            },

            submitProfileForm() {
                const id = this.fetchId();
                this.$refs.multiSelectRef.saveTraits();

                axios.put(`/api/characters/${id}`, this.character)
                .then(res => {
                    this.isEditModalOpen = false;
                    this.$refs.successBanner.toggle();
                    return res.status;
                })
                .catch(e => {
                    if (e.response)     { return e.status } 
                    else if (e.request) { return e.status } 
                    else                { return e.status }
                })
            },
        },
    }
</script>