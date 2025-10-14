<script setup>
import { Head } from "@inertiajs/vue3";
import MainLayout from "@/layouts/Main.vue";

// Define props for village profile data
defineProps({
    profile: {
        type: Object,
        default: () => ({
            name: "Desa Periuk Jaya",
            location: "Tangerang, Banten",
            description:
                "Periuk Jaya adalah salah satu kelurahan di Kecamatan Periuk, Kota Tangerang, yang dikenal sebagai kawasan padat penduduk dengan perkembangan pesat di bidang ekonomi, pendidikan, dan sosial. Masyarakatnya banyak bergerak di sektor perdagangan, jasa, dan usaha kecil menengah, serta menjunjung tinggi nilai gotong royong. Dengan letak yang strategis dan akses mudah ke berbagai fasilitas umum, Periuk Jaya terus berupaya menjadi wilayah yang maju, sejahtera, dan nyaman bagi warganya.",
            thumbnail: "@/assets/images/thumbnails/Desa.jpg",
            gallery: [
                "@/assets/images/thumbnails/desa-gallery-1.png",
                "@/assets/images/thumbnails/desa-gallery-2.png",
                "@/assets/images/thumbnails/desa-gallery-3.png",
                "@/assets/images/thumbnails/desa-gallery-4.png",
            ],
            head: {
                name: "Nurdin",
                position: "Lurah",
            },
            population: 17707,
            rtCount: 41,
            rwCount: 8,
            area: "2,28 km²",
            established: "Mon, 24 Feb 2012",
        }),
    },
});
</script>

