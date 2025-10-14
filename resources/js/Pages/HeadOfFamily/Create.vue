<script setup>
import { ref, onBeforeMount } from 'vue'
import { router } from '@inertiajs/vue3'
import { useAuthStore } from '@/stores/auth'
import Sidebar from '@/components/sidebar/Sidebar.vue'
import Topbar from '@/components/Topbar.vue'

const authStore = useAuthStore()

// Protect the route
onBeforeMount(async () => {
  await authStore.requireAuth()
})

const form = ref({
  name: '',
  nik: '',
  phone_number: '',
  job: '',
  birthdate: '',
  gender: '',
  status: '',
  email: '',
  password: '',
  photo: null
})

const age = ref(0)
const loading = ref(false)
const errors = ref({})
const photoPreview = ref('@/assets/images/photos/kk-preview.png')

const calculateAge = (birthDate) => {
  if (!birthDate) return 0
  const today = new Date()
  const birth = new Date(birthDate)
  let age = today.getFullYear() - birth.getFullYear()
  const monthDiff = today.getMonth() - birth.getMonth()
  
  if (monthDiff < 0 || (monthDiff === 0 && today.getDate() < birth.getDate())) {
    age--
  }
  
  return age
}

const handleBirthdateChange = (event) => {
  form.value.birthdate = event.target.value
  age.value = calculateAge(event.target.value)
}

const handlePhotoUpload = (event) => {
  const file = event.target.files[0]
  if (file) {
    form.value.photo = file
    const reader = new FileReader()
    reader.onload = (e) => {
      photoPreview.value = e.target.result
    }
    reader.readAsDataURL(file)
  }
}

