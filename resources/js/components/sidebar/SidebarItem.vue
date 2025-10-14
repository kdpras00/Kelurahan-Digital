<script setup>
import { computed, ref, watch } from "vue";
import { Link, usePage } from "@inertiajs/vue3";

const props = defineProps({
    item: {
        type: Object,
        required: true,
    },
});

const page = usePage();

// untuk mengecek komponen yang sedang aktif
// mencocokan berdasarkan path
const isActive = computed(() => page.url === props.item.path);

const isChildActive = computed(() => {
    if (props.item.children) {
        // Check if current page matches any child path
        return props.item.children.some((child) => page.url === child.path);
    }
    return false;
});

const isOpen = ref(isChildActive.value);

watch(isChildActive, (newVal) => {
    isOpen.value = newVal;
});

// Watch for URL changes to update the open state
watch(
    () => page.url,
    () => {
        isOpen.value = isChildActive.value;
    }
);
</script>

<template>
    <!-- akan menambahkan class aktif jika isActive bernilai true & akan muncul jika tidak ada children -->
    <li class="group" :class="{ active: isActive }" v-if="!item.children">
        <Link
            :href="item.path"
            class="flex items-center h-14 gap-2 rounded-2xl p-4 group-hover:bg-desa-foreshadow group-[.active]:bg-desa-foreshadow transition-setup"
        >
            <div
                class="relative flex size-6 shrink-0"
                v-if="item.iconActive && item.iconInactive"
            >
                <img
                    :src="item.iconActive"
                    class="absolute flex size-6 shrink-0 opacity-0 group-hover:opacity-100 group-[.active]:opacity-100 transition-setup"
                    alt="icon"
                />
                <img
                    :src="item.iconInactive"
                    class="absolute flex size-6 shrink-0 opacity-100 group-hover:opacity-0 group-[.active]:opacity-0 transition-setup"
                    alt="icon"
                />
            </div>
            <span
                class="text-left leading-5 text-desa-secondary flex flex-1 group-hover:text-desa-dark-green group-[.active]:text-desa-dark-green group-[.active]:font-medium transition-setup"
            >
                {{ item.label }}
            </span>
        </Link>
    </li>

    <template v-if="item.children">
        <div class="accordion group/accordion flex flex-col gap-1 w-full">
            <button
                :data-expand="`accordion-${item.label}`"
                class="group flex w-full shrink-0 items-center h-14 gap-2 rounded-2xl p-4"
                :class="{ active: isChildActive }"
                @click="isOpen = !isOpen"
            >
                <div class="relative flex size-6 shrink-0">
                    <img
                        :src="item.iconActive"
                        class="absolute flex size-6 shrink-0 opacity-0 group-[.active]:opacity-100 transition-setup"
                        alt="icon"
                    />
                    <img
                        :src="item.iconInactive"
                        class="absolute flex size-6 shrink-0 opacity-100 group-[.active]:opacity-0 transition-setup"
                        alt="icon"
                    />
                </div>
                <span
                    class="text-left leading-5 text-desa-secondary flex flex-1 group-[.active]:text-desa-dark-green transition-setup"
                >
                    {{ item.label }}
                </span>
                <div class="relative flex size-6 shrink-0">
                    <!-- Dropdown arrow icons -->
                    <img
                        src="@/assets/images/icons/arrow-circle-dark-green-up.svg"
                        class="absolute flex size-6 shrink-0 transition-setup"
                        :class="{ 'opacity-100': isOpen, 'opacity-0': !isOpen }"
                        alt="collapse menu"
                        v-if="isOpen"
                    />
                    <img
                        src="@/assets/images/icons/arrow-circle-secondary-green-down.svg"
                        class="absolute flex size-6 shrink-0 transition-setup"
                        :class="{ 'opacity-100': !isOpen, 'opacity-0': isOpen }"
                        alt="expand menu"
                        v-else
                    />
                </div>
            </button>
            <ul
                :id="`accordion-${item.label}`"
                class="flex flex-col flex-1r pl-[28px]"
                :class="{ hidden: !isOpen }"
            >
                <SidebarItem
                    v-for="child in item.children"
                    :key="child.path"
                    :item="child"
                />
            </ul>
        </div>
    </template>
</template>
