<template>
    <page-head title="Admin | Categories"></page-head>
    <layout-container>
        <div
            class="flex flex-col sm:flex-row items-start sm:items-center sm:justify-between"
        >
            <page-title>Categories</page-title>
            <admin-add-button
                class="ml-auto mt-3 sm:mt-0"
                :href="route('admin.categories.create')"
            >
                Add category</admin-add-button
            >
        </div>

        <div class="mt-10">
            <form-checkbox v-model="showList">
                <p>Show as list</p>
            </form-checkbox>
        </div>

        <div
            v-if="showList"
            class="grid sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-4 items-start mt-12"
        >
            <admin-category-card
                class="mb-4"
                :category="item"
                v-for="item in items"
                :key="item.id"
                @show-item="openItem"
            />
        </div>

        <div class="mt-10 grid md:grid-cols-2 lg:grid-cols-3 gap-10" v-else>
            <admin-category-tree :items="items"/>
        </div>

        <base-modal
            v-if="category?.id"
            modal-role="Show category"
            :show="showItem"
            @close="closeForm"
        >
            <div class="flex sm:items-center flex-col-reverse sm:flex-row">
                <h1 class="text-3xl md:text-4xl leading-normal">
                    {{ category.name }}
                </h1>
                <base-button
                    type="button"
                    class="ml-auto flex space-x-2 p-2 border hover:border-grey"
                    @click="editItem(category.id)"
                >
                    <PencilSquareIcon class="h-5" />
                    <span>Edit</span>
                </base-button>
            </div>
            <div class="mt-6">
                <h4 class="font-medium text-grey">Category information</h4>
                <p class="mt-3">
                    {{ category.description ?? "No description" }}
                </p>
            </div>
            <div class="mt-6">
                <h4 class="font-medium text-grey">Subcategories</h4>
                <div class="mt-4">
                    <ul class="space-y-4">
                        <li v-for="item in items" :key="item.id">
                            <div class="border rounded-lg p-2.5 flex">
                                <div class="flex-auto">
                                    <h4 class="text-ms font-medium">
                                        {{ item.name }}
                                    </h4>
                                    <p
                                        class="mt-1.5 text-[10px] text-grey italic"
                                    >
                                        {{ category.product_count ?? "No" }}
                                        Products
                                    </p>
                                </div>
                                <button
                                    type="button"
                                    @click="deleteCategory(category.id)"
                                >
                                    <TrashIcon
                                        class="h-6 text-gray-500 hover:text-red-500"
                                    />
                                </button>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </base-modal>

        <base-modal
            :modal-role="`${editMode ? 'Edit' : 'Create'} category`"
            :show="showForm"
            @close="closeForm"
        >
            <form @submit.prevent="submitForm">
                <div class="space-y-4">
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
                        <option v-for="i in items" :value="i.id" :key="i.id">
                            {{ i.name }}
                        </option>
                    </form-select>
                    <form-text
                        label="Category information"
                        v-model="form.description"
                        :error="errors.description"
                    />
                    <div class="!mt-10 flex space-x-4">
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
        </base-modal>
    </layout-container>
</template>
<script lang="ts" setup>
import Dashboard from "@/layouts/dashboard.vue";
import AdminCategoryCard from "@/components/admin/categories/card.vue";
import AdminCategoryTree from "@/components/admin/categories/tree.vue";
import AdminAddButton from "@/components/admin/add-btn.vue";
import { type Category, type CategoryForm } from "@/types/category";
import { PencilSquareIcon } from "@heroicons/vue/24/outline";
import { TrashIcon } from "@heroicons/vue/24/solid";
import { computed, ref, onMounted } from "vue";
import { router } from "@inertiajs/vue3";

const props = withDefaults(
    defineProps<{
        showForm?: boolean;
        showItem?: boolean;
        category?: Category;
        errors: {
            name?: string;
            description?: string;
            parent_id?: string;
        };
        categories: Array<Category>;
    }>(),
    {
        showForm: false,
        showItem: false,
    }
);

const form = ref<CategoryForm>({
    name: "",
    description: "",
    slug: "",
    parent_id: null,
});

onMounted(() => {
    if (props.category) {
        form.value = { ...props.category };
    }
});

defineOptions({
    layout: Dashboard,
});

const showList = ref(false);

const items = computed(() => props.categories);

const editMode = computed(() => {
    return !!props.category?.id;
});

const closeForm = () => {
    router.visit(route("admin.categories.index"));
};

const openItem = (id: string) => {
    router.visit(route("admin.categories.show", { id }));
};

const editItem = (id: string) => {
    router.visit(route("admin.categories.edit", { id }));
};

const deleteCategory = (id: string) => {};

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
</script>
