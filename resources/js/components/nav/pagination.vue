<template>
    <div class="py-10">
        <nav class="flex items-center justify-center">
            <pagination-button :disabled="!hasPrev" :href="hasPrev ? `${url}?page=${currentPage - 1}` : url">
                <ArrowLeftCircleIcon class="h-4"/>
                <span>Previous</span>
            </pagination-button>
            <pagination-button
                v-for="link in meta.last_page"
                :href="`${url}?page=${link}`"
                :key="`btn-page-${link}`"
                :active="meta.current_page === link"
            >
                {{link}}
            </pagination-button>
             <pagination-button :disabled="!hasNext" :href="hasNext ? `${url}?page=${currentPage + 1}`: url">
                <span>Next</span>
                <ArrowRightCircleIcon class="h-4"/>
            </pagination-button>
        </nav>
    </div>
</template>
<script lang="ts" setup>
import PaginationButton from "@/components/nav/pagination-button.vue";
import { ArrowLeftCircleIcon, ArrowRightCircleIcon } from "@heroicons/vue/24/outline";
import { usePage } from "@inertiajs/vue3";
import { computed } from "vue";

interface Link {
    label: string;
    url?: string;
    active: boolean;
}

const props = defineProps<{
    meta: {
        links: Array<Link>;
        last_page: number;
        current_page: number;
    };
}>();

const url = computed(()=> usePage().props.ziggy.location)
const hasNext = computed(() => props.meta.current_page < props.meta.last_page)
const hasPrev = computed(() => props.meta.current_page > 1)
const currentPage = computed(() => props.meta.current_page)
</script>
