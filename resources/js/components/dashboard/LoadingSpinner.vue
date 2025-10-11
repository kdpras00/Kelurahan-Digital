<script setup>
defineProps({
  size: {
    type: String,
    default: 'md' // 'sm', 'md', 'lg'
  }
})

const sizeClasses = {
  sm: 'size-6',
  md: 'size-12',
  lg: 'size-16'
}
</script>

<template>
  <div class="flex items-center justify-center">
    <div 
      class="animate-spin rounded-full border-t-2 border-desa-dark-green"
      :class="sizeClasses[size]"
    ></div>
  </div>
</template>

<style scoped>
.animate-spin {
  animation: spin 1s linear infinite;
}

@keyframes spin {
  0% { transform: rotate(0deg); }
  100% { transform: rotate(360deg); }
}
</style>