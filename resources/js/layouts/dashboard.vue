<template>
    <div class="text-dark min-h-screen flex">
        <!-- nav -->
        <div
            ref="target"
            class="w-full sm:w-64 bg-gray-50 border-r flex-none fixed h-full top-0 -translate-x-full z-50 p-10 md:p-8 md:relative md:translate-x-0 md:h-auto transition"
            :class="{ '!translate-x-0': navActive }"
        >
            <div class="flex justify-between text-light-grey">
                <button type="button" @click="toggleNav" class="md:hidden">
                    <ChevronLeftIcon class="h-6" />
                </button>
                <h1 class="uppercase font-semibold text-2xl">Menu</h1>
            </div>
            <div class="mt-10">
                <nav class="flex flex-col">
                    <nav-link
                        v-for="(link, index) in links"
                        :key="index"
                        :href="link.path"
                        :active="link.components.includes($page.component)"
                        class="inline-flex items-center space-x-2 p-2"
                    >
                        <component :is="link.icon" class="h-5" />
                        <span>{{ link.label }}</span>
                    </nav-link>
                </nav>
            </div>
        </div>
        <div class="flex-auto h-screen overflow-auto">
            <header class="py-6 sticky top-0 bg-white z-40 border-b">
                <layout-container class="flex">
                    <div class="flex items-center space-x-2 flex-auto">
                        <button
                            type="button"
                            class="p-3 md:hidden"
                            @click="toggleNav"
                        >
                            <Bars2Icon class="h-5" />
                        </button>
                        <nav-link href="/dashboard">
                            <img
                                src="@/assets/images/logo-md.svg"
                                class="h-8"
                                alt=""
                            />
                        </nav-link>
                    </div>
                    <div class="flex items-center">
                        <!-- dark toggle -->

                        <!-- user dropdown -->
                        <dropdown>
                            <template #trigger>
                                <UserCircleIcon class="h-10 text-gray-300" />
                                <div
                                    class="ml-2 hidden md:inline text-left leading-4 pt-1"
                                >
                                    <p class="font-medium">
                                        {{ user.name }}
                                    </p>
                                    <p class="text-xs text-grey">Admin</p>
                                </div>
                                <span class="bg-light-grey rounded-full p-1">
                                    <ChevronDownIcon class="h-5" />
                                </span>
                            </template>
                            <dropdown-link
                                href="/logout"
                                method="post"
                                as="button"
                                >Logout</dropdown-link
                            >
                        </dropdown>
                    </div>
                </layout-container>
            </header>
            <main class="py-8">
                <layout-container>
                    <slot />
                </layout-container>
            </main>
        </div>
    </div>
</template>
<script lang="ts" setup>
import { usePage } from "@inertiajs/vue3";
import { UserCircleIcon, ChevronDownIcon } from "@heroicons/vue/24/solid";
import {
    Bars2Icon,
    ChevronLeftIcon,
    EnvelopeIcon,
    HomeIcon,
    QueueListIcon,
    Squares2X2Icon,
} from "@heroicons/vue/24/outline";
import { computed, ref } from "vue";
import { onClickOutside } from "@vueuse/core";

const { props } = usePage();

const user = computed(() => props.auth.user);

const navActive = ref(false);

const toggleNav = () => {
    navActive.value = !navActive.value;
};

const links = ref([
    {
        path: "/dashboard",
        label: "Dashboard",
        icon: HomeIcon,
        components: ["dashboard/index"],
    },
    {
        path: "/dashboard/products",
        label: "Products",
        icon: Squares2X2Icon,
        components: [
            "dashboard/products/index",
            "dashboard/products/show",
            "dashboard/products/form",
        ],
    },
    {
        path: "/dashboard/categories",
        label: "Categories",
        icon: QueueListIcon,
        components: ["dashboard/categories/index"],
    },
    {
        path: "/dashboard/contact", // todo: use route('name')
        label: "Contact",
        icon: EnvelopeIcon,
        components: ["dashboard/contact/index"],
    },
]);

const target = ref(null);

onClickOutside(target, () => {
    navActive.value = false;
});
</script>
