<template>
  <div class="fixed bottom-0 inset-x-0 pb-2 sm:pb-5" v-if="isSuccessToastOpen" >
    <div class="ml-auto px-2 block sm:px-6 lg:px-8">
      <div class="p-2 rounded-lg bg-green-400 shadow-lg sm:p-3">
        <div class="flex items-center justify-between flex-wrap">
          <div class="w-0 flex-1 flex items-center">
            <span class="flex p-2">
              <CheckCircleIcon class="h-6 w-6 text-white" aria-hidden="true" />
            </span>
            <p class="ml-3 font-medium text-white truncate">
              <span class="hidden md:inline">
                {{this.message}}
              </span>
            </p>
          </div>
          <div class="order-2 flex-shrink-0 sm:order-3 sm:ml-2">
            <button type="button" @click="this.isSuccessToastOpen = false" class="-mr-1 transition-colors flex p-2 rounded-md hover:bg-green-500 focus:outline-none focus:ring-2 focus:ring-white">
              <span class="sr-only">Dismiss</span>
              <XIcon class="h-6 w-6 text-white" aria-hidden="true" />
            </button>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import { CheckCircleIcon, XIcon } from '@heroicons/vue/solid';
import { ref } from 'vue';

export default {
  setup() {
    const isSuccessToastOpen = ref(false);

    return {
      isSuccessToastOpen
    }
  },
  components: {
    CheckCircleIcon,
    XIcon
  },
  methods: {
    toggle() {
      this.isSuccessToastOpen = true;
      setTimeout(() => {
        this.isSuccessToastOpen = false;
      }, 3000);
    }
  },
  props: [
    'message'
  ]
}
</script>