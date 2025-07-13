<script setup>
const model=defineModel();

defineProps({
    label:String,
    icon:String,
    placeholder:{
        type:String,
        default:""
    },
    type:{
        type:String,
        default:'text'
    }
});

</script>
<template>
    <div dir="rtl" class="mb-7  items-center justify-center">
        <label for="label" class="block text-sm/6 font-medium text-gray-900 dark:text-slate-300 "
        :class="{'text-yellow-400 font-semibold text-[30px] mb-[10px] text-right' :  ['Cards/Create', 'Cards/Edit'].includes(
                            $page.component
                        ),}">{{ label }}</label>
        <div class="relative mt-1 rounded-md items-center py-3 ">
            <div
              class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-4">
                <span class=" grid place-center-center text-sm text-slate-400">
                    <i :class="`fa-solid fa-${ icon }`"></i>
                </span>
            </div>
            <input id="label"

            :type="type"
            :name="label"
            :placeholder="placeholder"
            v-model="model"
            class="flex items-center ring-1 border-indigo-100 block w-full text-black rounded-[15px] px-2 text-sm  py-4
            dark:text-slate-400 border-slate-100 outline-0 bg-slate-100
            "
            >
        </div>
    </div>
</template>
