<script setup>
import { ref } from 'vue';
import { router } from '@inertiajs/vue3';

const props = defineProps({
  cardId: Number,
  initialRating: { type: Number, default: 0 },       // تقييم المستخدم
  averageRating: { type: Number, default: 0 },       // المتوسط العام
});

const hover = ref(0);
const selected = ref(props.initialRating);

// إرسال تقييم المستخدم
const rate = (value) => {
  selected.value = value;
  hover.value = value;

  router.post(route('cards.rate', props.cardId), {
    rating: value,
  }, {
    preserveScroll: true,
  });
};
</script>

<template>
  <div class="bg-blue-500 py-10 mb-20 flex items-center justify-center">
    <div dir="rtl" class="bg-white p-10 rounded-lg shadow text-center">
      <p class="text-lg mb-6">قيّم القصة إذا أعجبتك</p>

      <div class="flex justify-center gap-2">
        <!-- تلوين النجوم حسب المتوسط أو hover أو تقييم المستخدم -->
        <button
          v-for="star in 5"
          :key="star"
          @click="rate(star)"
          @mouseover="hover = star"
          @mouseleave="hover = 0"
          class="w-10 h-10 flex items-center justify-center transition"
        >
          <i
            class="fa-star text-3xl transition-all duration-200"
            :class="[
              // الأولوية: hover > selected > average
              hover >= star
                ? 'fas text-yellow-400'
                : selected >= star
                  ? 'fas text-yellow-400'
                  : props.averageRating >= star
                    ? 'fas text-yellow-300'
                    : 'far text-gray-400'
            ]"
          ></i>
        </button>
      </div>

      <!-- عرض المتوسط -->
   
    </div>
  </div>
</template>

<style scoped>
.far {
  font-family: "Font Awesome 5 Free";
  font-weight: 400;
}

.fas {
  font-family: "Font Awesome 5 Free";
  font-weight: 900;
}
</style>
