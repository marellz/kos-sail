<template>
    <Teleport to="body">
        <Transition leave-active-class="duration-200">
            <div
                v-show="show"
                class="fixed inset-0 p-2 sm:px-4 md:p-0 md:py-6 z-50"
                scroll-region
            >
                <div
                    v-show="show"
                    class="fixed inset-0 transform transition-all"
                    @click="close"
                >
                    <div class="absolute inset-0 bg-light-primary opacity-20" />
                </div>

                <div
                    v-show="show"
                    class="bg-white rounded-t md:rounded-l-md overflow-auto shadow-xl transform transition-all sm:w-full sm:ml-auto h-full py-6 md:py-10"
                    :class="maxWidthClass"
                >
                    <!-- header -->
                    <div
                        class="flex justify-between text-light-grey px-6 md:px-10"
                    >
                        <p class="">{{ modalRole }}</p>
                        <button type="button" @click="close">
                            <XCircleIcon class="h-6" />
                        </button>
                    </div>
                    <div class="px-6 py-4 md:px-10 md:py-5">
                        <slot v-if="show" />
                    </div>
                </div>
            </div>
        </Transition>
    </Teleport>
</template>
<script setup lang="ts">
import { XCircleIcon } from "@heroicons/vue/24/outline";
import { computed, onMounted, onUnmounted, watch } from "vue";
import { useScrollLock } from "@vueuse/core";
const props = withDefaults(
    defineProps<{
        show?: boolean;
        maxWidth?: "sm" | "md" | "lg" | "xl" | "2xl";
        closeable?: boolean;
        modalRole?: string;
    }>(),
    {
        show: false,
        maxWidth: "2xl",
        closeable: true,
        modalRole: "View form",
    }
);

const emit = defineEmits(["close"]);
const lock = useScrollLock(document);

watch(
    () => props.show,
    (v) => {
        lock.value = v;
    }
);

const close = () => {
    if (props.closeable) {
        emit("close");
    }
};

const closeOnEscape = (e: KeyboardEvent) => {
    if (e.key === "Escape" && props.show) {
        close();
    }
};

onMounted(() => {
    document.addEventListener("keydown", closeOnEscape);
    if(props.show) {
        lock.value = true;
    }
});

onUnmounted(() => {
    document.removeEventListener("keydown", closeOnEscape);
    if(!props.show || !lock.value) {
        lock.value = false;
    }
});

const maxWidthClass = computed(() => {
    return {
        sm: "sm:max-w-sm",
        md: "sm:max-w-md",
        lg: "sm:max-w-lg",
        xl: "sm:max-w-xl",
        "2xl": "sm:max-w-2xl",
    }[props.maxWidth];
});
</script>
