<template>
    <nav-link :href="route('products.show', {'slug': product.slug})">
        <div class="bg-primary bg-opacity-[04%] rounded-lg transition transform hover:scale-[1.03] hover:bg-opacity-10">
            <div class="flex items-center justify-center px-6 pt-5">
                <img
                    src="@/assets/images/drill-md.png"
                    alt=""
                    class="max-h-[145px]"
                />
            </div>
            <div class="px-4 py-3 relative">
                <div class="">
                    <h3 class="font-medium text-sm">{{ product.name }}</h3>
                    <p class="text-xs text-primary mt-1" v-if="product.price">
                        Ksh.{{ product.price.toLocaleString() }}
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
defineProps<{
    product: Product;
}>();
</script>
