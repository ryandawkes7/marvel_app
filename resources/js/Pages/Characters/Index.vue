<template>
  <app-layout>
      Hello world
  </app-layout>
</template>

<script>
import AppLayout from '@/Layouts/AppLayout'
    export default {
        props: ['foo'],
        components: {
            AppLayout,
        },
    }
</script>