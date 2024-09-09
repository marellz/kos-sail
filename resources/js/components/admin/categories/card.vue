<template>
    <div class="py-5 rounded-lg flex flex-col overflow-hidden border group">
        <div class="flex-auto px-6">
            <div class="flex justify-between">
                <h1 class="text-xl font-semibold">
                    {{ category.name }}
                </h1>
                <ArrowTopRightOnSquareIcon class="h-5 opacity-30 group-hover:opacity-100" />
            </div>

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
    </div>
</template>
<script lang="ts" setup>
import { ArrowTopRightOnSquareIcon, PencilSquareIcon } from "@heroicons/vue/24/outline";
import { type Category } from "@/types/category";
import { ref } from "vue";
defineProps<{
    category: Category;
}>();

defineEmits(['show']);

const fullDescription = ref(false);
</script>
