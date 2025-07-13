<script setup>
import BarChart from "../../Component/BarChar.vue";
const props = defineProps({
  stories: {
    type: Array,
    required: true,
    default: () => [],
  },
  data: Array,
});
import { computed } from "vue";

const chartData = computed(() => ({
  labels: props.labels,
  datasets: [
    {
      label: "عدد القصص",
      data: props.data,
      backgroundColor: "#4f46e5", // لون أرجواني
      borderColor: "#3730a3",
      borderWidth: 1,
    },
  ],
}));

const chartOptions = {
  responsive: true,
  scales: {
    y: {
      beginAtZero: true,
      max: 200,
      ticks: {
        stepSize: 50,
      },
    },
  },
  plugins: {
    legend: {
      display: false,
    },
  },
};

import AdminLayout from "@/layout/adminlayout.vue";

defineOptions({
  layout: AdminLayout,
});
</script>
<template>
  <Head title="Reports" />

  <div class="py-5 bg-slate-200">
    <div class="container  p-4">
      <h2 class="text-2xl font-bold mb-4">إحصائية القصص المنشورة شهرياً</h2>
      <div class="bg-white p-6 rounded-lg shadow">
        <BarChart :data="data" />
      </div>
    </div>

    <div class="border-purple-700 rounded-lg items-center">
      <div class="text-2xl p-3 text-bold">القصص الاكثر قراءة</div>

      <table
        class="mx-auto divide-y divide-purple-300 rounded-md border-4 border-purple-700"
      >
        <thead class="bg-purple-800 border-b-4 border-purple-900 font-bold">
          <tr>
            <th
              class="w-2/10 px-6 py-3 text-right font-medium text-yellow-400 uppercase tracking-wider border-r-2 border-purple-700"
            >
              اسم القصة
            </th>
            <th
              class="w-1/10 px-6 py-3 text-right font-medium text-yellow-400 uppercase tracking-wider border-r-2 border-purple-700"
            >
              اسم الكاتب
            </th>
            <th
              class="w-2/10 px-6 py-3 text-right font-medium text-yellow-400 uppercase tracking-wider border-r-2 border-purple-700"
            >
              التصنيف
            </th>
            <th
              class="w-2/10 px-6 py-3 text-right font-medium text-yellow-400 uppercase tracking-wider border-r-2 border-purple-700"
            >
              عدد القراءات
            </th>
          </tr>
        </thead>
        <tbody class="bg-white divide-y divide-purple-200">
          <tr
            v-for="(story, i) in stories"
            :key="i"
            class="hover:bg-purple-100"
          >
            <td
              class="px-6 py-4 whitespace-nowrap border-r-2 border-purple-200 font-bold"
            >
              {{ story.titel.substring(1, 10) }}
            </td>
            <td
              class="px-6 py-4 whitespace-nowrap border-r-2 border-purple-200 font-bold"
            >
              {{ story.user.name }}
            </td>
            <td
              class="px-6 py-4 whitespace-nowrap border-r-2 border-purple-200 font-bold"
            >
              {{ story.category }}
            </td>
            <td
              class="px-6 py-4 whitespace-nowrap border-r-2 border-purple-200 font-bold"
            >
              {{ story.ratings.length }}
            </td>
          </tr>
          <tr v-if="stories.length === 0" class="bg-white">
            <td
              colspan="4"
              class="px-6 py-4 text-center text-sm font-medium text-gray-500 border-t-2 border-purple-200"
            >
              لا توجد قصص لعرضها
            </td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</template>
