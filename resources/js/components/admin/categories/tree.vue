<template>
    <div v-for="item in items" :key="item.id" class="group">
        <nav-link :href="route('admin.categories.show', { slug: item.slug })">
            <div class="flex justify-between items-center">
                <h2 class="text-2xl font-medium">
                    {{ item.name }}
                </h2>

                <ArrowTopRightOnSquareIcon
                    class="h-5 opacity-30 group-hover:opacity-100"
                />
            </div>

            <p class="text-grey text-sm mt-4">
                {{ item.description }}
            </p>
        </nav-link>

        <div class="mt-4" v-if="item.subcategories?.length">
            <ul>
                <admin-category-tree-item
                    :category
                    v-for="category in item.subcategories"
                    :key="'category' + category.id"
                ></admin-category-tree-item>
            </ul>
        </div>
    </div>
</template>
<script lang="ts" setup>
import { Category } from "@/types/category";
import AdminCategoryTreeItem from "@/components/admin/categories/item.vue";
import { ArrowTopRightOnSquareIcon } from "@heroicons/vue/24/outline";

defineProps<{ items: Array<Category> }>();
</script>
