<template>

  <!-- Options Bar -->
  <div class="mt-1 flex justify-between w-full bg-white border border-gray-300 shadow-sm py-2 px-3 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm capitalize gap-1"
    :class="isDropdownOpen && !checkAll(selected, options) ? 'rounded-b-none border-b-0' : 'rounded-md border-b'"
  >
    <div v-for="(item, index) in selected" :key="index" class="flex">
      <!-- Selected Options -->
      <div v-if="selected.includes(item)" @click="setSelected(item)" class="transition-all hover:shadow hover:bg-green-600 cursor-pointer flex justify-center items-center bg-green-500 text-green-50 text-sm px-2 py-1 rounded-2xl gap-1">
        <p class="flex">{{item.value}}</p>
        <XIcon class="h-4 w-4" />
      </div>
    </div>
      <p v-if="selected.length == 0" class="flex text-gray-400">No traits selected</p>

    <ChevronDownIcon @click="toggleDropdown()" class="ml-auto h-5 w-5 cursor-pointer"></ChevronDownIcon>
  </div>

  <!-- Dropdown -->
  <div v-if="!checkAll(selected, options)">
    <div v-if="isDropdownOpen" class="flex bg-white gap-1 py-3 px-3 border border-t-0 border-gray-300">
      <div v-for="(option, index) in options" :key="index">

        <!-- Unselected Options -->
        <label v-if="!selected.includes(option)" @click="setSelected(option)" class="transition-all hover:shadow hover:bg-purple-600 cursor-pointer bg-purple-500 text-purple-100 px-2 py-1 rounded-2xl flex items-center gap-1">
          <p class="text-sm">{{option.value}}</p>
          <PlusIcon class="h-4 w-4" />
        </label>

      </div>
    </div>
  </div>
</template>

<script>
  import { ref } from 'vue';
  import { ChevronDownIcon, PlusIcon, XIcon } from '@heroicons/vue/outline';

  export default {
    components: {
      ChevronDownIcon,
      PlusIcon,
      XIcon,
    },
    data() {
      return {
        value: null,
        options: this.options,
        selected: [],
      }
    },
    methods: {

      /**
       * Toggles dropdown
       *
       * @return bool
       */
      toggleDropdown() {
        this.isDropdownOpen 
          ? this.isDropdownOpen = false
          : this.isDropdownOpen = true;
        console.log(this.isDropdownOpen);
      },

      /**
       * Moves selected option into selected[]
       *
       * @param {Object} $sel 
       * @return array
       */
      setSelected(sel) {
        const items = this.selected;
        items.includes(sel)
          ? items.splice(items.indexOf(sel), 1)
          : items.push(sel);
      },

      checkAll(arr, target) {
        if (target.every(el => arr.includes(el))) return true;
      }

    },
    props: [
      'options',
    ],
    setup() {
      // Modals
      const isDropdownOpen = ref(false);

      return {
        isDropdownOpen
      }
    },
  }
</script>