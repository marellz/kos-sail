<template>
    <page-head title="Forgot Password" />

    <div class="mb-4 text-sm text-gray-600 dark:text-gray-400">
        Forgot your password? No problem. Just let us know your email address
        and we will email you a password reset link that will allow you to
        choose a new one.
    </div>

    <div
        v-if="status"
        class="mb-4 font-medium text-sm text-green-600 dark:text-green-400"
    >
        {{ status }}
    </div>

    <form @submit.prevent="submit">
        <div>
            <form-input
                label="Email"
                type="email"
                class="mt-1 block w-full"
                v-model="form.email"
                required
                autofocus
                autocomplete="username"
                :error="form.errors.email"
            />
        </div>

        <div class="flex items-center justify-end mt-4">
            <base-button
                :class="{ 'opacity-25': form.processing }"
                :disabled="form.processing"
            >
                Email Password Reset Link
            </base-button>
        </div>
    </form>
</template>
<script setup lang="ts">
import Auth from "@/layouts/auth.vue";

import {  useForm } from "@inertiajs/vue3";

defineOptions({
    layout: Auth,
})
defineProps<{
    status?: string;
}>();

const form = useForm({
    email: "",
});

const submit = () => {
    form.post(route("password.email"));
};
</script>
