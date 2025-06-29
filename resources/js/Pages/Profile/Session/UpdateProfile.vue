<script setup>
import Container from "../../../Component/Container.vue";
import Title from "../../../Component/Title.vue";
import PrimaryButton from "../../../Component/Button.vue";
import ErorrsMessage from "../../../Component/ErorrsMessage.vue";
import Changeimage from "../../../Component/Changeimage.vue";
import SessionMessage from "../../../Component/SessionMessage.vue";

import {  useForm } from "@inertiajs/vue3";
import { route } from "../../../../../vendor/tightenco/ziggy/src/js";

const props = defineProps({
    user: Object
});
const form = useForm({
    profile: props.user.profile,
});

const submit = () => {
     form.post(route("profile.profile"), {
  forceFormData: true,
});
};
</script>
<template>
    <Container class="w-full mb-2 rounded-[5px] border-b-2 border-black">
        <div class="mb-8 text-center " dir="rtl">
        <SessionMessage :status="status"/>

            <Title class="w-full text-start text-black" dir="rtl"
                > صورة الغلاف</Title
            >

            <form @submit.prevent="submit" action="" class=" relativ w-full items-center justify-center flex">
            <ErorrsMessage :errors="form.errors" />

            <div class="ml-2 mb-2 mt-2">
                <PrimaryButton
                    class="absolute top-[550px] text-black px-2 w-[60px] bg-blue-500 left-[100px]"
                    >save</PrimaryButton
                >


                    <Changeimage  id="profile"   positionicon="top-[250px] left-[50px]"  size=" h-[300px] w-[1450px]  object-contain" :image="form.profile"

                        @image="(e) => (form.profile = e)"

                  />

            </div>
        </form>
        </div>


    </Container>
</template>
