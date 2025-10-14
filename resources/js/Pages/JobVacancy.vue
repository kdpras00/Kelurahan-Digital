<script setup>
import { Head } from "@inertiajs/vue3";
import MainLayout from "@/layouts/Main.vue";

defineProps({
    // Add any props you need here
});
</script>

<template>
    <Head title="Lowongan Pekerjaan" />
    <MainLayout>
        <div class="flex flex-col gap-6 py-6 px-6">
            <div class="flex items-center justify-between">
                <h1 class="text-[22px] font-bold text-desa-dark-green">
                    Lowongan Pekerjaan
                </h1>
            </div>

            <div class="flex flex-col gap-6">
                <div
                    class="bg-white rounded-2xl border border-desa-foreshadow p-6"
                >
                    <h2 class="text-lg font-semibold text-desa-dark-green mb-4">
                        Daftar Lowongan Pekerjaan
                    </h2>
                    <p class="text-desa-secondary">
                        Halaman ini menampilkan daftar lowongan pekerjaan yang
                        tersedia di desa.
                    </p>

                    <!-- Content for job vacancy will go here -->
                    <div
                        class="mt-6 flex items-center justify-center h-64 bg-desa-foreshadow rounded-xl"
                    >
                        <p class="text-desa-secondary">
                            Daftar lowongan pekerjaan akan ditampilkan di sini
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </MainLayout>
</template>
