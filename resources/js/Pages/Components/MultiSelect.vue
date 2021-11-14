<template>

  <!-- Options Bar -->
  <div class="mt-1 flex flex-wrap w-full bg-white border border-gray-300 shadow-sm py-2 px-3 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm capitalize gap-1"
    :class="isDropdownOpen && !checkAll(this.selected, this.traits) ? 'rounded-b-none border-b-0' : 'rounded-md border-b'"
  >
    <div v-for="(item, index) in selected" :key="index" class="flex">
      <!-- Selected Options -->
      <div v-if="selected.includes(item)" @click="setSelected(item)" class="transition-all hover:shadow hover:bg-green-600 cursor-pointer flex justify-center items-center bg-green-500 text-green-50 text-sm px-2 py-1 rounded-2xl gap-1">
        <p class="flex">{{item.name}}</p>
        <XIcon class="h-4 w-4" />
      </div>
    </div>
      <p v-if="selected.length == 0" class="flex text-gray-400">No traits selected</p>

    <ChevronDownIcon @click="toggleDropdown()" class="ml-auto h-5 w-5 cursor-pointer"></ChevronDownIcon>
  </div>

  <!-- Dropdown -->
  <div v-if="!checkAll(this.selected, this.traits)">
    <div v-if="isDropdownOpen" class="flex flex-wrap bg-white gap-1 py-3 px-3 border border-t-0 border-gray-300">
      <div v-for="(option, index) in this.traits" :key="index">

        <!-- Unselected Options -->
        <label v-if="!selected.includes(option)" @click="setSelected(option)" class="transition-all hover:shadow hover:bg-purple-600 cursor-pointer bg-purple-500 text-purple-100 px-2 py-1 rounded-2xl flex items-center gap-1">
          <p class="text-sm">{{option.name}}</p>
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
    created() {
      this.fetchAllTraits();
      this.fetchCharacterTraits(this.char_id);
    },
    data() {
      return {
        value: null,
        selected: [],
        traits: [],
        characterId: this.char_id
      }
    },
    emits: ['setSelectedTraits'],
    methods: {

      //======================================================================
      // FETCH TRAITS
      //======================================================================
      /**
       * Fetch all traits
       *
       * @return void
       */
      fetchAllTraits() {
        axios.get(`/api/traits`)
        .then(res => {
          this.traits = res.data.data;
        })
      },

      /**
       * Fetch Character Traits via API
       *
       * @param {Integer} id
       * @return array
       */
      fetchCharacterTraits(id) {
        axios.get(`/api/character-traits/${id}`)
          .then(res => {
            const data = res.data.data;
            for (let item of data) {
              this.selected.push(item);
            }

              // Remove existing traits from All Traits array
            for (let sel of this.selected) {
              for (let item of this.traits) {
                if (item.id == sel.id) this.traits.splice(this.traits.indexOf(item), 1);
              }
            }
          })
          .catch(e => console.log(e));
      },

      //======================================================================
      // SET/SAVE TRAITS
      //======================================================================
      /**
       * Set the traits selected by the user when editing
       *
       * @param {Object} sel 
       * @return array
       */
      setSelected(sel) {
        const selected = this.selected;
        const existing = this.traits

        selected.includes(sel)
          ? selected.splice(selected.indexOf(sel), 1)
          : selected.push(sel);
        existing.includes(sel)
          ? existing.splice(existing.indexOf(sel), 1)
          : existing.push(sel);

        this.sortArray([selected, existing]);
      },

      /**
       * Saves all of the current traits
       *
       * @return void
       */
      saveTraits: function() {
        let traitPayload = { traits: this.selected, char_id: this.char_id }

        axios.post(`/api/traits`, { payload: traitPayload })
          .then(res => console.log(res))
          .catch(e => console.log(`Error: ${e}`))
      },

      /**
       * Returns all selected traits
       *
       * @return array
       */
      getSelectedTraits: function() {
        return this.selected;
      },

      //======================================================================
      // HELPER FUNCTIONS
      //======================================================================
      checkAll(arr, target) {
        if (target.every(el => arr.includes(el))) {
          return true;
        }
      },

      /**
       * Sort items in an array via child's IDs
       *
       * @param {Array} args 
       * @return {Integer}
       */
      sortArray(args) {
        for (let arg of args) {
          arg.sort((a, b) => {
            if (a.id > b.id)      { return 1 } 
            else if (a.id < b.id) { return -1 } 
            else                    return 0;
          });
        }
      },

      /**
       * Toggles dropdown
       *
       * @return bool
       */
      toggleDropdown() {
        this.isDropdownOpen 
          ? this.isDropdownOpen = false
          : this.isDropdownOpen = true;
      },

    },
    props: ['char_id'],
    setup() {
      // Modals
      const isDropdownOpen = ref(false);

      return {
        isDropdownOpen
      }
    },
  }
</script>