<template>
    <page-head :title="`Search results '${query}' `"></page-head>
    <div>
        <layout-container>
            <page-title>Search results</page-title>
            <div class="mt-10">
                <form @submit.prevent="search">
                    <div class="inline-flex items-center space-x-2">
                        <input
                            type="text"
                            class="form-input"
                            v-model="searchQuery"
                        />
                        <base-button class="btn--icon btn--primary">
                            <MagnifyingGlassIcon class="h-5" />
                            <span>Search</span></base-button
                        >
                    </div>
                </form>
            </div>

            <template v-if="query && (products.length || categories.length)">
                <div class="mt-10">
                    <h4 class="text-lg">
                        Showing results for:
                        <span class="font-medium"> "{{ query }}" </span>
                    </h4>
                </div>
                <div v-if="products.length" class="mt-10">
                    <h2 class="font-medium text-grey">Products</h2>

                    <div class="mt-6">
                        <div
                            class="grid sm:grid-cols-2 md:grid-cols-3 xl:grid-cols-4 gap-10"
                        >
                            <product-card
                                v-for="product in visibleProducts"
                                :product
                                :key="product.id"
                            />
                        </div>
                    </div>
                    <div
                        v-if="products.length > 4"
                        class="flex justify-center my-5"
                    >
                        <button
                            type="button"
                            class="border px-5 py-2 rounded-full inline-flex space-x-2 items-cenrter text-sm transform transition ease-linear text-dark border-dark hover:bg-dark hover:text-white"
                            @click="showAllProducts = !showAllProducts"
                        >
                            <span
                                >Show
                                {{ showAllProducts ? "less" : "more" }}</span
                            >
                            <ChevronDownIcon
                                class="h-5"
                                :class="{ 'rotate-180': showAllProducts }"
                            />
                        </button>
                    </div>
                </div>
                <div v-if="categories.length" class="mt-10">
                    <h2 class="font-medium text-grey">Categories</h2>

                    <div class="mt-6">
                        <div
                            class="grid sm:grid-cols-2 md:grid-cols-3 xl:grid-cols-4 gap-10"
                        >
                            <nav-link
                                v-for="category in visibleCategories"
                                :key="category.id"
                                :href="
                                    route('products.index', {
                                        category_id: category.id,
                                    })
                                "
                            >
                                <category-card
                                    class="h-full"
                                    :category
                                ></category-card>
                            </nav-link>
                        </div>
                    </div>
                    <div
                        v-if="categories.length > 4"
                        class="flex justify-center my-5"
                    >
                        <button
                            type="button"
                            class="border px-5 py-2 rounded-full inline-flex space-x-2 items-cenrter text-sm transform transition ease-linear text-dark border-dark hover:bg-dark hover:text-white"
                            @click="showAllCategories = !showAllCategories"
                        >
                            <span
                                >Show
                                {{ showAllCategories ? "less" : "more" }}</span
                            >
                            <ChevronDownIcon
                                class="h-5"
                                :class="{ 'rotate-180': showAllCategories }"
                            />
                        </button>
                    </div>
                </div>
            </template>
            <template v-else>
                <div class="mt-20">
                    <div class="grid md:grid-cols-2">
                        <div class="text-center">
                            <img
                                src="@/assets/images/empty-search.svg"
                                class="mx-auto max-w-xs"
                                alt=""
                            />
                        </div>
                        <div
                            class="row-start-1 md:col-start-2 px-5 pb-20 md:px-0 md:pt-20"
                        >
                            <h1 class="text-3xl font-medium">No results.</h1>
                            <p v-if="!query" class="mt-1 text-grey">
                                Your query was empty.
                            </p>
                            <p v-else class="mt-1 text-grey">
                                Your query returned zero results.
                            </p>
                        </div>
                    </div>
                </div>
            </template>
        </layout-container>
    </div>
</template>
<script lang="ts" setup>
import { ref, onMounted, computed } from "vue";
import { router } from "@inertiajs/vue3";
import {
    MagnifyingGlassIcon,
    ChevronDownIcon,
} from "@heroicons/vue/24/outline";
import { Product } from "@/types/products";
import { Category } from "@/types/category";
import ProductCard from "@/components/client/product/card.vue";
import CategoryCard from "@/components/admin/categories/card.vue";

const props = defineProps<{
    query: string;
    results: {
        products: Array<Product>;
        categories: Array<Category>;
    };
}>();

const searchQuery = ref("");
const showAllProducts = ref(false);
const showAllCategories = ref(false);

const search = () => {
    router.visit(route("search", { q: searchQuery.value }), {});
};

const products = computed(() => props.results.products);
const categories = computed(() => props.results.categories);

const visibleProducts = computed(() =>
    showAllProducts.value ? products.value : products.value.slice(0, 4)
);

const visibleCategories = computed(() =>
    showAllCategories.value ? categories.value : categories.value.slice(0, 4)
);

onMounted(() => {
    if (props.query) {
        searchQuery.value = props.query;
    }
});
</script>
