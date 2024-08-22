<template>
    <div class="flex items-center">
        <button
            type="button"
            class="px-2 disabled:text-gray-300"
            :disabled="disabled || model <= min"
            @click="lessValue"
        >
            <MinusCircleIcon class="h-7 stroke-1" />
        </button>
        <input
            type="number"
            class="border-0 w-12 text-center bg-grey bg-opacity-10 rounded-lg p-3 appearance-none"
            v-model="model"
            readonly
        />
        <button
            type="button"
            class="px-2 disabled:text-gray-300"
            :disabled
            @click="addValue"
        >
            <PlusCircleIcon class="h-7 stroke-1" />
        </button>
    </div>
</template>
<script lang="ts" setup>
import { MinusCircleIcon, PlusCircleIcon } from "@heroicons/vue/24/outline";
import { onMounted } from "vue";
import { ref } from "vue";
import { watch } from "vue";

const props = withDefaults(
    defineProps<{
        min?: number;
        disabled: boolean;
        value?: number;
    }>(),
    {
        value: 1,
        min: 1,
    }
);

const model = ref(1);

const emit = defineEmits(["update"]);

const lessValue = () => {
    --model.value;
    emit("update", model.value);
};
const addValue = () => {
    ++model.value;
    emit("update", model.value);
};

onMounted(() => {
    if (props.value) {
        model.value = props.value
    }
});
</script>
