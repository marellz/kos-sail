<template>
    <page-head title="Home" />

    <div>
        <h1>Homepage</h1>
    </div>
    
</template>
<script setup lang="ts">

defineProps<{
    canLogin?: boolean;
    canRegister?: boolean;
}>();

</script>

