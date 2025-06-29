<script setup>
import Container from "../../Component/Container.vue";
import Title from "../../Component/Title.vue";
import FavoriteIcon from "../../Component/FavoretIcon.vue";
import Button from "../../Component/Button.vue";
import Footer from "../../Component/Footer.vue";
import StarRating from "../../Component/StarRating.vue";
import { router } from "@inertiajs/vue3";

import { ref } from "vue";

const props = defineProps({
    card: Object,
    user: Object,
    Cardcomment: Object,
    userRating: Number,
    averageRating: Number,
});
//this to send comment
const comment = ref("");
const submitting = ref(false);

const submitComment = () => {
    if (!comment.value.trim()) return;

    submitting.value = true;

    router.post(
        route("comments.store"),
        {
            story_id: props.card.id,
            user_id: props.user.id,
            commentdepartment: 'read',
            content: comment.value,
        },
        {
            onSuccess: () => {
                comment.value = "";
                submitting.value = false;
            },
        }
    );
};

const showdelet = ref(false);
const deletcard = () => {
    router.delete(route("Card.destroy", props.card.id));
    showdelet = !showdelet;
};
</script>
<template>

    <Head title="read-story" />
    <Container class="w-full px-0 py-0">
        <Title class="text-black py-10">{{ card.titel }}</Title>
        <div class="imag-profile h-[834px] w-full">
            <div class="flex items-center justify-start px-38 gap-4 mb-4" dir="rtl">
                <Title class="w-auto text-[#8858BB] bg-yellow-500 rounded-lg px-3 py-2 flex items-center gap-2"
                    dir="rtl">
                    <Link :href="route('cards.favorite')" class="flex items-center gap-2">
                    <span v-if="card.is_favorite">إزالة من المفضلة</span>
                    <span v-else>أضف إلى المفضلة</span>
                    <FavoriteIcon :cardId="card.id" :isFavorite="card.is_favorite" />
                    </Link>
                </Title>
                <div class="bg-yellow-400 p-3 rounded-full flex items-center justify-center w-12 h-12">
                    <i class="fa-solid fa-headphones text-black text-3xl"></i>
                </div>
            </div>

            <div class="flex items-center justify-center object-cover">
                <img :src="card.image
                    ? `/storage/${card.image}`
                    : `/storage/images/cards/cards/img1.png`
                    " alt="صورة الكرت" class="object-auto h-[559px] w-[1125px] rounded-[10px]" />
            </div>
        </div>
        <div class="px-4">
            <div class="py-2 px-11" dir="rtl">
                {{ card.desc }}
                <p>النهاية...</p>
            </div>
            <div v-if="user.id === card.user_id" class="flex items-end justify-between mb-2" dir="rtl">
                <div dir="rtl" class="pl-4 flex items-center gap-4 px-5">
                    <Link :href="route('Card.edit', card.id)"
                        class="bg-green-500 text-white rounded-lg text-white px-3 py-4 hover:outline outline-green-500 outline-offset-2">
                    Edit
                    </Link>

                    <div v-if="!showdelet" @click="showdelet = !showdelet" class="bg-red-500 rounded-lg text-white">
                        <Button class="bg-red-500">delet</Button>
                    </div>

                    <div v-else class="flex items-center justify-center gap-1 w-300 px-2 py-2 rounded-lg">
                        <p>?are you sure to delete</p>

                        <Button @click="showdelet = !showdelet" href=""
                            class="bg-blue-500 rounded-lg text-white px-2 py-2 hover:outline outline-green-500 outline-offset-2">
                            cancel
                        </Button>
                        <Button @click="deletcard"
                            class="bg-red-500 rounded-lg text-white px-2 py-2 hover:outline outline-green-500 outline-offset-2">
                            confirm
                        </Button>
                    </div>
                </div>
            </div>

            <hr class="text-black text-2" />
        </div>
        <div dir="rtl" class="bg-white text-black px-15 py-4 rounded  flex items-start gap-4">
            <p dir="rtl" class="text-2xl">
                {{
                    Cardcomment.comments.filter(c => c.commentdepartment === 'read').length
                }} تعليقات
            </p>


        </div>
        <!-- نموذج كتابة تعليق -->
        <div dir="rtl" class="mb-4 flex justify-start items-center gap-3  px-15">

            <i class="fa-solid fa-circle-user text-4xl"></i>
            <textarea v-model="comment" placeholder="اكتب تعليقك هنا..." class="w-2/3 border rounded-[10px] p-2"
                rows="1" />
            <button @click="submitComment" :disabled="submitting"
                class="bg-blue-700 text-white px-4 py-3 rounded-[10px] hover:bg-purple-600">
                إرسال التعليق
            </button>
        </div>


        <!--comment div-->
        <div>
            <div v-if="Cardcomment.comments && Cardcomment.comments.length" class="space-y-4 my-6 px-15" dir="rtl">
                <div v-for="comment in Cardcomment.comments.filter(
                    (c) => c.commentdepartment === 'read'
                )" :key="comment.id"
                    class="bg-white text-black p-4 rounded-[10px] shadow mb-3 flex items-start gap-4 border-1">
                    <!-- صورة المستخدم -->
                    <img :src="comment.user.image
                        ? `/storage/${comment.user.image}`
                        : `/storage/images/cards/users/mm.jpg`
                        " alt="avatar" class="w-10 h-10 rounded-full object-cover" />

                    <!-- محتوى التعليق -->
                    <div>
                        <div class="flex justify-center items-center gap-3">
                            <p class="text-1xl bold text-black mb-1">
                                {{ comment.user.name }}
                            </p>
                            <p class="text-sm text-gray-500 mb-1">
                                {{
                                    new Date(comment.created_at).toLocaleString("EG", {
                                        dateStyle: "medium",
                                        timeStyle: "short",
                                    })
                                }}
                            </p>
                        </div>

                        <!-- نص التعليق -->
                        <p class="text-gray-500 text-sm">
                            {{ comment.content }}
                        </p>
                    </div>
                </div>
            </div>

            <!-- في حال لا توجد تعليقات مناسبة -->
            <p v-else dir="rtl" class="text-black-500 py-5 px-5">
                لا توجد تعليقات بعد.
            </p>


        </div>

        <StarRating :cardId="card.id" :initialRating="userRating" :averageRating="averageRating" />

        <Footer></Footer>
    </Container>
</template>
<style scoped>
.imag-profile {
    background-image: url("../../../sass/imag/Rectangle.png");
    padding: 47px;
}
</style>
