<template>
    <label :for class="block font-medium text-sm text-gray-700 dark:text-gray-300">
        <span v-if="value">{{ value }}</span>
        <span v-else><slot /></span>
    </label>
</template>

<script setup lang="ts">
defineProps<{
    value?: string;
    for?: string | undefined
}>();
</script>

