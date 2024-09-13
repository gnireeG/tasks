<template>
    <div>
        <div class="bg-red-500" @click="toggle">{{ title }}</div>
        <div v-show="open"><slot></slot></div>
    </div>
</template>
<script setup>
import { ref } from 'vue';
const props = defineProps({
    title: String,
})

const open = ref(false);

function toggle(){
    open.value = !open.value;
}
</script>