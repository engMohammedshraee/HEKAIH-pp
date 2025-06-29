<script setup>

const placeholder = ref("ارفع صورة"); // placeholder أصبح ref

import { ref } from "vue";
const props = defineProps({
    cardimage: String,
    label:String,
    id:String
});
// this to return image from database to form
const currentimage = props.cardimage
    ? `/storage/${props.cardimage}`
    : null;
const preview = ref(currentimage);
//this show text if size image more that specefied
const imagesizeover = ref(false);
//this to show butuon to rotate image
const showRevertbtn =ref(false)
//this to take image that chose and show it in form befor create listing
const emit = defineEmits(["image"]);

const selectimage = (e) => {
    preview.value = URL.createObjectURL(e.target.files[0]);
    imagesizeover.value = e.target.files[0].size > 31457888;
    emit("image", e.target.files[0]);
    const file=e.target.files[0];
    showRevertbtn.value=true,
    placeholder.value=file.name
};

</script>

<template>
    <div class="mb-7" dir="rtl">
        <label
            for="label"
            class="block text-sm/6 mt-5 font-medium text-gray-900 dark:text-slate-300 ml-2"
            :class="{
                'text-yellow-400 font-semibold text-[30px] mb-[10px] text-right':
                    $page.component === 'Cards/Create',
            }"
        >
            {{ label }}
        </label>

        <label
            :for="image"
            class="flex items-center justify-between py-1 px-4 ring-1 border-indigo-100 block w-1/2 text-black rounded-[15px] text-sm py-6 dark:text-slate-400 border-slate-100 outline-0 bg-slate-100 cursor-pointer"
        >
            {{ placeholder }}

            <svg
                xmlns="http://www.w3.org/2000/svg"
                width="32"
                height="32"
                viewBox="0 0 32 32"
                fill="none"
            >
                <path
                    d="M17 26.6673L17 5.33398M17 26.6673L8 18.6673M17 26.6673L26 18.6673"
                    stroke="#4F4F4F"
                    stroke-width="2"
                    stroke-linecap="round"
                    stroke-linejoin="round"
                />
            </svg>
        </label>

        <input
            @input="selectimage"
            type="file"
            name="image"
            id="image"
            hidden
        />
    </div>
</template>
