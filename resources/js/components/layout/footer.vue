<template>
    <footer class="py-9 border-t">
        <layout-container class="text-sm flex flex-col md:flex-row md:items-center md:space-x-4">
            <nav class="flex flex-col space-y-3 mb-6 md:mb-0 md:space-y-0 md:flex-row md:items-center md:space-x-6 ">
                <nav-link
                    :active="link.components.includes($page.component)"
                    v-for="(link, index) in links"
                    :key="index"
                    :href="link.path"
                    >{{ link.label }}</nav-link
                >
            </nav>
            <p>Design & Dev by Dave</p>
            <p class="mt-2 md:mt-0 md:!ml-auto">2024. All rights reserved?</p>
        </layout-container>
    </footer>
</template>
<script lang="ts" setup>
import { ref } from "vue";
const links = ref([
    { label: "Dashboard", path: "/dashboard", components: ['dashboard/index'] },
    { label: "Docs", path: "/docs", components: ['docs/index'] },
    { label: "Get help", path: "/help/", components: ['help/index'] },
]);
</script>
