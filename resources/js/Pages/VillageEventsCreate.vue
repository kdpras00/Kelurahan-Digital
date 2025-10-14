<script setup>
import { Head } from "@inertiajs/vue3";
import MainLayout from "@/layouts/Main.vue";
</script>

<template>
    <Head title="Tambah Event Desa" />
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
                            Tambah Event Desa
                        </p>
                    </div>
                    <h1 class="font-semibold text-2xl">Tambah Event Desa</h1>
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
                                        class="flex w-[100px] h-20 shrink-0 rounded-2xl overflow-hidden bg-desa-foreshadow border-2 border-dashed border-desa-secondary"
                                    ></div>
                                    <button
                                        class="flex items-center rounded-2xl py-4 px-6 gap-[10px] bg-desa-dark-green"
                                    >
                                        <p class="font-medium text-white">
                                            Pilih Foto
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
                                placeholder="Masukkan nama event"
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
                                    placeholder="Masukkan harga event"
                                    class="appearance-none outline-none w-full h-14 rounded-2xl ring-[1.5px] ring-desa-background focus:ring-desa-black py-4 px-6 gap-2 font-medium placeholder:text-desa-secondary transition-all duration-300"
                                />
                            </div>
                            <div class="flex flex-col gap-3">
                                <label class="font-medium text-desa-secondary"
                                    >Tanggal Pelaksanaan</label
                                >
                                <input
                                    type="date"
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
                                    <option value="Open">Open</option>
                                    <option value="Closed">Closed</option>
                                </select>
                            </div>
                        </div>
                        <hr class="border-desa-foreshadow" />
                        <div class="flex flex-col gap-3">
                            <label class="font-medium text-desa-secondary"
                                >Deskripsi Event</label
                            >
                            <textarea
                                placeholder="Masukkan deskripsi event"
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
                        <p class="font-medium text-white">Simpan Event</p>
                    </button>
                </div>
            </div>
        </div>
    </MainLayout>
</template>
