<script setup>
const model = defineModel();
defineProps({
    label: String,
    icon: String,
    placeholder: {
        type: String,
        default: "",
    },
    row:{
        type:String,
        default:""
    }
});
</script>
<template>
    <div>
        <label
            :for="label"
            class="block text-sm/6 font-medium text-gray-900 dark:text-slate-300 ml-2"
           :class="{'text-yellow-400 font-semibold text-[30px] mb-[10px] text-right' :$page.component ===('Cards/Create')||('Cards/Edit')}" >{{ label }}</label
        >
        <div class="relative mt-1 rounded-md">
            <div
                class="pointer-events-none absolute top-3 left-0 flex items-center pl-3"
            >
                <span class="grid place-center-center text-sm text-slate-400">
                    <i :class="`fa-solid fa-${icon}`"></i>
                </span>
            </div>
            <textarea dir="rtl"
                :rows="row"
                :name="label"
                :placeholder="placeholder"
                v-model="model"
                class="ring-indigo-400 text-black ring-inset ring-1 border-indigo-400 block w-full rounded-[15px] pr-3 pl-9
                 text-sm p-3 dark:text-slate-400 border-slate-300 outline-0 bg-slate-100 focus:ring-1
                  focus:ring-inset focus:ring-indigo-400 focus:border-indigo-400"
            >
            </textarea>
        </div>
    </div>
</template>
