<template>
    <div class="flex border rounded-lg overflow-hidden">
        <div
            class="bg-light-alt-2 w-24 flex-none flex items-center justify-center"
        >
            <img class="flex-none" src="@/assets/images/drill-md.png" alt="" />
        </div>
        <div class="px-2 py-1">
            <div class="flex space-x-1 items-center">
                <span class="text-sm">
                    {{ item.name }}
                </span>

                <span>
                    &ndash;
                </span>

                <span class="text-xs text-grey" :class="{'text-warning': !item.in_stock}">
                    Ksh. {{ (item.discount_price || item.price).toLocaleString() }}
                </span>
            </div>
            <p class="text-xs text-grey line-clamp-2" :title="item.description">{{ item.short_description }}</p>
        </div>
    </div>
</template>
<script lang="ts" setup>
import { Product } from "@/types/products";
import {
    ArrowTopRightOnSquareIcon,
    CheckCircleIcon,
    ExclamationCircleIcon,
} from "@heroicons/vue/24/outline";
defineProps<{
    item: Product;
}>();
</script>
