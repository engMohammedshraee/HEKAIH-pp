

<template>
  <div dir="rtl" class="flex space-x-2 justify-center py-2 ">
    <button
      v-for="n in 5"
      :key="n"
      class="w-8 h-8 p-1 rounded-full flex gap-2 items-center justify-center transition"

    >
          <i dir="rtl" class="fa-star text-2xl transition-all duration-200"
          :class="`${user.average_rating >= n? 'fas text-yellow-300'
                    : 'far text-gray-400'}
                                       `"></i>
    </button>
  </div>
</template>

<script setup>
defineProps({
    user:Object
})

</script>
