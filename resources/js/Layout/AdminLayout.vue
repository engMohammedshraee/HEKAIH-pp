<script setup>
import NavLink from "../Component/NavLink.vue"
import MainLayout from '../Layout/Mainlayouts.vue'
defineOptions({
  layout: MainLayout
})
</script>

<template>
    <MainLayout>
          <div dir="rtl" class="flex h-150 ">
    <aside class="w-80 bg-white  text-purple-700 shadow-lg shadow-[0_0_20px_rgba(22,220,220,3)]">
      <div class="p-4 text-[20px] bold">
        <div class="flex flex-col gap-4 text-1xl text-bold">
          <NavLink
            class="block text-purple-700 px-4 py-2 rounded"
            routeName="admin.index"
            componentName="Admin/AdminDashoard"
          >
          <i class="fa-solid fa-house"></i>

            الرئيسية
          </NavLink>

          <NavLink

            class="block text-purple-700 px-4 py-2 rounded"
            routeName="user.show"
            componentName="Admin/Users"
          >
             المستخدمين
          </NavLink>

           <NavLink

            class="block text-purple-700 px-4 py-2"
            routeName="user.show"
            componentName="Admin/UsersController"
          >
          <i class="fa-solid fa-receipt bg-purple-700 text-white text-2xl text-bold"></i>

            التقارير
          </NavLink>
        </div>
      </div>
    </aside>
    <main class="flex-1 p-6 bg-white">
      <slot />
    </main>
  </div>

    </MainLayout>

</template>
