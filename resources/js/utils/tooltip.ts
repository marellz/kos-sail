import { useId } from "@/composables/useId";
import { ref } from "vue";

const tooltip = ref<HTMLElement | null>(null);
const id = useId();
const position = ref<string>("top");

const showTooltip = (el: HTMLElement, message: string) => {
    const { top, left } = el.getBoundingClientRect();
    
    if (tooltip.value) {
        tooltip.value.classList.add(`tooltip--${position.value || "top"}`);
        tooltip.value.style.top = top + "px";
        tooltip.value.style.left = left + "px";
        tooltip.value.style.display = "block";

        tooltip.value.innerHTML = message || "";
    }

    if(tooltip.value){
        document.body.append(tooltip.value);
    }
};

const hideTooltip = () => {
    
    if (tooltip.value) {
        tooltip.value.style.display = "none";
    }

    const ell = document.getElementById(id);
    if(ell){
        ell.remove();
    }
};

export const tooltipDirective = {
    updated() {},

    created(el: HTMLElement, binding: any) {
        tooltip.value = document.createElement("div");
        tooltip.value.style.display = "none";
    },
    
    mounted(el: HTMLElement, binding: any) {
        if (binding.value.position) {
            position.value = binding.value.position;
        }

        if (tooltip.value) {
            tooltip.value.classList.add("tooltip");
            tooltip.value.id = id;
        }

        el.addEventListener("mouseenter", () => showTooltip(el, binding.value.message));
        el.addEventListener("mouseleave", hideTooltip);
    },

    unmounted(el: HTMLElement) {
        el.removeEventListener("mouseenter", () => showTooltip(el, ""));
        el.removeEventListener("mouseleave", hideTooltip);

    },
};
