<template>
    <page-head title="Admin | Contact messages"></page-head>
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
            <p class="text-gray-500 mb-5">
                Showing {{ contacts.meta.from }} to
                {{ contacts.meta.to }} contact messages
            </p>
            <contacts-table
                v-model:selected="selected"
                :items
                @open-row="openRow"
                @mark-many-as-read="updateMany('read')"
                @mark-many-as-resolved="updateMany('resolved')"
                @mark-as-read="markAsRead"
                @mark-as-resolved="markAsResolved"
            ></contacts-table>
        </div>

        <pagination :meta="contacts.meta"></pagination>
    </layout-container>
</template>
<script lang="ts" setup>
import Dashboard from "@/layouts/dashboard.vue";
import { type PaginationLink } from "@/types/index";
import ContactsTable from "@/components/admin/contact/table.vue";
import { router } from "@inertiajs/vue3";
import { ref, computed } from "vue";
import { type Contact } from "@/types/index";
import { useToastStore } from "@/store/toasts";
const toasts = useToastStore()
defineOptions({
    layout: Dashboard,
});

const props = defineProps<{
    contacts: {
        meta: {
            links: Array<PaginationLink>;
            last_page: number;
            current_page: number;
            from: number;
            to: number;
        };
        data: Array<Contact>;
    };
    query: string | null;
}>();

const activeContact = ref<Contact | null>(null);

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
    router.visit(route("admin.contacts.show", { id }), {
        preserveState: true,
        preserveScroll: true,
    });
};

const update = (
    id: number,
    data: { read?: boolean; resolved?: boolean }
) => {
    router.visit(route("admin.contacts.update", { id }), {
        method: "patch",
        data: { ...data },
        onSuccess: () => { 
            const action = data.read ? 'read' : 'resolved'
            toasts.createToast({
                type:"success",
                message: `Successfully marked as ${action}`,
            })
        },
    });
};

const markAsResolved = (id: number) => {
    update(id, { resolved: true });
};

const markAsRead = (id: number) => {
    update(id, { read: true });
};

const resetList = () => {
    router.visit(route("admin.contacts.index"));
};

const selected = ref([]);

const updateMany = (action: "resolved" | "read") => {
    router.visit(route("admin.contacts-update-many"), {
        method: "post",
        data: {
            contacts: selected.value,
            action,
        },
        preserveState: true,
        preserveScroll: true,
        onSuccess: () => {
            toasts.createToast({
                type:"success",
                message: `Successfully marked ${selected.value.length} contacts as ${action}`,
            })
        },
    });
};
</script>
