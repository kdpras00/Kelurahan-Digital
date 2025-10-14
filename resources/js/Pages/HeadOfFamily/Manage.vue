<script setup>
import { ref, onMounted, onBeforeMount, computed } from 'vue'
import { router, usePage } from '@inertiajs/vue3'
import { useAuthStore } from '@/stores/auth'
import { axiosInstance } from '@/plugins/axios'
import Sidebar from '@/components/sidebar/Sidebar.vue'
import Topbar from '@/components/Topbar.vue'
import Button from '@/components/ui/Button.vue'
import IconTrashWhite from '@/assets/images/icons/trash-white.svg'
import IconBriefcaseSecondary from '@/assets/images/icons/briefcase-secondary-green.svg'
import IconKeyboardDarkGreen from '@/assets/images/icons/keyboard-dark-green.svg'
import IconUserSquareDarkGreen from '@/assets/images/icons/user-square-dark-green.svg'
import IconManDarkGreen from '@/assets/images/icons/man-dark-green.svg'
import IconSmsDarkGreen from '@/assets/images/icons/sms-dark-green.svg'
import IconCallDarkGreen from '@/assets/images/icons/call-dark-green.svg'
import IconProfile2UserForeshadow from '@/assets/images/icons/profile-2user-foreshadow-background.svg'
import IconKeyboardSecondary from '@/assets/images/icons/keyboard-secondary-green.svg'
import IconMoneyDarkGreen from '@/assets/images/icons/money-dark-green.svg'
import IconBag2DarkGreen from '@/assets/images/icons/bag-2-dark-green.svg'
import IconCalendar2SecondaryGreen from '@/assets/images/icons/calendar-2-secondary-green.svg'
import IconProfile2UserOrange from '@/assets/images/icons/profile-2user-orange.svg'

const props = defineProps({
  headOfFamilyData: {
    type: Object,
    required: true
  },
  familyMembersData: {
    type: Array,
    required: true
  }
})

const authStore = useAuthStore()

// Data for recent activity tabs
const bansosData = ref([])
const eventsData = ref([])
const applicantsData = ref([])

// Loading states
const loadingBansos = ref(true)
const loadingEvents = ref(true)
const loadingApplicants = ref(true)

// Protect the route
onBeforeMount(async () => {
  await authStore.requireAuth()
})

// Fetch recent activity data when component mounts
onMounted(async () => {
  await Promise.all([
    fetchBansosData(),
    fetchEventsData(),
    fetchApplicantsData()
  ])
  
  // Initialize tab functionality
  initializeTabs()
})

// Debug: Log the props to see what data is being passed
console.log('HeadOfFamilyData props:', props.headOfFamilyData)
console.log('FamilyMembersData props:', props.familyMembersData)
console.log('HeadOfFamilyData keys:', Object.keys(props.headOfFamilyData || {}))
console.log('Family members from headOfFamilyData:', props.headOfFamilyData?.family_members)
console.log('User data:', props.headOfFamilyData?.user)
console.log('Name:', props.headOfFamilyData?.user?.name)
console.log('Email:', props.headOfFamilyData?.user?.email)

// Group family members by relationship
const groupedFamilyMembers = computed(() => {
  // Check if we're getting data from the controller directly or from the resource
  const familyMembers = props.familyMembersData || props.headOfFamilyData?.family_members || []
  
  if (!familyMembers || familyMembers.length === 0) return {}
  
  const groups = {}
  familyMembers.forEach(member => {
    const relationship = member.relation || member.relationship || 'Lainnya'
    if (!groups[relationship]) {
      groups[relationship] = []
    }
    groups[relationship].push(member)
  })
  
  return groups
})

const handleDeleteHeadOfFamily = async () => {
  if (confirm("Apakah Anda yakin ingin menghapus data kepala rumah ini? Tindakan ini permanen dan tidak bisa dibatalkan!")) {
    try {
      // We need to get the actual head of family ID from the data to delete it
      const headOfFamilyId = props.headOfFamilyData.id;
      await axiosInstance.delete(`/head-of-family/${headOfFamilyId}`)
      router.visit('/kepala-rumah')
    } catch (error) {
      console.error('Error deleting head of family:', error)
      alert('Gagal menghapus data kepala rumah')
    }
  }
}

