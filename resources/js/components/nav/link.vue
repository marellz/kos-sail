<template>
    <Link :href :class="{ [activeClass]: active }">
        <slot />
    </Link>
</template>
<script setup lang="ts">
import { computed } from "vue";
import { Link } from "@inertiajs/vue3";

const props = withDefaults(
    defineProps<{
        href: string;
        active?: boolean;
        activeClass?: string;
    }>(),
    {
        activeClass: "text-primary",
    }
);

const classes = computed(() => props.active);
</script>
