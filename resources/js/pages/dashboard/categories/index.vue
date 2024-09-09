<template>
    <page-head title="Admin | Categories"></page-head>
    <layout-container>
        <div class="flex flex-col sm:flex-row items-start sm:items-center space-x-4">
            <page-title>Categories</page-title>
            <form-switch v-model="showList">
                <p>Cards</p>
            </form-switch>
            <admin-add-button
                class="!ml-auto mt-3 sm:mt-0"
                :href="route('admin.categories.create')"
            >
                Add category</admin-add-button
            >
        </div>
        <div
            v-if="showList"
            class="grid sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-4 items-start mt-12"
        >
            <nav-link
                v-for="item in categories"
                :key="item.id"
                :href="route('admin.categories.show', { slug: item.slug })"
                class="block mb-4"
            >
                <admin-category-card :category="item" />
            </nav-link>
        </div>

        <div class="mt-10 grid md:grid-cols-2 lg:grid-cols-3 gap-10" v-else>
            <admin-category-tree :items="categories" />
        </div>
    </layout-container>
</template>
<script lang="ts" setup>
import Dashboard from "@/layouts/dashboard.vue";
import AdminCategoryCard from "@/components/admin/categories/card.vue";
import AdminCategoryTree from "@/components/admin/categories/tree.vue";
import AdminAddButton from "@/components/admin/add-btn.vue";
import { type Category } from "@/types/category";

import { computed, ref } from "vue";

const props = withDefaults(
    defineProps<{
        showForm?: boolean;
        showItem?: boolean;
        categories: Array<Category>;
    }>(),
    {
        showForm: false,
        showItem: false,
    }
);

defineOptions({
    layout: Dashboard,
});

const showList = ref(false);
</script>
