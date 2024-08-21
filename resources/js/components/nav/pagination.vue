<template>
    <div class="py-10">
        <nav class="flex items-center justify-center">
            <pagination-button
                :disabled="link.url === null"
                v-for="link in meta.links"
                :href="link.url ?? '/'"
                v-html="link.label"
                :active="link.active"
            >
            </pagination-button>
        </nav>
    </div>
</template>
<script lang="ts" setup>
import PaginationButton from "@/components/nav/pagination-button.vue";

interface Link {
    label: string;
    url?: string;
    active: boolean;
}

defineProps<{
    meta: {
        links: Array<Link>;
        last_page: number;
        current_page: number;
    };
}>();
</script>
