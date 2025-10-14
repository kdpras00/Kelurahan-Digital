<script setup>
import { Head } from "@inertiajs/vue3";
import MainLayout from "@/layouts/Main.vue";
import { Link } from "@inertiajs/vue3";

defineProps({
    // Add any props you need here
});
</script>

<template>
    <Head title="List Bantuan Sosial" />
    <MainLayout>
        <div
            id="Content"
            class="relative flex flex-col flex-1 gap-6 p-6 pb-[30px] w-full shrink-0"
        >
            <div id="Header" class="flex items-center justify-between">
                <h1 class="font-semibold text-2xl">List Bantuan Sosial</h1>
                <Link
                    href="/bantuan-sosial/add"
                    class="flex items-center rounded-2xl py-4 px-6 gap-[10px] bg-desa-dark-green"
                >
                    <img
                        src="@/assets/images/icons/add-square-white.svg"
                        class="flex size-6 shrink-0"
                        alt="icon"
                    />
                    <p class="font-medium text-white">Add New</p>
                </Link>
            </div>
            <section id="List-Bantuan-Sosial" class="flex flex-col gap-[14px]">
                <form
                    id="Page-Search"
                    class="flex items-center justify-between"
                >
                    <div class="flex flex-col gap-3 w-[370px] shrink-0">
                        <label class="relative group peer w-full valid">
                            <input
                                type="text"
                                placeholder="Cari nama bantuan social"
                                class="appearance-none outline-none w-full h-14 rounded-2xl ring-[1.5px] ring-desa-background focus:ring-desa-black py-4 pl-12 pr-6 gap-2 font-medium placeholder:text-desa-secondary transition-all duration-300"
                            />
                            <div
                                class="absolute transform -translate-y-1/2 top-1/2 left-4 flex size-6 shrink-0"
                            >
                                <img
                                    src="@/assets/images/icons/receipt-search-secondary-green.svg"
                                    class="size-6 hidden group-has-[:placeholder-shown]:flex"
                                    alt="icon"
                                />
                                <img
                                    src="@/assets/images/icons/receipt-search-black.svg"
                                    class="size-6 flex group-has-[:placeholder-shown]:hidden"
                                    alt="icon"
                                />
                            </div>
                        </label>
                    </div>
                    <div class="options flex items-center gap-4">
                        <div class="flex items-center gap-[10px]">
                            <span class="font-medium leading-5">Show</span>
                            <div class="relative">
                                <select
                                    name=""
                                    id=""
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
                                    src="@/assets/images/icons/arrow-down-black.svg"
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
                                src="@/assets/images/icons/filter-black.svg"
                                class="flex size-6 shrink-0"
                                alt="icon"
                            />
                            <span class="font-medium leading-5">Filter</span>
                        </button>
                    </div>
                </form>
                <div class="card flex flex-col gap-6 rounded-3xl p-6 bg-white">
                    <div class="flex items-center w-full">
                        <div
                            class="flex w-[100px] h-20 shrink-0 rounded-2xl overflow-hidden bg-desa-foreshadow"
                        >
                            <img
                                src="@/assets/images/thumbnails/bantuan_uang.jpg"
                                class="w-full h-full object-cover"
                                alt="photo"
                            />
                        </div>
                        <div class="flex flex-col gap-[6px] w-full ml-4 mr-9">
                            <p
                                class="font-semibold text-lg leading-[22.5px] line-clamp-1"
                            >
                                Bantuan Untuk Rakyat Kurang Mampu
                            </p>
                            <p class="flex items-center gap-1">
                                <img
                                    src="@/assets/images/icons/profile-secondary-green.svg"
                                    class="flex size-[18px] shrink-0"
                                    alt="icon"
                                />
                                <span
                                    class="font-medium text-sm text-desa-secondary"
                                    >PT Shaynakit Meningkatkan Bangsa</span
                                >
                            </p>
                        </div>
                        <Link
                            href="/bantuan-sosial/1"
                            class="flex items-center shrink-0 gap-[10px] rounded-2xl py-4 px-6 bg-desa-black"
                        >
                            <span class="font-medium text-white">Manage</span>
                        </Link>
                    </div>
                    <hr class="border-desa-background" />
                    <div class="grid grid-cols-3 gap-3">
                        <div class="flex items-center gap-3">
                            <div
                                class="flex size-[52px] rounded-2xl items-center justify-center bg-desa-foreshadow overflow-hidden"
                            >
                                <img
                                    src="@/assets/images/icons/money-dark-green.svg"
                                    class="flex size-6 shrink-0"
                                    alt="icon"
                                />
                            </div>
                            <div class="flex flex-col gap-1">
                                <p
                                    class="font-semibold text-lg leading-5 text-desa-dark-green"
                                >
                                    Rp120.000.000
                                </p>
                                <p
                                    class="font-medium text-sm text-desa-secondary"
                                >
                                    Uang Tunai
                                </p>
                            </div>
                        </div>
                        <div class="flex items-center gap-3">
                            <div
                                class="flex size-[52px] rounded-2xl items-center justify-center bg-desa-blue/10 overflow-hidden"
                            >
                                <img
                                    src="@/assets/images/icons/profile-2user-blue.svg"
                                    class="flex size-6 shrink-0"
                                    alt="icon"
                                />
                            </div>
                            <div class="flex flex-col gap-1">
                                <p
                                    class="font-semibold text-lg leading-5 text-desa-blue"
                                >
                                    15.600 Warga
                                </p>
                                <p
                                    class="font-medium text-sm text-desa-secondary"
                                >
                                    Total Pengajuan
                                </p>
                            </div>
                        </div>
                        <div class="flex items-center gap-3">
                            <div
                                class="flex size-[52px] rounded-2xl items-center justify-center bg-desa-red/10 overflow-hidden"
                            >
                                <img
                                    src="@/assets/images/icons/minus-square-red.svg"
                                    class="flex size-6 shrink-0"
                                    alt="icon"
                                />
                            </div>
                            <div class="flex flex-col gap-1">
                                <p
                                    class="font-semibold text-lg leading-5 text-desa-red"
                                >
                                    Tidak Tersedia
                                </p>
                                <p
                                    class="font-medium text-sm text-desa-secondary"
                                >
                                    Status Bansos
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card flex flex-col gap-6 rounded-3xl p-6 bg-white">
                    <div class="flex items-center w-full">
                        <div
                            class="flex w-[100px] h-20 shrink-0 rounded-2xl overflow-hidden bg-desa-foreshadow"
                        >
                            <img
                                src="@/assets/images/thumbnails/bantuan_beras.jpg"
                                class="w-full h-full object-cover"
                                alt="photo"
                            />
                        </div>
                        <div class="flex flex-col gap-[6px] w-full ml-4 mr-9">
                            <p
                                class="font-semibold text-lg leading-[22.5px] line-clamp-1"
                            >
                                Peduli Sesama: Penyaluran Beras untuk Warga Desa
                            </p>
                            <p class="flex items-center gap-1">
                                <img
                                    src="@/assets/images/icons/profile-secondary-green.svg"
                                    class="flex size-[18px] shrink-0"
                                    alt="icon"
                                />
                                <span
                                    class="font-medium text-sm text-desa-secondary"
                                    >PT Angga Membangun Indonesia</span
                                >
                            </p>
                        </div>
                        <Link
                            href="/bantuan-sosial/2"
                            class="flex items-center shrink-0 gap-[10px] rounded-2xl py-4 px-6 bg-desa-black"
                        >
                            <span class="font-medium text-white">Manage</span>
                        </Link>
                    </div>
                    <hr class="border-desa-background" />
                    <div class="grid grid-cols-3 gap-3">
                        <div class="flex items-center gap-3">
                            <div
                                class="flex size-[52px] rounded-2xl items-center justify-center bg-desa-foreshadow overflow-hidden"
                            >
                                <img
                                    src="@/assets/images/icons/bag-2-dark-green.svg"
                                    class="flex size-6 shrink-0"
                                    alt="icon"
                                />
                            </div>
                            <div class="flex flex-col gap-1">
                                <p
                                    class="font-semibold text-lg leading-5 text-desa-dark-green"
                                >
                                    Beras 20 ton
                                </p>
                                <p
                                    class="font-medium text-sm text-desa-secondary"
                                >
                                    Bahan Pokok
                                </p>
                            </div>
                        </div>
                        <div class="flex items-center gap-3">
                            <div
                                class="flex size-[52px] rounded-2xl items-center justify-center bg-desa-blue/10 overflow-hidden"
                            >
                                <img
                                    src="@/assets/images/icons/profile-2user-blue.svg"
                                    class="flex size-6 shrink-0"
                                    alt="icon"
                                />
                            </div>
                            <div class="flex flex-col gap-1">
                                <p
                                    class="font-semibold text-lg leading-5 text-desa-blue"
                                >
                                    15.600 Warga
                                </p>
                                <p
                                    class="font-medium text-sm text-desa-secondary"
                                >
                                    Total Pengajuan
                                </p>
                            </div>
                        </div>
                        <div class="flex items-center gap-3">
                            <div
                                class="flex size-[52px] rounded-2xl items-center justify-center bg-desa-foreshadow overflow-hidden"
                            >
                                <img
                                    src="@/assets/images/icons/tick-square-dark-green.svg"
                                    class="flex size-6 shrink-0"
                                    alt="icon"
                                />
                            </div>
                            <div class="flex flex-col gap-1">
                                <p
                                    class="font-semibold text-lg leading-5 text-desa-dark-green"
                                >
                                    Tersedia
                                </p>
                                <p
                                    class="font-medium text-sm text-desa-secondary"
                                >
                                    Status Bansos
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card flex flex-col gap-6 rounded-3xl p-6 bg-white">
                    <div class="flex items-center w-full">
                        <div
                            class="flex w-[100px] h-20 shrink-0 rounded-2xl overflow-hidden bg-desa-foreshadow"
                        >
                            <img
                                src="@/assets/images/thumbnails/bantuan_nutrisi.jpg"
                                class="w-full h-full object-cover"
                                alt="photo"
                            />
                        </div>
                        <div class="flex flex-col gap-[6px] w-full ml-4 mr-9">
                            <p
                                class="font-semibold text-lg leading-[22.5px] line-clamp-1"
                            >
                                Mendukung Pertumbuhan Anak dengan Nutrisi
                                Terbaik
                            </p>
                            <p class="flex items-center gap-1">
                                <img
                                    src="@/assets/images/icons/milk-dark-green.svg"
                                    class="flex size-6 shrink-0"
                                    alt="icon"
                                />
                                <span
                                    class="font-medium text-sm text-desa-secondary"
                                    >PT Peternakan Sapi Bimore</span
                                >
                            </p>
                        </div>
                        <Link
                            href="/bantuan-sosial/3"
                            class="flex items-center shrink-0 gap-[10px] rounded-2xl py-4 px-6 bg-desa-black"
                        >
                            <span class="font-medium text-white">Manage</span>
                        </Link>
                    </div>
                    <hr class="border-desa-background" />
                    <div class="grid grid-cols-3 gap-3">
                        <div class="flex items-center gap-3">
                            <div
                                class="flex size-[52px] rounded-2xl items-center justify-center bg-desa-foreshadow overflow-hidden"
                            >
                                <img
                                    src="@/assets/images/icons/milk-dark-green.svg"
                                    class="flex size-6 shrink-0"
                                    alt="icon"
                                />
                            </div>
                            <div class="flex flex-col gap-1">
                                <p
                                    class="font-semibold text-lg leading-5 text-desa-dark-green"
                                >
                                    Susu 9.000 ml
                                </p>
                                <p
                                    class="font-medium text-sm text-desa-secondary"
                                >
                                    Bahan Pokok
                                </p>
                            </div>
                        </div>
                        <div class="flex items-center gap-3">
                            <div
                                class="flex size-[52px] rounded-2xl items-center justify-center bg-desa-blue/10 overflow-hidden"
                            >
                                <img
                                    src="@/assets/images/icons/profile-2user-blue.svg"
                                    class="flex size-6 shrink-0"
                                    alt="icon"
                                />
                            </div>
                            <div class="flex flex-col gap-1">
                                <p
                                    class="font-semibold text-lg leading-5 text-desa-blue"
                                >
                                    15.600 Warga
                                </p>
                                <p
                                    class="font-medium text-sm text-desa-secondary"
                                >
                                    Total Pengajuan
                                </p>
                            </div>
                        </div>
                        <div class="flex items-center gap-3">
                            <div
                                class="flex size-[52px] rounded-2xl items-center justify-center bg-desa-foreshadow overflow-hidden"
                            >
                                <img
                                    src="@/assets/images/icons/tick-square-dark-green.svg"
                                    class="flex size-6 shrink-0"
                                    alt="icon"
                                />
                            </div>
                            <div class="flex flex-col gap-1">
                                <p
                                    class="font-semibold text-lg leading-5 text-desa-dark-green"
                                >
                                    Tersedia
                                </p>
                                <p
                                    class="font-medium text-sm text-desa-secondary"
                                >
                                    Status Bansos
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card flex flex-col gap-6 rounded-3xl p-6 bg-white">
                    <div class="flex items-center w-full">
                        <div
                            class="flex w-[100px] h-20 shrink-0 rounded-2xl overflow-hidden bg-desa-foreshadow"
                        >
                            <img
                                src="@/assets/images/thumbnails/bantuan_yatim_piatu.jpg"
                                class="w-full h-full object-cover"
                                alt="photo"
                            />
                        </div>
                        <div class="flex flex-col gap-[6px] w-full ml-4 mr-9">
                            <p
                                class="font-semibold text-lg leading-[22.5px] line-clamp-1"
                            >
                                Santunan Yatim Piatu: Bantuan santunan kepada
                                anak yatim piatu
                            </p>
                            <p class="flex items-center gap-1">
                                <img
                                    src="@/assets/images/icons/profile-secondary-green.svg"
                                    class="flex size-[18px] shrink-0"
                                    alt="icon"
                                />
                                <span
                                    class="font-medium text-sm text-desa-secondary"
                                    >PT Masayoshi Membangun Indonesia</span
                                >
                            </p>
                        </div>
                        <Link
                            href="/bantuan-sosial/4"
                            class="flex items-center shrink-0 gap-[10px] rounded-2xl py-4 px-6 bg-desa-black"
                        >
                            <span class="font-medium text-white">Manage</span>
                        </Link>
                    </div>
                    <hr class="border-desa-background" />
                    <div class="grid grid-cols-3 gap-3">
                        <div class="flex items-center gap-3">
                            <div
                                class="flex size-[52px] rounded-2xl items-center justify-center bg-desa-foreshadow overflow-hidden"
                            >
                                <img
                                    src="@/assets/images/icons/money-dark-green.svg"
                                    class="flex size-6 shrink-0"
                                    alt="icon"
                                />
                            </div>
                            <div class="flex flex-col gap-1">
                                <p
                                    class="font-semibold text-lg leading-5 text-desa-dark-green"
                                >
                                    Rp200.000.000
                                </p>
                                <p
                                    class="font-medium text-sm text-desa-secondary"
                                >
                                    Uang Tunai
                                </p>
                            </div>
                        </div>
                        <div class="flex items-center gap-3">
                            <div
                                class="flex size-[52px] rounded-2xl items-center justify-center bg-desa-blue/10 overflow-hidden"
                            >
                                <img
                                    src="@/assets/images/icons/profile-2user-blue.svg"
                                    class="flex size-6 shrink-0"
                                    alt="icon"
                                />
                            </div>
                            <div class="flex flex-col gap-1">
                                <p
                                    class="font-semibold text-lg leading-5 text-desa-blue"
                                >
                                    15.600 Warga
                                </p>
                                <p
                                    class="font-medium text-sm text-desa-secondary"
                                >
                                    Total Pengajuan
                                </p>
                            </div>
                        </div>
                        <div class="flex items-center gap-3">
                            <div
                                class="flex size-[52px] rounded-2xl items-center justify-center bg-desa-foreshadow overflow-hidden"
                            >
                                <img
                                    src="@/assets/images/icons/tick-square-dark-green.svg"
                                    class="flex size-6 shrink-0"
                                    alt="icon"
                                />
                            </div>
                            <div class="flex flex-col gap-1">
                                <p
                                    class="font-semibold text-lg leading-5 text-desa-dark-green"
                                >
                                    Tersedia
                                </p>
                                <p
                                    class="font-medium text-sm text-desa-secondary"
                                >
                                    Status Bansos
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card flex flex-col gap-6 rounded-3xl p-6 bg-white">
                    <div class="flex items-center w-full">
                        <div
                            class="flex w-[100px] h-20 shrink-0 rounded-2xl overflow-hidden bg-desa-foreshadow"
                        >
                            <img
                                src="@/assets/images/thumbnails/bantuan_minyak.jpg"
                                class="w-full h-full object-cover"
                                alt="photo"
                            />
                        </div>
                        <div class="flex flex-col gap-[6px] w-full ml-4 mr-9">
                            <p
                                class="font-semibold text-lg leading-[22.5px] line-clamp-1"
                            >
                                Bantuan Sembako: Memberikan bantuan sembako
                                minyak goreng kepada warga
                            </p>
                            <p class="flex items-center gap-1">
                                <img
                                    src="@/assets/images/icons/profile-secondary-green.svg"
                                    class="flex size-[18px] shrink-0"
                                    alt="icon"
                                />
                                <span
                                    class="font-medium text-sm text-desa-secondary"
                                    >PT Masayoshi Membangun Indonesia</span
                                >
                            </p>
                        </div>
                        <Link
                            href="/bantuan-sosial/5"
                            class="flex items-center shrink-0 gap-[10px] rounded-2xl py-4 px-6 bg-desa-black"
                        >
                            <span class="font-medium text-white">Manage</span>
                        </Link>
                    </div>
                    <hr class="border-desa-background" />
                    <div class="grid grid-cols-3 gap-3">
                        <div class="flex items-center gap-3">
                            <div
                                class="flex size-[52px] rounded-2xl items-center justify-center bg-desa-foreshadow overflow-hidden"
                            >
                                <img
                                    src="@/assets/images/icons/bag-2-dark-green.svg"
                                    class="flex size-6 shrink-0"
                                    alt="icon"
                                />
                            </div>
                            <div class="flex flex-col gap-1">
                                <p
                                    class="font-semibold text-lg leading-5 text-desa-dark-green"
                                >
                                    Minyak Goreng 1 kg
                                </p>
                                <p
                                    class="font-medium text-sm text-desa-secondary"
                                >
                                    Bahan Pokok
                                </p>
                            </div>
                        </div>
                        <div class="flex items-center gap-3">
                            <div
                                class="flex size-[52px] rounded-2xl items-center justify-center bg-desa-blue/10 overflow-hidden"
                            >
                                <img
                                    src="@/assets/images/icons/profile-2user-blue.svg"
                                    class="flex size-6 shrink-0"
                                    alt="icon"
                                />
                            </div>
                            <div class="flex flex-col gap-1">
                                <p
                                    class="font-semibold text-lg leading-5 text-desa-blue"
                                >
                                    15.600 Warga
                                </p>
                                <p
                                    class="font-medium text-sm text-desa-secondary"
                                >
                                    Total Pengajuan
                                </p>
                            </div>
                        </div>
                        <div class="flex items-center gap-3">
                            <div
                                class="flex size-[52px] rounded-2xl items-center justify-center bg-desa-foreshadow overflow-hidden"
                            >
                                <img
                                    src="@/assets/images/icons/tick-square-dark-green.svg"
                                    class="flex size-6 shrink-0"
                                    alt="icon"
                                />
                            </div>
                            <div class="flex flex-col gap-1">
                                <p
                                    class="font-semibold text-lg leading-5 text-desa-dark-green"
                                >
                                    Tersedia
                                </p>
                                <p
                                    class="font-medium text-sm text-desa-secondary"
                                >
                                    Status Bansos
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <nav id="Pagination">
                <ul class="flex items-center gap-3">
                    <li class="group">
                        <button
                            type="button"
                            disabled
                            class="group/arrow flex size-11 shrink-0 items-center justify-center rounded-full bg-desa-foreshadow disabled:!bg-desa-foreshadow group-hover:bg-desa-dark-green transition-setup"
                        >
                            <img
                                src="@/assets/images/icons/arrow-left-dark-green.svg"
                                class="flex size-6 shrink-0 group-hover:hidden group-disabled/arrow:!hidden"
                                alt="icon"
                            />
                            <img
                                src="@/assets/images/icons/arrow-left-foreshadow.svg"
                                class="hidden size-6 shrink-0 group-hover:flex group-disabled/arrow:!hidden"
                                alt="icon"
                            />
                            <img
                                src="@/assets/images/icons/disabled-arrow-pagination.svg"
                                class="hidden size-6 shrink-0 group-disabled/arrow:!flex"
                                alt="icon"
                            />
                        </button>
                    </li>
                    <li class="group active">
                        <a
                            class="flex size-11 shrink-0 items-center justify-center rounded-full bg-desa-foreshadow group-hover:bg-desa-dark-green group-[.active]:bg-desa-dark-green transition-setup"
                        >
                            <span
                                class="text-desa-dark-green font-semibold group-[.active]:text-desa-foreshadow group-hover:text-desa-foreshadow transition-setup"
                            >
                                1
                            </span>
                        </a>
                    </li>
                    <li class="group">
                        <a
                            class="flex size-11 shrink-0 items-center justify-center rounded-full bg-desa-foreshadow group-hover:bg-desa-dark-green group-[.active]:bg-desa-dark-green transition-setup"
                        >
                            <span
                                class="text-desa-dark-green font-semibold group-[.active]:text-desa-foreshadow group-hover:text-desa-foreshadow transition-setup"
                            >
                                2
                            </span>
                        </a>
                    </li>
                    <li class="group">
                        <a
                            class="flex size-11 shrink-0 items-center justify-center rounded-full bg-desa-foreshadow group-hover:bg-desa-dark-green group-[.active]:bg-desa-dark-green transition-setup"
                        >
                            <span
                                class="text-desa-dark-green font-semibold group-[.active]:text-desa-foreshadow group-hover:text-desa-foreshadow transition-setup"
                            >
                                3
                            </span>
                        </a>
                    </li>
                    <li class="group">
                        <a
                            class="flex size-11 shrink-0 items-center justify-center rounded-full bg-desa-foreshadow group-hover:bg-desa-dark-green group-[.active]:bg-desa-dark-green transition-setup"
                        >
                            <span
                                class="text-desa-dark-green font-semibold group-[.active]:text-desa-foreshadow group-hover:text-desa-foreshadow transition-setup"
                            >
                                4
                            </span>
                        </a>
                    </li>
                    <li class="group">
                        <a
                            class="flex size-11 shrink-0 items-center justify-center rounded-full bg-desa-foreshadow group-hover:bg-desa-dark-green group-[.active]:bg-desa-dark-green transition-setup"
                        >
                            <span
                                class="text-desa-dark-green font-semibold group-[.active]:text-desa-foreshadow group-hover:text-desa-foreshadow transition-setup"
                            >
                                5
                            </span>
                        </a>
                    </li>
                    <li class="group">
                        <button
                            type="button"
                            class="group/arrow flex size-11 shrink-0 items-center justify-center rounded-full bg-desa-foreshadow disabled:!bg-desa-foreshadow group-hover:bg-desa-dark-green transition-setup"
                        >
                            <img
                                src="@/assets/images/icons/arrow-left-dark-green.svg"
                                class="flex size-6 shrink-0 rotate-180 group-hover:hidden group-disabled/arrow:!hidden"
                                alt="icon"
                            />
                            <img
                                src="@/assets/images/icons/arrow-left-foreshadow.svg"
                                class="hidden size-6 shrink-0 rotate-180 group-hover:flex group-disabled/arrow:!hidden"
                                alt="icon"
                            />
                            <img
                                src="@/assets/images/icons/disabled-arrow-pagination.svg"
                                class="hidden size-6 shrink-0 rotate-180 group-disabled/arrow:!flex"
                                alt="icon"
                            />
                        </button>
                    </li>
                </ul>
            </nav>
        </div>
    </MainLayout>
</template>
