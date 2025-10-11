<script setup>
defineProps({
  companyLogo: {
    type: String,
    required: true
  },
  applicantPhoto: {
    type: String,
    required: true
  },
  applicantName: {
    type: String,
    required: true
  },
  position: {
    type: String,
    required: true
  },
  status: {
    type: String,
    required: true,
    validator: (value) => ['Menunggu', 'Diterima', 'Ditolak'].includes(value)
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
    <div class="flex size-[72px] shrink-0 rounded-2xl bg-desa-foreshadow overflow-hidden">
      <img
        :src="companyLogo"
        class="w-full h-full object-cover"
        :alt="`${applicantName} company logo`"
      />
    </div>
    <div class="flex flex-col gap-[6px] w-full">
      <div class="flex items-center gap-[6px]">
        <div class="flex size-8 rounded-full overflow-hidden bg-desa-foreshadow">
          <img
            :src="applicantPhoto"
            class="w-full h-full object-cover"
            :alt="`${applicantName} photo`"
          />
        </div>
        <p class="font-medium text-xl leading-[22.5px] line-clamp-1">{{ applicantName }}</p>
      </div>
      <span class="font-medium text-desa-secondary line-clamp-1">
        {{ position }}
      </span>
    </div>
    <div
      class="badge rounded-full p-3 gap-2 flex w-[100px] justify-center shrink-0"
      :class="getStatusClass(status)"
    >
      <span class="font-semibold text-xs text-white uppercase">{{ status }}</span>
    </div>
  </div>
</template>