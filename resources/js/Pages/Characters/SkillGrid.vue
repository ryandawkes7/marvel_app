<template>
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
              <ExternalLinkIcon class="h-5 w-5" />
            </div>

            <!-- Subheading -->
            <p class="text-sm text-gray-500" v-if="this.alias != ''">
              Get an insight into {{this.alias}}'s competence in the field. Click on this box to gain further insight into each type of skill.
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
                      <div class="col-span-9 rounded min-h-5 px-2 my-auto" :class="`bg-${skill.colour}-400`" :style="{width: `${(skill.pivot.value / 7) * 100}%`}">
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
</template>

<script>
import { ExternalLinkIcon } from '@heroicons/vue/solid';

export default {
  data() {
    return {
    }
  },
  components: {
    ExternalLinkIcon
  },
  props: [
    'alias',
    'skills'
  ]
}
</script>