<script setup>
import Container from "../../Component/Container.vue";
import PrimaryButton from "../../Component/Button.vue";
import SessiomMessage from "../../Component/SessionMessage.vue";


import { useForm, usePage } from "@inertiajs/vue3";
import { computed } from "vue";
defineProps({
    status:String
})
const form =useForm({});
const submit = () =>{
    form.post(route('verification.send'))
}

const page = usePage();
const user = computed (() => page.props.auth.user);
</script>
<template>
    <div>
        <Head title="-email verefication" />
        <Container class="w-1/2 rounded-[15px] shadow-[0_0_20px_rgba(220,220,220,1)]">
            <div class="mb-8">
                <p>
                    Hi {{ user.name }}, Thank you for registering with us! To
                    complete your registration and activate your account, please
                    verify your email address by clicking the link below:
                    [Verification Link] If you didn’t create an account with us,
                    you can safely ignore this email. Thank you, The [Your
                    Company Name] Team
                </p>
            </div>
            <SessiomMessage :status="status"/>
            <form action="" @submit.prevent="submit">
                <PrimaryButton :disabled="form.processing">Resend verification email</PrimaryButton>
            </form>
        </Container>
    </div>
</template>
