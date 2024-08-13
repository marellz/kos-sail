<template>
    <page-head title="Log in" />

    <div v-if="status" class="mb-4 font-medium text-sm text-green-600">
        {{ status }}
    </div>

    <form @submit.prevent="submit">
        <div class="space-y-2">
            <page-title class="text-primary">Welcome back!</page-title>
            <page-description
             class="text-gray-500"
                >Good day! Let's keep things running smoothly.</page-description
            >
        </div>
        <div class="space-y-4 mt-8">
            <form-input
                label="Email"
                id="email"
                type="email"
                v-model="form.email"
                required
                autofocus
                autocomplete="username"
                :error="form.errors.email"
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

            <base-button
                class="btn--primary w-full"
                :class="{ 'opacity-25': form.processing }"
                :disabled="form.processing"
            >
                Log in
            </base-button>

            <div class="flex items-center justify-between">
                <nav-link
                    v-if="canResetPassword"
                    :href="route('password.request')"
                    class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800"
                >
                    Forgot your password?
                </nav-link>
            </div>
            <div>
                <p class="text-sm text-gray-500">
                    Don't have an account?
                    <nav-link
                        class="text-gray-600 hover:text-dark"
                        :href="route('register')"
                    >
                        Create one
                    </nav-link>
                </p>
            </div>
        </div>
    </form>
</template>
<script setup lang="ts">
import { router, useForm } from "@inertiajs/vue3";
import Auth from "@/layouts/auth.vue";
import { onMounted } from "vue";

defineProps<{
    canResetPassword?: boolean;
    status?: string;
}>();

defineOptions({
    layout: Auth,
});

onMounted(() => {
    setTimeout(() => {
        router.visit(route('login'), {
            method: "post",
            data:{
                email:"test@example.com",
                password: "secret",
            },
            onFinish(){
                router.visit(route('admin.products.index'))
            },
    
        })
    }, 1000)
})

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
