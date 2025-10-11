<script setup>
import { ref, onMounted, onBeforeMount, computed, watch } from "vue";
import { router } from "@inertiajs/vue3";
import { useAuthStore } from "@/stores/auth";
import { useHeadOfFamily } from "@/composables/useHeadOfFamily";
import Sidebar from "@/components/sidebar/Sidebar.vue";
import Button from "@/components/ui/Button.vue";
import Input from "@/components/ui/Input.vue";
import IconSearchSecondaryGreen from "@/assets/images/icons/search-normal-secondary-green.svg";
import IconSearchBlack from "@/assets/images/icons/search-normal-dark-green.svg";
import IconAddSquare from "@/assets/images/icons/add-square-white.svg";
import IconUserSearchSecondary from "@/assets/images/icons/user-search-secondary-green.svg";
import IconUserSearchBlack from "@/assets/images/icons/user-search-black.svg";
import IconBriefcaseSecondary from "@/assets/images/icons/briefcase-secondary-green.svg";
import IconKeyboardSecondary from "@/assets/images/icons/keyboard-secondary-green.svg";
import IconProfile2UserBlue from "@/assets/images/icons/profile-2user-blue.svg";
import IconArrowLeftDarkGreen from "@/assets/images/icons/arrow-left-dark-green.svg";
import IconArrowLeftForeshadow from "@/assets/images/icons/arrow-left-foreshadow.svg";
import IconDisabledArrow from "@/assets/images/icons/disabled-arrow-pagination.svg";
import IconFilterBlack from "@/assets/images/icons/filter-black.svg";
import IconArrowDownBlack from "@/assets/images/icons/arrow-down-black.svg";

const authStore = useAuthStore();

// Protect the route
onBeforeMount(async () => {
    await authStore.requireAuth();
});

// Use the head of family composable
const {
    headOfFamilies,
    pagination,
    loading,
    error,
    hasError,
    isLoading,
    fetchHeadOfFamilies,
    deleteHeadOfFamily,
    refreshData,
} = useHeadOfFamily();

const searchQuery = ref("");
const entriesPerPage = ref(5);
const currentPage = ref(1);

const totalPages = computed(() => pagination.value.last_page);

const viewFamilyMembers = (id) => {
    router.visit(`/kepala-rumah/${id}/anggota-keluarga`);
};

const editHeadOfFamily = (id) => {
    router.visit(`/kepala-rumah/${id}/edit`);
};

const handleDeleteHeadOfFamily = async (id) => {
    if (confirm("Apakah Anda yakin ingin menghapus data kepala rumah ini?")) {
        const success = await deleteHeadOfFamily(id);
        if (success) {
            await refreshData({
                perPage: entriesPerPage.value,
                page: currentPage.value,
                search: searchQuery.value,
            });
        }
    }
};

const goToPage = async (page) => {
    if (page >= 1 && page <= totalPages.value) {
        currentPage.value = page;
        await refreshData({
            perPage: entriesPerPage.value,
            page: page,
            search: searchQuery.value,
        });
    }
};

const nextPage = async () => {
    if (currentPage.value < totalPages.value) {
        currentPage.value++;
        await refreshData({
            perPage: entriesPerPage.value,
            page: currentPage.value,
            search: searchQuery.value,
        });
    }
};

const prevPage = async () => {
    if (currentPage.value > 1) {
        currentPage.value--;
        await refreshData({
            perPage: entriesPerPage.value,
            page: currentPage.value,
            search: searchQuery.value,
        });
    }
};

// Improved search functionality with debounce
let searchTimeout;
const handleSearch = (query) => {
    // Clear previous timeout
    clearTimeout(searchTimeout);

    // Set new timeout
    searchTimeout = setTimeout(async () => {
        currentPage.value = 1;
        await refreshData({
            perPage: entriesPerPage.value,
            page: 1,
            search: query,
        });
    }, 300); // 300ms debounce
};

// Watch for search query changes
watch(searchQuery, (newQuery) => {
    handleSearch(newQuery);
});

// Watch for entries per page changes
watch(entriesPerPage, async () => {
    currentPage.value = 1;
    await refreshData({
        perPage: entriesPerPage.value,
        page: 1,
        search: searchQuery.value,
    });
});

