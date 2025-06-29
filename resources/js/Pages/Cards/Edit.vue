<script setup>
import Footer from "../../Component/Footer.vue";
import Textarea from "../../Component/Textarea.vue";
import InputField from "../../Component/InputField.vue";
import Changeimage from "../../Component/Changeimage.vue";
import UploadSound from "../../Component/UploadSound.vue";
import Title from "../../Component/Title.vue";
import errorMessage from "../../Component/ErorrsMessage.vue";
import PrimaryButton from "../../Component/Button.vue";
import { useForm } from "@inertiajs/vue3";
import { route } from "../../../../vendor/tightenco/ziggy/src/js";

const props = defineProps({
    Card: Object,
});

const form = useForm({
    titel: props.Card.titel,
    desc: props.Card.desc,
    category: props.Card.category,
    level: props.Card.level,
    image: null, // سيتم رفع صورة جديدة لو اختار المستخدم
    sound: null, // سيتم رفع صوت جديد لو اختار المستخدم
    _method: "PUT",


});
</script>

<template>
    <Head title="Edit-story" />
    <div class="container1" dir="rtl">
        <div class="image"></div>

        <Title class="tiltle" dir="rtl">تعديل القصة</Title>

        <div class="story-form-container text-end" dir="rtl">
            <form
                dir="ltr"
                @submit.prevent="
                    form.post(route('Card.update',props.Card.id), {
                        onFinish: () => form.reset(),
                    })
                "
            >
                <errorMessage :errors="form.errors" class="text-black" />

                <!-- عنوان القصة -->
                <InputField label="تعديل عنوان القصة" v-model="form.titel" />

                <!-- نص القصة -->
                <Textarea label="تعديل نص القصة" v-model="form.desc" />

                <!-- صورة القصة -->
                <div class="py-10">
                    <Changeimage
                        dir="rtl"
                        positionicon="right-10 top-5"
                        id="image"
                        label="تعديل غلاف القصة"
                        :image="Card.image"
                        size="w-full h-[300px] object-cover rounded-lg mx-auto"
                        @image="(file) => (form.image = file)"

                    />
                </div>

                <!-- الصوت -->
                <UploadSound
                    id="sound"
                    :sound="props.Card.sound"
                    label="تعديل المقطع الصوتي للقصة "
                    @sound="(file) => (form.sound = file)"
                />

                <!-- تصنيف القصة -->
                <div class="mb-4 px-2">
                    <label for="category" class="form-label"
                        >تصنيف القصة تعديل</label
                    >
                    <select
                        dir="rtl"
                        id="category"
                        v-model="form.category"
                        class="custom-input w-full px-5"
                    >
                        <option value="مغامرات">مغامرات</option>
                        <option value="تعليمي">تعليمي</option>
                        <option value="خيال علمي">خيال علمي</option>
                        <option value="حيوانات">حيوانات</option>
                    </select>
                </div>

                <!-- مستوى القصة -->
                <div class="mb-4 px-2">
                    <label for="level" class="form-label">مستوى القصة</label>
                    <select
                        dir="rtl"
                        id="level"
                        v-model="form.level"
                        class="custom-input w-full px-5"
                    >
                        <option value="1">من عمر 3-5 سنة</option>
                        <option value="2">من عمر 6-8 سنة</option>
                        <option value="3">من عمر 9-11 سنة</option>
                        <option value="4">من عمر 10-14 سنة</option>
                    </select>
                </div>

                <!-- زر الإرسال -->
                <div
                    class="flex justify-center items-center mb-5 w-full"
                    dir="rtl"
                >
                    <PrimaryButton
                        class="bg-blue-500 px-6 py-3 rounded-lg text-white"
                        >تعديل القصة</PrimaryButton
                    >
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
.story-form-container {
    background-color: #8858bb;
    padding: 60px 60px 70px;
    border-radius: 20px;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.2);
    color: #fff;
}
.form-label {
    color: #ffc107;
    font-size: 18px;
    margin-bottom: 10px;
}
.custom-input {
    background-color: #f8f9fa;
    border: 2px solid #fff;
    border-radius: 15px;
    padding: 10px 15px;
    font-size: 16px;
    color: #333;
}
.custom-button {
    border-radius: 15px;
    padding: 10px 20px;
    font-size: 18px;
    font-weight: bold;
    background-color: #00aeef;
    color: #fff;
}
</style>
