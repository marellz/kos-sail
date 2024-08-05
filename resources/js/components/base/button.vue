<template>
    <button :type class="btn" :disabled>
        <slot />
    </button>
</template>
<script setup lang="ts">
withDefaults(defineProps<{
    type ?: "submit" | "button" | undefined;
    disabled: boolean
}>(), {
    type: undefined
})
</script>