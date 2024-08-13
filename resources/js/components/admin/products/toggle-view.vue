<template>
    <div
        class="flex items-center relative space-x-3 overflow-hidden border border-grey rounded-lg"
    >
        <div
            class="relative w-20 flex justify-center px-0.5"
            v-for="(item, index) in options"
            :key="index"
        >
            <input
                type="radio"
                class="invisible absolute !h-0 !w-0 -z-10"
                v-model="model"
                name="model-view"
                :value="item.key"
                :id="`${id}-${item.key}`"
            />
            <label
                :for="`${id}-${item.key}`"
                class="transition justify-center flex-auto relative flex items-center space-x-2 py-2.5 z-[20] font-medium"
                :class="{ 'text-white': model === item.key }"
            >
                <component :is="item.icon" class="h-5" />
                <span class="text-sm leading-normal"> {{ item.label }}</span>
            </label>
        </div>
        <!-- indicator -->
        <div
            class="transition absolute !ml-0 bg-dark rounded-md w-20 z-[2] inset-0.5 right-unset"
            :class="{
                'left-0.5 right-unset': isTable,
                'transform translate-x-[88px]': isCards,
            }"
        ></div>
    </div>
</template>
<script lang="ts" setup>
import { useId } from "@/composables/useId";
import { ListBulletIcon, Squares2X2Icon } from "@heroicons/vue/24/outline";
import { computed } from "vue";

const id = useId();

const model = defineModel({ required: true, default: "table" });
const options = [
    { key: "table", label: "Table", icon: ListBulletIcon },
    { key: "cards", label: "Cards", icon: Squares2X2Icon },
];

const isTable = computed(() => model.value === "table");
const isCards = computed(() => model.value === "cards");
</script>
