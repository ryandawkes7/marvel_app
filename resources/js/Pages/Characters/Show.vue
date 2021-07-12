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
                  <button @click="isDeleteModalOpen = true" class="flex items-center block px-4 py-2 text-sm gap-2 w-full" ref="deleteButtonRef">
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
            <section aria-labelledby="skill-grid">
              <div class="rounded-lg bg-gray-200 overflow-hidden shadow divide-y divide-gray-200 sm:divide-y-0 sm:grid sm:grid-cols-1 sm:gap-px">
                <div class="rounded-tl-lg rounded-tr-lg sm:rounded-tr-none sm:rounded-tr-lg sm:rounded-bl-lg rounded-bl-lg rounded-br-lg sm:rounded-bl-none relative group bg-white p-6 focus-within:ring-2 focus-within:ring-inset focus-within:ring-cyan-500">
                  <div>
                    <!-- Heading -->
                    <div class="my-4 flex flex-col gap-1">

                      <!-- Title -->
                      <div class="flex justify-between">
                        <h3 class="text-lg font-medium">
                            Skill Grid
                        </h3>
                        <ExternalLinkIcon />
                      </div>

                      <!-- Subheading -->
                      <p class="text-sm text-gray-500" v-if="character.alias != ''">
                        Get an insight into {{character.alias}}'s competence in the field. Click on this box to gain further insight into each type of skill.
                      </p>
                    </div>

                    <!-- Grid -->
                    <div class="flex flex-col">
                      <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                        <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                          <div class="overflow-hidden border-b border-gray-200 rounded-lg">

                            <div class="block border border-gray-100">
                              <div v-for="skill in skills" :key="skill.id" :class="`bg-${skill.colour}-100`" class="grid grid-cols-12 p-3">
                                <p :class="`text-${skill.colour}-700`" class="col-span-3 text-wrap capitalize">{{skill.name}}</p>
                                <div class="col-span-9 rounded min-h-5 px-2 my-auto" :class="`bg-${skill.colour}-400`" :style="{width: `${skill.value}%`}">
                                  <span class="opacity-0">.</span>
                                </div>
                              </div>
                            </div>
                            
                          </div>
                        </div>
                      </div>
                    </div>

                  </div>
                </div>
              </div>
            </section>
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
      <TransitionRoot as="template" :show="isDeleteModalOpen">
        <Dialog as="div" static class="fixed z-10 inset-0 overflow-y-auto" @close="isDeleteModalOpen = false" :open="isDeleteModalOpen">
          <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
            <TransitionChild as="template" enter="ease-out duration-300" enter-from="opacity-0" enter-to="opacity-100" leave="ease-in duration-200" leave-from="opacity-100" leave-to="opacity-0">
              <DialogOverlay class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" />
            </TransitionChild>

            <!-- This element is to trick the browser into centering the modal contents. -->
            <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
            <TransitionChild as="template" enter="ease-out duration-300" enter-from="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" enter-to="opacity-100 translate-y-0 sm:scale-100" leave="ease-in duration-200" leave-from="opacity-100 translate-y-0 sm:scale-100" leave-to="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95">
              <div class="inline-block align-bottom bg-white rounded-lg px-4 pt-5 pb-4 text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full sm:p-6">
                <div>
                  <div class="mx-auto flex items-center justify-center h-12 w-12 rounded-full bg-red-100">
                    <TrashIcon class="h-6 w-6 text-red-600" aria-hidden="true" />
                  </div>
                  <div class="mt-3 text-center sm:mt-5">
                    <DialogTitle as="h3" class="text-lg leading-6 font-medium text-gray-900">
                      Delete Character
                    </DialogTitle>
                    <div class="mt-2">
                      <p class="text-sm text-gray-500">
                        Are you sure you want to delete {{character.alias}}?
                      </p>
                    </div>
                  </div>
                </div>
                <div class="mt-5 sm:mt-6 sm:grid sm:grid-cols-2 sm:gap-3 sm:grid-flow-row-dense">
                  <button type="button" 
                      class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-indigo-600 text-base font-medium text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:col-start-2 sm:text-sm" 
                      @click="deleteCharacter(character.id)">
                    Delete
                  </button>
                  <button type="button" 
                      class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:col-start-1 sm:text-sm" 
                      @click="isDeleteModalOpen = false" ref="cancelButtonRef">
                    Cancel
                  </button>
                </div>
              </div>
            </TransitionChild>
          </div>
        </Dialog>
      </TransitionRoot>
      
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
                              <input v-model.lazy="character.alias" type="text" name="alias" id="alias"
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
                              <select v-model="character.sex" id="country" name="country"
                                  class="mt-1 block w-full bg-white border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm capitalize"
                              >
                                <option class="capitalize" v-for="sex in sexValues" :key="sex.id" :value="sex.name" :selected="sex.name == character.sex">{{sex.name}}</option>
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
                              <select v-model="character.morality" id="morality" name="morality" class="mt-1 block w-full bg-white border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm capitalize">
                                <option class="capitalize" v-for="morality in moralityValues" :key="morality.id" :value="morality.name" :selected="morality.name == character.morality">{{morality.name}}</option>
                              </select>
                            </div>
                            
                            <!-- Type -->
                            <div class="col-span-6 sm:col-span-3">
                              <label for="country" class="block text-sm font-medium text-gray-700">Type</label>
                              <select v-model="character.type_id" id="type" name="type" class="mt-1 block w-full bg-white border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm capitalize">
                                <option class="capitalize" v-for="type in typeValues" :key="type.id" :value="type.id.toString()" :selected="type.name == character.type">{{type.name}}</option>
                              </select>
                            </div>

                            <!-- Traits -->
                            <div class="col-span-12">
                              <label for="traits" class="block text-sm font-medium text-gray-700">Traits</label>

                              <!-- Multiselect -->
                              <MultiSelect :trait_options="traits" :char_id="this.fetchId()" @setSelectedTraits="setSelectedTraits"></MultiSelect>

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

      <Dialog :open="isSuccessToastOpen" :show="isSuccessToastOpen">
        <div class="rounded-md bg-green-50 p-4 fixed bottom-5 right-5">
          <div class="flex gap-4">
            <div class="flex">
              <div class="flex-shrink-0">
                <CheckCircleIcon class="h-5 w-5 text-green-400" aria-hidden="true"/>
              </div>
              <div class="ml-3">
                <p class="text-sm font-medium text-green-800">
                  Character successfully updated
                </p>
              </div>
            </div>
            <div class="ml-auto pl-3">
              <div class="-mx-1.5 -my-1.5">
                <button type="button" 
                    class="inline-flex bg-green-50 rounded-md p-1.5 text-green-500 hover:bg-green-100 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-green-50 focus:ring-green-600"
                    @click="isSuccessToastOpen = false"
                >
                  <span class="sr-only">Dismiss</span>
                  <XIcon class="h-5 w-5" aria-hidden="true"/>
                </button>
              </div>
            </div>
          </div>
        </div>
      </Dialog>

    </app-layout>
