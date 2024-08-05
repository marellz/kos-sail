<template>
    <div>
        <form-label v-if="label" :for="id">
           {{ label }}
       </form-label>
       <div>
           <input
               class="border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm"
               v-model="model"
               :id
               ref="input"
           />
       </div>
       <form-error v-if="error">{{ error }}</form-error>
    </div>
</template>
<script setup lang="ts">
import { useId } from '@/composables/useId';
import { onMounted, ref } from 'vue';

withDefaults(defineProps<{
    label?: string | undefined;
    error?: string | undefined;
    type?: string | undefined
}>(), {
    type: 'text'
})

const id = useId()

const model = defineModel<string>({ required: true });

const input = ref<HTMLInputElement | null>(null);

onMounted(() => {
    if (input.value?.hasAttribute('autofocus')) {
        input.value?.focus();
    }
});

defineExpose({ focus: () => input.value?.focus() });
</script>


