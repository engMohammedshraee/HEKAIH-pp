<script setup>
const model = defineModel();
defineProps({
    name: String,
});
</script>
<template>
    <div class="flex items-center gap-2">


        <input
            type="checkbox"
            :id="name"
            v-model="model"
            class=" ml-2 mb-2 rounded-full border border-slate-500 outline-0 text-indigo-500 ring-indigo-500"

        />

        <label
            :for="name"
            class=" ml-2 mb-2 block text-sm font-medium text-slate-700 dark:text-slate-300 cursor-pointer"
        >
            <slot />
        </label>
    </div>
</template>
