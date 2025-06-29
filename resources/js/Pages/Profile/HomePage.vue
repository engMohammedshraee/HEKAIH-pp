<script setup>
import Title from "../../Component/Title.vue";
import Button from "../../Component/Button.vue";
import Footer from "../../Component/Footer.vue";
import { usePage } from "@inertiajs/vue3";
import { computed } from "vue";
const page=usePage();
const currentuser=computed(()=>page.props.auth.user)
const props = defineProps({
    user: Object,
    phone: Object,
    cards:Object,
    status: String
});
const phone = props.phone ?? {
    phone_number: '',
    social_number: ''
}
const writer = props.user ?? {
    name:'',
        email:'',
        defenation:'',
        image:'',
        profile:'',
}
</script>
<template>
    <Head title="profile" />

    <div class="relative mb-15 mt-5">
        <div>
            <img
                :src="
                    props.user.profile
                        ? `/storage/${writer.profile}`
                        : '/storage/images/cards/users/mm.jpg'
                "
                class="h-100 w-full"
            />
        </div>
        <div class="text-center">
            <img
                :src="
                    props.user.image
                        ? `/storage/${writer.image}`
                        : '/storage/images/cards/users/mm.jpg'
                "
                class="absolute top-65 left-180 h-[200px] w-[200px] rounded-full"
            />
        </div>
    </div>
    <div>
        <Title class="p-5 text-center">
            {{ writer.name }}
        </Title>
    </div>
    <div class="text-10 p-10">
        <div class="text-right px-15">
            {{ writer.defenation }}
        </div>
        <div class="text-right pt-15 px-15">: للتواصل</div>
        <div class="text-right px-15">
            {{ writer.email }}
        </div>
        <div dir="rtl" class="px-15 flex gap-4">
            <span> {{ phone.call_phone }} <i class="fa-brands fa-whatsapp fa-1xl"></i></span>
            <span class=""> {{ phone.social_phone }}</span>
        </div>
        <div  dir="rtl" class="flex gap-3 px-15 py-20">
            <Button class="bg-[#FFB74D]">
                <Link
                    :href="route('profile.edit')"
                    class="block w-full px-6 py-3 text-black"
                >
                    تعديل الملف الشخصي
                </Link></Button
            >
            <Button class="bg-[#FFB74D]">
                <Link
                    :href="route('Card.create')"
                    class="block w-full px-6 py-3 text-black"
                >
                    اضافة قصة جديدة</Link
                ></Button
            >
        </div>
    </div>
<!--
    <div>
                <Card :Cards="cards" />

    </div> -->
    <Footer></Footer>
</template>
