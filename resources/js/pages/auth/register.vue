<template>
    <page-head title="Register" />

    <form @submit.prevent="submit">
        <div class="space-y-4">
            <form-input
                label="Name"
                v-model="form.name"
                required
                autofocus
                autocomplete="name"
                :error="form.errors.name"
            />

            <form-input
                label="Email"
                type="email"
                v-model="form.email"
                required
                autocomplete="username"
                :error="form.errors.email"
            />

            <form-input
                label="Password"
                type="password"
                v-model="form.password"
                required
                autocomplete="new-password"
                :error="form.errors.password"
            />

            <form-input
                label="Confirm Password"
                type="password"
                v-model="form.password_confirmation"
                required
                autocomplete="new-password"
                :error="form.errors.password_confirmation"
            />

            <div class="flex items-center justify-end mt-4">
                <nav-link
                    :href="route('login')"
                    class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800"
                >
                    Already registered?
                </nav-link>

                <base-button
                    class="ms-4"
                    :class="{ 'opacity-25': form.processing }"
                    :disabled="form.processing"
                >
                    Register
                </base-button>
            </div>
        </div>
    </form>
</template>

<script setup lang="ts">
import { useForm } from "@inertiajs/vue3";
import Auth from "@/layouts/auth.vue";

defineOptions({
    layout: Auth,
});

const form = useForm({
    name: "",
    email: "",
    password: "",
    password_confirmation: "",
});

const submit = () => {
    form.post(route("register"), {
        onFinish: () => {
            form.reset("password", "password_confirmation");
        },
    });
};
</script>