</template>

<script>
  import AppLayout from '@/Layouts/AppLayout';
  import { ref } from 'vue';
  import { Dialog, DialogOverlay, DialogTitle, Menu, MenuButton, MenuItem, MenuItems, TransitionChild, TransitionRoot } from '@headlessui/vue';
  import { BookOpenIcon, CheckCircleIcon, ChevronDownIcon, FilmIcon, PencilIcon, TrashIcon, UserCircleIcon, UserGroupIcon, XIcon } from '@heroicons/vue/solid'
  import { CheckIcon, ExternalLinkIcon } from '@heroicons/vue/outline';
  import MultiSelect from '../Components/MultiSelect.vue';
  import axios from 'axios';

  export default {
    setup() {
      // Modals
      const isDeleteModalOpen = ref(false);
      const isEditModalOpen = ref(true);

      const isSuccessToastOpen = ref(false);

      const isProfile = ref(true);
      const isComics = ref(false);
      const isMovies = ref(false);
      const isTeams = ref(false);

      return {isDeleteModalOpen, isEditModalOpen, isSuccessToastOpen, isProfile, isComics, isMovies, isTeams}
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
        sexValues: [
          { id: 1, name: 'unknown' }, 
          { id: 2, name: 'male'}, 
          { id: 3, name: 'female'}, 
          { id: 4, name: 'none'}
        ],
        moralityValues: [
          { id: 1, name: 'hero' }, 
          { id: 2, name: 'neutral'}, 
          { id: 3, name: 'evil'}, 
          { id: 4, name: 'anti-hero'},
          { id: 5, name: 'anti-villain'},
          { id: 5, name: 'unknown'},
        ],
        typeValues: [
          { id: 1, name: 'human'},
          { id: 2, name: 'robot'},
          { id: 3, name: 'unknown'},
        ],
        skills: [
          { id: 1, name: 'durability', value: 86, colour: 'pink' },
          { id: 2, name: 'energy projection', value: 86, colour: 'purple' },
          { id: 3, name: 'fighting skills', value: 57, colour: 'red' },
          { id: 4, name: 'intelligence', value: 86, colour: 'blue' },
          { id: 5, name: 'speed', value: 71, colour: 'yellow' },
          { id: 6, name: 'strength', value: 57, colour: 'green' },
        ],
        traits: [],
        traitsSelected: []
      };
    },
    components: {
        AppLayout,
        CheckCircleIcon,
        CheckIcon,
        ChevronDownIcon,
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
        TransitionChild,
        TransitionRoot,
        TrashIcon,
        XIcon
    },
    created() {
      this.fetchCharacter();
      this.fetchTraits();
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

        if (activeSection.id == 2) {
          this.isProfile = false;
          this.isComics = true;
          this.isTeams = false;
          this.isMovies = false;
        } else if (activeSection.id == 3) {
          this.isProfile = false;
          this.isComics = false;
          this.isTeams = true;
          this.isMovies = false;
        } else if (activeSection.id == 4) {
          this.isProfile = false;
          this.isComics = false;
          this.isTeams = false;
          this.isMovies = true;
        } else {
          this.isProfile = true;
          this.isComics = false;
          this.isTeams = false;
          this.isMovies = false;
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
            const data = res.data.data[0];
            this.character = data;
            this.character.type_id = data.type_id.toString();

            // Fetch type
            axios.get(`/api/character-types/${data.type_id}`)
              .then(res => {
                const data = res.data.data[0];
                this.character.type = data.type;
              })
          })
      },
      deleteCharacter(id) {
        this.isDeleteModalOpen = false;
        axios.delete(`/api/characters/${id}`)
        return window.location.href = `/characters`;
      },

      // Trait Methods
      fetchTraits() {
        axios.get(`/api/traits`)
          .then(res => {
            this.traits = res.data.data;
            axios.get(`/api/character-traits/${this.fetchId()}`).then(response => {
                const existingTraits = response.data.data;
                for (const trait of existingTraits) {
                  const allTraits = res.data.data;
                  allTraits.find(el => {
                    if (el && el.id == trait.id) {
                      let index = allTraits.indexOf(el);
                      allTraits.splice(index, 1);
                      this.traits = allTraits;
                    }
                  })
                }
            }).catch(e => console.log(e));
          })
      },
      setSelectedTraits(sel) {
        const items = this.traitsSelected;
        items.includes(sel)
          ? items.splice(items.indexOf(sel), 1)
          : items.push(sel);

        console.log(sel);
      },
      saveTraits(charId) {
        axios.post(`/api/traits`, this.traitsSelected, charId);
      },

      submitProfileForm() {
        const id = this.fetchId();

        let traitPayload = {
          traits: this.traitsSelected,
          char_id: id
        }

        axios.post(`/api/traits`, { payload: traitPayload })
          .then(res => console.log(res))
          .catch(err => console.log(`Error: ${err}`));

        axios.put(`/api/characters/${id}`, this.character)
          .then(res => {
            this.isEditModalOpen = false;
            this.isSuccessToastOpen = true;
            setTimeout(() => {
              this.isSuccessToastOpen = false
            }, 3000);
            return res.status;
          })
          .catch(e => {
            if (e.response) {
              console.log(`Response: ${e}`);
              return e.status;
            } else if (e.request) {
              console.log(`Request: ${e}`);
              return e.status;
            } else {
              console.log(`Other: ${e}`);
              return e.status;
            }
          })
      },
    },
  }
</script>