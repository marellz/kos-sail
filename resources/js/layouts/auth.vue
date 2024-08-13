<template>
    <div class="min-h-screen flex flex-col bg-lighter-alt text-dark">
        <main class="flex items-start justify-center flex-auto">
            <div class="space-y-10 mt-10 w-full mx-3 md:max-w-md md:w-2/3">
                <div class="flex justify-center">
                    <nav-link href="/">
                        <base-logo />
                    </nav-link>
                </div>
                <div class="bg-white w-full rounded-xl p-6">
                    <slot />
                </div>
            </div>
        </main>
        <layout-footer />
    </div>
</template>
<script lang="ts" setup>
import LayoutFooter from "@/components/layout/footer.vue";
</script>
