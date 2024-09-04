<template>
    <Teleport to="body">
        <Transition name="toast">
            <div class="fixed top-5 left-1/2 transform -translate-x-1/2 z-50">
                <TransitionGroup
                    name="toast"
                    tag="ul"
                    class="flex flex-col-reverse"
                >
                    <li v-for="(item, index) in store.toasts" :key="index">
                        <ToastItem
                            class="mb-2"
                            :item
                            @delete-toast="deleteToast(index)"
                        />
                    </li>
                </TransitionGroup>
            </div>
        </Transition>
    </Teleport>
</template>
<script lang="ts" setup>
import ToastItem from "@/components/toast/item.vue";
import { useToastStore } from "@/store/toasts";
const store = useToastStore();

const deleteToast = (index: number) => {
    store.deleteToast(index);
};
</script>
<style>
.toast-enter-from,
.toast-leave-to {
    transform: translateX(10%);
    opacity: 0;
}

.toast-enter-active,
.toast-leave-active {
    transition: 0.25s ease all;
}
</style>
