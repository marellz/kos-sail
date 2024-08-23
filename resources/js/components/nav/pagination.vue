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
import { PaginationMeta, type PaginationLink as Link } from "@/types/index"


defineProps<{
    meta: PaginationMeta;
}>();
</script>
