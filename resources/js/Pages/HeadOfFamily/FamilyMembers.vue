<script setup>
import { ref, onMounted, onBeforeMount } from 'vue'
import { router } from '@inertiajs/vue3'
import { useAuthStore } from '@/stores/auth'
import Sidebar from '@/components/sidebar/Sidebar.vue'
import Button from '@/components/ui/Button.vue'
import IconUser from '@/assets/images/icons/user-secondary-green.svg'
import IconAddSquare from '@/assets/images/icons/add-square-dark-green.svg'

const props = defineProps({
  headOfFamily: {
    type: Object,
    required: true
  },
  familyMembers: {
    type: Array,
    required: true
  }
})

const authStore = useAuthStore()

// Protect the route
onBeforeMount(async () => {
  await authStore.requireAuth()
})

const loading = ref(false)

const fetchFamilyMembers = async () => {
  loading.value = true
  try {
    await router.reload({
      only: ['familyMembers']
    })
  } catch (error) {
    console.error('Error fetching family members:', error)
  } finally {
    loading.value = false
  }
}

onMounted(() => {
  fetchFamilyMembers()
})
</script>

<template>
  <div class="flex">
    <Sidebar />
    <main class="flex-1 p-6">
      <div class="flex flex-col gap-6">
        <div class="flex items-center justify-between">
          <div>
            <h1 class="font-semibold text-2xl">Anggota Keluarga</h1>
            <p class="text-desa-secondary">Kepala Rumah: {{ headOfFamily.name }}</p>
          </div>
          <Button 
            label="Tambah Anggota Keluarga" 
            :icon="IconAddSquare" 
            @click="router.visit(`/kepala-rumah/${headOfFamily.id}/anggota-keluarga/create`)"
          />
        </div>

        <div class="flex flex-col bg-white rounded-2xl p-6 gap-6">
          <!-- Loading state -->
          <div v-if="loading" class="flex justify-center items-center h-64">
            <div class="animate-spin rounded-full h-12 w-12 border-b-2 border-desa-dark-green"></div>
          </div>

          <!-- Empty state -->
          <div v-else-if="familyMembers.length === 0" class="flex flex-col items-center justify-center py-12">
            <img src="@/assets/images/icons/profile-2user-secondary-green.svg" class="w-16 h-16 mb-4" alt="No data" />
            <p class="text-desa-secondary">Tidak ada anggota keluarga</p>
            <Button 
              label="Tambah Anggota Keluarga" 
              class="mt-4"
              @click="router.visit(`/kepala-rumah/${headOfFamily.id}/anggota-keluarga/create`)"
            />
          </div>

          <!-- Family members list -->
          <div v-else class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            <div 
              v-for="member in familyMembers" 
              :key="member.id"
              class="border border-desa-foreshadow rounded-2xl p-4 flex items-center gap-4"
            >
              <div class="bg-desa-foreshadow rounded-full w-12 h-12 flex items-center justify-center">
                <img :src="IconUser" class="w-6 h-6" alt="Member" />
              </div>
              <div>
                <h3 class="font-medium text-desa-dark-green">{{ member.name }}</h3>
                <p class="text-sm text-desa-secondary">NIK: {{ member.nik }}</p>
                <p class="text-sm text-desa-secondary">Hubungan: {{ member.relationship }}</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </main>
  </div>
</template>