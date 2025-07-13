<template>
  <div class="overflow-x-auto">
    <pre>{{  }}</pre>

<div class="border-4 border-purple-700 rounded-lg  bg-purple-50">
  <table class="min-w-full divide-y divide-purple-300 rounded-md overflow-hidden">
    <thead class="bg-purple-800 border-b-4 border-purple-900 font-bold">
      <tr>
        <th scope="col" class="px-6 py-3 text-right  font-medium text-yellow-400 uppercase tracking-wider border-r-2 border-purple-700">
          الاسم
        </th>
        <th scope="col" class="px-6 py-3 text-right  font-medium text-yellow-400 uppercase tracking-wider border-r-2 border-purple-700">
          البريد الإلكتروني
        </th>
        <th scope="col" class="px-6 py-3 text-right  font-medium text-yellow-400 uppercase tracking-wider border-r-2 border-purple-700">
          نوع المستخدم
        </th>
        <th scope="col" class="px-6 py-3 text-right  font-medium text-yellow-400 uppercase tracking-wider">
          الحالة
        </th>
        <th scope="col" class="px-6 py-3 text-right  font-medium text-yellow-400 uppercase tracking-wider">
          التعديل
        </th>
      </tr>
    </thead>
    <tbody class="bg-white divide-y divide-purple-200">
      <tr v-for="user in users" :key="user.id" class="hover:bg-purple-100">
        <td class="px-6 py-4 whitespace-nowrap border-r-2 border-purple-200 font-bold">
          {{ user.name }}
        </td>
        <td class="px-6 py-4 whitespace-nowrap border-r-2 border-purple-200 font-bold">
          {{ user.email }}
        </td>
        <td class="px-6 py-4 whitespace-nowrap border-r-2 border-purple-200 font-bold">
          {{ user.type }}
        </td>
        <td :class="statusClasses(user.role)"  class="px-6 py-4 whitespace-nowrap font-bold">
              {{ user.role }}
        </td>
           <td class="w-1/6 py-5 px-3">
                    <Link
                        :href="route('admin.userController',user.id)"
                        class="fa-solid fa-up-right-from-square px-3 text-indigo-400"
                    >
                    </Link>
                </td>
      </tr>
      <tr v-if="users.length === 0" class="bg-white">
        <td colspan="4" class="px-6 py-4 text-center text-sm font-medium text-gray-500 border-t-2 border-purple-200">
          لا يوجد مستخدمين لعرضهم
        </td>
      </tr>
    </tbody>
  </table>
</div>
  </div>
</template>

<script setup>
defineProps({
  users: {
    type: Array,
    required: true,
    default: () => []
  }
});
import AdminLayout from '@/layout/adminlayout.vue'

defineOptions({
  layout: AdminLayout
})

const statusClasses = (role) => {
  return {
    ' text-green-500': role === 'نشط',
    ' text-yellow-500': role === 'مغلق',
    'text-red-500': role === 'محظور',
    'text-blue-500': role === 'مشرف',

  };
};
</script>
