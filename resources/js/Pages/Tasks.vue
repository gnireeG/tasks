<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import Accordion from '@/Components/Accordion.vue';


const props = defineProps({
    tasks: Object
});

const dateReadable = (date) => {
    if(!date) return ''
    let d = new Date(date)
    return d.toLocaleDateString()
};

</script>

<template>
    <AppLayout title="Dashboard">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                Tasks
            </h2>
        </template>

        <div class="py-12">
            <div class="mx-auto sm:px-6 lg:px-8">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg dark:text-gray-300 p-4">
                    <div class="flex gap-8">
                        <div>
                            <template v-for="task in tasks" :key="task.id">
                                <div class="flex justify-between gap-4">
                                    <p>{{ task.name }}</p>
                                    <p>{{ dateReadable(task.due_date) }}</p>
                                </div>
                            </template>
                        </div>
                        <div>Detaillasicht</div>
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
