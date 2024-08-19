<template>
    <svg
        class="transform"
        xmlns="http://www.w3.org/2000/svg"
        width="28"
        height="35"
        viewBox="0 0 28 35"
    >
        <g transform="translate(0,3) scale(0.8)" fill="none">
            <path
                v-if="fill"
                d="M17.5,0,35,28H0Z"
                stroke="currentColor"
                fill="currentColor"
            />
            <path
                d="M 17.5 5.660383224487305 L 5.412740707397461 25 L 29.58725929260254 25 L 17.5 5.660383224487305 M 17.5 0 L 35 28 L 0 28 L 17.5 0 Z"
                stroke="currentColor"
                :stroke-width
                fill="currentColor"
            />
        </g>
    </svg>
</template>
<script lang="ts" setup>
import { computed } from "vue";

const props = withDefaults(
    defineProps<{
        fill?: boolean;
        stroke?: number;
        rotate?: number;
        lg?: boolean;
    }>(),
    {
        stroke: 3,
    }
);

const strokeWidth = computed(() => (props.lg ? 4 : 1));
</script>
