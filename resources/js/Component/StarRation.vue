

<template>
  <div dir="rtl" class="flex space-x-2 justify-center py-2 ">
    <button
      v-for="n in 5"
      :key="n"
      class="w-8 h-8 p-1 rounded-full flex gap-2 items-center justify-center transition"

    >
          <i dir="rtl" class="fa-solid fa-star"
          :class="`${user.average_rating >= n?'text-yellow-500'
                                        :'text-black'}
                                       `"></i>
    </button>
  </div>
</template>

<script setup>
defineProps({
    user:Object
})

</script>
