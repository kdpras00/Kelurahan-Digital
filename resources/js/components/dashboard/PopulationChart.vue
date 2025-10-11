<script setup>
import { ref, onMounted, watch } from 'vue'

const props = defineProps({
  totalPopulation: {
    type: Number,
    default: 243000
  },
  demographics: {
    type: Array,
    default: () => [
      { name: 'Pria', value: 114210, color: 'bg-desa-dark-green', ageRange: '32-36 tahun' },
      { name: 'Wanita', value: 97200, color: 'bg-desa-soft-green', ageRange: '26-31 tahun' },
      { name: 'Anak-anak', value: 24300, color: 'bg-desa-orange', ageRange: '6-12 tahun' },
      { name: 'Balita', value: 7290, color: 'bg-desa-yellow', ageRange: '0-5 tahun' }
    ]
  }
})

const chartRef = ref(null)
const chartInstance = ref(null)

// Mock chart implementation since we don't have Chart.js properly set up
const initChart = () => {
  if (chartRef.value) {
    // Simple pie chart visualization using CSS
    const percentages = props.demographics.map(item => 
      Math.round((item.value / props.totalPopulation) * 100)
    )
    
    // Create a simple visual representation
    chartRef.value.innerHTML = `
      <div class="relative w-full h-full rounded-full border-8 border-desa-foreshadow flex items-center justify-center">
        ${props.demographics.map((item, index) => `
          <div 
            class="absolute w-full h-full rounded-full border-8 ${item.color.replace('bg-', 'border-')}"
            style="clip-path: ${getClipPath(index, percentages)};"
          ></div>
        `).join('')}
        <div class="absolute w-1/2 h-1/2 bg-white rounded-full z-10"></div>
      </div>
    `
  }
}

const getClipPath = (index, percentages) => {
  const start = percentages.slice(0, index).reduce((sum, val) => sum + val, 0)
  const end = start + percentages[index]
  
  if (index === 0) {
    return `polygon(50% 50%, 50% 0%, ${end > 25 ? '100%' : (end/25)*100 + '%'} 0%)`
  } else if (index === 1) {
    return `polygon(50% 50%, 100% 0%, 100% ${end > 50 ? '100%' : ((end-25)/25)*100 + '%'})`
  } else if (index === 2) {
    return `polygon(50% 50%, 100% 100%, ${end > 75 ? '0%' : (100-((end-50)/25)*100) + '%'} 100%)`
  } else {
    return `polygon(50% 50%, 0% 100%, 0% ${100-((100-end)/25)*100}%)`
  }
}

onMounted(() => {
  initChart()
})

watch(() => props.demographics, () => {
  initChart()
}, { deep: true })
</script>

<template>
  <div class="relative">
    <div class="absolute flex flex-col gap-1 justify-center items-center text-center inset-0">
      <p class="font-semibold text-[32px] leading-10">{{ totalPopulation.toLocaleString() }}</p>
      <p class="font-medium text-sm text-desa-secondary">Jumlah Penduduk</p>
    </div>
    <div ref="chartRef" class="size-[288px] mx-auto"></div>
  </div>
</template>