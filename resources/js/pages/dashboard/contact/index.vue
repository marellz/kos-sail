<template>
    <page-head title="Admin | Categories"></page-head>
    <layout-container>
        <page-title>Contact messages</page-title>
        <div class="mt-10 flex space-x-2">
            <form @submit.prevent="search">
                <div class="flex items-center space-x-2">
                    <filter-search
                        v-model="searchQuery"
                        @clear-search="resetList"
                    ></filter-search>
                    <base-button :disabled="!searchQuery" class="btn--secondary"
                        >Search</base-button
                    >
                </div>
            </form>
        </div>
        <div class="mt-10">
            <contacts-table :items @open-row="openRow" :activeRow></contacts-table>
        </div>

        <pagination :meta="contacts.meta"></pagination>
    </layout-container>
</template>
<script lang="ts" setup>
import Dashboard from "@/layouts/dashboard.vue";
import { type PaginationLink } from "@/types/index";

import ContactsTable from "@/components/admin/contact/table.vue";
import { router } from "@inertiajs/vue3";
import { ref } from "vue";
import { computed } from "vue";
import { type Contact } from "@/types/index";
defineOptions({
    layout: Dashboard,
});

const props = defineProps<{
    contacts: {
        meta: {
            links: Array<PaginationLink>;
            last_page: number;
            current_page: number;
        };
        data: Array<Contact>;
    };
    activeRow: string | null;
    query: string | null;
}>();

const items = computed(() => props.contacts.data);

const searchQuery = ref(props.query ?? "");

const search = () => {
    router.visit(route("admin.contacts.index"), {
        method: "get",
        data: {
            query: searchQuery.value,
        },
        preserveState: true,
    });
};

const openRow = (id: number) => {
    router.visit(route("admin.contacts.index", { show_id: id }), {
        preserveState: true,
        preserveScroll: true,
    });
};

const resetList = () => {
    router.visit(route("admin.contacts.index"));
};
</script>
