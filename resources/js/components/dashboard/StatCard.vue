<script setup>
defineProps({
  title: {
    type: String,
    required: true
  },
  value: {
    type: [String, Number],
    required: true
  },
  icon: {
    type: String,
    required: true
  },
  trend: {
    type: String,
    default: null
  },
  trendText: {
    type: String,
    default: null
  }
})
</script>

<template>
  <div class="card flex flex-col w-full rounded-2xl p-6 gap-3 bg-white">
    <div class="flex items-center justify-between">
      <p class="font-medium text-desa-secondary">{{ title }}</p>
      <img
        :src="icon"
        class="flex size-12 shrink-0"
        alt="icon"
      />
    </div>
    <div class="flex flex-col gap-[6px]">
      <p class="font-semibold text-[32px] leading-10">
        {{ value }}
      </p>
      <div v-if="trend || trendText" class="flex items-center gap-0.5">
        <img
          v-if="trend === 'up'"
          src="@/assets/images/icons/trend-up-dark-green-fill.svg"
          class="flex size-[18px] shrink-0"
          alt="icon"
        />
        <img
          v-else-if="trend === 'down'"
          src="@/assets/images/icons/trend-down-red-fill.svg"
          class="flex size-[18px] shrink-0"
          alt="icon"
        />
        <p v-if="trendText" class="font-medium text-sm text-desa-secondary">
          <span :class="trend === 'up' ? 'text-desa-dark-green' : trend === 'down' ? 'text-desa-red' : ''">
            {{ trendText }}
          </span>
        </p>
      </div>
    </div>
  </div>
</template>