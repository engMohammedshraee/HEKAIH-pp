<script setup>
import Container from "../../Component/Container.vue";
import SessionMessages from "../../Component/SessionMessage.vue";
import InputText from "../../Component/InputField.vue";
import PrimaryButton from "../../Component/Button.vue";
import ErorrsMessage from "../../Component/ErorrsMessage.vue";
import Title from "../../Component/Title.vue";
import { useForm } from "@inertiajs/vue3";
const form = useForm({
    email: "",
});
defineProps({
    status: Array,
});
const submit = () => {
    form.post(route('password.email'));
};
</script>
<template>
    <Container class="w-1/3 rounded-[15px] shadow-[0_0_20px_rgba(220,220,220,1)]">
        <div class="mb-8 text-center">
            <Title>
              اعادة تعيين كلمة المرور
            </Title>
            <p>
                سوف نرسل لك بريدا الكترونيا يحتوي على تعليمات لإعادة تعيين كلمة المرور الخاصة بك.
            </p>
        </div>
        <ErorrsMessage :errors="form.errors" />
        <SessionMessages :status="status" />

        <form @submit.prevent="submit" action="" class="p-2">
            <InputText type="email" label="ادخل البريد الالكتروني" icon="at" v-model="form.email" placeholder="البريد الالكتروني" />
            <PrimaryButton class="bg-black text-white">ارسال البريد الالكتروني</PrimaryButton>
        </form>
    </Container>
</template>
