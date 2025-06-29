<script setup>
import { router } from "@inertiajs/vue3";
import { ref, watch } from "vue";

const props = defineProps({
  cardId: {
    type: Number,
    required: true,
  },
  isFavorite: {
    type: Boolean,
    required: true,
  },
});

// نستخدم متغير محلي لتعكس حالة المفضلة فورًا بعد الضغط
const favorite = ref(props.isFavorite);

// نراقب التغيير في props ونحدث القيمة المحلية
watch(
  () => props.isFavorite,
  (newVal) => {
    favorite.value = newVal;
  }
);

const toggleFavorite = () => {
  router.post(
    "/favorites/toggle",
    { card_id: props.cardId },
    {
      preserveScroll: true,
      onSuccess: () => {
        // قلب الحالة المحلية (سيتم تحديثها لاحقًا من الصفحة الأم إذا لزم الأمر)
        favorite.value = !favorite.value;
      },
    }
  );
};
</script>

<template>
  <i
    class="cursor-pointer p-2 rounded transition-all duration-200"
    :class="[
      'fa-heart',
      favorite ? 'fa-solid text-red-500' : 'fa-regular text-gray-400',
    ]"
    @click="toggleFavorite"
  ></i>
</template>
