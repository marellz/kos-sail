<template>
    <page-head title="Reset Password" />

    <form @submit.prevent="submit">
        <div class="space-y-4">
            <form-input
                label="Email"
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
                <base-button
                    class="btn--primary"
                    :class="{ 'opacity-25': form.processing }"
                    :disabled="form.processing"
                >
                    Reset Password
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

const props = defineProps<{
    email: string;
    token: string;
}>();

const form = useForm({
    token: props.token,
    email: props.email,
    password: "",
    password_confirmation: "",
});

const submit = () => {
    form.post(route("password.store"), {
        onFinish: () => {
            form.reset("password", "password_confirmation");
        },
    });
};
</script>
