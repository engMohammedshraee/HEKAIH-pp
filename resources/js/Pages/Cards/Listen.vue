<script setup>
import AudioPlayer from "../../Component/AudioPlayer.vue";
import Footer from "../../Component/Footer.vue";
import StarRating from "../../Component/StarRating.vue";
import { router } from "@inertiajs/vue3";
import { ref } from "vue";

const props = defineProps({
  card: Object,
  user: Object,
  cardcomment: Object,
  userRating: Number,
  averageRating: Number,
});

const comment = ref("");
const submitting1 = ref(false);

const submitComment = () => {
    if (!comment.value.trim()) return;

    submitting1.value = true;

    router.post(
        route("comments.store"),
        {
            story_id: props.card.id,
            user_id: props.user.id,
            commentdepartment: "listen",
            content: comment.value,
        },
        {
            onSuccess: () => {
                comment.value = "";
                submitting1.value = false;
            },
        }
    );
};
</script>

<template>
    <Head title="listen" />
    <div class="relative w-full h-160">
        <img src="../../../sass/imag/backlisten.png" class="w-full h-full object-cover" alt="" />
        <div class="absolute inset-0 flex flex-col items-center justify-center gap-4 text-center">
            <h1 class="text-black text-4xl font-bold px-4 py-5 rounded-lg">{{ card.titel }}</h1>
            <div class="w-full px-20">
                <AudioPlayer :card="card" :src="`/storage/${card.sound}`" />
            </div>
        </div>
    </div>

    <div dir="rtl" class="bg-white text-black p-4 rounded shadow mb-3 flex items-start gap-4">
        <p class="text-2xl">
            {{ cardcomment.comments.filter(c => c.commentdepartment === "listen").length }} تعليقات
        </p>
    </div>

    <div dir="rtl" class="mb-4 flex justify-start items-center gap-3 py-5 px-5">
        <i class="fa-solid fa-circle-user text-4xl"></i>
        <textarea v-model="comment" placeholder="اكتب تعليقك هنا..." class="w-2/3 border rounded-[10px] p-2" rows="1" />
        <button @click="submitComment" :disabled="submitting1" class="bg-blue-700 text-white px-4 py-3 rounded-[10px] hover:bg-purple-600">
            إرسال التعليق
        </button>
    </div>

    <div>
        <div v-if="cardcomment.comments && cardcomment.comments.length" class="space-y-4 my-6 px-3" dir="rtl">
            <div
                v-for="comment in cardcomment.comments.filter(c => c.commentdepartment === 'listen')"
                :key="comment.id"
                class="bg-white text-black p-4 rounded-[10px] shadow mb-3 flex items-start gap-4 border-1"
            >
                <img
                    :src="comment.user.image ? `/storage/${comment.user.image}` : `/storage/images/cards/users/mm.jpg`"
                    alt="avatar"
                    class="w-10 h-10 rounded-full object-cover"
                />
                <div>
                    <div class="flex justify-center items-center gap-3">
                        <p class="text-1xl bold text-black mb-1">{{ comment.user.name }}</p>
                        <p class="text-sm text-gray-500 mb-1">
                            {{ new Date(comment.created_at).toLocaleString("EG", { dateStyle: "medium", timeStyle: "short" }) }}
                        </p>
                    </div>
                    <p class="text-gray-500 text-sm">{{ comment.content }}</p>
                </div>
            </div>
        </div>
        <p v-else dir="rtl" class="text-black-500 py-5 px-5">لا توجد تعليقات بعد.</p>
    </div>

    <StarRating :cardId="card.id" :initialRating="userRating" :averageRating="averageRating" />

    <Footer />
</template>

<style scoped>
.titel {
    text-align: center;
    font-weight: 700;
    font-size: 40px;
    line-height: 74.96px;
    color: #212121;
    margin: auto;
    margin-bottom: 50px;
}
.sound {
    margin-top: 50px;
    margin: auto;
    text-align: center;
}
</style>
