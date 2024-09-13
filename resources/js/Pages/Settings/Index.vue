<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';


const props = defineProps({
    inboxes: Object
});


</script>

<template>
    <AppLayout title="Dashboard">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                Email Settings
            </h2>
        </template>

        <div class="py-12">
            <div class="mx-auto sm:px-6 lg:px-8 max-w-7xl">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg dark:text-gray-300 p-4">
                    <div class="flex justify-between">
                        <h2>IMAP Inboxes</h2>
                        <button>New inbox</button>
                    </div>
                    <div>{{ inboxes }}</div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
