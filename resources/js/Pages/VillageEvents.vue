<script setup>
import { Head } from "@inertiajs/vue3";
import MainLayout from "@/layouts/Main.vue";

defineProps({
    // Add any props you need here
});
</script>

<template>
    <Head title="Events Desa" />
    <MainLayout>
        <div class="flex flex-col gap-6 py-6 px-6">
            <div class="flex items-center justify-between">
                <h1 class="text-[22px] font-bold text-desa-dark-green">
                    Events Desa
                </h1>
            </div>

            <div class="flex flex-col gap-6">
                <div
                    class="bg-white rounded-2xl border border-desa-foreshadow p-6"
                >
                    <h2 class="text-lg font-semibold text-desa-dark-green mb-4">
                        Daftar Events Desa
                    </h2>
                    <p class="text-desa-secondary">
                        Halaman ini menampilkan daftar events dan kegiatan desa.
                    </p>

                    <!-- Content for village events will go here -->
                    <div
                        class="mt-6 flex items-center justify-center h-64 bg-desa-foreshadow rounded-xl"
                    >
                        <p class="text-desa-secondary">
                            Daftar events desa akan ditampilkan di sini
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </MainLayout>
</template>
