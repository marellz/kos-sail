<template>
    <page-head title="Categories" />
    <layout-container>
        <page-title>Categories</page-title>

        <div class="mt-10 grid md:grid-cols-2 lg:grid-cols-3 gap-6">
            <nav-link
                :href="route('products.index', { category_id: category.id })"
                v-for="(category, index) in categories"
                :key="index"
            >
                <category-card :category />
            </nav-link>
        </div>
    </layout-container>
</template>
<script lang="ts" setup>
import { Category } from "@/types/category";
import CategoryCard from "@/components/client/category/card.vue";
defineProps<{
    categories: Array<Category>;
}>();
</script>
