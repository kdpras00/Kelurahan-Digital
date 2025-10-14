<script setup>
import { Head } from "@inertiajs/vue3";
import MainLayout from "@/layouts/Main.vue";

// Define props for event data
defineProps({
    event: {
        type: Object,
        default: () => ({
            id: 1,
            name: "Belajar HTML Dasar Bersama",
            thumbnail: "@/assets/images/thumbnails/kk-event-desa-1.png",
            price: 499000,
            participants: 15600,
            date: "Mon, 24 Feb 2025",
            time: "12:30 WIB",
            registrationStatus: "Open",
            description:
                "Belajar Teknologi untuk Masa Depan!Kepala desa mengundang seluruh warga untuk mengikuti acara Belajar HTML Dasar Bersama. Dalam acara ini, kita akan:\n- Mengenal dasar-dasar HTML sebagai langkah awal membuat website.\n- Belajar struktur sederhana halaman web.\n- Mencoba langsung membuat halaman web bersama\nMulailah perjalanan Anda untuk memahami elemen-elemen penting HTML, praktik langsung, dan temukan bagaimana teknologi ini membuka peluang baru. Jangan lupa untuk terus berlatih agar semakin mahir!",
        }),
    },
    participants: {
        type: Array,
        default: () => [
            {
                id: 1,
                name: "Nabila Reyna R",
                occupation: "Freelancer",
                photo: "@/assets/images/photos/kk-photo-1.png",
            },
            {
                id: 2,
                name: "Turaf Lintang G",
                occupation: "Kuli Bangunan",
                photo: "@/assets/images/photos/kk-photo-2.png",
            },
            {
                id: 3,
                name: "Monte Garry Ichsan",
                occupation: "Kuli Bangunan",
                photo: "@/assets/images/photos/kk-photo-3.png",
            },
            {
                id: 4,
                name: "Uzumaki Bimore",
                occupation: "Kuli Bangunan",
                photo: "@/assets/images/photos/kk-photo-4.png",
            },
            {
                id: 5,
                name: "Feri Prio Utomo",
                occupation: "Kuli Bangunan",
                photo: "@/assets/images/photos/kk-photo-5.png",
            },
        ],
    },
});
</script>

