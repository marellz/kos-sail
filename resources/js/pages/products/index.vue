<template>
    <page-head title="Browse products"></page-head>
    <layout-container>
        <div class="flex space-x-10">
            <div class="w-3/4">
                <page-title>Browse products</page-title>
                <div class="pt-10 flex items-center space-x-2">
                    <base-button
                        type="button"
                        class="px-3 py-1.5 leading-normal rounded-full font-normal btn--outline-primary"
                        :class="{'bg-primary text-white': showFilters}"
                        @click="showFilters = !showFilters"
                    >
                        <FunnelIcon class="h-5" />
                        <span>Show filters</span>
                    </base-button>
                    <template v-if="Object.keys(filtered).length">
                        <div
                            class="inline-flex items-center space-x-2 border-r py-1 px-2"
                            v-for="(filter, key) in filtered"
                            :key="`filter-${key}`"
                        >
                            <div class="inline-flex space-x-2 items-baseline">
                                <p class="text-xs text-grey">
                                    {{ key }}
                                </p>
                                <p class="text-base">
                                    {{ filter }}
                                </p>
                            </div>
                            <button
                                type="button"
                                class="bg-gray-100 rounded-full h-4 w-4 hover:bg-gray-500 hover:text-white"
                                @click="(filter) => removeFilter"
                            >
                                <XMarkIcon class="h-4" />
                            </button>
                        </div>
                    </template>
                </div>
            </div>
        </div>
        <div class="mt-10 flex items-start space-x-10">
            <div
                v-if="showFilters"
                class="w-1/4 py-6 px-7 rounded-xl bg-light-grey bg-opacity-15"
            >
                <ProductFilter
                    :filtered
                    :errors
                    :categories
                    @close="showFilters = false"
                    @submit="submitFilters"
                />
            </div>
            <div class="w-3/4 grid grid-cols-3 gap-6">
                <nav-link
                    :href="route('products.show', { slug: product.slug })"
                    v-for="product in products.data"
                    :key="`product-${product.id}`"
                >
                    <ProductCard :product />
                </nav-link>
                <div class="col-span-3">
                    <pagination :meta="products.meta" />
                </div>
            </div>
        </div>
    </layout-container>
</template>
<script lang="ts" setup>
import ProductFilter from "@/components/client/product/filter.vue";
import type { Product, ProductFilters } from "@/types/products";
import ProductCard from "@/components/client/product/card.vue";
import { FunnelIcon, XMarkIcon } from "@heroicons/vue/24/outline";
import { Category } from "@/types/category";
import { router } from "@inertiajs/vue3";
import { ref } from "vue";

defineProps<{
    products: {
        meta: object;
        data: Array<Product>;
    };
    categories: Array<Category>;
    filtered: ProductFilters;
    errors: {
        [key in keyof ProductFilters]: string;
    };
}>();

const showFilters = ref(false);

const submitFilters = (filters: ProductFilters) => {
    router.get(
        "/products",
        { ...filters },
        {
            preserveState: true,
            preserveScroll: true,
        }
    );
};

const removeFilter = (filter: string) => {
    // let _filters = { ...filters.value };
    // delete _filters[filter as keyof ProductFilters];
    // filters.value = _filters;
    // submitFilters();
};
</script>
