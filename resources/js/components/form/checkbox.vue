<template>
    <label class="flex items-center">
        <input
            type="checkbox"
            :value
            :required
            :disabled
            v-model="model"
            class="rounded dark:bg-gray-900 border-gray-300 dark:border-gray-700 text-indigo-600 shadow-sm focus:ring-indigo-500 dark:focus:ring-indigo-600 dark:focus:ring-offset-gray-800"
        />

        <div class="ml-1">
            <slot>
                <span v-if="label" class="ms-2 text-sm text-gray-600 dark:text-gray-400">
                    {{ label }}
                </span>
            </slot>
        </div>
    </label>
</template>
<script setup lang="ts">

const props = defineProps<{
    label?: string;
    value?: any;
    required?: boolean;
    disabled?: boolean;
}>();

const model = defineModel()

</script>
