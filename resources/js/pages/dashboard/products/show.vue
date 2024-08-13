<template>
    <page-head :title="`Admin | ${item ? item.name : 'Product'}`"></page-head>
    <layout-container>
        <div class="grid lg:grid-cols-3 gap-10">
            <!-- photos -->
            <div class="lg:col-start-1 lg:row-start-1">
                <div class="mt-3">
                    <div class="bg-light-alt-2 rounded-lg">
                        <img
                            src="@/assets/images/drill-xl.png"
                            class="max-w-full"
                            alt=""
                        />
                    </div>
                    <ul class="flex flex-wrap mt-3 gap-3">
                        <li
                            class=""
                            v-for="(i, index) in images"
                            :key="i"
                            @click="activeImageIndex = index"
                        >
                            <button
                                type="button"
                                class="rounded-lg w-20 h-20 inline-flex items-center"
                                :class="{
                                    'bg-light-alt-primary':
                                        activeImageIndex === index,
                                }"
                            >
                                <img
                                    class="w-full h-full object-cover hover:object-contain transform transition ease-linear"
                                    :src="i"
                                    alt=""
                                />
                            </button>
                        </li>
                    </ul>
                </div>
            </div>
            <!-- details -->
            <div class="row-start-1 lg:col-span-2">
                <div class="space-y-5">
                    <div
                        class="flex justify-between items-center flex-wrap-reverse"
                    >
                        <p class="text-lg text-grey">Product details</p>
                        <nav-link
                            :href="`${route('admin.products.edit', {
                                id: item.slug,
                            })}`"
                            as="button"
                            class="btn btn--outline-secondary"
                        >
                            <span class="leading-normal">
                                Edit this product
                            </span>
                            <PencilSquareIcon class="h-5" />
                        </nav-link>
                    </div>
                    <div>
                        <h1 class="text-4xl">{{ item.name }}</h1>
                        <p class="text-grey">
                            {{ item.short_description }}
                        </p>
                    </div>
                    <div class="space-y-3">
                        <h4 class="text-grey font-medium">
                            General information
                        </h4>
                        <p>Brand &ndash; {{ item.brand.name }}</p>
                        <p>Category &ndash; {{ item.category.name }}</p>
                    </div>
                    <div class="space-y-3">
                        <h4 class="text-grey font-medium">Description</h4>
                        <p>
                            {{ item.description ?? "No description provided" }}
                        </p>
                    </div>
                    <div class="space-y-3">
                        <h4 class="text-grey font-medium">Product status</h4>
                        <div>
                            <template v-if="item.in_stock">
                                <div
                                    class="flex items-center space-x-2 text-success"
                                >
                                    <CheckCircleIcon class="h-8" />
                                    <span class="text-lg">In stock</span>
                                </div>
                            </template>
                            <template v-else>
                                <div
                                    class="flex items-center space-x-2 text-warning"
                                >
                                    <ExclamationCircleIcon class="h-8" />
                                    <span class="text-lg">Out of stock</span>
                                </div>
                            </template>
                        </div>
                    </div>
                </div>
            </div>
            <!-- other details -->
            <div class="lg:row-start-2 lg:col-start-2 lg:col-span-2">
                <div class="space-y-5">
                    <div>
                        <h4 class="text-grey font-medium">Specifications</h4>

                        <ul class="space-y-2 mt-4">
                            <li
                                v-for="(spec, key) in specifications"
                                :key="`spec-${key}`"
                                class="flex space-x-2"
                            >
                                <span class="text-gray-600">{{ key }}</span>
                                <span> &ndash;</span>
                                <span>{{ spec }}</span>
                            </li>
                        </ul>
                    </div>

                    <div>
                        <h4 class="text-grey font-medium">Pricing</h4>
                        <div class="mt-4">
                            <p v-if="item.discount_price" class="text-gray-500">
                                Discounted!
                            </p>
                            <p>
                                <span class="text-sm text-gray-500">Ksh.</span>
                                <span
                                    class="text-2xl ml-1"
                                    :class="{
                                        '!text-base line-through text-gray-500':
                                            item.discount_price,
                                    }"
                                    >{{ item.price.toLocaleString() }}</span
                                >
                                <span
                                    class="text-xl ml-2 font-medium"
                                    v-if="item.discount_price"
                                >
                                    {{ item.discount_price.toLocaleString() }}
                                </span>
                            </p>
                        </div>
                    </div>
                    <div class="mt-12 italic text-gray-500">
                        Product last updated on {{ item.last_updated }}
                    </div>
                </div>
            </div>
            <picture-modal
                :show="activeImageIndex !== null"
                @close="activeImageIndex = null"
            >
                <img :src="item.images[activeImageIndex as number]" alt="" />
            </picture-modal>
        </div>
    </layout-container>
</template>
<script lang="ts" setup>
import { type Product } from "@/types/products";
import Dashboard from "@/layouts/dashboard.vue";
import { computed } from "vue";
import { ref } from "vue";
import { CheckCircleIcon, ExclamationCircleIcon, PencilSquareIcon } from "@heroicons/vue/24/outline";
import PictureModal from "@/components/base/picture-modal.vue";
const props = defineProps<{
    product: {
        data: Product;
    };
}>();

defineOptions({
    layout: Dashboard,
});

const activeImageIndex = ref<null | number>(null);
const item = computed(() => props.product.data);
const specifications = item.value?.specifications;
const images = item.value?.images;
</script>
