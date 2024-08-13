<template>
    <page-head title="Home" />

    <layout-container>
        <h1>Homepage</h1>
        <div class="polygon"></div>
    </layout-container>
    
</template>
<script setup lang="ts">

defineProps<{
    canLogin?: boolean;
    canRegister?: boolean;
}>();

</script>

