<template>
    <div v-if="validationErrors" class="pt-2">
        <ul class="bg-red-100 px-2 py-1 rounded-md">
            <li v-for="(value, key) in validationErrors" :key="key">
                <p class="text-red-500"><span class="font-bold mr-1">-</span> {{value}}</p>
            </li>
        </ul>
    </div>
</template>

<script>
export default {
    computed: {
        validationErrors() {
            let errors = Object.values(this.errors);
            errors = errors.flat();
            return errors;
        }
    },
    props: ['errors']
}
</script>