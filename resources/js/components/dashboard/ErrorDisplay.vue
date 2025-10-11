<script setup>
defineProps({
  message: {
    type: String,
    required: true
  },
  onRetry: {
    type: Function,
    default: null
  }
})
</script>

<template>
  <div class="flex flex-col items-center justify-center p-8 text-center">
    <div class="bg-desa-red/10 rounded-full p-4 mb-4">
      <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-desa-red" fill="none" viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
      </svg>
    </div>
    <h3 class="text-lg font-medium text-desa-secondary mb-2">Terjadi Kesalahan</h3>
    <p class="text-desa-secondary mb-4">{{ message }}</p>
    <button 
      v-if="onRetry"
      @click="onRetry"
      class="px-4 py-2 bg-desa-dark-green text-white rounded-2xl font-medium"
    >
      Coba Lagi
    </button>
  </div>
</template>