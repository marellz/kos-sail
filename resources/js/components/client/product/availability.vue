<template>
    <div
        class="flex items-center space-x-2"
        :class="{ 'text-primary': available, 'text-warning': !available }"
    >
        <template v-if="available">
            <span> In stock </span>
            <CheckCircleIcon class="h-5" />
        </template>
        <template v-else>
            <span> Not in stock </span>
            <ExclamationCircleIcon class="h-5" />
        </template>
    </div>
</template>
<script lang="ts" setup>
import { CheckCircleIcon, ExclamationCircleIcon } from "@heroicons/vue/24/solid";
defineProps<{
    available?: boolean;
}>();
</script>
