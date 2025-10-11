<script setup>
import { ref, onBeforeMount } from 'vue'
import { router } from '@inertiajs/vue3'
import { useAuthStore } from '@/stores/auth'
import Sidebar from '@/components/sidebar/Sidebar.vue'
import Button from '@/components/ui/Button.vue'
import Input from '@/components/ui/Input.vue'
import IconUser from '@/assets/images/icons/user-secondary-green.svg'
import IconUserBlack from '@/assets/images/icons/user-black.svg'
import IconCard from '@/assets/images/icons/card-secondary-green.svg'
import IconCardBlack from '@/assets/images/icons/card-black.svg'
import IconLocation from '@/assets/images/icons/location-secondary-green.svg'
import IconLocationBlack from '@/assets/images/icons/profile-circle-dark-green.svg'
import IconCall from '@/assets/images/icons/call-secondary-green.svg'
import IconCallBlack from '@/assets/images/icons/call-dark-green.svg'

const authStore = useAuthStore()

// Protect the route
onBeforeMount(async () => {
  await authStore.requireAuth()
})

const form = ref({
  name: '',
  nik: '',
  address: '',
  phone_number: ''
})

const loading = ref(false)
const errors = ref({})

const submitForm = async () => {
  loading.value = true
  errors.value = {}
  
  try {
    await router.post('/api/head-of-family', form.value, {
      onSuccess: () => {
        router.visit('/kepala-rumah')
      },
      onError: (err) => {
        errors.value = err
      }
    })
  } catch (error) {
    console.error('Error creating head of family:', error)
  } finally {
    loading.value = false
  }
}
</script>

<template>
  <div class="flex">
    <Sidebar />
    <main class="flex-1 p-6">
      <div class="flex flex-col gap-6">
        <div class="flex items-center justify-between">
          <h1 class="font-semibold text-2xl">Tambah Kepala Rumah</h1>
          <Button 
            label="Kembali" 
            @click="router.visit('/kepala-rumah')"
            variant="outline"
          />
        </div>

        <div class="bg-white rounded-2xl p-6">
          <form @submit.prevent="submitForm" class="space-y-6">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
              <div>
                <label class="block text-sm font-medium text-desa-secondary mb-2">Nama Lengkap</label>
                <Input
                  v-model="form.name"
                  placeholder="Masukkan nama lengkap"
                  :icon="IconUser"
                  :filled-icon="IconUserBlack"
                  :error-message="errors.name"
                />
              </div>
              
              <div>
                <label class="block text-sm font-medium text-desa-secondary mb-2">NIK</label>
                <Input
                  v-model="form.nik"
                  placeholder="Masukkan NIK"
                  :icon="IconCard"
                  :filled-icon="IconCardBlack"
                  :error-message="errors.nik"
                />
              </div>
              
              <div class="md:col-span-2">
                <label class="block text-sm font-medium text-desa-secondary mb-2">Alamat</label>
                <Input
                  v-model="form.address"
                  placeholder="Masukkan alamat lengkap"
                  :icon="IconLocation"
                  :filled-icon="IconLocationBlack"
                  :error-message="errors.address"
                />
              </div>
              
              <div>
                <label class="block text-sm font-medium text-desa-secondary mb-2">No. Telepon</label>
                <Input
                  v-model="form.phone_number"
                  placeholder="Masukkan no. telepon"
                  :icon="IconCall"
                  :filled-icon="IconCallBlack"
                  :error-message="errors.phone_number"
                />
              </div>
            </div>
            
            <div class="flex justify-end space-x-4">
              <Button 
                type="button"
                label="Batal" 
                @click="router.visit('/kepala-rumah')"
                variant="outline"
              />
              <Button 
                type="submit"
                label="Simpan" 
                :loading="loading"
              />
            </div>
          </form>
        </div>
      </div>
    </main>
  </div>
</template>