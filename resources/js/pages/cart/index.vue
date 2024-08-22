<template>
    <page-head title="Cart"></page-head>
    <layout-container class="md: 4/5 lg:w-3/4 mx-auto">
        <div class="flex items-center justify-between">
            <page-title>Your cart</page-title>
            <nav-link
                v-if="_items.length"
                as="button"
                method="post"
                :href="route('cart.reset')"
                class="btn btn--outline-secondary hover:bg-error hover:border-error"
            >
                <XCircleIcon class="h-6" />
                <span>Reset cart</span>
            </nav-link>
        </div>
        <div class="mt-10">
            <table v-if="_items.length" class="cart-table w-full">
                <thead>
                    <tr class="">
                        <th>Item</th>
                        <th></th>
                        <th class="!text-center">Quantity</th>
                        <th class="">Price</th>
                        <th>Total</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="item in _items" :key="item.slug">
                        <td class="order-first md:order-unset w-1/2 md:w-auto">
                            <div
                                class="h-28 w-28 md:h-20 md:w-20 bg-grey bg-opacity-20 rounded-lg flex items-center justify-center"
                            >
                                <img
                                    src="@/assets/images/drill-sm.png"
                                    class="object-contain md:h-12 w-full md:w-auto"
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
                        <td
                            class="order-first self-center flex-auto md:w-auto md:border-none md:order-unset md:align-unset"
                        >
                            <form-quantity
                                class="justify-center"
                                :value="item.quantity"
                                :disabled="!item.in_stock"
                                @update="(value: number)=> updateItem(item.slug, value)"
                            ></form-quantity>
                        </td>
                        <td class="vertical-align-bottom w-1/2 md:w-auto">
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
                        <td
                            class="w-1/2 bg-gray-100 px-3 md:w-auto md:bg-transparent md:px-0"
                        >
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
                        <td
                            class="w-full flex justify-center md:table-cell md:w-auto !pt-10"
                        >
                            <base-button
                                class="btn--sm font-normal"
                                @click="deletetItem(item.slug)"
                            >
                                <TrashIcon
                                    class="h-5 text-grey hover:text-error"
                                />
                                <span class="md:hidden">Remove item</span>
                            </base-button>
                        </td>
                    </tr>
                </tbody>
                <tfoot>
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
                        <td colspan="5" class="w-full md:w-auto">
                            <div class="flex justify-end">
                                <div>
                                    <base-button class="btn--primary">
                                        <span>Complete purchase</span>
                                        <ArrowLongRightIcon class="h-5" />
                                    </base-button>
                                    <p class="text-xs mt-1 text-end">
                                        Checkout via Whatsapp
                                    </p>
                                </div>
                            </div>
                        </td>
                        <td></td>
                    </tr>
                </tfoot>
            </table>

            <template v-else>
                <div
                    class="grid md:grid-cols-2 items-center gap-20 px-5 sm:px-12"
                >
                    <img
                        src="@/assets/images/empty-cart.svg"
                        class="max-w-full md:max-w-sm"
                        alt=""
                    />
                    <div class="space-y-5">
                        <h1 class="text-3xl lg:text-4xl font-medium">
                            Your cart is empty.
                        </h1>
                        <p class="text-smlg:text-lg text-grey">
                            Looks like you haven’t added anything to your cart
                            yet. Start exploring our wide range of tools and
                            equipment to find what you need!
                        </p>
                        <nav-link
                            :href="route('products.index')"
                            as="button"
                            class="btn lg:btn--lg font-normal lg:font-medium btn--outline-secondary"
                        >
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
import { ArrowLongRightIcon } from "@heroicons/vue/24/outline";
import { TrashIcon, XCircleIcon } from "@heroicons/vue/24/solid";
import { CartItem } from "@/types/cart";
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
        onSuccess() {
            // console.log('updated', quantity);
            
        }
    });
};

const deletetItem = (slug: string) => {
    router.visit(route("cart.destroy", { slug }), {
        method: "delete",
    });
};
</script>
