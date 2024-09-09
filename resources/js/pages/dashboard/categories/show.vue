<template>
    <page-head :title="`${category.name || 'Show Category'}`"></page-head>
    <layout-container>
        <div class="flex space-x-2 items-center">
            <page-title
                >Show category</page-title
            >
            <base-button
                type="button"
                class="!ml-auto btn--icon btn--outline-secondary"
                @click="editCategory"
            >
                <PencilSquareIcon class="h-5" />
                <span>Edit</span>
            </base-button>
            <base-button
                type="button"
                class="btn--icon border-error text-error hover:bg-error hover:text-white"
                @click="deleteCategory"
            >
                <TrashIcon class="h-5" />
                <span>Delete</span>
            </base-button>
        </div>

        <div class="mt-10">
            <div class="flex sm:items-center flex-col-reverse sm:flex-row">
                <h1 class="text-3xl md:text-4xl leading-normal">
                    {{ category.name }}
                </h1>
            </div>
            <div class="mt-6">
                <h4 class="font-medium text-grey">Category information</h4>
                <p class="mt-3">
                    {{ category.description ?? "No description" }}
                </p>
            </div>
            <div class="mt-6" v-if="category.subcategories">
                <h4 class="font-medium text-grey">Subcategories</h4>
                <div class="mt-4">
                    <ul class="space-y-4">
                        <li
                            v-for="item in category.subcategories"
                            class="px-4"
                            :key="item.id"
                        >
                            <div class="flex max-w-sm items-center space-x-6">
                                <div class="flex-auto">
                                    <h4 class="text-ms">
                                        {{ item.name }}
                                    </h4>
                                </div>
                                <nav-link
                                    :href="
                                        route('admin.categories.show', {
                                            category: item.slug,
                                        })
                                    "
                                >
                                    <ArrowTopRightOnSquareIcon
                                        class="h-6 text-gray-500 hover:text-red-500"
                                    />
                                </nav-link>
                            </div>
                        </li>
                        <li class="">
                            <a :href="route('admin.categories.create', {'parent': category.id })" class="font-medium inline-flex space-x-4 py-3 hover:bg-gray-50 p-4">
                                <PlusIcon class="h-5" />
                                <span>New subcategory</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
             <div class="mt-6">
                <h4 class="font-medium text-grey">Products</h4>
                 <div
                    class="mt-3 grid sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-3"
                >
                    <nav-link
                        v-for="item in category.products"
                        :key="item.id"
                        :href="
                            route('admin.products.show', { product: item.slug })
                        "
                    >
                        <product-tag :item />
                    </nav-link>
                </div>
            </div>
        </div>
    </layout-container>
</template>
<script lang="ts" setup>
import Dashboard from "@/layouts/dashboard.vue";
import ProductTag from "@/components/admin/products/tag.vue";
import {
    ArrowTopRightOnSquareIcon,
    PencilSquareIcon,
    TrashIcon,
} from "@heroicons/vue/24/outline";
import { router } from "@inertiajs/vue3";
import type { Category } from "@/types/category";
import { useToastStore } from "@/store/toasts";
import { PlusIcon } from "@heroicons/vue/24/solid";

const toasts = useToastStore();

defineOptions({
    layout: Dashboard,
});

const props = defineProps<{
    category: Category;
}>();

const editCategory = () => {
    router.visit(route("admin.categories.edit", { slug: props.category.slug }));
};

const deleteCategory = () => {
    if (confirm("Really?")) {
        router.visit(
            route("admin.categories.destroy", { slug: props.category.slug }),
            {
                method: "delete",
                onSuccess() {
                    toasts.createToast({
                        type: "success",
                        message:
                            "Successfully deleted category and all it's subcategories",
                    });
                },
            }
        );
    }
};
</script>
