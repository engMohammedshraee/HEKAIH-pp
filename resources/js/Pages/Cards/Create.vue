<script setup>
import Footer from "../../Component/Footer.vue";
import Textarea from "../../Component/Textarea.vue";
import InputField from "../../Component/InputField.vue";
import Changeimage from "../../Component/Changeimage.vue";
import UploadSound from "../../Component/UploadSound.vue";

import Title from "../../Component/Title.vue";
import errorMessage from "../../Component/ErorrsMessage.vue";
import PrimaryButton from "../../Component/Button.vue";
import { useForm, router } from "@inertiajs/vue3";
import { route } from "../../../../vendor/tightenco/ziggy/src/js";

defineProps({
    user: Object
})
const form = useForm({
    titel: "",
    desc: "",
    category: "",
    level: "",
    image: null,
    sound: null,
});
const previewCard = () => {
    router.visit(route('cards.preview'), {
        data: {
            titel: form.titel,
            desc: form.desc,
            image: form.image,
            sound: form.sound,
            category: form.category,
            level: form.level
        },
        method: 'post',
        preserveState: true,
    });
};


const submit = () => {
    form.post(route("Card.store"), {
        onFinish: () => form.reset("titel", "desc", "image", "sound"),
    });
};
</script>
<template>

    <Head title="create-story" />

    <div v-if="user.role === 'مغلق'" class=" p-20 bg-white text-lg font-medium leading-relaxed
     flex flex-col items-center justify-center ">
        <p class="text-red-500 text-5xl py-5">
            <i class="fa-solid fa-ban"></i>
        </p>

        <p class="py-2 text-red-500 text-3xl">
            عذرا لايمكنك انشاء قصة
        </p>
        <p class="py-2 text-[#8AC926] text-3xl">
            يرجى التواصل مع الادارة لحل المشكلة
        </p>

    </div>

    <div v-else class="container1" dir="rtl">
        <div class="image"></div>
        <Title class="tiltle" dir="rtl">اضافة قصة جديدة</Title>

        <div class="story-form-container text-end" dir="rtl">
            <form dir="ltr" @submit.prevent="submit">
                <errorMessage :errors="form.errors" />
                <!-- Title -->
                <div class="px-4">
                    <InputField label="أضف عنوان القصة" v-model="form.titel" placeholder="عنوان القصة" />
                </div>

                <!-- Story Text -->
                <div class="px-4">
                    <Textarea label="أضف نص القصة" v-model="form.desc" placeholder="نص القصة..." />
                </div>


                <div class="mb-4 px-2">
                    <label for="category"
                        class="block text-sm/6 mt-5 font-medium text-gray-900 dark:text-slate-300 ml-2" :class="{
                            'text-yellow-400 font-semibold text-[30px] mb-[10px] text-right':
                                $page.component === 'Cards/Create' ||
                                'Cards/Edit',
                        }">
                        تصنيف القصة</label>
                    <div
                        class="flex items-center  px-4 text-2xl ring-1 border-indigo-100 block w-full text-black rounded-[10px] dark:text-slate-400 border-slate-100 outline-0 bg-slate-100">
                        <select dir="rtl" id="category" v-model="form.category"
                            class="flex items-center py-4 px-4 text-2xl block w-full text-black rounded-[10px] dark:text-slate-400 border-slate-100 outline-0 bg-slate-100">
                            <option value="مغامرات">مغامرات</option>
                            <option value="تعليمي">تعليمي</option>
                            <option value="خيال علمي">خيال علمي</option>
                            <option value="حيوانات">حيوانات</option>
                        </select>
                    </div>
                </div>
                <div class="mb-4 px-2">
                    <label for="category"
                        class="block text-sm/6 mt-5 font-medium text-gray-900 dark:text-slate-300 ml-2" :class="{
                            'text-yellow-400 font-semibold text-[30px] mb-[10px] text-right':
                                $page.component === 'Cards/Create',
                        }">
                        مستوى القصة</label>
                    <div
                        class="flex items-center  px-4 text-2xl ring-1 border-indigo-100 block w-full text-black rounded-[10px] dark:text-slate-400 border-slate-100 outline-0 bg-slate-100">
                        <select dir="rtl" id="category" v-model="form.level"
                            class="flex items-center py-4 px-4 text-2xl block w-full text-black rounded-[10px] dark:text-slate-400 border-slate-100 outline-0 bg-slate-100">
                            <option value="1">من عمر 3-5 سنة</option>
                            <option value="2">من عمر 6-8 سنة</option>
                            <option value=" 3">من عمر 9-11 سنة</option>
                            <option value="4">من عمر 10-14 سنة</option>
                        </select>
                    </div>
                </div>
                <div class="">
                    <Changeimage dir="rtl" positionicon="right-10 top-5" id="image" label="أضف غلاف القص"
                        @image="(e) => (form.image = e)" />
                </div>

                <div class="">
                    <UploadSound id="sound" label="أضف مقطع صوتي للقصة (اختياري)"
                        @sound="(file) => (form.sound = file)" />
                </div>

                <!-- Category -->

                <!-- Buttons -->
                <div class="flex justify-center items-center mb-5 mt-5 gap-125" dir="rtl">
                    <PrimaryButton class="btn btn-primary btn-lg custom-button">
                        نشر القصة
                    </PrimaryButton>
                    <button type="button" @click="previewCard" class="custom-button btn-primary">
                        معاينة القصة
                    </button>
                </div>
            </form>
        </div>
    </div>
    <Footer />