<template>
    <Head title="Detail Event Desa" />
    <MainLayout>
        <div
            id="Content"
            class="relative flex flex-col flex-1 gap-6 p-6 pb-[30px] w-full shrink-0"
        >
            <div id="Header" class="flex items-center justify-between">
                <div class="flex flex-col gap-2">
                    <div
                        class="flex gap-1 items-center leading-5 text-desa-secondary"
                    >
                        <p
                            class="last-of-type:text-desa-dark-green last-of-type:font-semibold capitalize"
                        >
                            Events desa
                        </p>
                        <span>/</span>
                        <p
                            class="last-of-type:text-desa-dark-green last-of-type:font-semibold capitalize"
                        >
                            Detail Event Desa
                        </p>
                    </div>
                    <h1 class="font-semibold text-2xl">Detail Event Desa</h1>
                </div>
                <a
                    href="/jadwal-desa/events/edit"
                    class="flex items-center rounded-2xl py-4 px-6 gap-[10px] bg-desa-black"
                >
                    <p class="font-medium text-white">Ubah Data</p>
                    <img
                        src="@/assets/images/icons/edit-white.svg"
                        class="flex size-6 shrink-0"
                        alt="icon"
                    />
                </a>
            </div>
            <div class="flex gap-[14px]">
                <section
                    id="Informasi"
                    class="flex flex-col shrink-0 w-[calc(525/1000*100%)] h-fit rounded-3xl p-6 gap-6 bg-white"
                >
                    <p class="font-medium leading-5 text-desa-secondary">
                        Informasi Event
                    </p>
                    <div class="flex items-center w-full">
                        <div
                            class="flex w-[100px] h-20 shrink-0 rounded-2xl overflow-hidden bg-desa-foreshadow"
                        >
                            <img
                                :src="event.thumbnail"
                                class="w-full h-full object-cover"
                                :alt="event.name"
                            />
                        </div>
                        <div class="flex flex-col gap-[6px] w-full ml-4 mr-9">
                            <p
                                class="font-semibold text-lg leading-[22.5px] line-clamp-1"
                            >
                                {{ event.name }}
                            </p>
                            <div class="flex items-center gap-1">
                                <img
                                    src="@/assets/images/icons/ticket-secondary-green.svg"
                                    class="flex size-[18px] shrink-0"
                                    alt="icon"
                                />
                                <p
                                    class="font-medium text-sm text-desa-secondary"
                                >
                                    Registration:
                                    <span
                                        class="font-medium text-base text-desa-dark-green"
                                    >
                                        {{ event.registrationStatus }}
                                    </span>
                                </p>
                            </div>
                        </div>
                    </div>
                    <hr class="border-desa-foreshadow" />
                    <div class="flex items-center w-full gap-3">
                        <div
                            class="flex size-[52px] shrink-0 rounded-2xl bg-desa-red/10 items-center justify-center"
                        >
                            <img
                                src="@/assets/images/icons/ticket-2-red.svg"
                                class="flex size-6 shrink-0"
                                alt="icon"
                            />
                        </div>
                        <div class="flex flex-col gap-1 w-full">
                            <p
                                class="font-semibold text-lg leading-[22.5px] text-desa-red"
                            >
                                Rp{{ event.price.toLocaleString("id-ID") }}
                            </p>
                            <span class="font-medium text-desa-secondary">
                                Harga Event
                            </span>
                        </div>
                    </div>
                    <hr class="border-desa-foreshadow" />
                    <div class="flex items-center w-full gap-3">
                        <div
                            class="flex size-[52px] shrink-0 rounded-2xl bg-desa-blue/10 items-center justify-center"
                        >
                            <img
                                src="@/assets/images/icons/profile-2user-blue.svg"
                                class="flex size-6 shrink-0"
                                alt="icon"
                            />
                        </div>
                        <div class="flex flex-col gap-1 w-full">
                            <p
                                class="font-semibold text-lg leading-[22.5px] text-desa-blue"
                            >
                                {{
                                    event.participants.toLocaleString("id-ID")
                                }}
                                Warga
                            </p>
                            <span class="font-medium text-desa-secondary">
                                Total Partisipasi
                            </span>
                        </div>
                    </div>
                    <hr class="border-desa-foreshadow" />
                    <div class="flex items-center w-full gap-3">
                        <div
                            class="flex size-[52px] shrink-0 rounded-2xl bg-desa-foreshadow items-center justify-center"
                        >
                            <img
                                src="@/assets/images/icons/calendar-2-dark-green.svg"
                                class="flex size-6 shrink-0"
                                alt="icon"
                            />
                        </div>
                        <div class="flex flex-col gap-1 w-full">
                            <p
                                class="font-semibold text-lg leading-[22.5px] text-desa-dark-green"
                            >
                                {{ event.date }}
                            </p>
                            <span class="font-medium text-desa-secondary">
                                Tanggal Pelaksaaan
                            </span>
                        </div>
                    </div>
                    <hr class="border-desa-foreshadow" />
                    <div class="flex items-center w-full gap-3">
                        <div
                            class="flex size-[52px] shrink-0 rounded-2xl bg-desa-yellow/10 items-center justify-center"
                        >
                            <img
                                src="@/assets/images/icons/clock-yellow.svg"
                                class="flex size-6 shrink-0"
                                alt="icon"
                            />
                        </div>
                        <div class="flex flex-col gap-1 w-full">
                            <p
                                class="font-semibold text-lg leading-[22.5px] text-desa-yellow"
                            >
                                {{ event.time }}
                            </p>
                            <span class="font-medium text-desa-secondary">
                                Tanggal Pelaksaaan
                            </span>
                        </div>
                    </div>
                    <hr class="border-desa-foreshadow" />
                    <div class="flex flex-col gap-3">
                        <p class="font-medium text-sm text-desa-secondary">
                            Tentang Event
                        </p>
                        <p class="font-medium leading-8 whitespace-pre-line">
                            {{ event.description }}
                        </p>
                    </div>
                </section>
                <section
                    id="Participants"
                    class="flex flex-col flex-1 h-fit shrink-0 rounded-3xl p-6 gap-6 bg-white"
                >
                    <p class="font-medium leading-5 text-desa-secondary">
                        Latest Participants
                    </p>
                    <div class="flex flex-col gap-[14px]">
                        <div
                            v-for="participant in participants"
                            :key="participant.id"
                            class="flex items-center gap-3 w-[302px] shrink-0"
                        >
                            <div
                                class="flex size-[54px] rounded-full bg-desa-foreshadow overflow-hidden"
                            >
                                <img
                                    :src="participant.photo"
                                    class="w-full h-full object-cover"
                                    :alt="participant.name"
                                />
                            </div>
                            <div class="flex flex-col gap-1">
                                <p
                                    class="font-semibold text-lg leading-5 text-desa-black"
                                >
                                    {{ participant.name }}
                                </p>
                                <p class="flex items-center gap-1">
                                    <img
                                        src="@/assets/images/icons/briefcase-secondary-green.svg"
                                        class="flex size-[18px] shrink-0"
                                        alt="icon"
                                    />
                                    <span
                                        class="font-medium text-sm text-desa-secondary"
                                        >{{ participant.occupation }}</span
                                    >
                                </p>
                            </div>
                        </div>
                        <hr class="border-desa-background" />
                    </div>
                    <a
                        href="#"
                        class="flex items-center justify-center h-14 rounded-2xl py-4 px-6 gap-[10px] bg-desa-dark-green"
                    >
                        <span class="font-medium leading-5 text-white"
                            >View All</span
                        >
                    </a>
                </section>
            </div>
        </div>
    </MainLayout>
</template>
