<script setup>
import Container from "../../Component/Container.vue";
import Title from "../../Component/Title.vue";
import Footer from "../../Component/Footer.vue";

const props = defineProps({
    card: Object,
});
</script>

<template>
    <Head title="معاينة القصة" />

    <Container class="w-full px-0 py-0">
        <!-- العنوان -->
        <Title class="text-black py-10 text-4xl font-bold text-center">
            {{ card.titel }}
        </Title>

        <!-- صورة القصة -->
        <div class="imag-profile h-[834px] w-full flex justify-center">
            <img
                :src="card.image ? `/storage/${card.image}` : `/storage/images/cards/cards/img1.png`"
                alt="صورة القصة"
                class="object-cover h-[559px] w-[1125px] rounded-[10px]"
            />
        </div>

        <!-- النص -->
        <div class="px-4 py-6 text-right text-lg text-black leading-relaxed" dir="rtl">
            {{ card.desc }}
        </div>
         <div class="flex  items-center mb-5 mt-5 gap-10 px-4" dir="rtl">
                    <PrimaryButton class="btn  btn-primary btn-lg custom-button bg-yellow-700 rounded-[10px] p-5">
                        نشر القصة
                    </PrimaryButton>
                    <button type="button"
                        class="custom-button btn-primary bg-yellow-700 p-5 rounded-[10px]">
                        تعديل القصة
                    </button>
                </div>
    </Container>
    <Footer></Footer>
</template>

<style scoped>
.imag-profile {
    background-image: url("../../../sass/imag/Rectangle.png");
    padding: 47px;
}
</style>
