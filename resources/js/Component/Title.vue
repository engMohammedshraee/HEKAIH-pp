<script setup>
</script>
<template>
    <h1 class="text-3xl font-bold mb-4 text-center text-[#8858BB] w-auto"
    :class="{'text-black font-semibold text-[30px] mb-[10px] text-right' :$page.component ===('Cards/Create')}">
  <slot />
</h1>
</template>
