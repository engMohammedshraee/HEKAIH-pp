<script setup>
defineProps({
    routeName:String,
    lable:{
        type:String,
        default:""
    }
})
</script>
<template>
    <Link :href="route(routeName)" class="text-indigo-500 font-meduim-underline
    hover:text-indigo-600 dark:text-indigo-400 dark:hover:text-indigo-500 ">
    {{ lable }}</Link>

</template>
