<script setup>
import SidebarItem from './SidebarItem.vue'
import iconChartActive from '@/assets/images/icons/chart-square-dark-green.svg'
import iconChartInactive from '@/assets/images/icons/chart-square-secondary-green.svg'

// untuk konfigurasi menu yang tersedia
const sidebarItems = [
  {
    label: 'Dashboard',
    path: '/dashboard',
    iconActive: iconChartActive,
    iconInactive: iconChartInactive,
  },
  {
    label: 'Kepala Rumah',
    path: '/kepala-rumah',
    iconActive: iconChartActive,
    iconInactive: iconChartInactive,
  },
]
</script>

<template>
  <aside
    id="Sidebar"
    class="relative flex w-[280px] shrink-0 min-h-screen bg-white border-r border-desa-foreshadow overflow-hidden"
  >
    <div class="fixed top-0 h-full w-[280px] flex shrink-0 flex-1 z-20 bg-white">
      <div class="flex flex-col h-full w-full gap-6 pt-[30px] px-6">
        <div class="flex items-center justify-between">
          <img
            src="@/assets/images/logos/logo-text.svg"
            class="flex h-[30px] shrink-0"
            alt="logo"
          />
          <button
            class="flex size-11 items-center justify-center rounded-2xl border border-desa-background hover:border-desa-secondary transition-setup"
          >
            <img src="@/assets/images/icons/menu-secondary-green.svg" class="size-6" alt="icon" />
          </button>
        </div>
        <div class="flex flex-col flex-1 gap-6 overflow-y-scroll hide-scrollbar">
          <nav class="flex flex-col gap-2 pb-12">
            <p class="font-medium text-sm text-desa-secondary">Main Menu</p>
            <ul class="flex flex-col gap-2">
              <SidebarItem v-for="(item, index) in sidebarItems" :key="index" :item="item" />
            </ul>
          </nav>
        </div>
      </div>
    </div>
  </aside>
</template>
