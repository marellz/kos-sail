<template>
    <div
        class="p-2 border border-transparent rounded-lg hover:bg-white hover:border-light-grey transition-all ease-linear"
    >
        <div class="rounded-lg bg-light-alt-2 relative">
            <img
                class="max-w-[80%]"
                src="@/assets/images/drill-md.png"
                alt=""
            />
            <ArrowTopRightOnSquareIcon
                class="h-4 absolute right-3 top-3 stroke-1"
            />
        </div>
        <div class="leading-normal mt-1">
            <h4 class="font-medium">
                {{ item.name }}
            </h4>
            <p class="text-xs text-grey">
                {{ item.short_description }}
            </p>
        </div>
        <div class="mt-4 flex justify-between">
            <p class="font-medium" :class="{ 'text-grey': !item.in_stock }">
                Ksh. {{ item.price }}
            </p>
            <template v-if="item.in_stock">
                <div class="flex items-center space-x-2 text-success">
                    <CheckCircleIcon class="h-5" />
                    <span class="text-xs">In stock</span>
                </div>
            </template>
            <template v-else>
                <div class="flex items-center space-x-2 text-warning">
                    <ExclamationCircleIcon class="h-5" />
                    <span class="text-xs">Out of stock</span>
                </div>
            </template>
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
