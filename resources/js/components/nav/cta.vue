<template>
    <nav-link class="inline-flex items-center space-x-4 text-primary">
        <span class="whitespace-nowrap"><slot /></span>
        <ArrowLongRightIcon class="h-5" />
    </nav-link>
</template>
<script lang="ts" setup>
import { ArrowLongRightIcon } from "@heroicons/vue/24/outline";
</script>
