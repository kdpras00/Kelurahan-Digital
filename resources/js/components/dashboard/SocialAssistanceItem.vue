<script setup>
defineProps({
  icon: {
    type: String,
    required: true
  },
  title: {
    type: String,
    required: true
  },
  description: {
    type: String,
    required: true
  },
  status: {
    type: String,
    required: true,
    validator: (value) => ['Menunggu', 'Diterima', 'Ditolak'].includes(value)
  },
  amount: {
    type: String,
    default: null
  }
})

const getStatusClass = (status) => {
  switch (status) {
    case 'Diterima':
      return 'bg-desa-dark-green'
    case 'Ditolak':
      return 'bg-desa-orange'
    case 'Menunggu':
    default:
      return 'bg-desa-yellow'
  }
}
</script>

<template>
  <div class="card flex items-center w-full gap-3">
    <div
      class="flex size-[72px] shrink-0 rounded-2xl bg-desa-foreshadow items-center justify-center"
    >
      <img
        :src="icon"
        class="flex size-9 shrink-0"
        :alt="`${title} icon`"
      />
    </div>
    <div class="flex flex-col gap-[6px] w-full">
      <p v-if="amount" class="font-semibold text-xl leading-[25px]">{{ amount }}</p>
      <p v-else class="font-semibold text-xl leading-[25px]">{{ title }}</p>
      <div class="flex items-center gap-0.5 font-medium text-desa-secondary">
        <img
          src="@/assets/images/icons/profile-secondary-green.svg"
          class="flex size-[18px] shrink-0"
          alt="profile icon"
        />
        <span class="line-clamp-1"> {{ description }} </span>
      </div>
    </div>
    <div
      class="badge rounded-full p-3 gap-2 flex w-[100px] justify-center shrink-0"
      :class="getStatusClass(status)"
    >
      <span class="font-semibold text-xs text-white uppercase">{{ status }}</span>
    </div>
  </div>
</template>