</template>
<style scoped>
.container1 {
    position: relative;
    padding: 200px;
    background-color: white;
    margin: auto;
}

.tiltle {
    direction: rtl;
    font-size: 40px;
    font-weight: 700;
}

.image {
    background-image: url("../../../sass/imag/childimg.png");
    position: absolute;
    height: 400px;
    width: 400px;
    background-size: cover;
    top: -30px;
    left: 30px;
}

.mb4 {
    margin-bottom: 100px;
}

.story-form-container {
    background-color: #8858bb;
    /* Purple background */
    padding: 60px;
    padding-bottom: 70px;
    border-radius: 20px;
    box-shadow: 0px 4px 20px rgba(0, 0, 0, 0.2);
    color: #fff;
    font-family: "Tajawal", sans-serif;
    margin-top: 20px;
    margin: auto;
}

.form-label {
    color: #ffc107;
    /* Yellow color for labels */
    font-weight: 600;
    font-size: 18px;
    margin-bottom: 10px;
    text-align: right;
}

.selecticon {
    background-color: #f8f9fa;
    /* Light gray background */
    border: 2px solid #fff;
    border-radius: 15px;
    padding: 10px 15px;
    font-size: 16px;
    text-align: right;
    /* Align text to the right */
    color: #333;
    display: flex;
    justify-content: space-between;
    align-items: center;
    direction: rtl;
}

.custom-input,
.custom-textarea {
    background-color: #f8f9fa;
    /* Light gray background */
    border: 2px solid #fff;
    border-radius: 15px;
    padding: 10px 15px;
    font-size: 16px;
    text-align: right;
    /* Align text to the right */
    color: #333;
}

.custom-input::placeholder,
.custom-textarea::placeholder {
    color: #999;
    text-align: right;
}

.custom-textarea {
    resize: none;
}

.file-upload {
    background-color: #ffffff;
    color: #333;
    padding: 15px;
    border-radius: 15px;
    cursor: pointer;
    font-size: 16px;
    width: 400px;
    direction: rtl;
    display: flex;
    justify-content: space-between;
}

.custom-button {
    border-radius: 15px;
    padding: 10px 20px;
    font-size: 18px;
    font-weight: bold;
}

.custom-button.btn-primary {
    background-color: #00aeef;
    color: #fff;
    border: none;
}

.custom-button.btn-secondary {
    background-color: #ffc107;
    color: #fff;
    border: none;
}

.form-label {
    font-size: 32px;
    font-weight: bold;
}

.btn-primary {
    width: 250px;
    font-size: 32px;
    font-weight: bold;
}
</style>
