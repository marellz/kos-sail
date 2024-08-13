<template>
    <div class="relative">
        <input
            type="text"
            class="form-input form-input--search"
            :placeholder
        />
        <MagnifyingGlassIcon
            class="h-5 text-light-grey absolute top-2.5 left-5 pointer-events-none"
        />
    </div>
</template>
<script lang="ts" setup>
import { MagnifyingGlassIcon } from "@heroicons/vue/24/outline";
withDefaults(defineProps<{
    placeholder?: string
}>(),{
    placeholder: "Search"
})
</script>
