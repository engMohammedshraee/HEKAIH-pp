

<script setup>
import Card from '../../Component/Card.vue';
import Footer from '../../Component/Footer.vue'
import SearchSection from '../../Component/SearchSection.vue';
defineProps({
  cards:Object
})
</script>
<template>
    <Head title="favorite-stories"/>
    <div class="py-20">
<SearchSection></SearchSection>
        <Card :Cards="cards"/>
    </div>
    <Footer></Footer>


</template>

