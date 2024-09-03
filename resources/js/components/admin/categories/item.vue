<template>
    <li class="ml-4">
        <div class="flex items-center">
            <p class="py-1 pl-5" :class="{ 'border-l': true }">
                {{ category.name }}
            </p>
            <template v-if="category.subcategories?.length">
                <span
                    class="ml-2 text-xs bg-gray-700 text-white w-4 h-4 inline-flex items-center justify-center rounded-full flex-none"
                >
                    {{ category.subcategories?.length }}
                </span>
                <button
                    class="ml-auto"
                    type="button"
                    @click="showSubcategories = !showSubcategories"
                >
                    <ArrowDownCircleIcon
                        class="h-5 transform transition-all ease-linear"
                        :class="{ 'rotate-180': showSubcategories }"
                    />
                </button>
            </template>
        </div>

        <ul v-show="showSubcategories">
            <admin-category-tree-item
                v-for="sub in category.subcategories"
                :category="sub"
            ></admin-category-tree-item>
        </ul>
    </li>
</template>
<script lang="ts" setup>
import { Category } from "@/types/category";
import AdminCategoryTreeItem from "@/components/admin/categories/item.vue";
import { ArrowDownCircleIcon } from "@heroicons/vue/24/outline";
import { ref } from "vue";

defineProps<{ category: Category }>();

const showSubcategories = ref(false);
</script>
