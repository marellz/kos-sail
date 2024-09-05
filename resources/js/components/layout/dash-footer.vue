<template>
    <footer class="py-5 border-t">
        <layout-container>
            <nav
                class="text-sm flex flex-col space-y-3 mb-6 md:mb-0 md:space-y-0 md:flex-row md:items-center md:space-x-6"
            >
                <nav-link :href="route('home')">Main site</nav-link>
                <nav-link
                    :active="link.components.includes($page.component)"
                    v-for="(link, index) in links"
                    :key="index"
                    :href="link.path"
                    >{{ link.label }}</nav-link
                >
            </nav>
        </layout-container>
    </footer>
</template>
<script lang="ts" setup>
import { type NavLink } from "@/types";
const links: Array<NavLink> = [
    { label: "Main site", path: route("home"), components: ["welcome"] },
    { label: "Docs", path: "/docs", components: [] },
];
</script>