const submitForm = async () => {
  loading.value = true
  errors.value = {}
  
  try {
    const formData = new FormData()
    formData.append('name', form.value.name)
    formData.append('nik', form.value.nik)
    formData.append('phone_number', form.value.phone_number)
    formData.append('job', form.value.job)
    formData.append('birthdate', form.value.birthdate)
    formData.append('gender', form.value.gender)
    formData.append('status', form.value.status)
    formData.append('email', form.value.email)
    formData.append('password', form.value.password)
    if (form.value.photo) {
      formData.append('photo', form.value.photo)
    }
    
    await router.post('/api/head-of-family', formData, {
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
  <div class="flex flex-1">
    <Sidebar />
    <div id="Main-Container" class="flex flex-col flex-1">
      <Topbar />
      <div id="Content" class="relative flex flex-col flex-1 gap-6 p-6 pb-[30px] w-full shrink-0">
        <div id="Header" class="flex items-center justify-between">
          <div class="flex flex-col gap-2">
            <div class="flex gap-1 items-center leading-5 text-desa-secondary">
              <p class="last-of-type:text-desa-dark-green last-of-type:font-semibold capitalize">Kepala Rumah</p>
              <span>/</span>
              <p class="last-of-type:text-desa-dark-green last-of-type:font-semibold capitalize">Tambah Kepala Rumah</p>
            </div>
            <h1 class="font-semibold text-2xl">Tambah Kepala Rumah Baru</h1>
          </div>
        </div>
        <form @submit.prevent="submitForm" id="myForm" class="capitalize">
          <div class="shrink-0 rounded-3xl p-6 bg-white flex flex-col gap-6 h-fit">
            <section id="Photo-Profile" class="flex items-center justify-between">
              <h2 class="font-medium leading-5 text-desa-secondary w-[calc(424/904*100%)]">Profile Kepala Rumah</h2>
              <div class="flex-1 flex items-center justify-between">
                <div id="Photo-Preview" class="flex items-center justify-center size-[100px] rounded-full overflow-hidden bg-desa-foreshadow">
                  <img :src="photoPreview" id="Photo" alt="image" class="size-full object-cover" />
                </div>
                <div class="relative">
                  <input required id="File" type="file" name="file" class="absolute opacity-0 left-0 w-full top-0 h-full" @change="handlePhotoUpload" />
                  <button id="Upload" type="button" class="relative flex items-center py-4 px-6 rounded-2xl bg-desa-black gap-[10px]">
                    <img src="@/assets/images/icons/send-square-white.svg" alt="icon" class="size-6 shrink-0" />
                    <p class="font-medium leading-5 text-white">Upload</p>
                  </button>
                </div>
              </div>
            </section>
            <hr class="border-desa-background" />
            <section id="Nama-Kepala-Rumah" class="flex items-center justify-between">
              <p class="font-medium leading-5 text-desa-secondary w-[calc(424/904*100%)]">Nama Kepala Rumah</p>
              <div class="flex flex-col gap-3 flex-1 shrink-0">
                <label class="relative group peer w-full">
                  <input v-model="form.name" type="text" placeholder="Masukan nama lengkap" class="appearance-none outline-none w-full h-14 rounded-2xl ring-[1.5px] ring-desa-background focus:ring-desa-black py-4 px-12 gap-2 font-medium placeholder:text-desa-secondary transition-all duration-300">
                  <div class="absolute transform -translate-y-1/2 top-1/2 left-4 flex size-6 shrink-0">
                    <img src="@/assets/images/icons/user-secondary-green.svg" class="size-6 hidden group-has-[:placeholder-shown]:flex" alt="icon">
                    <img src="@/assets/images/icons/user-black.svg" class="size-6 flex group-has-[:placeholder-shown]:hidden" alt="icon">
                  </div>
                  <img v-if="form.name" src="@/assets/images/icons/Checklist-dark-green-fill.svg" class="absolute transform -translate-y-1/2 top-1/2 right-4 size-6 shrink-0" alt="icon">
                </label>
              </div>
            </section>
            <hr class="border-desa-background" />
            <section id="NIK" class="flex items-center justify-between">
              <p class="font-medium leading-5 text-desa-secondary w-[calc(424/904*100%)]">Nomor Induk Kependudukan</p>
              <div class="flex flex-col gap-3 flex-1 shrink-0">
                <label class="relative group peer w-full">
                  <input v-model="form.nik" type="number" placeholder="Ketik NIK" class="appearance-none outline-none w-full h-14 rounded-2xl ring-[1.5px] ring-desa-background focus:ring-desa-black py-4 px-12 gap-2 font-medium placeholder:text-desa-secondary transition-all duration-300">
                  <div class="absolute transform -translate-y-1/2 top-1/2 left-4 flex size-6 shrink-0">
                    <img src="@/assets/images/icons/keyboard-secondary-green.svg" class="size-6 hidden group-has-[:placeholder-shown]:flex" alt="icon">
                    <img src="@/assets/images/icons/keyboard-black.svg" class="size-6 flex group-has-[:placeholder-shown]:hidden" alt="icon">
                  </div>
                  <img v-if="form.nik" src="@/assets/images/icons/Checklist-dark-green-fill.svg" class="absolute transform -translate-y-1/2 top-1/2 right-4 size-6 shrink-0" alt="icon">
                </label>
              </div>
            </section>
            <hr class="border-desa-background" />
            <section id="Phone" class="flex items-center justify-between">
              <p class="font-medium leading-5 text-desa-secondary w-[calc(424/904*100%)]">Nomor Handphone</p>
              <div class="flex flex-col gap-3 flex-1 shrink-0">
                <label class="relative group peer w-full">
                  <input v-model="form.phone_number" type="text" placeholder="Masukan No. HP yang aktif" class="appearance-none outline-none w-full h-14 rounded-2xl ring-[1.5px] ring-desa-background focus:ring-desa-black py-4 px-12 gap-2 font-medium placeholder:text-desa-secondary transition-all duration-300">
                  <div class="absolute transform -translate-y-1/2 top-1/2 left-4 flex size-6 shrink-0">
                    <img src="@/assets/images/icons/call-secondary-green.svg" class="size-6 hidden group-has-[:placeholder-shown]:flex" alt="icon">
                    <img src="@/assets/images/icons/call-black.svg" class="size-6 flex group-has-[:placeholder-shown]:hidden" alt="icon">
                  </div>
                  <img v-if="form.phone_number" src="@/assets/images/icons/Checklist-dark-green-fill.svg" class="absolute transform -translate-y-1/2 top-1/2 right-4 size-6 shrink-0" alt="icon">
                </label>
              </div>
            </section>
            <hr class="border-desa-background" />
            <section id="Pekerjaan" class="flex items-center justify-between">
              <p class="font-medium leading-5 text-desa-secondary w-[calc(424/904*100%)]">Pekerjaan</p>
              <div class="flex flex-col gap-3 flex-1 shrink-0">
                <label class="relative group peer w-full">
                  <input v-model="form.job" type="text" placeholder="Masukan nama pekerjaan" class="appearance-none outline-none w-full h-14 rounded-2xl ring-[1.5px] ring-desa-background focus:ring-desa-black py-4 px-12 gap-2 font-medium placeholder:text-desa-secondary transition-all duration-300">
                  <div class="absolute transform -translate-y-1/2 top-1/2 left-4 flex size-6 shrink-0">
                    <img src="@/assets/images/icons/briefcase-secondary-green.svg" class="size-6 hidden group-has-[:placeholder-shown]:flex" alt="icon">
                    <img src="@/assets/images/icons/briefcase-black.svg" class="size-6 flex group-has-[:placeholder-shown]:hidden" alt="icon">
                  </div>
                  <img v-if="form.job" src="@/assets/images/icons/Checklist-dark-green-fill.svg" class="absolute transform -translate-y-1/2 top-1/2 right-4 size-6 shrink-0" alt="icon">
                </label>
              </div>
            </section>
            <hr class="border-desa-background" />
            <section id="Tanggal-Lahir" class="flex items-center justify-between">
              <p class="font-medium leading-5 text-desa-secondary w-[calc(424/904*100%)]">Tanggal Lahir</p>
              <div class="flex items-center gap-6 flex-1 shrink-0">
                <label class="relative group peer w-full">
                  <input required type="date" id="birthdate" placeholder="Masukan tanggal lahir" 
                         class="appearance-none outline-none w-full h-14 rounded-2xl ring-[1.5px] ring-desa-background focus:ring-desa-black p-4 pl-12 gap-2 font-medium invalid:text-desa-secondary transition-all duration-300 [&::-webkit-calendar-picker-indicator]:hidden" 
                         @change="handleBirthdateChange">
                  <div class="absolute transform -translate-y-1/2 top-1/2 left-4 flex size-6 shrink-0">
                    <img src="@/assets/images/icons/calendar-2-secondary-green.svg" class="size-6 hidden group-has-[:invalid]:flex" alt="icon">
                    <img src="@/assets/images/icons/calendar-2-black.svg" class="size-6 flex group-has-[:invalid]:hidden" alt="icon">
                  </div>
                  <img v-if="form.birthdate" src="@/assets/images/icons/Checklist-dark-green-fill.svg" class="absolute transform -translate-y-1/2 top-1/2 right-4 size-6 shrink-0" alt="icon">
                </label>
                <div class="w-[180px] flex shrink-0 h-[52px] rounded-2xl bg-desa-foreshadow p-4 font-medium leading-5 text-desa-dark-green justify-center">
                  <p>Umur: <span id="Age">{{ age }}</span> tahun</p>
                </div>
              </div>
            </section>
            <hr class="border-desa-background" />
            <section id="Jenis-Kelamin" class="flex items-center justify-between">
              <p class="font-medium leading-5 text-desa-secondary w-[calc(424/904*100%)]">Jenis Kelamin</p>
              <div class="flex flex-1 gap-6 shrink-0">
                <label class="group flex w-full items-center h-14 rounded-2xl p-4 ring-[1.5px] ring-desa-background gap-2 has-[:checked]:ring-desa-dark-green transition-setup">
                  <input v-model="form.gender" type="radio" name="gender" value="male" class="flex size-[18px] shrink-0 accent-desa-secondary checked:accent-desa-dark-green transition-setup">
                  <span class="font-medium leading-5 text-desa-secondary w-full group-has-[:checked]:text-desa-dark-green transition-setup">
                    Pria
                  </span>
                  <div class="flex size-6 shrink-0">
                    <img src="@/assets/images/icons/man-secondary-green.svg" class="size-6 flex group-has-[:checked]:hidden" alt="icon">
                    <img src="@/assets/images/icons/man-dark-green.svg" class="size-6 hidden group-has-[:checked]:flex" alt="icon">
                  </div>
                </label>
                <label class="group flex w-full items-center h-14 rounded-2xl p-4 ring-[1.5px] ring-desa-background gap-2 has-[:checked]:ring-desa-dark-green transition-setup">
                  <input v-model="form.gender" type="radio" name="gender" value="female" class="flex size-[18px] shrink-0 accent-desa-secondary checked:accent-desa-dark-green transition-setup">
                  <span class="font-medium leading-5 text-desa-secondary w-full group-has-[:checked]:text-desa-dark-green transition-setup">
                    Wanita
                  </span>
                  <div class="flex size-6 shrink-0">
                    <img src="@/assets/images/icons/woman-secondary-green.svg" class="size-6 flex group-has-[:checked]:hidden" alt="icon">
                    <img src="@/assets/images/icons/woman-dark-green.svg" class="size-6 hidden group-has-[:checked]:flex" alt="icon">
                  </div>
                </label>
              </div>
            </section>
            <hr class="border-desa-background" />
            <section id="Status" class="flex items-center justify-between">
              <p class="font-medium leading-5 text-desa-secondary w-[calc(424/904*100%)]">Status</p>
              <div class="flex flex-1 gap-6 shrink-0">
                <label class="group flex w-full items-center h-14 rounded-2xl p-4 ring-[1.5px] ring-desa-background gap-2 has-[:checked]:ring-desa-dark-green transition-setup">
                  <input v-model="form.status" type="radio" name="status" value="single" class="flex size-[18px] shrink-0 accent-desa-secondary checked:accent-desa-dark-green transition-setup">
                  <span class="font-medium leading-5 text-desa-secondary w-full group-has-[:checked]:text-desa-dark-green transition-setup">
                    Belum Menikah
                  </span>
                  <div class="flex size-6 shrink-0">
                    <img src="@/assets/images/icons/profile-secondary-green.svg" class="size-6 flex group-has-[:checked]:hidden" alt="icon">
                    <img src="@/assets/images/icons/profile-dark-green.svg" class="size-6 hidden group-has-[:checked]:flex" alt="icon">
                  </div>
                </label>
                <label class="group flex w-full items-center h-14 rounded-2xl p-4 ring-[1.5px] ring-desa-background gap-2 has-[:checked]:ring-desa-dark-green transition-setup">
                  <input v-model="form.status" type="radio" name="status" value="married" class="flex size-[18px] shrink-0 accent-desa-secondary checked:accent-desa-dark-green transition-setup">
                  <span class="font-medium leading-5 text-desa-secondary w-full group-has-[:checked]:text-desa-dark-green transition-setup">
                    Sudah Menikah
                  </span>
                  <div class="flex size-6 shrink-0">
                    <img src="@/assets/images/icons/profile-2user-secondary-green.svg" class="size-6 flex group-has-[:checked]:hidden" alt="icon">
                    <img src="@/assets/images/icons/profile-2user-dark-green.svg" class="size-6 hidden group-has-[:checked]:flex" alt="icon">
                  </div>
                </label>
              </div>
            </section>
            <hr class="border-desa-background w-[calc(100%+48px)] -mx-6" />
            <p class="font-medium leading-5">Akun Dashboard</p>
            <section id="Email" class="flex items-center justify-between">
              <p class="font-medium leading-5 text-desa-secondary w-[calc(424/904*100%)]">Email Address</p>
              <div class="flex flex-col gap-3 flex-1 shrink-0">
                <label class="relative group peer w-full" :class="{ 'invalid': errors.email }">
                  <input v-model="form.email" type="email" placeholder="Masukan Email" class="appearance-none outline-none w-full h-14 rounded-2xl ring-[1.5px] ring-desa-background focus:ring-desa-black py-4 px-12 gap-2 font-medium placeholder:text-desa-secondary transition-all duration-300 group-[.invalid]:input-invalid-state">
                  <div class="absolute transform -translate-y-1/2 top-1/2 left-4 flex size-6 shrink-0">
                    <img src="@/assets/images/icons/sms-secondary-green.svg" class="size-6 hidden group-has-[:placeholder-shown]:flex group-[.invalid]:!hidden" alt="icon">
                    <img src="@/assets/images/icons/sms-black.svg" class="size-6 flex group-has-[:placeholder-shown]:hidden group-[.invalid]:hidden" alt="icon">
                    <img v-if="errors.email" src="@/assets/images/icons/sms-red.svg" class="size-6 hidden group-[.invalid]:flex" alt="icon">
                  </div>
                  <img v-if="form.email && !errors.email" src="@/assets/images/icons/Checklist-dark-green-fill.svg" class="absolute transform -translate-y-1/2 top-1/2 right-4 size-6 shrink-0" alt="icon">
                  <img v-if="errors.email" src="@/assets/images/icons/close-circle-red-fill.svg" class="absolute transform -translate-y-1/2 top-1/2 right-4 size-6 shrink-0" alt="icon">
                </label>
                <span v-if="errors.email" class="font-medium text-sm text-desa-red">{{ errors.email }}</span>
              </div>
            </section>
            <hr class="border-desa-background" />
            <section id="Passwords" class="flex items-center justify-between">
              <p class="font-medium leading-5 text-desa-secondary w-[calc(424/904*100%)]">Passwords</p>
              <div class="flex flex-col gap-3 flex-1 shrink-0">
                <label class="relative group peer w-full">
                  <input v-model="form.password" type="password" placeholder="Masukan Password" class="appearance-none outline-none w-full h-14 rounded-2xl ring-[1.5px] ring-desa-background focus:ring-desa-black py-4 px-12 gap-2 font-medium placeholder:text-desa-secondary transition-all duration-300 tracking-[4px] placeholder:tracking-normal">
                  <div class="absolute transform -translate-y-1/2 top-1/2 left-4 flex size-6 shrink-0">
                    <img src="@/assets/images/icons/key-secondary-green.svg" class="size-6 hidden group-has-[:placeholder-shown]:flex" alt="icon">
                    <img src="@/assets/images/icons/key-black.svg" class="size-6 flex group-has-[:placeholder-shown]:hidden" alt="icon">
                  </div>
                </label>
              </div>
            </section>
            <hr class="border-desa-background" />
            <section id="Buttons" class="flex items-center justify-end gap-4">
              <a href="/kepala-rumah">
                <div class="py-[18px] rounded-2xl bg-desa-red w-[180px] text-center flex justify-center font-medium text-white">Batal, Tidak jadi</div>
              </a>
              <button :disabled="loading" type="submit" class="py-[18px] rounded-2xl disabled:bg-desa-grey w-[180px] text-center flex justify-center font-medium text-white bg-desa-dark-green transition-all duration-300">
                {{ loading ? 'Creating...' : 'Create Now' }}
              </button>
            </section>
          </div>
        </form>
      </div>
    </div>
  </div>
</template>