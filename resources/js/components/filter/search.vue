<template>
    <div class="relative">
        <input
            type="text"
            class="form-input form-input--search"
            v-model="model"
            :placeholder
        />
        <button type="button" class="absolute top-2.5 right-2.5" v-if="model" @click="clearModel">
            <XMarkIcon class="h-5" />
        </button>
        <MagnifyingGlassIcon
            class="h-5 text-light-grey absolute top-2.5 left-5 pointer-events-none"
        />
    </div>
</template>
<script lang="ts" setup>
import { MagnifyingGlassIcon, XMarkIcon } from "@heroicons/vue/24/outline";

const model = defineModel()
withDefaults(defineProps<{
    placeholder?: string
}>(),{
    placeholder: "Search"
})

const emit = defineEmits(['clear-search'])

const clearModel = () => {
    model.value = ''
    emit('clear-search')
}
</script>
