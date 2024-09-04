<template>
    <div class="rounded-lg p-4 w-72" :class="classMap[item.type]">
        <div class="flex">
            <div class="flex-auto">
                <h5 class="capitalize font-medium text-sm text-gray-700">
                    {{ item.type }}
                </h5>
                <p class="text-sm mt-2">
                    {{ item.message }}
                </p>
            </div>
            <button
                type="button"
                class="opacity-50 hover:opacity-100 ml-5"
                @click="deleteToast"
            >
                <XCircleIcon class="h-5" />
            </button>
        </div>
    </div>
</template>
<script lang="ts" setup>
import { ToastItem } from "@/types";
import { XCircleIcon } from "@heroicons/vue/24/solid";

defineProps<{
    item: ToastItem;
}>();

const classMap = {
    success: "bg-green-200",
    info: "bg-blue-200",
    error: "bg-red-200",
};

const emit = defineEmits(["delete-toast"]);

const deleteToast = () => {
    emit("delete-toast");
};
</script>
