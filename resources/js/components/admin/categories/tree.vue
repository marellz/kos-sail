<template>
    <div v-for="item in items" :key="item.id">
        <div>
            <h2 class="text-2xl font-medium">
                {{ item.name }}
            </h2>
    
            <p class="text-grey text-sm mt-2">
                {{ item.description }}
            </p>
        </div>

        <div class="mt-4" v-if="item.subcategories?.length">
            <ul>
                <admin-category-tree-item
                    :category
                    v-for="category in item.subcategories"
                    :key="'category'+category.id"
                ></admin-category-tree-item>
            </ul>
        </div>
    </div>
</template>
<script lang="ts" setup>
import { Category } from "@/types/category";
import AdminCategoryTreeItem from "@/components/admin/categories/item.vue";

defineProps<{ items: Array<Category> }>();
</script>
