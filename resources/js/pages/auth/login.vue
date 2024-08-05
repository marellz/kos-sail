<template>
    <page-head title="Log in" />

    <div v-if="status" class="mb-4 font-medium text-sm text-green-600">
        {{ status }}
    </div>

    <form @submit.prevent="submit">
        <div class="space-y-4">
            <form-input
                label="Email"
                id="email"
                type="email"
               
                v-model="form.email"
                required
                autofocus
                autocomplete="username"
                :message="form.errors.email"
            />
       
            <form-input
                label="Password"
                type="password"
               
                v-model="form.password"
                required
                autocomplete="current-password"
                :error="form.errors.password"
            />
        
            <form-checkbox
                name="remember"
                label="Remember me"
                v-model:checked="form.remember"
            />
        </div>

        <div class="flex items-center justify-end mt-4">
            <nav-link
                v-if="canResetPassword"
                :href="route('password.request')"
                class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800"
            >
                Forgot your password?
            </nav-link>

            <base-button
                class="btn--primary ms-4"
                :class="{ 'opacity-25': form.processing }"
                :disabled="form.processing"
            >
                Log in
            </base-button>
        </div>
    </form>
</template>
<script setup lang="ts">
import { useForm } from "@inertiajs/vue3";
import Auth from "@/layouts/auth.vue";

defineProps<{
    canResetPassword?: boolean;
    status?: string;
}>();

defineOptions({
    layout: Auth,
});

const form = useForm({
    email: "",
    password: "",
    remember: false,
});

const submit = () => {
    form.post(route("login"), {
        onFinish: () => {
            form.reset("password");
        },
    });
};
</script>
