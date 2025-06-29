<script setup>
import Container from "../../../Component/Container.vue";
import Title from "../../../Component/Title.vue";
import PrimaryButton from "../../../Component/Button.vue";
import ErorrsMessage from "../../../Component/ErorrsMessage.vue";
import filedtext from "../../../Component/Textarea.vue";

import { useForm } from "@inertiajs/vue3";
import { route } from "../../../../../vendor/tightenco/ziggy/src/js";

const props = defineProps({
    user: Object,
    phone:Object
});
const form = useForm({
    defenation: props.user.defenation,
    email: props.user.email,
    call_phone:props.phone.call_phone,
    social_phone:props.phone.social_phone


});

const submit = () => {
    form.patch(route("profile.info"));
};
</script>
<template>
    <Container class="rounded-[5px] border-b-2 border-black">
        <div class="mb-8">
            <Title class="w-full text-end text-black">السيرة الذاتية </Title>
        </div>

        <form @submit.prevent="submit" action="" class="p-2" dir="rtl">
            <ErorrsMessage :errors="form.errors" />
            <PrimaryButton
                class="absolute top-[1050px] text-black px-2 w-[60px] bg-blue-500 left-[100px]"
                >save</PrimaryButton
            >

            <div class="mb-8">
                <Title class="w-full text-start text-black text-[20px]">
                    نبذة عني
                </Title>
                <filedtext
                    class="w-2/3"
                    row="4"
                    v-model="form.defenation"
                ></filedtext>
            </div>
            <div class="mb-8">
                <Title class="w-full text-start text-black text-[20px]">
                    البريد الالكتروني
                </Title>
                <filedtext
                    class="w-2/3"
                    row="1"
                    v-model="form.email"
                ></filedtext>
            </div>
            <div class="mb-8">
                <Title class="w-full text-start text-black text-[20px]">
                    ارقام التواصل
                </Title>
                <filedtext class="w-2/3" row="2" v-model="form.call_phone">

                </filedtext>
                <filedtext class="w-2/3" row="2" v-model="form.social_phone">

                </filedtext>
            </div>
        </form>
    </Container>
</template>
