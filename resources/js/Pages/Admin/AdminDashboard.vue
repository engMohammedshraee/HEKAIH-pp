<!-- resources/js/Pages/Admin/Dashboard.vue -->
<script setup>
import AdminLayout from '@/layout/adminlayout.vue'

defineOptions({
    layout: AdminLayout
})
defineProps({
    users: Object,
    comments: Object,
    cardsrating: Object,
    stories: Object
})

</script>

<template>

    <div class="flex items-center  gap-6 px-4">
        <div class="bg-purple-700 text-yellow-500 p-5 flex items-center justify-center rounded-[10px]">
            <div class="flex items-center justify-center h-20 w-20">
                <i class="  fa-solid fa-users-gear bg-white text-yellow-500 text-4xl py-3 px-1"></i>

            </div>
            <div>
                <p class="text-3xl text-white">{{ users.length }}</p>
                <p>اجمالي عدد المستخدمين المسجلين</p>
            </div>
        </div>
        <div class="bg-purple-700 text-yellow-500 p-5 flex items-center justify-center rounded-[10px]">
            <div class="flex items-center justify-center h-20 w-20">
                <i class="  fa-solid fa-users-gear bg-white text-yellow-500 text-4xl py-3 px-1"></i>

            </div>
            <div>
                <p class="text-3xl text-white">{{stories.filter((l) => l.approved)
                    .length}}</p>
                <p>اجمالي عدد القصص المنشورة</p>
            </div>
        </div>
    </div>


    <div class="flex items-center  gap-6 px-4 mt-5">
        <div class="bg-purple-700 text-yellow-500 px-7 py-5 flex items-center justify-center rounded-[10px]">
            <div class="flex items-center justify-center h-20 w-20">
                <i class="  fa-solid fa-users-gear bg-white text-yellow-500 text-4xl py-3 px-1"></i>

            </div>
            <div>
                    <p class="text-4xl text-white">{{ comments.length + cardsrating.length }}</p>
                    <p class="text-yellow-500"> اجمالي عدد التعليقات والتقيمات </p>
                </div>
        </div>
        <div class="bg-purple-700 text-yellow-500 px-7 py-5 flex items-center justify-center rounded-[10px]">
            <div class="flex items-center justify-center h-20 w-20">
                <i class="  fa-solid fa-users-gear bg-white text-yellow-500 text-4xl py-3 px-1"></i>

            </div>
            <div>
                <p class="text-3xl text-white">{{stories.filter((l) => !l.approved)
                    .length}}</p>
                <p>اجمالي عدد القصص الموقفة</p>
            </div>
        </div>
    </div>

</template>
