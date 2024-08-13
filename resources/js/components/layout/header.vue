<template>
    <header>
        <layout-container>
            <div class="flex items-center">
                <nav-link href="/">
                    <base-logo class="h-24" />
                </nav-link>

                <div class="flex ml-9 space-x-5">
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
                    <nav-link as="button" class="btn btn--primary" href="/login">Login</nav-link>
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
        components: ["browse/index"],
    },
    {
        path: "/categories",
        label: "Categories",
        components: ["categories/index"],
    },
]);
const searchActive = ref(false);
</script>
