<template>
    <div>
        <page-head :title="pageName"></page-head>
        <layout-container>
            <div class="mt-10 grid grid-cols-2">
                <div>
                    <div class="relative bg-primary bg-opacity-5">
                        <img src="@/assets/images/drill-xl.png" alt="" />
                        <div
                            class="flex items-center space-x-8 absolute left-0 w-full bottom-0 p-4 justify-between"
                        >
                            <div class="bg-primary bg-opacity-20 p-3 rounded-full text-lg font-medium text-primary">
                                {{ currentImage }} /
                                {{ _product.images.length }}
                            </div>
                            <div class="space-x-8">
                                <button type="button">
                                    <icons-polygon
                                        class="rotate-[270deg] text-grey"
                                    ></icons-polygon>
                                </button>
                                <button type="button">
                                    <icons-polygon
                                        class="rotate-90 text-primary"
                                    ></icons-polygon>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="px-10 space-y-10">
                    <div class="space-y-5">
                        <div>
                            <h1 class="text-4xl font-medium">
                                {{ _product.name }}
                            </h1>
                            <p class="mt-4">
                                <span class="text-sm text-gray-500">by </span>
                                <span class="text-lg">
                                    {{ _product.brand.name }}
                                </span>
                                <span
                                    class="border-r border-gray-400 mx-3 py-1"
                                ></span>
                                <span class="text-sm text-gray-500">in </span>
                                <span>
                                    {{ _product.category.name }}
                                </span>
                            </p>
                        </div>
                        <p class="text-lg text-grey">
                            {{ _product.short_description }}
                        </p>
                    </div>
                    <div>
                        <div class="flex mb-3">
                            <div class="flex items-center space-x-4">
                                <div class="flex items-baseline">
                                    <p class="text-2xl" :class="{'line-through text-gray-500 text-sm': discountPrice}">
                                        Ksh. {{ _product.price.toLocaleString() }}
                                    </p>
    
                                    <p class="text-2xl ml-2 font-medium" v-if="discountPrice">
                                        {{ discountPrice.toLocaleString() }}
                                    </p>
                                </div>

                                <ProductAvailability :available="inStock" />
                            </div>
                        </div>
                        <icons-wavy
                            :class="{
                                'text-primary': inStock,
                                'text-warning': !inStock,
                            }"
                        />
                    </div>
                    <div>
                        <base-button
                            class="btn--primary"
                            :disabled="!inStock"
                            @click="makePurchase"
                        >
                            <span> Purchase </span>
                            <ShoppingBagIcon class="h-5" />
                        </base-button>
                    </div>
                    <div>
                        <p class="text-lg text-gray-600 leading-8">
                            {{ _product.description }}
                        </p>
                    </div>
                    <div>
                        <h2 class="text-sm font-medium mb-2 text-gray-600">
                            Product specifications
                        </h2>

                        <table>
                            <tbody>
                                <tr
                                    v-for="(spec, key) in JSON.parse(
                                        _product.specifications
                                    )"
                                    :key="`spec-${key}`"
                                    class="border-b"
                                >
                                    <td class="p-3 pl-0 text-grey">
                                        <span>
                                            {{ key }}
                                        </span>
                                    </td>
                                    <td class="px-3">
                                        <span>{{ spec }}</span>
                                    </td>
                                </tr>
                            </tbody>
                        </table>

                        <!-- <div class="flex">
                            <div>
                                <p v-for="(spec, key) in JSON.parse(_product.specifications)" :key="`spec-${key}`" class="flex items-center mb-3 border-b">
                                    <span class="w-24 pr-4 mr-4 py-2 text-gray-500 text-sm">
                                        {{ key }}
                                    </span>
                                    <span>
                                        {{ spec }}
                                    </span>
                                </p>
                            </div>
                        </div> -->
                    </div>
                    <div class="flex items-center space-x-3">
                        <base-button
                            class="border-gray-200 text-dark py-1.5 px-3 font-normal leading-4 over"
                        >
                            <ShareIcon class="h-6" />
                            <span>Share</span>
                        </base-button>
                        <base-button
                            class="border-gray-200 py-1.5 px-3 font-normal leading-4"
                            :class="{
                                'border-primary text-primary': favorited,
                            }"
                            @click="favorited = !favorited"
                        >
                            <HeartIcon
                                class="h-6"
                                :class="{
                                    'fill-current stroke-current': favorited,
                                }"
                            />
                            <span>Favorite</span>
                        </base-button>
                    </div>
                </div>
            </div>
        </layout-container>
    </div>
</template>
<script lang="ts" setup>
import { type Product } from "@/types/products";
import ProductAvailability from "@/components/client/product/availability.vue";
import { computed } from "vue";
import { HeartIcon, ShareIcon, ShoppingBagIcon } from "@heroicons/vue/24/outline";
import { ref } from "vue";
const props = defineProps<{
    product: {
        data: Product;
    };
}>();

const currentImage = ref(1);
const _product = computed(() => props.product.data);
const inStock = computed(() => _product.value.in_stock);
const pageName = computed(() => props.product.data.name ?? "Product page");
const favorited = ref(Math.random() > 0.5);
const makePurchase = () => {
    router.visit(route("cart.index"), {
        method: "post",
        data: {
            item: _product.value.slug,
        },
    });
};
</script>
