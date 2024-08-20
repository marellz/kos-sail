<template>
    <header>
        <layout-container>
            <div class="flex items-center">
                <nav-link href="/" class="text-primary">
                    <base-logo class="h-12" />
                </nav-link>

                <div class="flex ml-12 space-x-5">
                    <nav-link
                        v-for="(link, index) in links"
                        :key="index"
                        class="text-lg"
                        :active="link.components.includes($page.component)"
                        :href="link.path"
                        >{{ link.label }}</nav-link
                    >
                </div>

                <div class="flex items-center ml-auto space-x-4">
                    <button
                        type="button"
                        class="btn leading-normal font-normal p-2 hover:bg-primary hover:bg-opacity-15"
                        @click="searchActive = true"
                    >
                        <MagnifyingGlassIcon class="h-6" />
                        <span>Search</span>
                    </button>
                    <nav-link
                        as="button"
                        href="/cart"
                        class="btn font-normal leading-normal p-2 hover:bg-primary hover:text-white relative group"
                        :class="{
                            'text-primary bg-primary bg-opacity-10':
                                $page.component === 'cart/index',
                        }"
                    >
                        <ShoppingBagIcon class="h-6" />
                        <span>Want to buy</span>
                        <span
                            v-if="cartItems"
                            class="bg-primary text-xs leading-[15px] pl-px text-center h-4 w-4 rounded-full text-white absolute bottom-0 left-4 border border-transparent p-0 group-hover:border-white"
                            >{{ cartItems }}</span
                        >
                    </nav-link>
                    <nav-link
                        v-if="!$page.props.auth.user"
                        as="button"
                        class="btn btn--primary"
                        href="/login"
                        >Login</nav-link
                    >
                    <nav-link
                        v-else
                        as="button"
                        class="btn btn--outline-primary"
                        method="post"
                        href="/logout"
                        >Logout</nav-link
                    >
                </div>
            </div>
        </layout-container>
    </header>
</template>
<script lang="ts" setup>
import {
    MagnifyingGlassIcon,
    ShoppingBagIcon,
} from "@heroicons/vue/24/outline";
import { usePage } from "@inertiajs/vue3";
import { computed, ref } from "vue";
const links = ref([
    {
        path: "/products",
        label: "Browse",
        components: ["products/index", "products/show"],
    },
    {
        path: "/categories",
        label: "Categories",
        components: ["categories/index"],
    },
]);
const searchActive = ref(false);
const cart = computed(() => usePage().props.cart??{})
const cartItems = computed(() => Object.keys(cart.value).length)
</script>
