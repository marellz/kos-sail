<template>
    <page-head title="Browse products"></page-head>
    <layout-container>
        <div class="grid lg:grid-cols-4 gap-10">
            <div class="lg:col-span-3 lg:col-start-2">
                <div class="flex justify-between">
                    <page-title>Browse products</page-title>
                    <button
                        class="btn btn--outline-primary lg:hidden"
                        :class="{
                            'ring ring-primary ring-opacity-30 ring-offset-2':
                                showFilters,
                        }"
                        @click="showFilters = !showFilters"
                    >
                        <span>Filters</span>
                        <FunnelIcon class="h-5" />
                    </button>
                </div>
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
        <div
            class="mt-10 grid lg:grid-cols-3 xl:grid-cols-4 items-start gap-10"
            ref="filtersElement"
        >
            <span
                class="invisible bg-dark fixed inset-0 z-10 bg-opacity-20 lg:hidden transform transition-all duration-200 ease-in-out"
                :class="{ '!visible': showFilters }"
                @click="showFilters = false"
            ></span>
            <div
                class="p-5 lg:py-6 lg:px-7 lg:rounded-xl bg-white shadow bottom-auto fixed inset-0 max-w-md mx-auto z-50 rounded-b-xl transform -translate-y-full invisible ease-in-out transition delay-200 lg:sticky lg:top-20 lg:transform-none lg:visible lg:shadow-none lg:bg-gray-300 lg:bg-opacity-25"
                :class="{ '!visible !translate-y-0 delay-0': showFilters }"
            >
                <ProductFilter
                    v-model="filters"
                    :filtered-values
                    :errors
                    :categories
                    @submit="submitFilters"
                    @close="showFilters = false"
                />
            </div>
            <!-- lg:col-span-2 xl:col-span-3 grid md:grid-cols-2 xl:grid-cols-3 gap-6 -->
            <div
                class="md:col-span-2 xl:col-span-3 grid sm:grid-cols-2 xl:grid-cols-3 gap-6"
            >
                <template v-if="products.data.length">
                    <nav-link
                        :href="route('products.show', { slug: product.slug })"
                        v-for="product in products.data"
                        :key="`product-${product.id}`"
                    >
                        <ProductCard :product />
                    </nav-link>
                    <div class="sm:col-span-2 xl:col-span-3">
                        <pagination :meta="products.meta" />
                    </div>
                </template>
                <template v-else>
                    <div class="sm:col-span-2 xl:col-span-3">
                        <product-no-results />
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
import ProductNoResults from "@/components/client/product/no-results.vue";
import { FunnelIcon, XMarkIcon } from "@heroicons/vue/24/outline";
import { onClickOutside } from "@vueuse/core";
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

const filtersElement = ref();
const showFilters = ref(false);

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
onClickOutside(filtersElement, () => {
    if (showFilters.value) {
        showFilters.value = false;
    }
});
</script>
