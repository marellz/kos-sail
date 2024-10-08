<template>
    <page-head title="Email Verification" />

    <div class="mb-4 text-sm text-gray-600 dark:text-gray-400">
        Thanks for signing up! Before getting started, could you verify your
        email address by clicking on the link we just emailed to you? If you
        didn't receive the email, we will gladly send you another.
    </div>

    <div
        class="mb-4 font-medium text-sm text-green-600 dark:text-green-400"
        v-if="verificationLinkSent"
    >
        A new verification link has been sent to the email address you provided
        during registration.
    </div>

    <form @submit.prevent="submit">
        <div class="mt-4 flex items-center justify-between">
            <base-button
                class="btn--primary"
                :class="{ 'opacity-25': form.processing }"
                :disabled="form.processing"
            >
                Resend Verification Email
            </base-button>

            <nav-link
                :href="route('logout')"
                method="post"
                as="button"
                class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800"
                >Log Out</nav-link
            >
        </div>
    </form>
</template>
<script setup lang="ts">
import { computed } from "vue";
import { useForm } from "@inertiajs/vue3";
import Auth from "@/layouts/auth.vue";

defineOptions({
    layout: Auth,
});

const props = defineProps<{
    status?: string;
}>();

const form = useForm({});

const submit = () => {
    form.post(route("verification.send"));
};

const verificationLinkSent = computed(
    () => props.status === "verification-link-sent"
);
</script>
