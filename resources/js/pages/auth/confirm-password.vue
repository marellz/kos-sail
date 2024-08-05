<template>
    <page-head title="Confirm Password" />

    <div class="mb-4 text-sm text-gray-600 dark:text-gray-400">
        This is a secure area of the application. Please confirm your password
        before continuing.
    </div>

    <form @submit.prevent="submit">
        <div>
            <form-input
                value="Password"
                type="password"
                v-model="form.password"
                required
                autocomplete="current-password"
                autofocus
                :error="form.errors.password"
            />
        </div>

        <div class="flex justify-end mt-4">
            <base-button
                class="btn--primary ms-4"
                :class="{ 'opacity-25': form.processing }"
                :disabled="form.processing"
            >
                Confirm
            </base-button>
        </div>
    </form>
</template>
<script setup lang="ts">
import Auth from "@/layouts/auth.vue";
import { useForm } from "@inertiajs/vue3";

defineOptions({
    layout: Auth,
});
const form = useForm({
    password: "",
});

const submit = () => {
    form.post(route("password.confirm"), {
        onFinish: () => {
            form.reset();
        },
    });
};
</script>
