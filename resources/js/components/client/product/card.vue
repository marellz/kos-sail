<template>
    <nav-link :href="route('products.show', { slug: product.slug })">
        <div class="group transition transform hover:scale-[1.03]">
            <div
                class="flex items-center justify-center px-6 pt-5 bg-primary bg-opacity-[04%] rounded-lg group-hover:bg-opacity-10"
            >
                <img
                    src="@/assets/images/drill-md.png"
                    alt=""
                    class="max-h-[145px]"
                />
            </div>
            <div class="px-4 py-3 relative">
                <div class="">
                    <h3
                        class="font-medium"
                        :class="{ 'text-gray-500': notInStock }"
                    >
                        {{ product.name }}
                        <span v-if="notInStock">[not in stock]</span>
                    </h3>
                    <p class="text-xs">
                        <span class="text-gray-500">in</span>
                        {{ product.category.name }}
                    </p>
                    <p class="text-sm text-primary mt-1" v-if="product.price" :class="{
                        'line-through  !text-gray-500': notInStock
                    }">
                        Ksh. {{ product.price.toLocaleString() }}
                    </p>
                    <img
                        class="absolute opacity-[26%] right-0"
                        src="@/assets/images/wavy.svg"
                        alt=""
                    />
                </div>
                <p class="line-clamp-3 mt-2 text-xs">
                    {{ product.description }}
                </p>
            </div>
        </div>
    </nav-link>
</template>
<script lang="ts" setup>
import { type Product } from "@/types/products";
import { computed } from "vue";
const props = defineProps<{
    product: Product;
}>();

const notInStock = computed(() => !props.product.in_stock);
</script>
