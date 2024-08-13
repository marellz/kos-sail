<template>
    <page-head title="Forgot Password" />

    <div class="space-y-2">
        <page-title class="!text-2xl text-primary">Forgot your password?</page-title>
        <page-description class="text-gray-500">
            No problem. Just let us know your email address and we will email
            you a password reset link that will allow you to choose a new
            one.</page-description
        >
    </div>

    <div class="mt-10">
        <div
            v-if="status"
            class="mb-4 font-medium text-sm text-green-600 dark:text-green-400"
        >
            {{ status }}
        </div>

        <form @submit.prevent="submit">
            <div class="space-y-4">
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

                <div class="">
                    <base-button
                        class="btn--primary w-full"
                        :class="{ 'opacity-25': form.processing }"
                        :disabled="form.processing"
                    >
                        Email Password Reset Link
                    </base-button>
                </div>
            </div>
        </form>
    </div>
</template>
<script setup lang="ts">
import Auth from "@/layouts/auth.vue";

import { useForm } from "@inertiajs/vue3";

defineOptions({
    layout: Auth,
});
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
