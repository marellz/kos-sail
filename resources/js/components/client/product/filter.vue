<template>
    <form ref="form" @submit.prevent="submit">
        <div class="flex items-center mb-4">
            <h3 class="text-xl font-medium">Filters</h3>
            <div class="flex space-x-2 ml-auto">
                <button type="reset" class="btn btn--sm" @click="reset">
                    <span>Reset</span>
                    <ArrowPathIcon class="h-5" />
                </button>
                <button type="button" class="lg:hidden" @click="close">
                    <XMarkIcon class="h-5" />
                </button>
            </div>
        </div>

        <img class="mb-8" src="@/assets/images/wavy.svg" alt="" />

        <div
            v-if="Object.keys(errors).length"
            class="my-4 py-2 px-2 text-error bg-red-100 rounded-lg"
        >
            <div class="flex items-center space-x-4 py-2">
                <ExclamationTriangleIcon class="h-6" />
                <h4 class="text-sm font-medium">Filter errors</h4>
            </div>
            <ul class="space-y-2 list-disc pl-5">
                <li v-for="(error, index) in errors" :key="index">
                    <p class="text-xs">
                        {{ error }}
                    </p>
                </li>
            </ul>
        </div>
        <div class="grid grid-cols-2 gap-4">
            <div class="col-span-2">
                <form-input label="Keyword" v-model="filters.query" />
            </div>
            <div class="col-span-2">
                <form-select
                    placeholder="Select category"
                    label="Category"
                    v-model="filters.category_id"
                >
                    <option
                        v-for="category in categories"
                        :key="`category-${category.id}`"
                        :value="category.id"
                    >
                        <span>
                            {{ category.parent_id ? "-" : "" }}
                            {{ category.name }}
                        </span>
                    </option>
                </form-select>
            </div>
            <div>
                <form-input
                    label="Price min"
                    v-model="filters.price_min"
                ></form-input>
            </div>
            <div>
                <form-input
                    label="Price max"
                    v-model="filters.price_max"
                ></form-input>
            </div>
            <div class="col-span-2">
                <form-select
                    placeholder="Select order"
                    label="Order by"
                    v-model="filters.order_by"
                >
                    <option
                        v-for="option in orderByOptions"
                        :value="option.key"
                        :key="`order-by-${option.key}`"
                    >
                        {{ option.label }}
                    </option>
                </form-select>
            </div>
            <div class="col-span-2">
                <base-button
                    :disabled="!canApplyFilter"
                    class="btn--outline-primary w-full"
                    >Apply</base-button
                >
            </div>
        </div>
    </form>
</template>
<script lang="ts" setup>
import { Category } from "@/types/category";
import { ProductFilters } from "@/types/products";
import {
    ArrowPathIcon,
    ExclamationTriangleIcon,
} from "@heroicons/vue/24/outline";
import { XMarkIcon } from "@heroicons/vue/24/solid";
import { router } from "@inertiajs/vue3";
import { computed, ref, onMounted } from "vue";

const props = defineProps<{
    categories: Array<Category>;
    filteredValues: ProductFilters;
    errors: {
        [key in keyof ProductFilters]: string;
    };
}>();

const form = ref();

const emit = defineEmits(["submit", "close"]);

const filters = defineModel<ProductFilters>({default: {}});

const submit = () => {
    emit("submit", filters.value);
};

const orderByOptions = [
    {
        label: "Alphabetical(ascending)",
        key: "alphabetical_asc",
    },
    {
        label: "Alphabetical(descending)",
        key: "alphabetical_desc",
    },
    {
        label: "Price(descending)",
        key: "price_desc",
    },
    {
        label: "Price(ascending)",
        key: "price_asc",
    },
    {
        label: "Date added(latest)",
        key: "newest",
    },
    {
        label: "Date added(oldest)",
        key: "oldest",
    },
];

const canApplyFilter = computed(() => true);

const reset = () => {
    router.visit(route("products.index"), {
        onSuccess() {
            form.value.reset();
        },
    });
};

const close = () => {
    emit('close')
}

onMounted(() => {
    if (Object.keys(props.filteredValues).length) {
        filters.value = { ...props.filteredValues };
    }
});
</script>
