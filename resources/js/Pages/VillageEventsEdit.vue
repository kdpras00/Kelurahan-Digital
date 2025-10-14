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
});
</script>

<template>
    <Head title="Edit Event Desa" />
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
                            Edit Event Desa
                        </p>
                    </div>
                    <h1 class="font-semibold text-2xl">Edit Event Desa</h1>
                </div>
                <a
                    href="/jadwal-desa/events"
                    class="flex items-center rounded-2xl py-4 px-6 gap-[10px] bg-desa-black"
                >
                    <p class="font-medium text-white">Kembali</p>
                </a>
            </div>
            <div class="flex flex-col gap-[14px]">
                <section
                    id="Informasi"
                    class="flex flex-col rounded-3xl p-6 gap-6 bg-white"
                >
                    <p class="font-medium leading-5 text-desa-secondary">
                        Informasi Event
                    </p>
                    <div class="flex flex-col gap-4">
                        <div class="flex items-center w-full gap-3">
                            <div
                                class="flex size-[52px] shrink-0 rounded-2xl bg-desa-foreshadow items-center justify-center"
                            >
                                <img
                                    src="@/assets/images/icons/gallery-secondary-green.svg"
                                    class="flex size-6 shrink-0"
                                    alt="icon"
                                />
                            </div>
                            <div class="flex flex-col gap-1 w-full">
                                <p class="font-medium text-desa-secondary">
                                    Thumbnail Event
                                </p>
                                <div class="flex items-center gap-3">
                                    <div
                                        class="flex w-[100px] h-20 shrink-0 rounded-2xl overflow-hidden bg-desa-foreshadow"
                                    >
                                        <img
                                            :src="event.thumbnail"
                                            class="w-full h-full object-cover"
                                            :alt="event.name"
                                        />
                                    </div>
                                    <button
                                        class="flex items-center rounded-2xl py-4 px-6 gap-[10px] bg-desa-dark-green"
                                    >
                                        <p class="font-medium text-white">
                                            Ubah Foto
                                        </p>
                                    </button>
                                </div>
                            </div>
                        </div>
                        <hr class="border-desa-foreshadow" />
                        <div class="flex flex-col gap-3">
                            <label class="font-medium text-desa-secondary"
                                >Nama Event</label
                            >
                            <input
                                type="text"
                                :value="event.name"
                                class="appearance-none outline-none w-full h-14 rounded-2xl ring-[1.5px] ring-desa-background focus:ring-desa-black py-4 px-6 gap-2 font-medium placeholder:text-desa-secondary transition-all duration-300"
                            />
                        </div>
                        <hr class="border-desa-foreshadow" />
                        <div class="grid grid-cols-2 gap-3">
                            <div class="flex flex-col gap-3">
                                <label class="font-medium text-desa-secondary"
                                    >Harga Event (Rp)</label
                                >
                                <input
                                    type="number"
                                    :value="event.price"
                                    class="appearance-none outline-none w-full h-14 rounded-2xl ring-[1.5px] ring-desa-background focus:ring-desa-black py-4 px-6 gap-2 font-medium placeholder:text-desa-secondary transition-all duration-300"
                                />
                            </div>
                            <div class="flex flex-col gap-3">
                                <label class="font-medium text-desa-secondary"
                                    >Tanggal Pelaksanaan</label
                                >
                                <input
                                    type="date"
                                    :value="event.date"
                                    class="appearance-none outline-none w-full h-14 rounded-2xl ring-[1.5px] ring-desa-background focus:ring-desa-black py-4 px-6 gap-2 font-medium placeholder:text-desa-secondary transition-all duration-300"
                                />
                            </div>
                        </div>
                        <hr class="border-desa-foreshadow" />
                        <div class="grid grid-cols-2 gap-3">
                            <div class="flex flex-col gap-3">
                                <label class="font-medium text-desa-secondary"
                                    >Waktu Pelaksanaan</label
                                >
                                <input
                                    type="time"
                                    :value="event.time"
                                    class="appearance-none outline-none w-full h-14 rounded-2xl ring-[1.5px] ring-desa-background focus:ring-desa-black py-4 px-6 gap-2 font-medium placeholder:text-desa-secondary transition-all duration-300"
                                />
                            </div>
                            <div class="flex flex-col gap-3">
                                <label class="font-medium text-desa-secondary"
                                    >Status Registrasi</label
                                >
                                <select
                                    class="appearance-none outline-none w-full h-14 rounded-2xl ring-[1.5px] ring-desa-background focus:ring-desa-black py-4 px-6 gap-2 font-medium placeholder:text-desa-secondary transition-all duration-300"
                                >
                                    <option
                                        value="Open"
                                        :selected="
                                            event.registrationStatus === 'Open'
                                        "
                                    >
                                        Open
                                    </option>
                                    <option
                                        value="Closed"
                                        :selected="
                                            event.registrationStatus ===
                                            'Closed'
                                        "
                                    >
                                        Closed
                                    </option>
                                </select>
                            </div>
                        </div>
                        <hr class="border-desa-foreshadow" />
                        <div class="flex flex-col gap-3">
                            <label class="font-medium text-desa-secondary"
                                >Deskripsi Event</label
                            >
                            <textarea
                                :value="event.description"
                                rows="5"
                                class="appearance-none outline-none w-full rounded-2xl ring-[1.5px] ring-desa-background focus:ring-desa-black py-4 px-6 gap-2 font-medium placeholder:text-desa-secondary transition-all duration-300"
                            ></textarea>
                        </div>
                    </div>
                </section>
                <div class="flex items-center justify-end gap-3">
                    <a
                        href="/jadwal-desa/events"
                        class="flex items-center rounded-2xl py-4 px-6 gap-[10px] border border-desa-background"
                    >
                        <p class="font-medium text-desa-black">Batal</p>
                    </a>
                    <button
                        class="flex items-center rounded-2xl py-4 px-6 gap-[10px] bg-desa-dark-green"
                    >
                        <p class="font-medium text-white">Simpan Perubahan</p>
                    </button>
                </div>
            </div>
        </div>
    </MainLayout>
</template>
