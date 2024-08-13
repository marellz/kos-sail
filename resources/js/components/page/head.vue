<template>
    <Head :title />
</template>
<script lang="ts" setup>
import { Head } from '@inertiajs/vue3';
defineProps<{
    title: string;
}>();
</script>
