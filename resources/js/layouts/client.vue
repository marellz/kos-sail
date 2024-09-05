<template>
    <div class="text-dark min-h-screen flex flex-col">
        <div class=" sticky top-0 bg-white">
            <layout-header class="border pt-9 pb-5" />
            <layout-container class="sticky top-28 bg-white pt-6">
                    <nav>
                        <ul class="flex border-b">
                            <li v-for="(link, index) in links" :key="index">
                                <nav-link
                                    :href="link.path"
                                    class="px-2 pb-2 border-b flex -mb-px"
                                    :class="{'border-b-dark font-medium': link.components.includes($page.component)}"
                                    >{{ link.label }}</nav-link
                                >
                            </li>
                        </ul>
                    </nav>
                </layout-container>
        </div>
        <main class="py-8 bg-gray-100 flex-auto">
            <slot />
        </main>
        <layout-footer />
        <ToastWrapper />
    </div>
</template>
<script lang="ts" setup>
import LayoutHeader from "@/components/layout/header.vue";
import LayoutFooter from "@/components/layout/footer.vue";
import ToastWrapper from "@/components/toast/wrapper.vue";
import { type NavLink } from "@/types/index.d";

const links : Array<NavLink> = [
    {
        label: "Profile",
        path: route("profile.index"),
        components: ['profile/index'],
    },
    {
        label: "Edit profile",
        path: route("profile.edit"),
        components: ['profile/edit'],
    },
];
</script>
