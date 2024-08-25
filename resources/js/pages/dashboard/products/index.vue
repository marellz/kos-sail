<template>
    <page-head title="Admin | Products"></page-head>
    <layout-container>
        <div
            class="flex flex-col sm:flex-row items-start sm:items-center sm:justify-between"
        >
            <page-title>Products</page-title>
            <div class="flex items-center ml-auto space-x-2 mt-3 sm:mt-0">
                <admin-add-button :href="route('admin.products.create')">
                    <span>Add product</span>
                </admin-add-button>
                <a
                    class="btn btn--outline-secondary"
                    target="_blank"
                    :href="route('admin.products.export')"
                >
                    <ArrowDownTrayIcon class="h-5" />
                    <span>Export products</span>
                </a>
            </div>
        </div>
        <div class="mt-6 flex flex-wrap items-center">
            <filter-search class="w-full mb-2 md:w-auto md:mr-5 md:mb-0" />
            <filter-toggle class="mr-5 md:mb-0" />
            <toggle-view v-model="viewModel" />
        </div>

        <div class="mt-5" v-if="products">
            <p>
                Showing {{ products.meta.from }} to {{ products.meta.to }} of
                {{ products.meta.total }} products
            </p>
        </div>
        <div class="mt-10">
            <template v-if="viewModel === 'table'">
                <products-table
                    :current-product="product?.id"
                    :items="products.data"
                    @show="showProduct"
                    @delete="deleteProduct"
                    @edit="editProduct"
                />
            </template>
            <template v-else-if="viewModel === 'cards'">
                <div
                    class="grid sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-10"
                >
                    <nav-link
                        v-for="item in products.data"
                        :href="route('admin.products.show', { id: item.slug })"
                    >
                        <product-card :item></product-card>
                    </nav-link>
                </div>
            </template>
            <pagination :meta="products.meta" />
        </div>
    </layout-container>
</template>
<script lang="ts" setup>
import Dashboard from "@/layouts/dashboard.vue";
import { type Product } from "@/types/products";
import AdminAddButton from "@/components/admin/add-btn.vue";
import ToggleView from "@/components/admin/products/toggle-view.vue";
import ProductsTable from "@/components/admin/products/table.vue";
import ProductCard from "@/components/admin/products/card.vue";
import { router } from "@inertiajs/vue3";
import { ref, computed } from "vue";
import { ArrowDownTrayIcon } from "@heroicons/vue/24/outline";

defineOptions({
    layout: Dashboard,
});

const props = defineProps<{
    products: {
        data: Product[];
        meta: {
            per_page: number;
            total: number;
            current_page: number;
            from: number;
            to: number;
        };
    };
    product?: Product;
    showForm?: boolean;
    showProduct?: boolean;
}>();

const currentPage = computed(() => props.products.meta.current_page);

const viewModel = ref<"table" | "cards">("table");

const showProduct = (slug: string) => {
    router.visit(route("admin.products.show", { id: slug }));
};

const editProduct = (slug: string) => {
    router.visit(
        `${route("admin.products.edit", { id: slug })}?page=${
            currentPage.value
        }`
    );
};

const deleteProduct = (slug: string) => {
    if (
        confirm(
            "Are you sure you want to delete this product? This will delete all images also. This action is irreversible."
        )
    ) {
        router.visit(
            `${route("admin.products.destroy", { id: slug })}?page=${
                currentPage.value
            }`,
            {
                method: "delete",
                onFinish() {
                    console.log("Product deleted!");
                },
            }
        );
    }
};
</script>
