<template>
    <page-head title="Edit profile" />
    <layout-container class="py-12 space-y-6">
        <page-title>User profile</page-title>
    </layout-container>
</template>
<script lang="ts" setup>
import Client from "@/layouts/client.vue";

defineOptions({
    layout: Client,
});

</script>