const calculateAge = (dateOfBirth) => {
  if (!dateOfBirth) return 'Tidak diketahui'
  const today = new Date()
  const birthDate = new Date(dateOfBirth)
  let age = today.getFullYear() - birthDate.getFullYear()
  const monthDiff = today.getMonth() - birthDate.getMonth()
  if (monthDiff < 0 || (monthDiff === 0 && today.getDate() < birthDate.getDate())) {
    age--
  }
  return age
}

// Fetch bansos (social assistance) data for the current user
const fetchBansosData = async () => {
  try {
    loadingBansos.value = true
    // Get social assistance recipients for the current head of family
    const response = await axiosInstance.get(`/social-assistance-recipient`)
    bansosData.value = response.data.data || []
  } catch (error) {
    console.error('Error fetching bansos data:', error)
    bansosData.value = []
  } finally {
    loadingBansos.value = false
  }
}

// Fetch events data for the current user
const fetchEventsData = async () => {
  try {
    loadingEvents.value = true
    // Get events for the current head of family
    const response = await axiosInstance.get(`/event`)
    eventsData.value = response.data.data || []
  } catch (error) {
    console.error('Error fetching events data:', error)
    eventsData.value = []
  } finally {
    loadingEvents.value = false
  }
}

// Fetch job applicants data for the current user
const fetchApplicantsData = async () => {
  try {
    loadingApplicants.value = true
    // Get job applicants for the current head of family
    const response = await axiosInstance.get(`/job-applicant`)
    applicantsData.value = response.data.data || []
  } catch (error) {
    console.error('Error fetching applicants data:', error)
    applicantsData.value = []
  } finally {
    loadingApplicants.value = false
  }
}

// Initialize tab functionality
const initializeTabs = () => {
  const tabBtns = document.querySelectorAll('.tab-btn')
  const tabContents = document.querySelectorAll('#Tabs-Content > div')

  tabBtns.forEach(btn => {
    btn.addEventListener('click', () => {
      // Remove active class from all buttons and contents
      tabBtns.forEach(b => b.classList.remove('active'))
      tabContents.forEach(c => c.classList.add('hidden'))

      // Add active class to clicked button
      btn.classList.add('active')

      // Show corresponding content
      const contentId = btn.getAttribute('data-content')
      document.getElementById(contentId).classList.remove('hidden')
    })
  })
}

const head = computed(() => props.headOfFamilyData || {})
const user = computed(() => head.value.user || {})

</script>

