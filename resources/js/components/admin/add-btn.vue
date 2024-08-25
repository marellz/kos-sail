<template>
    <nav-link as="button" class="btn btn--outline-primary">
        <span>
            <slot />
        </span>
        <SquaresPlusIcon class="h-5" />
    </nav-link>
</template>
<script lang="ts" setup>
import { SquaresPlusIcon } from "@heroicons/vue/24/outline";
</script>
