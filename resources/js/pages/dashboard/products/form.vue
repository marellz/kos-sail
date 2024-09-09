<template>
    <page-head
        v-if="isTrulyEdit"
        :title="`Update product | ${item?.name}`"
    ></page-head>
    <page-head v-else title="New product"></page-head>
    <form @submit.prevent="submit">
        <layout-container>
            <page-title>{{
                isTrulyEdit ? "Update product" : "New product"
            }}</page-title>
            <div class="mt-10 relative">
                <div class="grid lg:grid-cols-2 gap-10 items-start">
                    <div class="space-y-4 form-card">
                        <h3 class="font-medium border-b pb-4 !mb-10">
                            General Information
                        </h3>
                        <form-input
                            label="Name"
                            required
                            v-model="form.name"
                            :error="errors.name"
                        ></form-input>
                        <form-text
                            label="Short description"
                            required
                            v-model="form.short_description"
                            :error="errors.short_description"
                        ></form-text>

                        <form-select
                            label="Category"
                            v-model="form.category_id"
                            :error="errors.category_id"
                            required
                        >
                            <option
                                :value="category.id"
                                v-for="category in categories"
                                :key="`category-${category.id}`"
                            >
                                {{ category.name }}
                            </option>
                        </form-select>
                        <form-select
                            label="Brand"
                            v-model="form.brand_id"
                            :error="errors.brand_id"
                        >
                            <option
                                :value="brand.id"
                                v-for="brand in brands"
                                :key="`brand-${brand.id}`"
                            >
                                {{ brand.name }}
                            </option>
                        </form-select>
                        <form-text
                            label="Long description"
                            :error="errors.description"
                            v-model="form.description"
                        ></form-text>

                        <div class="grid md:grid-cols-2 gap-4">
                            <div class="space-y-4">
                                <form-input
                                    label="Price"
                                    required
                                    :error="errors.price"
                                    v-model="form.price"
                                ></form-input>
                                <form-checkbox
                                    label="Discount price?"
                                    v-model="discountPrice"
                                >
                                </form-checkbox>
                            </div>
                            <form-input
                                :disabled="!discountPrice"
                                label="Discount price"
                                :error="errors.discount_price"
                                v-model="form.discount_price"
                            ></form-input>
                        </div>

                        <div class="border-b">
                            <form-group label="Product settings">
                                <div class="flex items-center gap-4 my-4">
                                    <form-checkbox
                                        label="In stock"
                                        v-model="form.in_stock"
                                    />

                                    <form-checkbox
                                        label="Publish product"
                                        v-model="form.visible"
                                    />
                                </div>
                            </form-group>
                        </div>
                    </div>
                    <div class="space-y-4 form-card">
                        <h3 class="font-medium border-b pb-4 !mb-10">
                            Product photos
                        </h3>
                        <form-group label="Upload">
                            <photo-upload
                                :disabled="!canUploadPhoto"
                                @upload="uploadPhoto"
                            />
                        </form-group>
                        <div
                            v-if="item && item.images"
                            class="mt-4 flex flex-wrap gap-4"
                        >
                            <div
                                v-for="(image, index) in item.images"
                                :key="index"
                                class="group bg-light-alt-2 rounded p-3 relative overflow-auto"
                            >
                                <img class="h-28 w-28 object-cover object-center" :src="image" alt="" />
                                <div
                                    class="invisible group-hover:visible transition border-t absolute inset-0"
                                >
                                    <div
                                        class="!my-0 bg-light-primary opacity-80 absolute inset-0"
                                    ></div>
                                    <div
                                        class="relative ease-in-out flex flex-col space-y-2 items-start pl-3 h-full justify-center"
                                    >
                                        <button
                                            type="button"
                                            class="btn p-1 hover:text-gray-500"
                                        >
                                            <ArrowUpOnSquareIcon
                                                class="h-5"
                                                title="Set as featured image"
                                            />
                                            <span>Featured</span>
                                        </button>
                                        <button
                                            type="button"
                                            class="btn p-1 hover:text-error"
                                        >
                                            <TrashIcon class="h-5" />
                                            <span>Delete</span>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div v-else class="py-10">
                            <p class="text-center text-gray-600">
                                No images added.
                            </p>
                        </div>
                    </div>

                    <div class="lg:col-span-2 grid lg:grid-cols-2 gap-10">
                        <div class="space-y-4 form-card">
                            <h3 class="font-medium border-b pb-4 !mb-10">
                                Product specifications
                            </h3>
                            <form-group label="Select any to add">
                                <div class="flex flex-wrap mt-4">
                                    <button
                                        type="button"
                                        v-for="specification in specifications"
                                        :key="`spec-${specification.id}`"
                                        :disabled="!canSaveForm"
                                        class="border hover:bg-dark hover:text-white py-2 px-4 text-sm inline-flex space-x-2 me-2 mb-2 rounded-full disabled:border-gray-400 disabled:text-gray-400 disabled:hover:bg-transparent disabled:cursor-not-allowed"
                                        :class="{
                                            'border-dark bg-dark text-white':
                                                Object.keys(
                                                    form.specifications
                                                ).includes(specification.name),
                                        }"
                                        @click="addSpecification(specification)"
                                    >
                                        <span>
                                            {{ specification.name }}
                                        </span>
                                        <CheckCircleIconOutlined
                                            class="h-5"
                                            v-if="
                                                Object.keys(
                                                    form.specifications
                                                ).includes(specification.name)
                                            "
                                        />
                                        <PlusCircleIcon v-else class="h-5" />
                                    </button>
                                </div>
                            </form-group>
                        </div>

                        <div class="space-y-2" v-if="form.specifications">
                            <div
                                class="flex"
                                v-for="(spec, key) in form.specifications"
                            >
                                <div
                                    class="flex items-center border space-x-3 bg-white pr-4 rounded-lg"
                                >
                                    <div class="flex items-center py-3">
                                        <p
                                            class="w-36 text-sm px-3 text-gray-500"
                                        >
                                            {{ key }}
                                        </p>
                                        <input
                                            type="text"
                                            class="w-40 border-l border-0 focus:border-transparent border-l-gray-100 hover:border-l-dark bg-transparent flex-auto focus:ring-0 text-sm"
                                            placeholder="Specification"
                                            v-model="form.specifications[key]"
                                        />
                                    </div>
                                    <button
                                        type="button"
                                        class="p-2 hover:text-error"
                                        @click="
                                            deleteSpecification(key as string)
                                        "
                                    >
                                        <XCircleIcon class="h-6" />
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="sticky bottom-0 p-4 bg-white">
                <div class="flex space-x-4 !mt-10">
                    <base-button
                        type="button"
                        class="btn--outline-secondary"
                        @click="cancelForm"
                    >
                        Cancel
                    </base-button>
                    <base-button
                        :disabled="!canSaveForm"
                        type="submit"
                        class="btn--primary"
                    >
                        <span>Save changes</span>
                        <CheckCircleIcon class="h-5" />
                    </base-button>
                </div>
            </div>
        </layout-container>
    </form>