<template>
  <div class="flex">
    <Sidebar />
    <div id="Main-Container" class="flex flex-col flex-1">
      <Topbar />
      <div id="Content" class="relative flex flex-col flex-1 gap-6 p-6 pb-[30px] w-full shrink-0 mt-[116px]">
        <div id="Header" class="flex items-center justify-between">
          <div class="flex flex-col gap-2">
            <div class="flex gap-1 items-center leading-5 text-desa-secondary">
              <p class="last-of-type:text-desa-dark-green last-of-type:font-semibold capitalize">Kepala Rumah</p>
              <span>/</span>
              <p class="last-of-type:text-desa-dark-green last-of-type:font-semibold capitalize">Manage Kepala Rumah</p>
            </div>
            <h1 class="font-semibold text-2xl">Manage Kepala Rumah</h1>
          </div>
          <Button 
            @click="handleDeleteHeadOfFamily"
            label="Hapus Data"
            :icon="IconTrashWhite"
            class="bg-desa-red"
          />
        </div>
        <div class="flex gap-[14px]">
          <div class="flex flex-col w-[calc(525/1000*100%)] shrink-0 gap-[14px]">
            <section id="Kepala-Rumah" class="flex flex-col rounded-3xl p-6 gap-6 bg-white">
              <p class="font-medium leading-5 text-desa-secondary">Kepala Rumah</p>
              <div class="flex items-center gap-4">
                <div class="flex size-[76px] shrink-0 rounded-full overflow-hidden bg-desa-foreshadow">
                  <img 
                    :src="props.headOfFamilyData.profile_picture ? (props.headOfFamilyData.profile_picture.startsWith('http') ? props.headOfFamilyData.profile_picture : `/storage/${props.headOfFamilyData.profile_picture}`) : '/images/photos/kk-photo-1.png'" 
                    class="w-full h-full object-cover" 
                    :alt="props.headOfFamilyData.user?.name"
                  >
                </div>
                <div class="flex flex-col gap-[6px] w-full">
                  <p class="font-semibold text-xl line-clamp-1">{{ headOfFamilyData.user?.name || 'no data' }}</p>
                  <p class="flex items-center gap-1">
                    <img :src="IconBriefcaseSecondary" class="flex size-[18px] shrink-0" alt="icon">
                    <span class="font-medium text-sm text-desa-secondary">{{ headOfFamilyData.occupation  }}</span>
                  </p>
                </div>
                <div class="badge rounded-full p-3 gap-2 flex w-[100px] justify-center shrink-0 bg-desa-soft-green">
                  <span class="font-semibold text-xs text-white uppercase">{{ headOfFamilyData.marital_status || 'Status' }}</span>
                </div>
              </div>
              <hr class="border-desa-foreshadow">
              <div class="flex items-center w-full gap-3">
                <div class="flex size-[52px] shrink-0 rounded-2xl bg-desa-foreshadow items-center justify-center">
                  <img :src="IconKeyboardDarkGreen" class="flex size-6 shrink-0" alt="icon">
                </div>
                <div class="flex flex-col gap-1 w-full">
                  <p class="font-semibold text-xl leading-[22.5px]">{{ headOfFamilyData.identity_number || 'no data' }}</p>
                  <span class="font-medium text-desa-secondary">
                    Nomor Induk Kependudukan
                  </span>
                </div>
              </div>
              <hr class="border-desa-foreshadow">
              <div class="flex items-center w-full gap-3">
                <div class="flex size-[52px] shrink-0 rounded-2xl bg-desa-foreshadow items-center justify-center">
                  <img :src="IconUserSquareDarkGreen" class="flex size-6 shrink-0" alt="icon">
                </div>
                <div class="flex flex-col gap-1 w-full">
                  <p class="font-semibold text-xl leading-[22.5px]">{{ calculateAge(headOfFamilyData.date_of_birth) }} Tahun</p>
                  <span class="font-medium text-desa-secondary">
                    Umur Kepala Rumah
                  </span>
                </div>
              </div>
              <hr class="border-desa-foreshadow">
              <div class="flex items-center w-full gap-3">
                <div class="flex size-[52px] shrink-0 rounded-2xl bg-desa-foreshadow items-center justify-center">
                  <img :src="IconManDarkGreen" class="flex size-6 shrink-0" alt="icon">
                </div>
                <div class="flex flex-col gap-1 w-full">
                  <p class="font-semibold text-xl leading-[22.5px]">{{ headOfFamilyData.gender === 'male' ? 'Pria' : 'Wanita' }}</p>
                  <span class="font-medium text-desa-secondary">
                    Jenis Kelamin
                  </span>
                </div>
              </div>
              <hr class="border-desa-foreshadow">
              <div class="flex items-center w-full gap-3">
                <div class="flex size-[52px] shrink-0 rounded-2xl bg-desa-foreshadow items-center justify-center">
                  <img :src="IconSmsDarkGreen" class="flex size-6 shrink-0" alt="icon">
                </div>
                <div class="flex flex-col gap-1 w-full">
                  <p class="font-semibold text-xl leading-[22.5px]">{{ headOfFamilyData.user?.email || 'no data' }}</p>
                  <span class="font-medium text-desa-secondary">
                    Email Address
                  </span>
                </div>
              </div>
              <hr class="border-desa-foreshadow">
              <div class="flex items-center w-full gap-3">
                <div class="flex size-[52px] shrink-0 rounded-2xl bg-desa-foreshadow items-center justify-center">
                  <img :src="IconCallDarkGreen" class="flex size-6 shrink-0" alt="icon">
                </div>
                <div class="flex flex-col gap-1 w-full">
                  <p class="font-semibold text-xl leading-[22.5px]">{{ headOfFamilyData.phone_number || 'Tidak ada nomor' }}</p>
                  <span class="font-medium text-desa-secondary">
                    Nomor Hp
                  </span>
                </div>
              </div>
            </section>
            <section id="Anggota-Keluarga" class="flex flex-col rounded-3xl p-6 gap-6 bg-white">
              <div class="flex items-center justify-between">
                <div class="flex flex-col gap-[6px]">
                  <p class="font-semibold text-[32px] leading-10">{{ (familyMembersData || props.headOfFamilyData?.family_members || []).length }}</p>
                  <p class="font-medium leading-5 text-desa-secondary">Anggota Keluarga</p>
                </div>
                <img :src="IconProfile2UserForeshadow" class="flex size-12 shrink-0" alt="icon">
              </div>
              <hr class="border-desa-foreshadow">
              
              <div 
                v-for="(members, relationship) in groupedFamilyMembers" 
                :key="relationship" 
                class="flex flex-col gap-[14px]"
              >
                <p class="font-medium leading-5 text-desa-secondary">{{ relationship }} ({{ members.length }})</p>
                <div 
                  v-for="member in members" 
                  :key="member.id"
                  class="card flex flex-col rounded-2xl border border-desa-background p-4 gap-6"
                >
                  <div class="flex items-center gap-4">
                    <div class="flex size-[64px] shrink-0 rounded-full overflow-hidden bg-desa-foreshadow">
                      <img 
                        :src="member.profile_picture ? (member.profile_picture.startsWith('http') ? member.profile_picture : `/storage/${member.profile_picture}`) : '/images/photos/kk-photo-1.png'" 
                        class="w-full h-full object-cover" 
                        :alt="member.user?.name"
                      >
                    </div>
                    <div class="flex flex-col gap-[6px] w-full">
                      <p class="font-semibold text-xl line-clamp-1">{{ member.user?.name }}</p>
                      <p class="flex items-center gap-1">
                        <img :src="IconBriefcaseSecondary" class="flex size-[18px] shrink-0" alt="icon">
                        <span class="font-medium text-sm text-desa-secondary">{{ member.occupation || 'Tidak ada pekerjaan' }}</span>
                      </p>
                    </div>
                    <p class="font-medium leading-5 text-nowrap">{{ calculateAge(member.date_of_birth) }} tahun</p>
                  </div>
                  <hr class="border-desa-background">
                  <div class="flex justify-between items-center">
                    <p class="flex items-center gap-1">
                      <img :src="IconKeyboardSecondary" class="flex size-[18px] shrink-0" alt="icon">
                      <span class="font-medium text-sm text-desa-secondary">Nomor Induk Kependudukan:</span>
                    </p>
                    <p class="font-medium leading-5">{{ member.identity_number }}</p>
                  </div>
                </div>
              </div>
            </section>
          </div>
          <div class="flex flex-col flex-1 shrink-0 gap-[14px]">
            <section id="Recent-Activity" class="flex flex-col rounded-3xl p-6 gap-6 bg-white">
              <p class="font-medium leading-5 text-desa-secondary">Recent Activity</p>
              <div id="Tabs-Button" class="grid grid-cols-3 gap-3">
                <button data-content="Bansos" class="tab-btn group active">
                  <div class="flex items-center justify-center rounded-full border border-desa-background py-[14px] px-[18px] group-hover:bg-desa-black group-[.active]:bg-desa-black transition-setup">
                    <span class="font-medium leading-5 text-desa-secondary group-hover:text-white group-[.active]:text-white transition-setup">
                      Bansos
                    </span>
                  </div>
                </button>
                <button data-content="Events" class="tab-btn group">
                  <div class="flex items-center justify-center rounded-full border border-desa-background py-[14px] px-[18px] group-hover:bg-desa-black group-[.active]:bg-desa-black transition-setup">
                    <span class="font-medium leading-5 text-desa-secondary group-hover:text-white group-[.active]:text-white transition-setup">
                      Events
                    </span>
                  </div>
                </button>
                <button data-content="Applicants" class="tab-btn group">
                  <div class="flex items-center justify-center rounded-full border border-desa-background py-[14px] px-[18px] group-hover:bg-desa-black group-[.active]:bg-desa-black transition-setup">
                    <span class="font-medium leading-5 text-desa-secondary group-hover:text-white group-[.active]:text-white transition-setup">
                      Applicants
                    </span>
                  </div>
                </button>
              </div>
              <div id="Tabs-Content" class="flex flex-col">
                <!-- Bansos Tab Content -->
                <div id="Bansos" class="flex flex-col gap-6">
                  <div v-if="loadingBansos" class="text-center py-4">
                    <p>Loading bansos data...</p>
                  </div>
                  <div v-else-if="bansosData.length === 0" class="text-center py-4">
                    <p>No bansos applications found.</p>
                  </div>
                  <div 
                    v-for="bansos in bansosData" 
                    :key="bansos.id"
                    class="card flex flex-col rounded-2xl border border-desa-background p-4 gap-4"
                  >
                    <div class="flex items-center justify-between">
                      <p class="font-medium text-sm text-desa-secondary">{{ new Date(bansos.created_at).toLocaleDateString('id-ID', { weekday: 'short', day: 'numeric', month: 'short', year: 'numeric' }) }}</p>
                      <img :src="IconCalendar2SecondaryGreen" class="flex size-[18px] shrink-0" alt="icon">
                    </div>
                    <hr class="border-desa-background">
                    <p class="font-semibold text-lg">{{ bansos.socialAssistance?.name || 'Bantuan Sosial' }}</p>
                    <div class="flex items-center gap-3">
                      <div class="flex size-[52px] shrink-0 items-center justify-center rounded-2xl bg-desa-foreshadow">
                        <img :src="IconMoneyDarkGreen" alt="icon">
                      </div>
                      <div class="flex flex-col gap-[6px] w-full">
                        <p class="font-semibold text-lg leading-5">{{ bansos.socialAssistance?.amount || 'N/A' }}</p>
                        <p class="font-medium text-sm text-desa-secondary">Nominal Pengajuan</p>
                      </div>
                      <div 
                        class="badge rounded-full p-3 gap-2 flex w-[100px] justify-center shrink-0"
                        :class="{
                          'bg-desa-yellow': bansos.status === 'pending',
                          'bg-desa-dark-green': bansos.status === 'approved',
                          'bg-desa-red': bansos.status === 'rejected'
                        }"
                      >
                        <span class="font-semibold text-xs text-white uppercase">
                          {{ bansos.status === 'pending' ? 'Menunggu' : bansos.status === 'approved' ? 'Diterima' : 'Ditolak' }}
                        </span>
                      </div>
                    </div>
                    <hr class="border-desa-background">
                    <div class="flex items-center justify-between">
                      <p class="font-medium text-sm text-desa-secondary">Nominal Pengajuan:</p>
                      <p class="font-medium leading-5 text-desa-red">{{ bansos.amount || 'N/A' }}</p>
                    </div>
                  </div>
                </div>
                
                <!-- Events Tab Content -->
                <div id="Events" class="flex flex-col gap-6 hidden">
                  <div v-if="loadingEvents" class="text-center py-4">
                    <p>Loading events data...</p>
                  </div>
                  <div v-else-if="eventsData.length === 0" class="text-center py-4">
                    <p>No events found.</p>
                  </div>
                  <div 
                    v-for="event in eventsData" 
                    :key="event.id"
                    class="card flex flex-col rounded-2xl border border-desa-background p-4 gap-4"
                  >
                    <div class="flex items-center justify-between">
                      <p class="font-medium text-sm text-desa-secondary">{{ new Date(event.date).toLocaleDateString('id-ID', { weekday: 'short', day: 'numeric', month: 'short', year: 'numeric' }) }}</p>
                      <img :src="IconCalendar2SecondaryGreen" class="flex size-[18px] shrink-0" alt="icon">
                    </div>
                    <hr class="border-desa-background">
                    <div class="flex items-center gap-3">
                      <div class="flex w-20 h-[60px] shrink-0 items-center justify-center rounded-2xl bg-desa-foreshadow overflow-hidden">
                        <img 
                          :src="event.thumbnail ? `/storage/${event.thumbnail}` : '@/assets/images/thumbnails/event-image-1.png'" 
                          class="w-full h-full object-cover" 
                          alt="thumbnail"
                        >
                      </div>
                      <div class="flex flex-col gap-[6px] w-full">
                        <p class="font-semibold leading-5 line-clamp-1">{{ event.name || 'Event Name' }}</p>
                        <div class="flex items-center gap-1">
                          <img :src="IconProfile2UserOrange" class="flex size-[18px] shrink-0" alt="icon">
                          <p class="font-medium text-sm text-desa-orange">{{ event.participants_count || 0 }} total partisipasi</p>
                        </div>
                      </div>
                    </div>
                    <hr class="border-desa-background">
                    <div class="flex items-center justify-between">
                      <p class="font-medium text-sm text-desa-secondary">Harga Event:</p>
                      <p class="font-medium leading-5 text-desa-red">{{ event.price ? `Rp${parseInt(event.price).toLocaleString('id-ID')}` : 'Gratis' }}</p>
                    </div>
                  </div>
                </div>
                
                <!-- Applicants Tab Content -->
                <div id="Applicants" class="flex flex-col gap-6 hidden">
                  <div v-if="loadingApplicants" class="text-center py-4">
                    <p>Loading applicants data...</p>
                  </div>
                  <div v-else-if="applicantsData.length === 0" class="text-center py-4">
                    <p>No job applications found.</p>
                  </div>
                  <div 
                    v-for="applicant in applicantsData" 
                    :key="applicant.id"
                    class="card flex flex-col rounded-2xl border border-desa-background p-4 gap-4"
                  >
                    <div class="flex items-center justify-between gap-3">
                      <div class="flex w-20 h-[60px] shrink-0 items-center justify-center rounded-2xl bg-desa-foreshadow overflow-hidden">
                        <img 
                          :src="applicant.jobVacancy?.company_logo ? `/storage/${applicant.jobVacancy.company_logo}` : '@/assets/images/thumbnails/PT Cingluh.jpg'" 
                          class="w-full h-full object-cover" 
                          alt="thumbnail"
                        >
                      </div>
                      <div 
                        class="badge rounded-full p-3 gap-2 flex w-[100px] justify-center shrink-0"
                        :class="{
                          'bg-desa-yellow': applicant.status === 'pending',
                          'bg-desa-dark-green': applicant.status === 'approved',
                          'bg-desa-red': applicant.status === 'rejected'
                        }"
                      >
                        <span class="font-semibold text-xs text-white uppercase">
                          {{ applicant.status === 'pending' ? 'Menunggu' : applicant.status === 'approved' ? 'Diterima' : 'Ditolak' }}
                        </span>
                      </div>
                    </div>
                    <div class="flex flex-col gap-1">
                      <p class="font-semibold leading-5">{{ applicant.jobVacancy?.title || 'Job Title' }}</p>
                      <p class="font-medium leading-5 text-desa-secondary">
                        Penanggung jawab: 
                        <span class="font-semibold text-desa-dark-green">
                          {{ applicant.jobVacancy?.company_name || 'Company Name' }}
                        </span>
                      </p>
                    </div>
                    <hr class="border-desa-background">
                    <div class="flex items-center gap-3">
                      <div class="flex size-12 shrink-0 rounded-full bg-desa-foreshadow overflow-hidden items-center justify-center">
                        <img :src="IconCalendar2SecondaryGreen" class="flex size-6" alt="icon">
                      </div>
                      <div>
                        <p class="font-semibold leading-5 text-desa-dark-green">{{ new Date(applicant.created_at).toLocaleDateString('id-ID', { day: 'numeric', month: 'short', year: 'numeric' }) }}</p>
                        <p class="font-medium text-sm text-desa-secondary">Tanggal Pelaksanaan</p>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </section>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>