<script setup>
import HeroSection from "../Component/HeroSection.vue";
import Footer from "../Component/Footer.vue";
import Card from "../Component/Card.vue";
import SessionMessage from "../Component/SessionMessage.vue";
import InputField from "../Component/InputField.vue";

import { ref } from "vue";
import { router } from "@inertiajs/vue3";

defineProps({
  cards: Object,
  status: String,
});

const query = ref("");
const level = ref("");
const showSelect = ref(false);

const search = () => {
  router.get(
    route("home"),
    {
      query: query.value || null,
      level: level.value || null,
    },
    {
      preserveState: true,
      replace: true,
    }
  );
};
</script>

<template>
  <Head title="home" />

  <div class="w-full p-0">
    <div class="mx-auto relative">
      <div class="search flex items-center justify-center gap-2 w-full p-3 mx-auto">
        <form @submit.prevent="search" class="w-full p-3 mx-auto flex justify-center items-center gap-4">

          <!-- أيقونة القائمة -->
             <div class="relative ">
              <i
                class="fa-solid fa-bars text-[#8858BB] text-5xl cursor-pointer mt-[-20px] rounded-md items-center py-3"
                @click="showSelect = !showSelect"
              ></i>

              <select
                v-show="showSelect"
                v-model="level"
                @change="search"
                class="absolute top-[45px] right-0 z-50 border border-black text-black text-2xl py-2 px-4 rounded-lg bg-white"
              >
                <option value="">اختر المستوى</option>
                <option value="1">من عمر 3-5 سنة</option>
                <option value="2">من عمر 6-8 سنة</option>
                <option value="3">من عمر 9-11 سنة</option>
                <option value="4">من عمر 10-14 سنة</option>
              </select>
            </div>



          <!-- حقل البحث -->
          <InputField
            class="w-1/2"
            type="search"
            placeholder="ابحث عن قصتك"
            icon="magnifying-glass"
            v-model="query"
            @keydown.enter.prevent="search"
          />

          <!-- زر البحث -->

        </form>
      </div>
    </div>

    <HeroSection />
    <SessionMessage :status="status" />
    <Card :Cards="cards" />
    <Footer />
  </div>
</template>

