<script setup>
import Container from "../../../Component/Container.vue";
import Title from "../../../Component/Title.vue";
import PrimaryButton from "../../../Component/Button.vue";
import ErorrsMessage from "../../../Component/ErorrsMessage.vue";
import Changeimage from "../../../Component/Changeimage.vue";

import {  useForm } from "@inertiajs/vue3";
import { route } from "../../../../../vendor/tightenco/ziggy/src/js";

const props = defineProps({
    user: Object,

});
const form = useForm({
    image: props.user.image,

});


const submit = () => {
 form.post(route("profile.image"), {
  forceFormData: true,
});

};
</script>
<template>
    <Container class="w-full mb-2 rounded-[5px] border-b-2 border-black">
        <div class="mb-8 text-center " dir="rtl">

            <Title class="w-full text-start text-black" dir="rtl"
                >الصورة الشخصية</Title
            >

            <form @submit.prevent="submit" action="" class=" relativ w-full items-center justify-center flex">
            <ErorrsMessage :errors="form.errors" />

            <div class="ml-2 mb-2 mt-2">
                <PrimaryButton
                    class="absolute top-[135px] text-black px-2 w-[60px] bg-blue-500 left-[100px]"
                    >save</PrimaryButton
                >


                    <Changeimage id="image" :image="form.image"
                        @image="(e) => (form.image = e)"

                     positionicon="top-[150px] left-[3px]"  size=" h-[200px] w-[200px] rounded-full"/>

            </div>
        </form>
        </div>


    </Container>
</template>
