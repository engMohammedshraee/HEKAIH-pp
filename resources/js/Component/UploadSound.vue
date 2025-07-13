<script setup>
import { ref, watch } from "vue";

const props = defineProps({
    sound: { type: String, default: null }, // الصوت القادم من قاعدة البيانات
    label: { type: String, default: "" },
    placeholder: { type: String, default: "رفع ملف صوتي" },
});

const emit = defineEmits(["sound"]);
const placeholderText = ref(props.placeholder);
const selectedFile = ref(null);
const previewSound = ref(props.sound ? `/storage/${props.sound}` : null);

const selectSound = (e) => {
    const file = e.target.files[0];
    if (file) {
        previewSound.value = URL.createObjectURL(file);
        placeholderText.value = file.name;
        emit("sound", file);
    }
};

watch(() => props.sound, (newSound) => {
    previewSound.value = newSound ? `/storage/${newSound}` : null;
});
</script>

<template>
    <div class="flex flex-col gap-2 text-right" dir="rtl">
        <label class="block text-sm/6 mt-5 font-medium text-gray-900 dark:text-slate-300 ml-2"
                :class="{
                    'text-yellow-400 font-semibold text-[30px] mb-[10px] text-right':
                        $page.component === 'Cards/Create'||'Cards/Edit',
                }">{{ label }}</label>

        <!-- زر اختيار الصوت -->
        <label
          class="flex items-center justify-between py-1 px-4 ring-1 border-indigo-100 block w-1/2 text-black rounded-[15px] text-sm py-6 dark:text-slate-400 border-slate-100 outline-0 bg-slate-100 cursor-pointer"

        >
            {{ placeholderText }}
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
            <input type="file" class="hidden" accept="audio/*" @change="selectSound" />
        </label>

        <!-- عرض الصوت القديم -->
        <audio v-if="previewSound" controls class="mt-2  w-1/2">
            <source :src="previewSound" type="audio/mpeg" />
            متصفحك لا يدعم تشغيل الصوت.
        </audio>
    </div>
</template>
