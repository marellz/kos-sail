import { useId } from "@/composables/useId";
import { ToastItem } from "@/types";
import { defineStore } from "pinia";
import { ref } from "vue";

export const useToastStore = defineStore("toasts", () => {
    const id  = useId()
    const toasts = ref<Array<ToastItem & { id: string }>>([]);

    const deleteToast = (index: number) => {
        toasts.value.splice(index, 1);
    };

    const createToast = (toast: ToastItem) => {
        toasts.value.push({...toast, id});
        setTimeout(() => {
            let index = toasts.value.findIndex(t=>t.id === id);
            deleteToast(index)
        }, toast.timeout ?? 2000);
    };

    return {
        toasts,
        createToast,
        deleteToast,
    };
});
