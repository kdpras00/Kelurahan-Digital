<script setup>
import { onMounted, onBeforeMount } from "vue";
import { useAuthStore } from "@/stores/auth";
import Sidebar from "@/components/sidebar/Sidebar.vue";
import StatCard from "@/components/dashboard/StatCard.vue";
import SocialAssistanceItem from "@/components/dashboard/SocialAssistanceItem.vue";
import ApplicantCard from "@/components/dashboard/ApplicantCard.vue";
import LoadingSpinner from "@/components/dashboard/LoadingSpinner.vue";
import ErrorDisplay from "@/components/dashboard/ErrorDisplay.vue";
import PopulationChart from "@/components/dashboard/PopulationChart.vue";
import { useDashboard } from "@/composables/useDashboard";

const authStore = useAuthStore();

const {
    statistics,
    loading,
    error,
    hasError,
    isLoading,
    fetchDashboardData,
    refreshData,
} = useDashboard();

// Protect the route
onBeforeMount(async () => {
    await authStore.requireAuth();
});

onMounted(fetchDashboardData);
</script>

<template>
    <div class="flex" role="main" aria-label="Dashboard">
        <Sidebar />
        <main class="flex-1 p-6">
            <h1 class="font-semibold text-2xl mb-6">Desa Statistics</h1>

            <!-- Loading State -->
            <div
                v-if="isLoading && !statistics"
                class="flex justify-center items-center h-64"
                role="status"
                aria-live="polite"
            >
                <LoadingSpinner size="lg" />
                <span class="sr-only">Loading dashboard data...</span>
            </div>

            <!-- Error State -->
            <div
                v-else-if="hasError"
                class="bg-white rounded-2xl p-6"
                role="alert"
                aria-live="assertive"
            >
                <ErrorDisplay :message="error" :on-retry="refreshData" />
            </div>

            <!-- Dashboard Content -->
            <div v-else>
                <div id="Row-1" class="flex gap-6 mb-6">
                    <div
                        class="flex flex-col w-[calc(389/1000*100%)] h-[358px] rounded-2xl p-6 gap-6 gradient-vertical"
                        role="region"
                        aria-labelledby="bantuan-sosial-heading"
                    >
                        <h2 id="bantuan-sosial-heading" class="sr-only">
                            Bantuan Sosial Section
                        </h2>
                        <img
                            src="@/assets/images/icons/gift-orange-background.svg"
                            class="flex size-[86px] shrink-0"
                            alt="Bantuan Sosial Icon"
                        />
                        <div class="flex flex-col gap-3">
                            <p class="font-medium text-sm text-desa-lime">
                                — Bantuan Sosial
                            </p>
                            <p
                                class="font-semibold text-2xl text-white text-nowrap"
                            >
                                Dari Desa untuk Warga ❤️
                            </p>
                            <p class="text-white">
                                Wujudkan kesejahteraan desa dengan bantuan
                                sosial yang tepat sasaran.
                            </p>
                        </div>
                        <a
                            href="#"
                            class="flex items-center justify-between rounded-2xl p-4 gap-[10px] bg-white"
                            aria-label="Bikin Bantuan Sosial"
                        >
                            <span
                                class="font-medium text-desa-dark-green leading-5"
                                >Bikin Bantuan Sosial</span
                            >
                            <img
                                src="@/assets/images/icons/add-square-dark-green.svg"
                                class="flex size-6 shrink-0"
                                alt=""
                            />
                        </a>
                    </div>
                    <section
                        id="Statistics"
                        class="grid grid-cols-2 flex-1 shrink-0 gap-[14px]"
                        role="region"
                        aria-label="Statistics"
                    >
                        <StatCard
                            title="Jumlah Penduduk"
                            :value="statistics.residents"
                            icon="@/assets/images/icons/profil-2user-foreshadow-background.svg"
                            trend="up"
                            trend-text="+12% dari bulan sebelumnya"
                        />
                        <StatCard
                            title="Job Applicant"
                            :value="statistics.jobApplicants"
                            icon="@/assets/images/icons/buildings-foreshadow-background.svg"
                            trend="up"
                            trend-text="+12% dari bulan sebelumnya"
                        />
                        <StatCard
                            title="Kepala Rumah"
                            :value="statistics.headOfFamilies"
                            icon="@/assets/images/icons/crown-foreshadow-background.svg"
                            trend="up"
                            trend-text="+12% dari bulan sebelumnya"
                        />
                        <StatCard
                            title="Total Events"
                            :value="statistics.events"
                            icon="@/assets/images/icons/calendar-2-foreshadow-background.svg"
                            trend="up"
                            trend-text="+12% dari bulan sebelumnya"
                        />
                    </section>
                </div>
                <div id="Row-2" class="flex gap-[14px] mb-[14px]">
                    <section
                        id="Bantuan-Sosial"
                        class="flex flex-col w-[calc(497/1000*100%)] shrink-0 rounded-2xl bg-white"
                        role="region"
                        aria-labelledby="bantuan-sosial-list-heading"
                    >
                        <h2 id="bantuan-sosial-list-heading" class="sr-only">
                            Daftar Bantuan Sosial
                        </h2>
                        <div class="flex flex-col gap-3 p-6">
                            <div class="flex items-center justify-between">
                                <p class="font-medium text-desa-secondary">
                                    Bantuan Sosial
                                </p>
                                <img
                                    src="@/assets/images/icons/bag-2-foreshadow-background.svg"
                                    class="flex size-12 shrink-0"
                                    alt="Bantuan Sosial Icon"
                                />
                            </div>
                            <div class="flex flex-col gap-[6px]">
                                <p class="font-semibold text-[32px] leading-10">
                                    {{ statistics.socialAssistances }}
                                </p>
                                <div class="flex items-center gap-0.5">
                                    <img
                                        src="@/assets/images/icons/trend-up-dark-green-fill.svg"
                                        class="flex size-[18px] shrink-0"
                                        alt="Trend Up Icon"
                                    />
                                    <p
                                        class="font-medium text-sm text-desa-secondary"
                                    >
                                        <span class="text-desa-dark-green"
                                            >+12%</span
                                        >
                                        dari bulan sebelumnya
                                    </p>
                                </div>
                            </div>
                        </div>
                        <hr class="border-desa-foreshadow" />
                        <div class="flex flex-col gap-4 p-6">
                            <p
                                class="font-semibold text-[20px] leading-[25px] text-left w-full"
                            >
                                Bansos Terakhir
                            </p>

                            <SocialAssistanceItem
                                icon="@/assets/images/icons/money-dark-green.svg"
                                title="Rp362.500.000"
                                description="Diberikan oleh RW 01"
                                status="Menunggu"
                            />
                            <hr
                                class="border-desa-foreshadow last-of-type:hidden"
                            />

                            <SocialAssistanceItem
                                icon="@/assets/images/icons/bag-2-dark-green.svg"
                                title="Beras 10kg"
                                description="Diberikan oleh oleh Warga Periuk Jaya"
                                status="Diterima"
                            />
                            <hr
                                class="border-desa-foreshadow last-of-type:hidden"
                            />

                            <SocialAssistanceItem
                                icon="@/assets/images/icons/money-dark-green.svg"
                                title="Rp52.500.000"
                                description="Diberikan oleh RW 01"
                                status="Ditolak"
                            />
                            <hr
                                class="border-desa-foreshadow last-of-type:hidden"
                            />

                            <SocialAssistanceItem
                                icon="@/assets/images/icons/money-dark-green.svg"
                                title="Rp52.500.000"
                                description="Diberikan oleh Bu Haji Ela"
                                status="Diterima"
                            />
                            <hr
                                class="border-desa-foreshadow last-of-type:hidden"
                            />

                            <div
                                class="hidden m-auto h-[384px] flex flex-col shrink-0 justify-center items-center gap-6"
                            >
                                <img
                                    src="@/assets/images/icons/bag-cross-secondary.svg"
                                    class="flex size-[52px] shrink-0"
                                    alt="No Bansos Icon"
                                />
                                <p
                                    class="font-medium leading-5 text-center text-desa-secondary"
                                >
                                    Ups, nampaknya belum bansos
                                </p>
                            </div>
                        </div>
                    </section>
                    <section
                        id="Event"
                        class="flex flex-col flex-1 shrink-0 rounded-2xl bg-white"
                        role="region"
                        aria-label="Events"
                    >
                        <div
                            id="Date-Picker"
                            class="flex flex-col gap-4 p-6"
                            role="region"
                            aria-label="Date Picker"
                        >
                            <div class="flex items-center justify-between">
                                <button
                                    class="flex items-center justify-center size-14 rounded-2xl border border-desa-foreshadow hover:border-desa-dark-green"
                                    aria-label="Previous month"
                                >
                                    <img
                                        src="@/assets/images/icons/arrow-left-secondary-green.svg"
                                        class="flex size-6 shrink-0"
                                        alt="Previous month"
                                    />
                                </button>
                                <p
                                    class="font-semibold text-xl"
                                    aria-live="polite"
                                >
                                    September 2025
                                </p>
                                <button
                                    class="flex items-center justify-center size-14 rounded-2xl border border-desa-foreshadow hover:border-desa-dark-green"
                                    aria-label="Next month"
                                >
                                    <img
                                        src="@/assets/images/icons/arrow-left-secondary-green.svg"
                                        class="flex size-6 shrink-0 rotate-180"
                                        alt="Next month"
                                    />
                                </button>
                            </div>
                            <div
                                class="flex justify-between"
                                role="group"
                                aria-label="Calendar days"
                            >
                                <button
                                    class="group flex flex-col items-center w-[46px] h-[76px] shrink-0 gap-3"
                                >
                                    <div
                                        class="flex rounded-full size-[46px] items-center justify-center bg-desa-foreshadow group-[.active]:bg-desa-soft-green"
                                    >
                                        <span
                                            class="font-medium text-desa-dark-green group-[.active]:text-white"
                                        >
                                            28
                                        </span>
                                    </div>
                                    <span
                                        class="font-medium text-sm text-desa-secondary group-[.active]:text-desa-black"
                                    >
                                        Sen
                                    </span>
                                </button>
                                <button
                                    class="group flex flex-col items-center w-[46px] h-[76px] shrink-0 gap-3"
                                >
                                    <div
                                        class="flex rounded-full size-[46px] items-center justify-center bg-desa-foreshadow group-[.active]:bg-desa-soft-green"
                                    >
                                        <span
                                            class="font-medium text-desa-dark-green group-[.active]:text-white"
                                        >
                                            29
                                        </span>
                                    </div>
                                    <span
                                        class="font-medium text-sm text-desa-secondary group-[.active]:text-desa-black"
                                    >
                                        Sel
                                    </span>
                                </button>
                                <button
                                    class="group flex flex-col items-center w-[46px] h-[76px] shrink-0 gap-3"
                                >
                                    <div
                                        class="flex rounded-full size-[46px] items-center justify-center bg-desa-foreshadow group-[.active]:bg-desa-soft-green"
                                    >
                                        <span
                                            class="font-medium text-desa-dark-green group-[.active]:text-white"
                                        >
                                            30
                                        </span>
                                    </div>
                                    <span
                                        class="font-medium text-sm text-desa-secondary group-[.active]:text-desa-black"
                                    >
                                        Rab
                                    </span>
                                </button>
                                <button
                                    class="group flex flex-col items-center w-[46px] h-[76px] shrink-0 gap-3 active"
                                >
                                    <div
                                        class="flex rounded-full size-[46px] items-center justify-center bg-desa-foreshadow group-[.active]:bg-desa-soft-green"
                                    >
                                        <span
                                            class="font-medium text-desa-dark-green group-[.active]:text-white"
                                        >
                                            31
                                        </span>
                                    </div>
                                    <span
                                        class="font-medium text-sm text-desa-secondary group-[.active]:text-desa-black"
                                    >
                                        Kam
                                    </span>
                                </button>
                                <button
                                    class="group flex flex-col items-center w-[46px] h-[76px] shrink-0 gap-3"
                                >
                                    <div
                                        class="flex rounded-full size-[46px] items-center justify-center bg-desa-foreshadow group-[.active]:bg-desa-soft-green"
                                    >
                                        <span
                                            class="font-medium text-desa-dark-green group-[.active]:text-white"
                                        >
                                            1
                                        </span>
                                    </div>
                                    <span
                                        class="font-medium text-sm text-desa-secondary group-[.active]:text-desa-black"
                                    >
                                        Jum
                                    </span>
                                </button>
                                <button
                                    class="group flex flex-col items-center w-[46px] h-[76px] shrink-0 gap-3"
                                >
                                    <div
                                        class="flex rounded-full size-[46px] items-center justify-center bg-desa-foreshadow group-[.active]:bg-desa-soft-green"
                                    >
                                        <span
                                            class="font-medium text-desa-dark-green group-[.active]:text-white"
                                        >
                                            2
                                        </span>
                                    </div>
                                    <span
                                        class="font-medium text-sm text-desa-secondary group-[.active]:text-desa-black"
                                    >
                                        Sab
                                    </span>
                                </button>
                                <button
                                    class="group flex flex-col items-center w-[46px] h-[76px] shrink-0 gap-3"
                                >
                                    <div
                                        class="flex rounded-full size-[46px] items-center justify-center bg-desa-foreshadow group-[.active]:bg-desa-soft-green"
                                    >
                                        <span
                                            class="font-medium text-desa-dark-green group-[.active]:text-white"
                                        >
                                            3
                                        </span>
                                    </div>
                                    <span
                                        class="font-medium text-sm text-desa-secondary group-[.active]:text-desa-black"
                                    >
                                        Min
                                    </span>
                                </button>
                            </div>
                        </div>
                        <div
                            id="Events"
                            class="flex flex-col flex-1 gap-4 p-6"
                            role="region"
                            aria-label="Upcoming Events"
                        >
                            <div class="flex items-center justify-between">
                                <button aria-label="Previous events">
                                    <img
                                        src="@/assets/images/icons/arrow-left-secondary-green.svg"
                                        class="flex size-6 shrink-0"
                                        alt="Previous events"
                                    />
                                </button>
                                <span class="font-medium text-desa-secondary"
                                    >Upcoming Events (2)</span
                                >
                                <button aria-label="Next events">
                                    <img
                                        src="@/assets/images/icons/arrow-left-secondary-green.svg"
                                        class="flex size-6 shrink-0 rotate-180"
                                        alt="Next events"
                                    />
                                </button>
                            </div>
                            <div
                                class="event-card relative flex w-full h-[365px] shrink-0 rounded-2xl bg-desa-background overflow-hidden"
                            >
                                <img
                                    src="@/assets/images/thumbnails/pengajian_bersama.jpg"
                                    class="w-full h-full object-cover object-top"
                                    alt="Pengajian Bulanan Event"
                                />
                                <div
                                    class="absolute inset-3 top-auto text-white flex flex-col rounded-[18px] border border-white/20 p-4 gap-[6px] backdrop-blur-xl bg-white/[2%]"
                                >
                                    <p
                                        class="font-semibold text-xl leading-[25px]"
                                    >
                                        Pengajian Bulanan
                                    </p>
                                    <div class="flex items-center gap-1">
                                        <img
                                            src="@/assets/images/icons/clock-white.svg"
                                            class="flex size-[18px] shrink-0"
                                            alt="Clock Icon"
                                        />
                                        <p class="font-medium">11:30 WIB</p>
                                    </div>
                                </div>
                            </div>
                            <div
                                class="event-empty-state hidden m-auto h-[384px] flex flex-col shrink-0 justify-center items-center gap-6"
                            >
                                <img
                                    src="@/assets/images/icons/calendar-remove-secondary-green.svg"
                                    class="flex size-[52px] shrink-0"
                                    alt="No Events Icon"
                                />
                                <p
                                    class="font-medium leading-5 text-center text-desa-secondary"
                                >
                                    Ups, nampaknya belum ada event
                                </p>
                            </div>
                        </div>
                    </section>
                </div>
                <div id="Row-3" class="flex gap-[14px] mb-[14px]">
                    <section
                        id="Total-Aplicants"
                        class="flex flex-col gap-[14px] w-[calc(603/1000*100%)]"
                        role="region"
                        aria-label="Job Applicants"
                    >
                        <div
                            class="flex flex-col flex-1 shrink-0 rounded-2xl bg-white"
                        >
                            <div class="flex flex-col gap-3 p-6">
                                <div class="flex items-center justify-between">
                                    <p class="font-medium text-desa-secondary">
                                        Total Applicants
                                    </p>
                                    <img
                                        src="@/assets/images/icons/document-text-foreshadow-background.svg"
                                        class="flex size-12 shrink-0"
                                        alt="Applicants Icon"
                                    />
                                </div>
                                <div class="flex flex-col gap-[6px]">
                                    <p
                                        class="font-semibold text-[32px] leading-10"
                                    >
                                        {{ statistics.jobApplicants }}
                                    </p>
                                    <div class="flex items-center gap-0.5">
                                        <img
                                            src="@/assets/images/icons/trend-up-dark-green-fill.svg"
                                            class="flex size-[18px] shrink-0"
                                            alt="Trend Up Icon"
                                        />
                                        <p
                                            class="font-medium text-sm text-desa-secondary"
                                        >
                                            <span class="text-desa-dark-green"
                                                >+12%</span
                                            >
                                            dari bulan sebelumnya
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <hr class="border-desa-foreshadow" />
                            <div class="flex flex-col gap-4 p-6">
                                <p
                                    class="font-semibold text-[20px] leading-[25px] text-left w-full"
                                >
                                    Applicant Terakhir
                                </p>

                                <ApplicantCard
                                    companyLogo="@/assets/images/thumbnails/PT Cingluh.jpg"
                                    applicantPhoto="@/assets/images/photos/kk-photo-1.png"
                                    applicantName="Fahmi"
                                    position="Melamar Operator Produksi PT.Cingluh"
                                    status="Menunggu"
                                />
                                <hr
                                    class="border-desa-foreshadow last-of-type:hidden"
                                />

                                <ApplicantCard
                                    companyLogo="@/assets/images/thumbnails/PT Mayora.jpg"
                                    applicantPhoto="@/assets/images/photos/kk-photo-2.png"
                                    applicantName="Mayang"
                                    position="Melamar Operator Produksi PT.Mayora"
                                    status="Diterima"
                                />
                                <hr
                                    class="border-desa-foreshadow last-of-type:hidden"
                                />

                                <ApplicantCard
                                    companyLogo="@/assets/images/thumbnails/PT Panarub.jpeg"
                                    applicantPhoto="@/assets/images/photos/kk-photo-3.png"
                                    applicantName="Sari"
                                    position="Melamar Operator produksi PT.Panarub"
                                    status="Ditolak"
                                />
                                <hr
                                    class="border-desa-foreshadow last-of-type:hidden"
                                />

                                <div
                                    class="hidden m-auto h-[280px] flex flex-col shrink-0 justify-center items-center gap-6"
                                >
                                    <img
                                        src="@/assets/images/icons/note-remove-secondary.svg"
                                        class="flex size-[52px] shrink-0"
                                        alt="No Applicants Icon"
                                    />
                                    <p
                                        class="font-medium leading-5 text-center text-desa-secondary"
                                    >
                                        Ups, nampaknya belum ada Applicant
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div
                            class="flex items-center justify-between h-[125px] rounded-2xl p-8 gap-4 gradient-horizontal"
                        >
                            <div class="flex flex-col gap-[6px]">
                                <p class="font-medium text-sm text-desa-lime">
                                    — Unduh Data Desa
                                </p>
                                <p
                                    class="font-semibold text-2xl text-white text-nowrap"
                                >
                                    Data Desa Terkini
                                </p>
                            </div>
                            <a
                                href="#"
                                class="flex items-center flex-nowrap rounded-2xl p-4 gap-[10px] bg-white"
                                aria-label="Download Laporan"
                            >
                                <span class="font-medium text-desa-dark-green"
                                    >Download Laporan</span
                                >
                                <img
                                    src="@/assets/images/icons/receive-square-dark-green.svg"
                                    class="flex size-6 shrink-0"
                                    alt=""
                                />
                            </a>
                        </div>
                    </section>
                    <section
                        id="statistik-Penduduk"
                        class="flex flex-col flex-1 shrink-0 gap-4 p-6 rounded-2xl bg-white"
                        role="region"
                        aria-labelledby="population-statistics-heading"
                    >
                        <h2 id="population-statistics-heading" class="sr-only">
                            Population Statistics
                        </h2>
                        <div class="flex items-center justify-between">
                            <p class="font-medium text-desa-secondary">
                                Statistics Penduduk
                            </p>
                            <img
                                src="@/assets/images/icons/profile-2user-foreshadow-background.svg"
                                class="flex size-12 shrink-0"
                                alt="Population Statistics Icon"
                            />
                        </div>

                        <PopulationChart />

                        <div class="flex flex-col gap-4">
                            <div class="flex items-center justify-between">
                                <div class="flex flex-col gap-1">
                                    <p class="font-medium leading-5 flex">
                                        <span
                                            class="block size-2 rounded-full my-auto bg-desa-dark-green mr-[6px]"
                                        ></span>
                                        Pria
                                    </p>
                                    <p
                                        class="font-medium text-sm text-desa-secondary"
                                    >
                                        Rentang usia: 32-36 tahun
                                    </p>
                                </div>
                                <p
                                    class="flex items-center font-medium leading-5"
                                >
                                    114.210
                                    <img
                                        src="@/assets/images/icons/user-black.svg"
                                        class="flex size-[18px] shrink-0 ml-0.5"
                                        alt="User Icon"
                                    />
                                </p>
                            </div>
                            <hr class="border-desa-foreshadow" />
                            <div class="flex items-center justify-between">
                                <div class="flex flex-col gap-1">
                                    <p class="font-medium leading-5 flex">
                                        <span
                                            class="block size-2 rounded-full my-auto bg-desa-soft-green mr-[6px]"
                                        ></span>
                                        Wanita
                                    </p>
                                    <p
                                        class="font-medium text-sm text-desa-secondary"
                                    >
                                        Rentang usia: 26-31 tahun
                                    </p>
                                </div>
                                <p
                                    class="flex items-center font-medium leading-5"
                                >
                                    97.200
                                    <img
                                        src="@/assets/images/icons/user-black.svg"
                                        class="flex size-[18px] shrink-0 ml-0.5"
                                        alt="User Icon"
                                    />
                                </p>
                            </div>
                            <hr class="border-desa-foreshadow" />
                            <div class="flex items-center justify-between">
                                <div class="flex flex-col gap-1">
                                    <p class="font-medium leading-5 flex">
                                        <span
                                            class="block size-2 rounded-full my-auto bg-desa-orange mr-[6px]"
                                        ></span>
                                        Anak-anak
                                    </p>
                                    <p
                                        class="font-medium text-sm text-desa-secondary"
                                    >
                                        Rentang usia: 6-12 tahun
                                    </p>
                                </div>
                                <p
                                    class="flex items-center font-medium leading-5"
                                >
                                    24.300
                                    <img
                                        src="@/assets/images/icons/user-black.svg"
                                        class="flex size-[18px] shrink-0 ml-0.5"
                                        alt="User Icon"
                                    />
                                </p>
                            </div>
                            <hr class="border-desa-foreshadow" />
                            <div class="flex items-center justify-between">
                                <div class="flex flex-col gap-1">
                                    <p class="font-medium leading-5 flex">
                                        <span
                                            class="block size-2 rounded-full my-auto bg-desa-yellow mr-[6px]"
                                        ></span>
                                        Balita
                                    </p>
                                    <p
                                        class="font-medium text-sm text-desa-secondary"
                                    >
                                        Rentang usia: 0-5 tahun
                                    </p>
                                </div>
                                <p
                                    class="flex items-center font-medium leading-5"
                                >
                                    7.290
                                    <img
                                        src="@/assets/images/icons/user-black.svg"
                                        class="flex size-[18px] shrink-0 ml-0.5"
                                        alt="User Icon"
                                    />
                                </p>
                            </div>
                        </div>
                    </section>
                </div>
            </div>
        </main>
    </div>
</template>
