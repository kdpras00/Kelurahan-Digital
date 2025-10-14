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
    <Head title="Ubah Profile Desa" />
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
                            Profile desa
                        </p>
                        <span>/</span>
                        <p
                            class="last-of-type:text-desa-dark-green last-of-type:font-semibold capitalize"
                        >
                            Ubah Profile Desa
                        </p>
                    </div>
                    <h1 class="font-semibold text-2xl">Ubah Profile Desa</h1>
                </div>
                <a
                    href="/profile-desa"
                    class="flex items-center rounded-2xl py-4 px-6 gap-[10px] bg-desa-black"
                >
                    <p class="font-medium text-white">Kembali</p>
                </a>
            </div>
            <div class="flex flex-col gap-[14px]">
                <section
                    id="Nama-Desa"
                    class="flex flex-col rounded-3xl p-6 gap-6 bg-white"
                >
                    <p class="font-medium leading-5 text-desa-secondary">
                        Nama Desa
                    </p>
                    <div class="flex flex-col gap-4">
                        <div class="flex flex-col gap-3">
                            <label class="font-medium text-desa-secondary"
                                >Nama Desa</label
                            >
                            <input
                                type="text"
                                :value="profile.name"
                                class="appearance-none outline-none w-full h-14 rounded-2xl ring-[1.5px] ring-desa-background focus:ring-desa-black py-4 px-6 gap-2 font-medium placeholder:text-desa-secondary transition-all duration-300"
                            />
                        </div>
                        <hr class="border-desa-foreshadow" />
                        <div class="flex flex-col gap-3">
                            <label class="font-medium text-desa-secondary"
                                >Lokasi Desa</label
                            >
                            <input
                                type="text"
                                :value="profile.location"
                                class="appearance-none outline-none w-full h-14 rounded-2xl ring-[1.5px] ring-desa-background focus:ring-desa-black py-4 px-6 gap-2 font-medium placeholder:text-desa-secondary transition-all duration-300"
                            />
                        </div>
                        <hr class="border-desa-foreshadow" />
                        <div class="flex flex-col gap-3">
                            <label class="font-medium text-desa-secondary"
                                >Thumbnail Desa</label
                            >
                            <div class="flex items-center gap-3">
                                <div
                                    class="flex w-[100px] h-20 shrink-0 rounded-2xl overflow-hidden bg-desa-foreshadow"
                                >
                                    <img
                                        :src="profile.thumbnail"
                                        class="w-full h-full object-cover"
                                        alt="thumbnail"
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
                        <hr class="border-desa-foreshadow" />
                        <div class="flex flex-col gap-3">
                            <label class="font-medium text-desa-secondary"
                                >Gallery Desa</label
                            >
                            <div class="grid grid-cols-4 gap-[14px]">
                                <div
                                    v-for="(image, index) in profile.gallery"
                                    :key="index"
                                    class="flex flex-col gap-3"
                                >
                                    <div
                                        class="flex w-full h-[120px] shrink-0 rounded-2xl overflow-hidden bg-desa-foreshadow"
                                    >
                                        <img
                                            :src="image"
                                            class="w-full h-full object-cover"
                                            :alt="`gallery-${index}`"
                                        />
                                    </div>
                                    <button
                                        class="flex items-center rounded-2xl py-2 px-4 gap-[10px] bg-desa-dark-green"
                                    >
                                        <p
                                            class="font-medium text-white text-sm"
                                        >
                                            Ubah
                                        </p>
                                    </button>
                                </div>
                            </div>
                        </div>
                        <hr class="border-desa-foreshadow" />
                        <div class="flex flex-col gap-3">
                            <label class="font-medium text-desa-secondary"
                                >Tentang Desa</label
                            >
                            <textarea
                                :value="profile.description"
                                rows="5"
                                class="appearance-none outline-none w-full rounded-2xl ring-[1.5px] ring-desa-background focus:ring-desa-black py-4 px-6 gap-2 font-medium placeholder:text-desa-secondary transition-all duration-300"
                            ></textarea>
                        </div>
                        <hr class="border-desa-foreshadow" />
                        <div class="flex flex-col gap-3">
                            <label class="font-medium text-desa-secondary"
                                >Peta Desa (Embed Link)</label
                            >
                            <input
                                type="text"
                                placeholder="Masukkan link embed peta desa"
                                class="appearance-none outline-none w-full h-14 rounded-2xl ring-[1.5px] ring-desa-background focus:ring-desa-black py-4 px-6 gap-2 font-medium placeholder:text-desa-secondary transition-all duration-300"
                            />
                        </div>
                    </div>
                </section>
                <section
                    id="Detail-Desa"
                    class="flex flex-col rounded-3xl p-6 gap-6 bg-white"
                >
                    <p class="font-medium leading-5 text-desa-secondary">
                        Detail Desa
                    </p>
                    <div class="flex flex-col gap-4">
                        <div class="grid grid-cols-2 gap-3">
                            <div class="flex flex-col gap-3">
                                <label class="font-medium text-desa-secondary"
                                    >Nama Kepala Desa</label
                                >
                                <input
                                    type="text"
                                    :value="profile.head.name"
                                    class="appearance-none outline-none w-full h-14 rounded-2xl ring-[1.5px] ring-desa-background focus:ring-desa-black py-4 px-6 gap-2 font-medium placeholder:text-desa-secondary transition-all duration-300"
                                />
                            </div>
                            <div class="flex flex-col gap-3">
                                <label class="font-medium text-desa-secondary"
                                    >Jabatan</label
                                >
                                <input
                                    type="text"
                                    :value="profile.head.position"
                                    class="appearance-none outline-none w-full h-14 rounded-2xl ring-[1.5px] ring-desa-background focus:ring-desa-black py-4 px-6 gap-2 font-medium placeholder:text-desa-secondary transition-all duration-300"
                                />
                            </div>
                        </div>
                        <hr class="border-desa-foreshadow" />
                        <div class="grid grid-cols-2 gap-3">
                            <div class="flex flex-col gap-3">
                                <label class="font-medium text-desa-secondary"
                                    >Jumlah Penduduk</label
                                >
                                <input
                                    type="number"
                                    :value="profile.population"
                                    class="appearance-none outline-none w-full h-14 rounded-2xl ring-[1.5px] ring-desa-background focus:ring-desa-black py-4 px-6 gap-2 font-medium placeholder:text-desa-secondary transition-all duration-300"
                                />
                            </div>
                            <div class="flex flex-col gap-3">
                                <label class="font-medium text-desa-secondary"
                                    >Luas Area</label
                                >
                                <input
                                    type="text"
                                    :value="profile.area"
                                    class="appearance-none outline-none w-full h-14 rounded-2xl ring-[1.5px] ring-desa-background focus:ring-desa-black py-4 px-6 gap-2 font-medium placeholder:text-desa-secondary transition-all duration-300"
                                />
                            </div>
                        </div>
                        <hr class="border-desa-foreshadow" />
                        <div class="grid grid-cols-2 gap-3">
                            <div class="flex flex-col gap-3">
                                <label class="font-medium text-desa-secondary"
                                    >Jumlah RT</label
                                >
                                <input
                                    type="number"
                                    :value="profile.rtCount"
                                    class="appearance-none outline-none w-full h-14 rounded-2xl ring-[1.5px] ring-desa-background focus:ring-desa-black py-4 px-6 gap-2 font-medium placeholder:text-desa-secondary transition-all duration-300"
                                />
                            </div>
                            <div class="flex flex-col gap-3">
                                <label class="font-medium text-desa-secondary"
                                    >Jumlah RW</label
                                >
                                <input
                                    type="number"
                                    :value="profile.rwCount"
                                    class="appearance-none outline-none w-full h-14 rounded-2xl ring-[1.5px] ring-desa-background focus:ring-desa-black py-4 px-6 gap-2 font-medium placeholder:text-desa-secondary transition-all duration-300"
                                />
                            </div>
                        </div>
                        <hr class="border-desa-foreshadow" />
                        <div class="flex flex-col gap-3">
                            <label class="font-medium text-desa-secondary"
                                >Tanggal Berdiri Desa</label
                            >
                            <input
                                type="date"
                                class="appearance-none outline-none w-full h-14 rounded-2xl ring-[1.5px] ring-desa-background focus:ring-desa-black py-4 px-6 gap-2 font-medium placeholder:text-desa-secondary transition-all duration-300"
                            />
                        </div>
                    </div>
                </section>
                <div class="flex items-center justify-end gap-3">
                    <a
                        href="/profile-desa"
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
