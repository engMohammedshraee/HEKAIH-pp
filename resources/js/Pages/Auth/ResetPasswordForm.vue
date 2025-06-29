<script setup>
import Container from "../../Component/Container.vue";
import Title from "../../Component/Title.vue";
import InputText from "../../Component/InputField.vue";
import PrimaryButton from "../../Component/Button.vue";
import { useForm } from "@inertiajs/vue3";
import { route } from "../../../../vendor/tightenco/ziggy/src/js";
import ErorrsMessage from "../../Component/ErorrsMessage.vue";
import { ref } from "vue";

const showPassword = ref(false);
const togglePassword = () => {
    showPassword.value = !showPassword.value;
};
const props = defineProps({
    token: String,
    email: String,
});
const form = useForm({
    token: props.token,
    email: props.email,
    password: "",
    password_confirmation: "",
});
const submit = () => {
    form.post(route("password.update"), {
        onFinish: () => form.reset("password", "password_confirmation"),
    });
};
</script>
<template>
    <Container
        class="w-1/3 rounded-[15px] shadow-[0_0_20px_rgba(220,220,220,1)]"
    >
        <div class="mb-8 text-center">
            <Title>انشاء كلمة مرور جديدة</Title>
            <p>
                يجب ان تكون كلمة المرور الخاصة بك مختلفة عن كلمات المرور
                المستخدمة سابقا
            </p>
        </div>
        <ErorrsMessage :errors="form.errors" />

        <form @submit.prevent="submit" action="" class="p-2">
            <InputText hidden label="البريد" icon="at" v-model="form.email" />

            <InputText
            :type="showPassword ? 'text' : 'password'"
              @click="togglePassword"
                label="ادخل كلمة المرور"
                placeholder="كلمة المرور"
                :icon="showPassword ? 'fa-regular fa-eye-slash' : 'fa-regular fa-eye'" class="text-gray-500"
                v-model="form.password"
            />

            <InputText
              :type="showPassword ? 'text' : 'password'"
              @click="togglePassword"
                label="تاكيد كلمة المرور"
                :icon="showPassword ? 'fa-regular fa-eye-slash' : 'fa-regular fa-eye'" class="text-gray-500"
                
                placeholder="تاكيد كلمة المرور"
                v-model="form.password_confirmation"
            />
            <PrimaryButton class="bg-black text-white"
                >اعادة تعيين كلمةالمرور</PrimaryButton
            >
        </form>
    </Container>
</template>
