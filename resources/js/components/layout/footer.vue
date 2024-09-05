<template>
    <footer class="py-9 border-t">
        <layout-container
            class="text-sm flex flex-col md:flex-row md:items-center md:space-x-4"
        >
            <nav
                class="flex flex-col space-y-3 mb-6 md:mb-0 md:space-y-0 md:flex-row md:items-center md:space-x-6"
            >
                <template v-if="$page.props.auth.user">
                    <nav-link
                        :href="route('admin.index')"
                        v-if="[1, 2].includes($page.props.auth.user?.role?.id)"
                    >
                        <span>Dashboard</span>
                    </nav-link>
                    <nav-link
                        :href="route('profile.index')"
                        v-else
                    >
                        <span>User profile</span>
                    </nav-link>
                </template>
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
import { NavLink } from "@/types";

const links : Array<NavLink>= [
    { label: "Docs", path: "/docs", components: ["docs/index"] },
    { label: "Get help", path: "/help/", components: ["help/index"] },
    { label: "FAQs", path: "/faq/", components: ["help/index"] },
];
</script>
