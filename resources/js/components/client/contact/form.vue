<template>
    <form @submit.prevent="submitContact">
        <div class="grid lg:grid-cols-2 gap-5">
            <form-input
                class="lg:col-span-2"
                label="Name"
                placeholder="e.g. John Kamau"
                required
                v-model="form.name"
                :error="errors.name"
            ></form-input>
            <form-input
                type="email"
                placeholder="e.g. john.kamau@example.com"
                label="Email"
                required
                v-model="form.email"
                :error="errors.email"
            ></form-input>
            <form-input
                label="Phone"
                placeholder="e.g. +254 7xx xxxxxx"
                required
                v-model="form.phone"
                :error="errors.phone"
            ></form-input>
            <form-text
                placeholder="Write your message here"
                class="lg:col-span-2"
                required
                label="Message"
                v-model="form.message"
                :error="errors.message"
            ></form-text>

            <div class="lg:col-span-2">
                <base-button
                    class="btn--primary"
                    type="submit"
                    :disabled="submitted"
                >
                    <template v-if="submitted">
                        <span>Message submitted!</span>
                        <CheckCircleIcon class="h-5" />
                    </template>
                    <template v-else>
                        <span>Submit message</span>
                        <PaperAirplaneIcon class="h-5" />
                    </template>
                </base-button>
            </div>
        </div>
    </form>
</template>
<script lang="ts" setup>
import { CheckCircleIcon, PaperAirplaneIcon } from "@heroicons/vue/24/outline";
import { router } from "@inertiajs/vue3";
import { ref } from "vue";

interface ContactForm {
    name: string;
    email: string;
    phone: string;
    message: string;
    subject?: string;
}
const props = defineProps<{
    submitted?: boolean;
    subject?: string;
    errors: {
        [key : string]: string
    }
}>();

const form = ref<ContactForm>({
    name: "",
    email: "",
    phone: "",
    message: "",
    subject: props.subject ?? "No suject",
});

const resetForm = () => {
    form.value = {
        name: "",
        email: "",
        phone: "",
        message: "",
    };
};

const submitContact = () => {
    router.visit(route("contact.store"), {
        method: "post",
        data: { ...form.value },
        preserveScroll: true,
        preserveState: true,
        onSuccess() {
            resetForm();
        },
    });
};
</script>
