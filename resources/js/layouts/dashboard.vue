<template>
    <div class="bg-lighter-alt text-dark min-h-screen">
        <header class="py-6">
            <layout-container class="flex justify-between">
                <div class="flex items-center space-x-2">
                    <button type="button" class="p-3 md:hidden" @click="toggleNav">
                        <Bars2Icon class="h-5"/>
                    </button>
                    <nav-link href="/dashboard">
                        <img src="@/assets/images/logo-md.svg" class="h-8" alt="" />
                    </nav-link>
                </div>
                <div class="flex items-center">
                    <!-- dark toggle -->

                    <!-- user dropdown -->
                    <dropdown>
                        <template #trigger>
                            <UserCircleIcon class="h-10 text-gray-300" />
                            <div class="ml-2 hidden md:inline text-left leading-4 pt-1">
                                <p class="font-medium">
                                    {{ user.name }}
                                </p>
                                <p class="text-xs text-grey">Admin</p>
                            </div>
                            <span class="bg-light-grey rounded-full p-1">
                                <ChevronDownIcon class="h-5" />
                            </span>
                        </template>
                        <dropdown-link href="/logout" method="post" as="button"
                            >Logout</dropdown-link
                        >
                    </dropdown>
                </div>
            </layout-container>
            <!-- nav -->
            <div ref="target" class="bg-white fixed top-0 w-full p-9 transform -translate-y-full transition md:static md:bg-transparent md:p-0 md:transform-none z-20" :class="{'!translate-y-0': navActive}"> 
                <div class="flex justify-between text-light-grey md:hidden">
                    <button type="button" @click="toggleNav">
                        <ChevronLeftIcon class="h-6" />
                    </button>
                    <h1 class="uppercase font-semibold text-2xl">Menu</h1>
                </div>
                <div class="mt-10 border-b">
                    <layout-container>
                        <nav class="flex flex-col md:flex-row md:items-center md:space-x-5">
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
                    </layout-container>
                </div>
            </div>
        </header>
        <main class="py-8 overflow-auto">
            <slot />
        </main>
    </div>
</template>
<script lang="ts" setup>
import { usePage } from "@inertiajs/vue3";
import { UserCircleIcon, ChevronDownIcon } from "@heroicons/vue/24/solid";
import {
Bars2Icon,
    ChevronLeftIcon,
    HomeIcon,
    QueueListIcon,
    Squares2X2Icon,
} from "@heroicons/vue/24/outline";
import { computed,ref } from "vue";
import { onClickOutside } from '@vueuse/core'


const { props } = usePage();

const user = computed(() => props.auth.user);

const navActive = ref(false)

const toggleNav = () => {
    navActive.value = !navActive.value
}

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
        components: ["dashboard/products/index", "dashboard/products/show", "dashboard/products/form"],
    },
    {
        path: "/dashboard/categories",
        label: "Categories",
        icon: QueueListIcon,
        components: ["dashboard/categories/index"],
    },
]);


const target = ref(null)

onClickOutside(target, () => {
    navActive.value = false
})
</script>
