<template>
    <page-head title="Admin | Contact Message"></page-head>
    <layout-container>
        <div class="pb-5">
            <a
                :href="route('admin.contacts.index')"
                class="inline-flex space-x-2 font-medium hover:bg-dark hover:text-white rounded-full text-sm py-2 px-3"
                @click.prevent="goBack"
            >
                <ArrowUturnLeftIcon class="h-5" />
                <span>Return to contacts</span>
            </a>
        </div>
        <div class="flex justify-between flex-wrap space-y-5 lg:space-y-0">
            <page-title>Contact message</page-title>
            <div class="flex items-center space-x-3">
                <button
                    v-if="!contact.resolved"
                    type="button"
                    class="btn text-blue-500 border-blue-500"
                    @click="markAsResolved"
                >
                    <CheckBadgeIcon class="h-5" />
                    <span>Mark as resoved</span>
                </button>
                <div
                    v-else
                    class="text-success font-medium inline-flex space-x-2"
                >
                    <CheckBadgeIcon class="h-5" />
                    <span class="">Marked as resolved!</span>
                </div>
                <button
                    type="button"
                    class="btn text-red-500 border-red-500"
                    @click="deleteMessage"
                >
                    <TrashIcon class="h-5" />
                    <span>Delete message</span>
                </button>
            </div>
        </div>
        <div class="mt-10">
            <div class="border-b flex items-center space-x-2 py-2">
                <UserCircleIcon class="h-16 flex-none text-gray-400" />
                <div class="flex-auto">
                    <h3 class="font-medium">
                        {{ contact.name }}
                    </h3>
                    <p class="text-sm flex flex-wrap">
                        <a :href="`mailto:${contact.email}`">
                            {{ contact.email }}
                        </a>
                        <span class="px-2">|</span>
                        <a :href="`tel:${contact.phone}`">
                            {{ contact.phone }}
                        </a>
                    </p>
                    <p class="text-xs text-gray-500">
                        Sent {{ contact.sent_at }}
                    </p>
                </div>
                <div>
                    <base-button
                        class="btn-icon border-gray-400"
                        @click="showResponseForm = true"
                    >
                        <ArrowUturnLeftIcon class="h-5" />
                        <span>Reply</span>
                    </base-button>
                </div>
            </div>
            <div class="border-b py-3">
                <p class="font-medium">
                    Subject:
                    <span>
                        {{ contact.subject }}
                    </span>
                </p>
            </div>
            <div class="border-b py-3 leading-7 text-sm md:text-base">
                {{ contact.message }}
            </div>
        </div>
    </layout-container>
    <div class="py-2 mt-10" v-if="showResponseForm">
        <layout-container>
            <form @submit.prevent="submitResponse">
                <div class="">
                    <form-text v-model="response" label="Response"></form-text>
                    <div class="flex space-x-3 mt-5 justify-end">
                        <base-button
                            @click="showResponseForm = false"
                            type="button"
                            class="btn--outline-secondary"
                        >
                            <span>Cancel</span>
                        </base-button>
                        <base-button
                            type="submit"
                            class="btn--secondary"
                            :disabled="!response"
                        >
                            <span>Send response</span>
                        </base-button>
                    </div>
                </div>
            </form>
        </layout-container>
    </div>
</template>

<script lang="ts" setup>
import Dashboard from "@/layouts/dashboard.vue";
import { Contact } from "@/types/index.d";
import {
    ArrowUturnLeftIcon,
    CheckBadgeIcon,
    TrashIcon,
} from "@heroicons/vue/24/outline";
import { UserCircleIcon } from "@heroicons/vue/24/solid";
import { router } from "@inertiajs/vue3";
import { ref } from "vue";
import { useToastStore } from "@/store/toasts";
const toasts = useToastStore()
const props = defineProps<{
    contact: Contact;
}>();

defineOptions({
    layout: Dashboard,
});

const goBack = () => {
    router.visit(document.referrer)
};

const update = (payload: object = {}) => {
    router.visit(
        route("admin.contacts.update", { contact: props.contact.id }),
        {
            method: "patch",
            data: { ...payload },
            onSuccess: () => {
                router.visit(
                    route("admin.contacts.show", { contact: props.contact.id })
                );

                // throw toast
            },
        }
    );
};

const showResponseForm = ref(false);
const response = ref("");
const submitResponse = () => {
    // router.visit()
};

const markAsResolved = () => {
    update({
        resolved: true,
    });
};

const deleteMessage = () => {
    if (!confirm("Really")) {
        return false;
    }
    router.visit(route("admin.contacts.destroy", { id: props.contact.id }), {
        method: "delete",
        onSuccess() {
            toasts.createToast({
                type:"success",
                message: `Successfully deleted the contact`,
            })
        },
    });
};
</script>
