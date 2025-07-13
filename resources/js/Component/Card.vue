<script setup>
import Pagination from "./Pagination.vue";
import Title from "./Title.vue";
import { Link, usePage, router } from "@inertiajs/vue3";
import { computed } from "vue";
import FavoriteIcon from "../Component/FavoretIcon.vue";

const page = usePage();
const user = computed(() => page.props.auth.user);

const props = defineProps({
    Cards: Object,
});



</script>

<template>
    <div class="first_Lay">
        <!-- ---------Header-------- -->
        <div class="flex items-start py-4">
            <div class="flex items-center justify-between w-full pl-150 pr-40">
                <Title v-if="$page.component === 'Home'" class="text-yellow-500 bold py-4">القصص الاكثر قراءة</Title>
                <Title v-if="$page.component === 'Profile/HomePage'" class="text-yellow-500 bold py-4"> القصص التي تم
                    نشرها</Title>

                <Title v-if="user !== null && $page.component === 'Home'"
                    class="text-[#8858BB] bg-yellow-500 py-4 px-2 rounded-lg">
                    <Link :href="route('cards.favorite')">
                    <i class="fa-solid fa-heart text-red-500 mx-1"></i>
                    قصصك المفضلة
                    </Link>
                </Title>
                <Title v-if="$page.component === 'User/FavoriteCards'" class="text-yellow-500 py-4 px-2 rounded-lg">
                    قصصك المفضلة
                </Title>
            </div>
        </div>

        <!-- ---------Cards Section-------- -->
        <div v-if="props.Cards.data.length" class="px-50">
            <div class="grid grid-cols-3 gap-4">
                <div v-for="Card in props.Cards.data" :key="Card.id" class="bg-white rounded-[10px] p-2">
                    <img :src="Card.image
                        ? `/storage/${Card.image}`
                        : `/storage/images/cards/cards/img1.png`
                        " alt="صورة الكرت" class="object-cover h-50 w-90 rounded-[10px]" />

                    <div class="p-2">
                        <h3 dir="rtl" class="font-bold text-xl mb-2 flex items-center justify-between">
                            {{ Card.titel.substring(0, 20) }}
                            <i v-if="$page.component === 'User/FavoriteCards'" class=" fa-solid text-red-500 fa-heart cursor-pointer p-2 text-red-500 rounded transition-all duration-200"></i>
                            <FavoriteIcon :cardId="Card.id" :isFavorite="Card.is_favorite"
                                v-if="$page.component !== 'User/FavoriteCards'" />
                        </h3>
                        <p dir="rtl" class="break-words whitespace-normal">
                            {{ Card.desc.substring(0, 50) }}<br />...
                        </p>
                        <p dir="rtl" class="text-black bold text-[20px]">
                      الكاتب:

                            <button class="text-link" @click="selectuser(Card.user.id)">
                                {{ Card.user.name }}
                            </button>

                        </p>
                    </div>
                    <div>
                        <div v-if="$page.component === 'User/FavoriteCards'"
                            class="flex items-center justify-between p-2 gap-2">
                            <p @click="toggleFavorite"
                                class="flex justify-between items-center bg-red-500  rounded-lg px-4 py-2">
                                <span style="font-size: 20px; color: white">
                                    <FavoriteIcon :cardId="Card.id" :isFavorite="Card.is_favorite" /> حذف
                                </span>
                            </p>

                            <Link :href="route('Card.show', Card.id)"
                                class="flex justify-between items-center bg-yellow-500 hover:bg-yellow-600 rounded-lg px-4 py-2">
                            <span style="font-size: 20px; color: black">
                                تمت القراءة
                            </span>
                            </Link>

                        </div>
                        <div v-else class="flex items-center justify-between p-2 gap-2">
                            <Link :href="route('Card.listen', Card.id)"
                                class="flex justify-between items-center bg-yellow-500 hover:bg-yellow-600 rounded-lg px-4 py-2">
                            <span style="font-size: 20px; color: black">
                                <i class="fas fa-volume-high"></i>
                                استمع
                            </span>
                            </Link>

                            <Link :href="route('Card.show', Card.id)"
                                class="flex justify-between items-center bg-yellow-500 hover:bg-yellow-600 rounded-lg px-4 py-2">
                            <span style="font-size: 20px; color: black">
                                <i class="fa-solid fa-book-open"></i>
                                اقرء الآن
                            </span>
                            </Link>
                        </div>
                    </div>


                </div>
            </div>

            <div class="mt-8 px-2 py-2">
                <Pagination :paginator="props.Cards" />
            </div>
        </div>
    </div>
</template>

<style scoped>
.first_Lay {
    background-color: #8858bb;
    background-image: url("../../sass/imag/Vector.png");
    width: 1531.01px;
    padding: 47px;
    margin: auto;
}
</style>
