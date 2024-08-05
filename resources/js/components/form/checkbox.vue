<template>
    <label>
        <input
            type="checkbox"
            :value="value"
            v-model="proxyChecked"
            class="rounded dark:bg-gray-900 border-gray-300 dark:border-gray-700 text-indigo-600 shadow-sm focus:ring-indigo-500 dark:focus:ring-indigo-600 dark:focus:ring-offset-gray-800"
        />

        <slot>
            <span class="ms-2 text-sm text-gray-600 dark:text-gray-400">
                {{ label }}
            </span>
        </slot>
    </label>
</template>
<script setup lang="ts">
import { computed } from "vue";

const emit = defineEmits(["update:checked"]);

const props = defineProps<{
    checked: boolean;
    label?: string | undefined;
    value?: any;
}>();

const proxyChecked = computed({
    get() {
        return props.checked;
    },

    set(val) {
        emit("update:checked", val);
    },
});
</script>
