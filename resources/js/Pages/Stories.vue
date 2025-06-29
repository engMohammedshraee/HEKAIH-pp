<script setup>
import Title from "../Component/Title.vue";
import Footer from "../Component/Footer.vue";
import SelectCategory from "../Component/SelectCategory.vue";
import MenuIcon from '../Component/MenuIcon.vue';
import Card from "../Component/Card.vue";
defineProps({
    cards: Object,
});
</script>
<template>
    <Head title="stories-see" />
    <div>
        <div class="py-20">
            <Title class="text-black py-2">عالم القصص السحري</Title>
            <Title class="text-[20px] py-2">
                <span>!</span>
                استكشف مغامرات ممتعة وخيال بلا حدود


            </Title>
            <div class="flex items-center justify-center gap-2 py-4 w-full">
                <MenuIcon></MenuIcon>

                <SelectCategory firstoption="مغامرات" />
                <SelectCategory firstoption="حيوانات" />

                <SelectCategory firstoption="علمي" />

                <SelectCategory firstoption="علمي خيال" />
            </div>

        </div>
                <Card :Cards="cards"></Card>

        <Footer></Footer>
    </div>
</template>