<template>
    <Head title="Profile Desa" />
    <MainLayout>
        <div
            id="Content"
            class="relative flex flex-col flex-1 gap-6 p-6 pb-[30px] w-full shrink-0"
        >
            <div id="Header" class="flex items-center justify-between">
                <div class="flex flex-col gap-2">
                    <h1 class="font-semibold text-2xl">Profile Desa</h1>
                </div>
                <a
                    href="/profile-desa/edit"
                    class="flex items-center rounded-2xl py-4 px-6 gap-[10px] bg-desa-black"
                    style="margin-right: 110px"
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
                    id="Nama-Desa"
                    class="flex flex-col shrink-0 w-[calc(565/1000*100%)] h-fit rounded-3xl p-6 gap-6 bg-white"
                >
                    <div class="flex items-center justify-between">
                        <p class="font-medium leading-5 text-desa-secondary">
                            Nama Desa
                        </p>
                        <img
                            src="@/assets/images/icons/building-foreshadow-background.svg"
                            class="flex size-12 shrink-0"
                            alt="icon"
                        />
                    </div>
                    <div id="Nama-Desa" class="flex flex-col gap-[6px]">
                        <h1 class="font-bold text-[32px] leading-10">
                            {{ profile.name }}
                        </h1>
                        <div class="flex items-center gap-0.5">
                            <img
                                src="@/assets/images/icons/location-secondary-green.svg"
                                class="flex size-6 shrink-0"
                                alt="icon"
                            />
                            <span
                                class="font-medium text-sm text-desa-secondary"
                                >{{ profile.location }}</span
                            >
                        </div>
                    </div>
                    <div id="Gallery" class="flex flex-col gap-[14px]">
                        <div
                            data-modal="Modal-Gallery"
                            :data-gallery="profile.gallery[0]"
                            id="Thumbnail-Desa"
                            class="flex w-[492px] h-[300px] shrink-0 rounded-3xl bg-desa-background overflow-hidden"
                        >
                            <img
                                :src="profile.thumbnail"
                                class="w-full h-full object-cover"
                                alt="thumbnail"
                            />
                        </div>
                        <div class="grid grid-cols-3 gap-[14px] w-[492px]">
                            <button
                                data-modal="Modal-Gallery"
                                :data-gallery="profile.gallery[1]"
                                class="relative"
                            >
                                <div
                                    class="thumbnail-selection flex w-full h-[120px] shrink-0 rounded-3xl bg-desa-background overflow-hidden"
                                >
                                    <img
                                        :src="profile.gallery[1]"
                                        class="w-full h-full object-cover"
                                        alt="thumbnail"
                                    />
                                </div>
                            </button>
                            <button
                                data-modal="Modal-Gallery"
                                :data-gallery="profile.gallery[2]"
                                class="relative"
                            >
                                <div
                                    class="thumbnail-selection flex w-full h-[120px] shrink-0 rounded-3xl bg-desa-background overflow-hidden"
                                >
                                    <img
                                        :src="profile.gallery[2]"
                                        class="w-full h-full object-cover"
                                        alt="thumbnail"
                                    />
                                </div>
                            </button>
                            <button
                                data-modal="Modal-Gallery"
                                :data-gallery="profile.gallery[3]"
                                class="relative"
                            >
                                <div
                                    class="thumbnail-selection flex w-full h-[120px] shrink-0 rounded-3xl bg-desa-background overflow-hidden"
                                >
                                    <img
                                        :src="profile.gallery[3]"
                                        class="w-full h-full object-cover"
                                        alt="thumbnail"
                                    />
                                </div>
                                <div
                                    class="absolute inset-0 rounded-3xl overflow-hidden flex flex-col items-center justify-center bg-[#001B1ACC] text-white"
                                >
                                    <p class="font-semibold text-xl leading-6">
                                        2+
                                    </p>
                                    <p class="font-semibold text-sm text-white">
                                        Photo
                                    </p>
                                </div>
                            </button>
                        </div>
                    </div>
                    <div class="flex flex-col gap-3">
                        <p class="font-medium text-sm text-desa-secondary">
                            Tentang Desa
                        </p>
                        <p class="font-medium leading-8">
                            {{ profile.description }}
                        </p>
                    </div>
                    <div class="flex flex-col gap-3">
                        <p class="font-medium text-sm text-desa-secondary">
                            Peta Desa
                        </p>
                        <div
                            class="rounded-2xl overflow-hidden max-w-full w-full !h-[350px]"
                        >
                            <div
                                id="embedded-map-display"
                                class="size-full max-w-full"
                            >
                                <iframe
                                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d31734.294148765526!2d106.58636025671045!3d-6.1593063865740705!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69ff41c0918e63%3A0xb6aab96f7525cfdc!2sPeriuk%20Jaya%2C%20Kec.%20Periuk%2C%20Kota%20Tangerang%2C%20Banten!5e0!3m2!1sid!2sid!4v1758153545410!5m2!1sid!2sid"
                                    width="600"
                                    height="450"
                                    style="border: 0"
                                    allowfullscreen=""
                                    loading="lazy"
                                    referrerpolicy="no-referrer-when-downgrade"
                                ></iframe>
                            </div>
                        </div>
                    </div>
                </section>
                <section
                    id="Detail-Desa"
                    class="flex flex-col flex-1 h-fit shrink-0 rounded-3xl p-6 gap-6 bg-white"
                >
                    <p class="font-medium leading-5 text-desa-secondary">
                        Detail Desa
                    </p>
                    <div class="flex flex-col gap-[14px]">
                        <div class="flex items-center gap-3 w-[302px] shrink-0">
                            <div
                                class="flex size-[54px] rounded-full bg-desa-foreshadow overflow-hidden"
                            >
                                <img
                                    src="@/assets/images/photos/kk-photo-1.png"
                                    class="w-full h-full object-cover"
                                    alt="icon"
                                />
                            </div>
                            <div class="flex flex-col gap-1">
                                <p
                                    class="font-semibold text-lg leading-5 text-desa-black"
                                >
                                    {{ profile.head.name }}
                                </p>
                                <p class="flex items-center gap-1">
                                    <span
                                        class="font-medium text-sm text-desa-secondary"
                                        >{{ profile.head.position }}</span
                                    >
                                </p>
                            </div>
                        </div>
                        <hr class="border-desa-background" />
                        <div class="flex items-center gap-3 w-[302px] shrink-0">
                            <div
                                class="flex size-[52px] rounded-2xl items-center justify-center bg-desa-foreshadow overflow-hidden"
                            >
                                <img
                                    src="@/assets/images/icons/profile-2user-dark-green.svg"
                                    class="flex size-6 shrink-0"
                                    alt="icon"
                                />
                            </div>
                            <div class="flex flex-col gap-1">
                                <p class="font-semibold text-lg leading-5">
                                    {{
                                        profile.population.toLocaleString(
                                            "id-ID"
                                        )
                                    }}
                                </p>
                                <p
                                    class="font-medium text-sm text-desa-secondary"
                                >
                                    Jumlah Penduduk
                                </p>
                            </div>
                        </div>
                        <hr class="border-desa-background" />
                        <div class="flex items-center gap-3 w-[302px] shrink-0">
                            <div
                                class="flex size-[52px] rounded-2xl items-center justify-center bg-desa-foreshadow overflow-hidden"
                            >
                                <img
                                    src="@/assets/images/icons/tree-dark-green.svg"
                                    class="flex size-6 shrink-0"
                                    alt="icon"
                                />
                            </div>
                            <div class="flex flex-col gap-1">
                                <p class="font-semibold text-lg leading-5">
                                    {{ profile.rtCount }}
                                </p>
                                <p
                                    class="font-medium text-sm text-desa-secondary"
                                >
                                    Jumlah RT
                                </p>
                            </div>
                        </div>
                        <div class="flex items-center gap-3 w-[302px] shrink-0">
                            <div
                                class="flex size-[52px] rounded-2xl items-center justify-center bg-desa-foreshadow overflow-hidden"
                            >
                                <img
                                    src="@/assets/images/icons/tree-dark-green.svg"
                                    class="flex size-6 shrink-0"
                                    alt="icon"
                                />
                            </div>
                            <div class="flex flex-col gap-1">
                                <p class="font-semibold text-lg leading-5">
                                    {{ profile.rwCount }}
                                </p>
                                <p
                                    class="font-medium text-sm text-desa-secondary"
                                >
                                    Jumlah RW
                                </p>
                            </div>
                        </div>
                        <hr class="border-desa-background" />
                        <div class="flex items-center gap-3 w-[302px] shrink-0">
                            <div
                                class="flex size-[52px] rounded-2xl items-center justify-center bg-desa-foreshadow overflow-hidden"
                            >
                                <img
                                    src="@/assets/images/icons/grid-5-dark-green.svg"
                                    class="flex size-6 shrink-0"
                                    alt="icon"
                                />
                            </div>
                            <div class="flex flex-col gap-1">
                                <p
                                    class="font-semibold text-lg leading-5"
                                    v-html="profile.area"
                                ></p>
                                <p
                                    class="font-medium text-sm text-desa-secondary"
                                >
                                    Luas Area
                                </p>
                            </div>
                        </div>
                        <hr class="border-desa-background" />
                        <div class="flex items-center gap-3 w-[302px] shrink-0">
                            <div
                                class="flex size-[52px] rounded-2xl items-center justify-center bg-desa-foreshadow overflow-hidden"
                            >
                                <img
                                    src="@/assets/images/icons/calendar-2-dark-green.svg"
                                    class="flex size-6 shrink-0"
                                    alt="icon"
                                />
                            </div>
                            <div class="flex flex-col gap-1">
                                <p class="font-semibold text-lg leading-5">
                                    {{ profile.established }}
                                </p>
                                <p
                                    class="font-medium text-sm text-desa-secondary"
                                >
                                    Desa Dibangun
                                </p>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </MainLayout>
</template>
