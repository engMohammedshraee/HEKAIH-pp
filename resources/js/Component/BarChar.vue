<template >
  <div class="chart-container">
    <canvas ref="chartCanvas"></canvas>
  </div>
</template>

<script setup>
import { ref, onMounted, watch } from 'vue';
import Chart from 'chart.js/auto';

const props = defineProps({
  data: {
    type: Array,
    required: true,
    default: () => [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0]
  },
  labels: {
    type: Array,
    default: () => ['0', '1', '2', '3', '4', '5', '6', '7', '8', '9', '10', '11']
  }
});

const chartCanvas = ref(null);
let chartInstance = null;

const chartData = {
  labels: props.labels,
  datasets: [{
    data: props.data,
    backgroundColor: '#8858BB',
    borderColor: '#6D3B9E',
    borderWidth: 0, // بدون حدود
    borderRadius: 0, // بدون حواف مدورة
    barPercentage: 0.8 // عرض الأعمدة
  }]
};

const chartOptions = {
  responsive: true,
  maintainAspectRatio: false,
  scales: {
    y: {
      beginAtZero: true,
      max: 200,
      ticks: {
        stepSize: 50,
        color: 'black',
        font: {
          weight: 'bold'
        }
      },
      grid: {
        display: false // إخفاء الخطوط الأفقية
      }
    },
    x: {
      ticks: {
        color: 'black',
        font: {
          weight: 'bold'
        }
      },
      grid: {
        display: false // إخفاء الخطوط العمودية
      }
    }
  },
  plugins: {
    legend: {
      display: false
    },
    tooltip: {
      enabled: false // تعطيل التلميحات
    }
  }
};

onMounted(() => renderChart());
watch(() => props.data, renderChart, { deep: true });

function renderChart() {
  if (chartCanvas.value) {
    if (chartInstance) chartInstance.destroy();

    chartInstance = new Chart(chartCanvas.value, {
      type: 'bar',
      data: chartData,
      options: chartOptions
    });
  }
}
</script>

<style scoped>
.chart-container {
  width: 100%;
  height: 300px;
  direction: ltr; /* للتأكد من اتجاه المخطط صحيح */
}
</style>
