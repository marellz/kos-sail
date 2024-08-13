<template>
    <div class="bg-white pt-5 rounded-lg flex flex-col overflow-hidden">
        <div class="flex-auto px-6">
            <h1 class="text-xl font-semibold">
                {{ category.name }}
            </h1>

            <div v-if="category.description">
                <p
                    class="text-sm mt-4"
                    :class="{ 'line-clamp-2': !fullDescription }"
                >
                    {{ category.description }}
                </p>

                <button
                    type="button"
                    class="inline-flex items-center space-x-2 text-[10px] text-grey"
                    @click="fullDescription = !fullDescription"
                >
                    <span v-if="fullDescription">See less</span>
                    <span v-else>See more</span>
                </button>
            </div>

            <ul v-if="category.subcategories" class="mt-4 space-y-2">
                <li
                    v-for="subcategory in category.subcategories"
                    :key="subcategory.id"
                >
                    <p class="text-xs text-grey">
                        {{ subcategory.name }}
                    </p>
                </li>
            </ul>
        </div>
        <div class="mt-4">
            <button
                type="button"
                class="inline-flex w-full items-center justify-center space-x-3 px-6 py-4 hover:bg-gray-100"
                @click="$emit('show-item', category.id)"
            >
                <span class="text-[10px] font-bold">VIEW CATEGORY</span>
                <PencilSquareIcon class="h-4" />
            </button>
        </div>
    </div>
</template>
<script lang="ts" setup>
import { PencilSquareIcon } from "@heroicons/vue/24/outline";
import { type Category } from "@/types/category";
import { ref } from "vue";
defineProps<{
    category: Category;
}>();

defineEmits(['show-item']);

const fullDescription = ref(false);
</script>