</template>
<script lang="ts" setup>
import Dashboard from "@/layouts/dashboard.vue";
import type { ProductForm, ProductSpecification } from "@/types/products";
import { onMounted } from "vue";
import PhotoUpload from "@/components/form/photo-upload.vue";
import { computed, ref } from "vue";
import { router } from "@inertiajs/vue3";
import { CheckCircleIcon } from "@heroicons/vue/24/solid";
import {
    TrashIcon,
    ArrowUpOnSquareIcon,
    PlusCircleIcon,
    XCircleIcon,
    CheckCircleIcon as CheckCircleIconOutlined,
} from "@heroicons/vue/24/outline";

defineOptions({
    layout: Dashboard,
});

const props = defineProps<{
    product?: ProductForm;
    isEdit?: boolean;
    brands: Array<{
        id: string;
        name: string;
    }>;
    categories: Array<{
        id: number;
        name: string;
    }>;
    specifications: Array<ProductSpecification>;
    errors: {
        [key in keyof ProductForm]: string;
    };
}>();

const item = computed(() => (props.isEdit ? props.product : null));

const savedForm = ref<ProductForm | null>();
const form = ref<ProductForm>({
    images: [],
    specifications: {},
});

const discountPrice = ref(false);

const isTrulyEdit = computed(() => props.isEdit && item.value);

const canSaveForm = computed(() => {
    let importantFields = ["name", "short_description", "price"];
    return importantFields.every((field) => {
        let val = form.value[field as keyof ProductForm];
        return val !== null && val !== "" && val !== undefined;
    });
});

const canUploadPhoto = computed(() => {
    return isTrulyEdit.value || canSaveForm.value;
});

const addSpecification = (spec: ProductSpecification) => {
    if (!form.value.specifications) {
        form.value.specifications = {};
    }

    Object.assign(form.value.specifications, {
        [spec.name]: "",
    });
};

const deleteSpecification = (key: string) => {
    if (
        form.value.specifications &&
        Object.keys(form.value.specifications).includes(key) &&
        confirm("Really?")
    ) {
        delete form.value.specifications[key];
    }
};

const submit = () => {
    let options: {
            method: "post" | "patch";
            data: any;
            preserveState: boolean;
        } = {
            method: isTrulyEdit.value ? "patch" : "post",
            data: form.value,
            preserveState: true,
        },
        url = isTrulyEdit.value
            ? route("admin.products.update", { id: item.value?.slug })
            : route("admin.products.store");

    router.visit(url, options);
};

const cancelForm = () => {
    let url;
    if (isTrulyEdit.value) {
        url = route("admin.products.show", { product: item.value?.slug });
    } else {
        url = route("admin.products.index");
    }
    if (confirm("Really?")) {
        router.visit(url);
    }
};

const uploadPhoto = (photo: File) => {
    console.log(photo.name);
    router.visit(
        route("admin.products.photo.store", { product: item.value?.slug }),
        {
            method: "post",
            data: { photo },
            forceFormData: true,
        }
    );
};

onMounted(() => {
    if (props.isEdit && props.product) {
        form.value = { ...props.product };

        if (props.product.discount_price) {
            discountPrice.value = true;
        }
    }
});
</script>
