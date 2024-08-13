<template>
    <div class="pt-9 text-dark min-h-screen flex flex-col">
        <layout-header />
        <main class="flex-auto py-20">
            <slot />
        </main>
        <layout-footer />
    </div>
</template>
<script setup lang="ts">
import LayoutHeader from "@/components/layout/header.vue";
import LayoutFooter from "@/components/layout/footer.vue";
</script>
