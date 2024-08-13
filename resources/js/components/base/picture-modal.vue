<template>
    <div
        class="fixed z-50 inset-0 flex items-center justify-center invisible"
        :class="{ '!visible': show }"
    >
        <div class="bg-gray-800 opacity-90 absolute inset-0"></div>
        <div ref="target" class="relative">
            <div class="flex justify-end mb-10">
                <button type="button" class="text-white" @click="close">
                    <XMarkIcon class="h-12" />
                </button>
            </div>
            <div class="max-h-[70vh] max-w-[90vw] h-full">
                <slot />
            </div>
        </div>
    </div>
</template>
<script lang="ts" setup>
import { XMarkIcon } from "@heroicons/vue/24/outline";
import { onClickOutside, onKeyStroke } from "@vueuse/core";
import { ref } from "vue";
const emit = defineEmits(["close"]);
const target = ref()
defineProps<{
    show?: boolean;
}>();

const close = () => {
    emit("close");
};

onKeyStroke('Escape', (e) => {
  e.preventDefault()
  close()
})

onClickOutside(target, () => {
    close()
})


</script>
