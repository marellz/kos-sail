<template>
    <page-head title="Edit profile" />
    <layout-container class="space-y-6 py-12">
        <page-title>Edit profile</page-title>
        <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
            <UpdateProfileInformationForm
                :must-verify-email="mustVerifyEmail"
                :status="status"
                class="max-w-xl"
            />
        </div>

        <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
            <UpdatePasswordForm class="max-w-xl" />
        </div>

        <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
            <DeleteUserForm class="max-w-xl" />
        </div>
    </layout-container>
</template>
<script setup lang="ts">
import DeleteUserForm from "./partials/delete-user-form.vue";
import UpdatePasswordForm from "./partials/update-password-form.vue";
import UpdateProfileInformationForm from "./partials/update-profile-information.vue";
import Client from "@/layouts/client.vue";

defineOptions({
    layout: Client,
});

defineProps<{
    mustVerifyEmail?: boolean;
    status?: string;
}>();
</script>
