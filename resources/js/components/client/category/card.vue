<template>
    <div class="rounded-xl overflow-auto flex flex-col hover:scale-[1.02] transition">
        <div class="p-6 pb-10 bg-light-primary bg-opacity-70 relative">
            <div class="flex items-center justify-between text-primary">
                <h3 class="text-3xl font-medium leading-10">
                    {{ category.name }}
                </h3>
                <icons-polygon class="h-7 rotate-90" />
            </div>
            <p class="mt-2 leading-5 text-primary">{{ category.description }}</p>
            <img class="absolute right-0 bottom-4" src="@/assets/images/wavy.svg" alt="">
        </div>
        <div class="py-5 px-6 bg-light-grey bg-opacity-30 flex-auto">
            <ul class="space-y-3" v-if="category.subcategories">
                <li v-for="subcategory in category.subcategories">
                    <p class="leading-normal">
                        {{ subcategory.name }}
                    </p>
                </li>
            </ul>
        </div>
    </div>
</template>
<script lang="ts" setup>
import { type Category } from "@/types/category";

defineProps<{ category: Category }>();

</script>
