<template>
    <p class="text-sm text-red-600 dark:text-red-400">
        <slot>
            {{ message }}
        </slot>
    </p>
</template>
<script setup lang="ts">
defineProps<{
    message?: string;
}>();
</script>
