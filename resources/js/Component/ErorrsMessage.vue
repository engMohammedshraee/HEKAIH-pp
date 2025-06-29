<script setup>
defineProps({
    errors:Object
})
</script>
<template>
    <div class="mb-4" v-if="Object.keys(errors).length">
        <ul v-for="(error,i) in errors" :key="i">
            <li  class="text-red-500 text-sm">
                {{ error }}
            </li>
        </ul>
    </div>
</template>
