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

                <div class="flex ml-auto space-x-4">
                    <button
                        type="button"
                        class="inline-flex space-x-2 items-center"
                        @click="searchActive = true"
                    >
                        <MagnifyingGlassIcon class="h-6" />
                        <span>Search</span>
                    </button>
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
import { MagnifyingGlassIcon } from "@heroicons/vue/24/outline";
import { ref } from "vue";
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
</script>
