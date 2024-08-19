<template>
    <div>
        <ul class="flex items-center space-x-3">
            <li v-for="tab in tabs">
                <a
                    class="inline-flex items-center space-x-2 text-gray-400"
                    :href="`#${tab.key}`"
                    :class="{ 'text-primary': tab.key === activeTab }"
                    @click.prevent="switchTab(tab.key)"
                    :key="`tab-${tab.key}`"
                >
                    <icons-polygon
                        class="rotate-90 h-4 opacity-50"
                        fill
                        :class="{ '!opacity-100': tab.key === activeTab }"
                    />
                    <span>{{ tab.label }}</span>
                </a>
            </li>
            <slot name="header" />
        </ul>
        <div class="mt-10">
            <div
                v-for="tab in tabs"
                :key="`slot-${tab.key}`"
                v-show="tab.key === activeTab"
            >
                <slot :name="tab.key" />
            </div>
        </div>
    </div>
</template>
<script lang="ts" setup>
import { ref, watch } from "vue";
const emit = defineEmits(["change"]);
const props = defineProps<{
    tabs: Array<{
        key: string;
        label: string;
    }>;
}>();

const activeTab = ref(props.tabs[0].key);

const switchTab = (tab: string) => {
    activeTab.value = tab
}

watch(activeTab, (v: string) => {
    emit("change", v);
});
</script>
