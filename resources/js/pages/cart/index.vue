<template>
    <page-head title="Cart"></page-head>
    <layout-container class="w-3/4 mx-auto">
        <div class="flex items-center justify-between">
            <page-title>Your cart</page-title>
            <nav-link
                v-if="_items.length"
                as="button"
                method="post"
                :href="route('cart.reset')"
                class="btn btn--outline-primary"
                @click=""
                >Reset cart</nav-link
            >
        </div>
        <div class="mt-10">
            <table v-if="_items.length" class="cart-table w-full">
                <thead>
                    <tr class="">
                        <th>Item</th>
                        <th></th>
                        <th class="!text-center">Quantity</th>
                        <th class="!text-center">Price</th>
                        <th>Total</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="item in _items" :key="item.slug">
                        <td>
                            <div
                                class="h-20 w-20 bg-grey bg-opacity-20 rounded-lg flex items-center justify-center"
                            >
                                <img
                                    src="@/assets/images/drill-sm.png"
                                    class="h-12 object-contain"
                                    alt=""
                                />
                            </div>
                        </td>
                        <td>
                            <h2
                                class="text-lg font-medium"
                                :class="{ 'text-grey': !item.in_stock }"
                            >
                                {{ item.name }}

                                <span
                                    v-if="!item.in_stock"
                                    class="text-error opacity-50"
                                    >[not in stock]</span
                                >
                            </h2>
                            <p class="text-grey text-sm mt-1">
                                {{ item.short_description }}
                            </p>
                        </td>
                        <td>
                            <div class="flex items-center">
                                <button
                                    type="button"
                                    class="px-2 disabled:text-gray-300"
                                    :disabled="
                                        item.quantity <= 1 || !item.in_stock
                                    "
                                    @click="
                                        updateItem(item.slug, --item.quantity)
                                    "
                                >
                                    <MinusCircleIcon class="h-7 stroke-1" />
                                </button>
                                <input
                                    type="number"
                                    class="border-0 w-12 text-center bg-grey bg-opacity-10 rounded-lg p-3 appearance-none"
                                    v-model="item.quantity"
                                    readonly
                                />
                                <button
                                    type="button"
                                    class="px-2 disabled:text-gray-300"
                                    :disabled="!item.in_stock"
                                    @click="
                                        updateItem(item.slug, ++item.quantity)
                                    "
                                >
                                    <PlusCircleIcon class="h-7 stroke-1" />
                                </button>
                            </div>
                        </td>
                        <td class="vertical-align-bottom">
                            <div
                                v-if="item.discount_price"
                                class="flex items-end"
                            >
                                <div>
                                    <p class="line-through text-xs text-grey">
                                        <span>Ksh.</span>
                                        {{ item.price.toLocaleString() }}
                                    </p>
                                    <p>
                                        <span>Ksh.</span>
                                        {{
                                            item.discount_price.toLocaleString()
                                        }}
                                    </p>
                                </div>
                            </div>

                            <p v-else class="pt-[18px]">
                                <span class="text-xs"> Ksh. </span>
                                {{ item.price.toLocaleString() }}
                            </p>
                        </td>
                        <td>
                            <p class="text-xs text-grey">
                                Ksh.
                                {{
                                    (
                                        item.discount_price || item.price
                                    ).toLocaleString()
                                }}
                                x
                                {{ item.quantity }}
                            </p>
                            <p>
                                Ksh.
                                {{
                                    (
                                        (item.discount_price || item.price) *
                                        item.quantity
                                    ).toLocaleString()
                                }}
                            </p>
                        </td>
                        <td>
                            <base-button class="btn--sm" @click="deletetItem(item.slug)">
                                <TrashIcon
                                    class="h-5 text-grey hover:text-error"
                                />
                            </base-button>
                        </td>
                    </tr>
                    <tr class="subtotal-row">
                        <td>
                            <h4 class="text-xl font-medium text-grey">
                                Subtotal
                            </h4>
                        </td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td>
                            <p class="text-lg font-medium">
                                Ksh. {{ subTotal.toLocaleString() }}
                            </p>
                        </td>
                        <td></td>
                    </tr>
                    <tr>
                        <td colspan="5">
                            <div class="flex justify-end">
                                <div>
                                    <base-button class="btn--primary">
                                        <span>Complete purchase</span>
                                        <ArrowLongRightIcon class="h-5" />
                                    </base-button>
                                    <p class="text-xs mt-1 text-end">Checkout via Whatsapp</p>
                                </div>
                            </div>
                        </td>
                        <td></td>
                    </tr>
                </tbody>
            </table>
            
            <template v-else>
                <div class="grid grid-cols-3 items-center">
                    <img src="@/assets/images/empty-cart.svg" class="max-w-sm" alt="">
                    <div class="space-y-5">
                        <h1 class="text-4xl font-medium">Your cart is empty.</h1>
                        <p class="text-lg text-grey">Looks like you haven’t added anything to your cart yet. Start exploring our wide range of tools and equipment to find what you need!</p>
                        <nav-link :href="route('products.index')" as="button" class="btn btn--lg font-medium btn--outline-secondary">
                            <span>Browse tools</span>
                            <ArrowLongRightIcon class="h-6" />
                        </nav-link>
                    </div>

                </div>
            </template>
        </div>
    </layout-container>
</template>
<script lang="ts" setup>
import { ArrowLongRightIcon, MinusCircleIcon, PlusCircleIcon, } from "@heroicons/vue/24/outline";
import { TrashIcon } from "@heroicons/vue/24/solid";
import { CartItem } from "@/types/cart"
import { router } from "@inertiajs/vue3";
import { computed } from "vue";

const props = defineProps<{
    items: Array<CartItem>;
}>();

const _items = computed(() =>
    props.items.map((item) => ({ ...item.item, quantity: item.quantity }))
);

const subTotal = computed(() =>
    _items.value.reduce((total, item) => {
        const price = item.discount_price || item.price;

        return item.in_stock ? total + price * item.quantity : total;
    }, 0)
);

const updateItem = (slug: string, quantity: number) => {
    router.visit(route("cart.update"), {
        method: "patch",
        data: {
            item: slug,
            quantity,
        },
        preserveScroll: true,
        preserveState: true,
    });
};

const deletetItem = (slug: string) => {
    router.visit(route('cart.destroy', { slug }), {
        method: 'delete'
    })
}
</script>