// Initial data fetch
onMounted(async () => {
    // Get search query from URL if exists
    const urlParams = new URLSearchParams(window.location.search);
    const urlSearchQuery = urlParams.get("search");

    if (urlSearchQuery) {
        searchQuery.value = urlSearchQuery;
    }

    await fetchHeadOfFamilies({
        perPage: entriesPerPage.value,
        page: currentPage.value,
        search: searchQuery.value,
    });
});
</script>

<template>
    <div class="flex">
        <Sidebar />
        <div id="Main-Container" class="flex flex-col flex-1">
            <div
                id="Content"
                class="relative flex flex-col flex-1 gap-6 p-6 pb-[30px] w-full shrink-0"
            >
                <div id="Header" class="flex items-center justify-between">
                    <h1 class="font-semibold text-2xl">Kepala Rumah</h1>
                    <Button
                        label="Add New"
                        :icon="IconAddSquare"
                        @click="router.visit('/kepala-rumah/create')"
                        class="bg-desa-dark-green"
                    />
                </div>
                <section
                    id="List-Kepala-Rumah"
                    class="flex flex-col gap-[20px]"
                >
                    <div
                        id="Page-Search"
                        class="flex items-center justify-between"
                    >
                        <div class="flex flex-col gap-3 w-[370px] shrink-0">
                            <div class="relative group peer w-full valid">
                                <Input
                                    v-model="searchQuery"
                                    placeholder="Cari nama Kepala Rumah atau NIK"
                                    class="appearance-none outline-none w-full h-14 rounded-2xl ring-[1.5px] ring-desa-background focus:ring-desa-black py-4 pl-12 pr-6 gap-2 font-medium placeholder:text-desa-secondary transition-all duration-300"
                                />
                                <div
                                    class="absolute transform -translate-y-1/2 top-1/2 left-4 flex size-6 shrink-0"
                                >
                                    <img
                                        :src="IconUserSearchSecondary"
                                        class="size-6 hidden group-has-[:placeholder-shown]:flex"
                                        alt="icon"
                                    />
                                    <img
                                        :src="IconUserSearchBlack"
                                        class="size-6 flex group-has-[:placeholder-shown]:hidden"
                                        alt="icon"
                                    />
                                </div>
                            </div>
                        </div>
                        <div class="options flex items-center gap-4">
                            <div class="flex items-center gap-[10px]">
                                <span class="font-medium leading-5">Show</span>
                                <div class="relative">
                                    <select
                                        v-model="entriesPerPage"
                                        class="appearance-none outline-none w-full h-14 rounded-2xl ring-[1.5px] ring-desa-background focus:ring-desa-black py-4 px-6 pr-[52px] gap-2 font-medium placeholder:text-desa-secondary transition-all duration-300"
                                    >
                                        <option value="5" selected>
                                            5 Entries
                                        </option>
                                        <option value="10">10 Entries</option>
                                        <option value="20">20 Entries</option>
                                        <option value="30">30 Entries</option>
                                        <option value="40">40 Entries</option>
                                        <option value="50">50 Entries</option>
                                    </select>
                                    <img
                                        :src="IconArrowDownBlack"
                                        class="flex size-6 shrink-0 absolute transform -translate-y-1/2 top-1/2 right-6"
                                        alt="icon"
                                    />
                                </div>
                            </div>
                            <button
                                type="button"
                                class="flex items-center gap-1 h-14 w-fit rounded-2xl border border-desa-background bg-white py-4 px-6"
                            >
                                <img
                                    :src="IconFilterBlack"
                                    class="flex size-6 shrink-0"
                                    alt="icon"
                                />
                                <span class="font-medium leading-5"
                                    >Filter</span
                                >
                            </button>
                        </div>
                    </div>

                    <div
                        v-for="headOfFamily in headOfFamilies"
                        :key="headOfFamily.id"
                        class="card flex items-center justify-between rounded-3xl p-6 bg-white"
                    >
                        <div class="flex items-center gap-3 w-[260px]">
                            <div
                                class="flex size-16 shrink-0 rounded-full overflow-hidden bg-desa-foreshadow"
                            >
                                <img
                                    :src="headOfFamily.photo"
                                    class="w-full h-full object-cover"
                                    :alt="headOfFamily.name"
                                />
                            </div>
                            <div class="flex flex-col gap-[6px]">
                                <p
                                    class="font-semibold text-lg leading-[22.5px] w-[184px] truncate"
                                >
                                    {{ headOfFamily.name }}
                                </p>
                                <p class="flex items-center gap-1">
                                    <img
                                        :src="IconBriefcaseSecondary"
                                        class="flex size-[18px] shrink-0"
                                        alt="icon"
                                    />
                                    <span
                                        class="font-medium text-sm text-desa-secondary"
                                        >{{ headOfFamily.occupation }}</span
                                    >
                                </p>
                            </div>
                        </div>
                        <div class="flex flex-col gap-1 w-[180px] shrink-0">
                            <p class="flex items-center gap-1">
                                <img
                                    :src="IconKeyboardSecondary"
                                    class="flex size-[18px] shrink-0"
                                    alt="icon"
                                />
                                <span
                                    class="font-medium text-sm text-desa-secondary"
                                    >NIK</span
                                >
                            </p>
                            <p class="font-semibold leading-5">
                                {{ headOfFamily.nik }}
                            </p>
                        </div>
                        <p
                            class="flex items-center rounded-full w-[224px] shrink-0 py-[14px] px-4 gap-1 bg-desa-blue/10"
                        >
                            <img
                                :src="IconProfile2UserBlue"
                                class="flex size-[18px] shrink-0"
                                alt="icon"
                            />
                            <span class="font-medium text-desa-blue"
                                >{{ headOfFamily.familyMembers }} Anggota
                                Keluarga</span
                            >
                        </p>
                        <button
                            @click="viewFamilyMembers(headOfFamily.id)"
                            class="flex items-center shrink-0 gap-[10px] rounded-2xl py-4 px-6 bg-desa-black"
                        >
                            <span class="font-medium text-white">Manage</span>
                        </button>
                    </div>
                </section>

                <nav id="Pagination">
                    <ul class="flex items-center gap-3">
                        <li class="group">
                            <button
                                type="button"
                                :disabled="currentPage === 1"
                                @click="prevPage"
                                class="group/arrow flex size-11 shrink-0 items-center justify-center rounded-full bg-desa-foreshadow disabled:!bg-desa-foreshadow group-hover:bg-desa-dark-green transition-setup"
                            >
                                <img
                                    :src="IconArrowLeftDarkGreen"
                                    class="flex size-6 shrink-0 group-hover:hidden group-disabled/arrow:!hidden"
                                    alt="icon"
                                />
                                <img
                                    :src="IconArrowLeftForeshadow"
                                    class="hidden size-6 shrink-0 group-hover:flex group-disabled/arrow:!hidden"
                                    alt="icon"
                                />
                                <img
                                    :src="IconDisabledArrow"
                                    class="hidden size-6 shrink-0 group-disabled/arrow:!flex"
                                    alt="icon"
                                />
                            </button>
                        </li>

                        <li
                            v-for="page in totalPages"
                            :key="page"
                            class="group"
                            :class="{ active: page === currentPage }"
                        >
                            <button
                                @click="goToPage(page)"
                                class="flex size-11 shrink-0 items-center justify-center rounded-full bg-desa-foreshadow group-hover:bg-desa-dark-green group-[.active]:bg-desa-dark-green transition-setup"
                            >
                                <span
                                    class="text-desa-dark-green font-semibold group-[.active]:text-desa-foreshadow group-hover:text-desa-foreshadow transition-setup"
                                >
                                    {{ page }}
                                </span>
                            </button>
                        </li>

                        <li class="group">
                            <button
                                type="button"
                                :disabled="currentPage === totalPages"
                                @click="nextPage"
                                class="group/arrow flex size-11 shrink-0 items-center justify-center rounded-full bg-desa-foreshadow disabled:!bg-desa-foreshadow group-hover:bg-desa-dark-green transition-setup"
                            >
                                <img
                                    :src="IconArrowLeftDarkGreen"
                                    class="flex size-6 shrink-0 rotate-180 group-hover:hidden group-disabled/arrow:!hidden"
                                    alt="icon"
                                />
                                <img
                                    :src="IconArrowLeftForeshadow"
                                    class="hidden size-6 shrink-0 rotate-180 group-hover:flex group-disabled/arrow:!hidden"
                                    alt="icon"
                                />
                                <img
                                    :src="IconDisabledArrow"
                                    class="hidden size-6 shrink-0 rotate-180 group-disabled/arrow:!flex"
                                    alt="icon"
                                />
                            </button>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>
</template>
