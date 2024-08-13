<template>
    <nav-link as="button" class="btn btn--outline-primary text-base">
        <span>
            <slot />
        </span>
        <SquaresPlusIcon class="h-4" />
    </nav-link>
</template>
<script lang="ts" setup>
import { SquaresPlusIcon } from "@heroicons/vue/24/outline";
</script>
