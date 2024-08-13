<template>
    <nav-link
        as="button"
        class="inline-flex space-x-2 border-l border-y last:border-r px-3 py-2 first:rounded-l-lg last:rounded-r-lg text-sm"
        :class="{ 'text-primary bg-light-alt-primary': active,
    'text-grey opacity-50': disabled }"
    >
        <slot />
    </nav-link>
</template>
<script lang="ts" setup>
defineProps<{
    active?: boolean;
    disabled?: boolean;
}>();
</script>
