<template>
    <page-head title="Categories" />
    <layout-container>
        <page-title>Categories</page-title>

        <div class="mt-10 grid grid-cols-3 gap-6">
            <category-card
                v-for="(category, index) in categories.data"
                :key="index"
                :category
            />
        </div>
    </layout-container>
</template>
<script lang="ts" setup>
import { Category } from "@/types/category";
import CategoryCard from "@/components/client/category/card.vue";
defineProps<{
    categories: {
        data: Array<Category>
    };
}>();
</script>
