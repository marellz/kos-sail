<template>
    <page-head :title="`${editMode ? 'Edit' : 'New'} category`"></page-head>
    <div>
        <layout-container>
            <page-title>Category form</page-title>
            <div class="mt-10">
                <form @submit.prevent="submitForm">
                    <div class="grid md:grid-cols-2 gap-4">
                        <form-input
                            label="Category name"
                            v-model="form.name"
                            :error="errors.name"
                            required
                        ></form-input>
                        <form-select
                            label="Parent category"
                            v-model="form.parent_id"
                            :error="errors.parent_id"
                        >
                            <option
                                v-for="i in categories"
                                :value="i.id"
                                :key="i.id"
                            >
                                {{ i.name }}
                            </option>
                        </form-select>
                        <div class="md:col-span-2">
                            <form-text
                                label="Category information"
                                v-model="form.description"
                                :error="errors.description"
                            />
                        </div>
                        <div class="!mt-10 flex space-x-4 md:col-span-2">
                            <base-button
                                type="button"
                                class="btn--outline-secondary"
                                @click="closeForm"
                                >Cancel</base-button
                            >
                            <base-button class="btn--primary" type="submit"
                                >Save</base-button
                            >
                        </div>
                    </div>
                </form>
            </div>
        </layout-container>
    </div>
</template>
<script lang="ts" setup>
import Dashboard from "@/layouts/dashboard.vue";
import { Category, CategoryForm } from "@/types/category";
import { router } from "@inertiajs/vue3";
import { onMounted, ref, computed } from "vue";

defineOptions({
    layout: Dashboard,
});

const props = defineProps<{
    category?: Category;
    categories: Array<Category>;
    parent_id?: string;
    errors: {
        name?: string;
        description?: string;
        parent_id?: string;
    };
}>();

const form = ref<CategoryForm>({
    name: "",
    description: "",
    slug: "",
    parent_id: null,
});

const editMode = computed(() => {
    return !!props.category?.id;
});

const submitForm = () => {
    let options = {
        preserveState: true,
    };

    if (editMode.value) {
        router.patch(
            route("admin.categories.update", form.value, {
                id: props.category?.id,
            }),
            form.value,
            options
        );
    } else {
        router.post(route("admin.categories.store"), form.value, options);
    }
};

const closeForm = () => {
    history.back();
};

onMounted(() => {
    if (props.category) {
        form.value = { ...props.category };
    }

    if(props.parent_id){
        form.value.parent_id = props.parent_id
    }
});
</script>
