<template>
    <page-head title="Browse products"></page-head>
    <layout-container>
        <div class="grid grid-cols-4 gap-10">
            <div class="col-span-3 col-start-2">
                <page-title>Browse products</page-title>
                <div class="pt-10 flex items-center space-x-2">
                    <template v-if="Object.keys(filtered).length">
                        <div
                            class="border flex items-center space-x-4 rounded-full py-1 px-5"
                            v-for="(filter, key) in filtered"
                            :key="`filter-${key}`"
                        >
                            <div class="">
                                <p class="text-xs text-grey">
                                    {{ filter.label }}
                                </p>
                                <p class="text-base">
                                    {{ filter.value ?? "Null" }}
                                </p>
                            </div>
                            <button
                                type="button"
                                class="bg-gray-100 rounded-full h-4 w-4 hover:bg-gray-500 hover:text-white"
                                @click="removeFilter(filter.key)"
                            >
                                <XMarkIcon class="h-4" />
                            </button>
                        </div>
                    </template>
                </div>
            </div>
        </div>
        <div class="mt-10 grid grid-cols-4 items-start gap-10">
            <div
                v-if="showFilters"
                class="py-6 px-7 rounded-xl bg-light-grey bg-opacity-15 sticky top-10"
            >
                <ProductFilter
                    v-model="filters"
                    :filtered-values
                    :errors
                    :categories
                    @submit="submitFilters"
                />
            </div>
            <div class="col-span-3 grid grid-cols-3 gap-6">
                <template v-if="products.data.length">
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
                </template>
                <template v-else>
                    <div class="col-span-3">
                        <div
                            class="max-w-2xl gap-10 mx-auto flex items-center justify-center"
                        >
                            <img
                                src="@/assets/images/no-data.svg"
                                class="max-w-[200px]"
                                alt=""
                            />
                            <div class="space-y-3">
                                <h1 class="text-3xl font-medium">
                                    No matches.
                                </h1>
                                <p class="text-grey">
                                    Try adjusting your filters or browse through
                                    other categories to find what you're looking
                                    for.
                                </p>
                            </div>
                        </div>
                    </div>
                </template>
            </div>
        </div>
    </layout-container>
</template>
<script lang="ts" setup>
import type { Product, ProductFilters } from "@/types/products";
import ProductFilter from "@/components/client/product/filter.vue";
import ProductCard from "@/components/client/product/card.vue";
import { XMarkIcon } from "@heroicons/vue/24/outline";
import { Category } from "@/types/category";
import { router } from "@inertiajs/vue3";
import { ref } from "vue";

defineProps<{
    products: {
        meta: object;
        data: Array<Product>;
    };
    categories: Array<Category>;
    filtered: Array<{
        key: string;
        label: string;
        value: string | number;
    }>;
    filteredValues: ProductFilters;
    errors: {
        [key in keyof ProductFilters]: string;
    };
}>();

const showFilters = ref(true);

const filters = ref<ProductFilters>({});

const submitFilters = (filters: ProductFilters) => {
    // delete unused/empty keys
    for (const key in filters) {
        let val = filters[key as keyof ProductFilters];
        if (val === null || val === "") {
            delete filters[key as keyof ProductFilters];
        }
    }

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
    let _filters = { ...filters.value };
    delete _filters[filter as keyof ProductFilters];
    filters.value = _filters;
    submitFilters(_filters);
};
</script>
