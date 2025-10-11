<template>
    <div class="min-h-screen bg-gray-100 flex items-center justify-center">
        <div class="bg-white p-8 rounded-lg shadow-lg max-w-md w-full">
            <h1 class="text-3xl font-bold text-center text-gray-800 mb-6">
                Welcome to Inertia.js with Laravel
            </h1>
            <p class="text-center text-gray-600 mb-8">
                This is a simple example of Inertia.js working with Laravel and
                Vue.js
            </p>
            <div class="text-center">
                <button
                    @click="increment"
                    class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded"
                >
                    Count: {{ count }}
                </button>
            </div>
        </div>
    </div>
</template>

<script>
import { ref } from "vue";

export default {
    setup() {
        const count = ref(0);

        const increment = () => {
            count.value++;
        };

        return {
            count,
            increment,
        };
    },
};
</script>
