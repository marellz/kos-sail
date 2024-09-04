<template>
    <page-head title="Register" />
    <form @submit.prevent="submit">
        <div class="space-y-2">
            <page-title class="text-primary">Register</page-title>
            <page-description class="text-gray-500">Go on. Give us your details so you can get started.</page-description>
        </div>
        <div class="space-y-4 mt-10">
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

            <base-button class="w-full btn--primary" :disabled="form.processing"> Register </base-button>

            <div class="flex items-center justify-end mt-4">
                <p
                    :href="route('login')"
                    class="text-sm text-gray-600 "
                >
                    Already registered?

                    <nav-link :href="route('login')" :class="{ 'opacity-25': form.processing }">
                        Login
                    </nav-link>
                </p>
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
    role_id: 3,
});

const submit = () => {
    form.post(route("register"), {
        onFinish: () => {
            form.reset("password", "password_confirmation");
        },
    });
};
</script>
