<script setup>
import Title from "../Component/Title.vue";
import Footer from "../Component/Footer.vue";
const props = defineProps({
    writer: Object,
});
const phone = props.phone ?? {
    phone_number: '',
    social_number: ''
}
const writer = props.writer ?? {
    name:'',
        email:'',
        defenation:'',
        image:'',
        profile:'',
         call_phone: '',
    social_phone: ''
}
</script>
<template>
    <Head title="Writerknowen" />

    <div class="relative mb-15 mt-5">
        <div>
            <img
                :src="
                    props.writer.profile
                        ? `/storage/${writer.profile}`
                        : '/storage/images/cards/users/mm.jpg'
                "
                class="h-100 w-full"
            />
        </div>
        <div class="text-center">
            <img
                :src="
                    props.writer.image
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
        <div v-if="writer.phone" dir="rtl" class="px-15 flex gap-4">
            <span> {{ writer.phone? writer.phone.call_phone:null }} <i class="fa-brands fa-whatsapp fa-1xl"></i></span>
            <span class=""> {{ writer.phone? writer.phone.social_phone:null }}</span>
        </div>

    </div>

    <Footer></Footer>
</template>
