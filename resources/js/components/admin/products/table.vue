<template>
    <div class="overflow-auto">
        <table class="products-table border-separate border-spacing-y-3">
            <thead>
                <tr class="">
                    <th
                        v-for="header in headers"
                        class="products-table__th last:text-right"
                    >
                        <span>
                            {{ header.label }}
                        </span>
                    </th>
                </tr>
            </thead>
            <tbody>
                <template v-if="items.length">
                    <tr v-for="item in items" :class="{'row--active': currentProduct === item.id}">
                        <td width="50px">
                            <a href="#" @click.prevent="showProduct(item.slug)">
                                <img src="@/assets/images/drill-sm.png" class="max-w-[45px]" alt="">
                            </a>
                        </td>
                        <td>
                            <a class="flex" href="#" @click.prvent="showProduct(item.slug)">
                                <div>
                                    <h2 class="font-medium">
                                        {{ item.name }}
                                    </h2>
                                    <p class="text-xs text-grey">
                                        {{ item.short_description }}
                                    </p>
                                </div>
                                <div class="pl-5">
                                    <ArrowTopRightOnSquareIcon class="h-3" />
                                </div>
                            </a>
                        </td>
                        <td>
                            <div v-if="item.discount_price">
                                <p class="font-medium">
                                   Ksh. {{item.discount_price.toLocaleString() }}
                                </p>
                                <p class="text-xs line-through text-grey">
                                   Ksh. {{item.price.toLocaleString() }}
                                </p>
                            </div>
                            <p v-else>
                                Ksh.
                                {{ item.price.toLocaleString() }}
                            </p>
                        </td>
                        <td>
                            <template v-if="item.in_stock">
                                <div
                                    class="flex items-center space-x-2 text-success"
                                >
                                    <CheckCircleIcon class="h-5" />
                                    <span class="text-xs">In stock</span>
                                </div>
                            </template>
                            <template v-else>
                                <div
                                    class="flex items-center space-x-2 text-warning"
                                >
                                    <ExclamationCircleIcon class="h-5" />
                                    <span class="text-xs">Out of stock</span>
                                </div>
                            </template>
                        </td>
                        <td>
                            <span class="text-xs italic text-grey">
                                {{ item.last_updated }}
                            </span>
                        </td>
                        <td>
                            <div
                                class="flex items-center justify-end space-x-2"
                            >
                                <table-button
                                    @click="editProduct(item.slug)"
                                    class="hover:text-warning hover:border-warning focus:ring-current"
                                >
                                    <PencilSquareIcon class="h-4" />
                                    <span>edit</span>
                                </table-button>
                                <table-button
                                    class="hover:text-error hover:border-error focus:ring-current"
                                    @click="deleteProduct(item.slug)"
                                >
                                    <TrashIcon class="h-4" />
                                    <span>delete</span>
                                </table-button>
                            </div>
                        </td>
                    </tr>
                </template>
                <template v-else>
                    <tr>
                        <td :colspan="headers.length">
                            <div class="py-5">
                                <p class="text-center">No items to display</p>
                            </div>
                        </td>
                    </tr>
                </template>
            </tbody>
        </table>
    </div>
</template>
<script lang="ts" setup>
import { Product } from "@/types/products";
import TableButton from "@/components/admin/products/table-btn.vue";
import {
    CheckCircleIcon,
    ExclamationCircleIcon,
    TrashIcon,
    PencilSquareIcon,
ArrowTopRightOnSquareIcon,
} from "@heroicons/vue/24/outline";

defineProps<{
    items: Array<Product>;
    currentProduct?: string | number;
}>();

const headers = [
    {
        key: "featured_image",
        label: "",
    },
    {
        key: "item",
        label: "Item",
    },
    {
        key: "price",
        label: "Price",
    },
    {
        key: "in_stock",
        label: "Availability",
    },
    {
        key: "updated_at",
        label: "Last updated",
    },
    {
        key: "actions",
        label: "Actions",
    },
];

const emit = defineEmits(['show', 'edit', 'delete']);

const showProduct = (slug: string) =>{
    emit('show', slug)
}

const editProduct = (slug: string) =>{
    emit('edit', slug)
}

const deleteProduct = (slug: string) =>{
    emit('delete', slug)
}

</script>
