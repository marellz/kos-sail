<template>
    <header>
        <layout-container>
            <div class="flex items-center justify-between">
                <div class="flex flex-col md:flex-row items-center">
                    <nav-link href="/" class="text-primary">
                        <base-logo class="h-8 lg:h-12 w-auto" />
                    </nav-link>

                    <span
                        class="invisible bg-dark fixed inset-0 z-10 bg-opacity-20 lg:hidden transform transition-all duration-200 ease-in-out"
                        :class="{ '!visible': showNav }"
                        @click="showNav = false"
                    ></span>
                    <div
                        ref="nav"
                        :class="{ 'translate-y-0': showNav }"
                        class="bg-white top-0 left-0 w-full p-10 md:p-0 shadow rounded-b-xl z-50 -translate-y-full md:translate-y-0 md:bg-transparent md:shadow-none transition-all ease-linear bottom-unset fixed md:static flex flex-col md:flex-row md:ml-6 lg:ml-12 space-y-3 md:space-y-0 md:space-x-3 lg:space-x-5"
                    >
                        <div
                            class="flex items-center justify-between mb-5 md:hidden"
                        >
                            <h1 class="font-bold uppercase text-grey">Menu</h1>
                            <button type="button" @click="showNav = false">
                                <icons-polygon
                                    class="h-6 rotate-90 text-grey"
                                />
                            </button>
                        </div>
                        <nav-link
                            v-for="(link, index) in links"
                            :key="index"
                            class="lg:text-lg"
                            :active="link.components.includes($page.component)"
                            :href="link.path"
                            >{{ link.label }}</nav-link
                        >
                    </div>
                </div>

                <div class="flex items-center md:space-x-3">
                    <button
                        type="button"
                        class="btn leading-normal font-normal p-2 hover:bg-primary hover:bg-opacity-15"
                        @click="searchActive = true"
                    >
                        <MagnifyingGlassIcon class="h-6" />
                        <span class="hidden lg:inline">Search</span>
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
                        <span class="hidden lg:inline">Want to buy</span>
                        <span
                            v-if="cartItems"
                            class="bg-primary text-xs leading-[15px] pl-px text-center h-4 w-4 rounded-full text-white absolute bottom-0 left-4 border border-transparent p-0 group-hover:border-white"
                            >{{ cartItems }}</span
                        >
                    </nav-link>

                    <!-- authentication -->

                    <nav-link
                        v-if="!$page.props.auth.user"
                        as="button"
                        class="inline-flex items-center space-x-2 text-sm md:border md:hover:bg-primary md:hover:border-primary md:hover:!text-white rounded-lg py-2 px-4"
                        href="/login"
                    >
                        <UserCircleIcon class="h-6 opacity-50" />
                        <span class="hidden md:inline">Login</span>
                    </nav-link>
                    <nav-link
                        v-else
                        as="button"
                        class="btn btn--outline-primary"
                        method="post"
                        href="/logout"
                        >Logout</nav-link
                    >

                    <button
                        type="button"
                        class="p-2 md:hidden"
                        @click="showNav = !showNav"
                    >
                        <Bars3BottomRightIcon class="h-5" />
                    </button>
                </div>
            </div>
        </layout-container>
    </header>
</template>
<script lang="ts" setup>
import { NavLink } from "@/types";
import {
    Bars3BottomRightIcon,
    MagnifyingGlassIcon,
    ShoppingBagIcon,
    UserCircleIcon,
} from "@heroicons/vue/24/outline";
import { usePage } from "@inertiajs/vue3";
import { onClickOutside } from "@vueuse/core";
import { computed, ref, watch } from "vue";

const links : Array<NavLink> = [
    {
        path: "/products",
        label: "Browse products",
        components: ["products/index", "products/show"],
    },
    {
        path: "/categories",
        label: "Categories",
        components: ["categories/index"],
    },
];

const nav = ref();
const showNav = ref(false);
const searchActive = ref(false);
const cart = computed(() => usePage().props.cart ?? {});
const cartItems = computed(() => Object.keys(cart.value).length);
onClickOutside(nav, () => {
    showNav.value = false;
});

let page = usePage();

watch(
    () => page.url,
    () => {
        showNav.value = false;
    },
    { deep: true }
);
</script>
