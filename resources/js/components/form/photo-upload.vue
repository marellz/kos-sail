<template>
    <div :class="{'opacity-50': disabled}">
        <input
            class="invisible h-0 w-0 opacity-0 absolute -z-40"
            @change="(e)=>handleChange(e)"
            type="file"
            accept="image/*"
            :disabled
            :id
        />
        <label :for="id">
            <div class="border border-dashed border-light-grey rounded-lg px-5 py-10">
                <div class="flex flex-col items-center space-y-3 text-gray-500">
                    <PhotoIcon class="h-10 stroke-1" />
                    <p class="text-center font-medium">Upload photos</p>
                    <span v-if="disabled" class="!mt-1 text-xs">(disabled)</span>
                </div>
            </div>
        </label>
    </div>
</template>
<script lang="ts" setup>
import { useId } from "@/composables/useId";
import { PhotoIcon } from "@heroicons/vue/24/outline";
const id = useId();
defineProps<{
    disabled?: boolean;
}>()

const emit = defineEmits(['upload'])

const handleChange = (e: Event) => {
    let target = e.target as HTMLInputElement
    let files = target.files as FileList
    emit('upload', files[0])
};
</script>
