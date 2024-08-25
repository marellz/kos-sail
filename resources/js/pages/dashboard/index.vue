<template>
    <page-head title="Dashboard" />

    <div class="mt-10 space-y-10">
        <div class="flex gap-5 flex-wrap">
            <div
                class="border rounded-xl p-3"
                v-for="(item, key) in stats"
                :key="key"
            >
                <div class="text-gray-800">
                    <h4 class="text-lg">
                        {{ labels[key as keyof Stats].title }}
                    </h4>
                    <p class="text-xs text-gray-500">
                        {{ labels[key as keyof Stats].description }}
                    </p>
                </div>
                <p class="text-4xl font-light mt-4 text-end">
                    {{ item }}
                </p>
            </div>
        </div>

        <div>
            <div class="flex justify-between">
                <h1 class="text-lg font-medium">Most popular products</h1>
                <nav-link
                    :href="route('admin.products.index')"
                    class="btn-icon text-primary"
                >
                    <span>View all</span>
                    <ArrowLongRightIcon class="h-5" />
                </nav-link>
            </div>
            <div
                class="grid sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-3"
            >
                <nav-link
                    v-for="item in products"
                    :key="item.id"
                    :href="route('admin.products.show', { product: item.slug })"
                >
                    <product-tag :item />
                </nav-link>
            </div>
        </div>
    </div>
</template>

<script setup lang="ts">
import Dashboard from "@/layouts/dashboard.vue";
import { Product } from "@/types/products";
import { ArrowLongRightIcon } from "@heroicons/vue/24/outline";
import ProductTag from "@/components/admin/products/tag.vue";

interface Stats {
    products: number;
    users: number;
    views: number;
    contacts: number;
}

type StatLabels = {
    [key in keyof Stats]: { title: string; description: string };
};

defineProps<{
    stats: Stats;
    products: Array<Product>;
}>();

defineOptions({
    layout: Dashboard,
});

const labels: StatLabels = {
    products: { title: "Products", description: "Sum of all products" },
    users: { title: "Users", description: "All registered users" },
    views: { title: "Views", description: "Total product page views" },
    contacts: { title: "Contacts", description: "Unresolved contact messages" },
};
</script>
