<template>
    <table class="table-auto w-full">
        <thead>
            <tr v-if="selected.length" class="flex flex-col lg:table-row">
                <th colspan="3" class="text-left font-normal lg:pb-4">
                    {{ selected.length }} contacts selected
                </th>
                <th colspan="" class="pb-4"></th>
                <th
                    class="font-normal flex justify-end space-x-3 pb-2 border-b mb-4 lg:pb-4 lg:mb-0 lg:border-b-0"
                >
                    <button
                        type="button"
                        class="btn btn--sm"
                        @click="$emit('mark-many-as-read', selected)"
                    >
                        <EnvelopeIcon class="h-5" />
                        <span>Read</span>
                    </button>

                    <button
                        type="button"
                        class="btn btn--sm"
                        :disabled="!canResolveMany"
                        @click="$emit('mark-many-as-resolved', selected)"
                    >
                        <CheckBadgeIcon class="h-5" />
                        <span>Resolve</span>
                    </button>
                </th>
            </tr>
            <tr class="hidden lg:table-row">
                <th class="font-medium text-sm border-b text-left p-2">
                    <form-checkbox
                        v-model="selectedAll"
                        @change="selectAll"
                    ></form-checkbox>
                </th>
                <th
                    v-for="(header, index) in headers"
                    :key="index"
                    class="font-medium text-sm border-b text-left p-2"
                    :class="[header.headerClass]"
                >
                    {{ header.label }}
                </th>
            </tr>
        </thead>
        <tbody class="">
            <tr
                v-for="row in items"
                :key="row.id"
                class="flex lg:table-row flex-wrap hover:bg-gray-100 cursor-pointer"
            >
                <td class="px-2 self-center order-first lg:-order-none">
                    <form-checkbox
                        v-model="selected"
                        :value="row.id"
                        name=""
                    ></form-checkbox>
                </td>
                <td class="order-first px-2" @click="open(row.id)">
                    <div class="flex items-center space-x-2">
                        <UserCircleIcon class="h-10 flex-none text-gray-400" />
                        <div>
                            <h2
                                class="line-clamp-1"
                                :class="{
                                    'text-gray-400': row.read,
                                }"
                            >
                                {{ row.name }}
                            </h2>
                        </div>
                    </div>
                </td>
                <td class="p-3" @click="open(row.id)">
                    <p class="text-sm line-clamp-1">
                        {{ row.subject }}
                    </p>
                </td>
                <td class="border-b pb-4 lg:pb-0 lg:border-b-0">
                    <div
                        class="px-2 text-center flex items-center h-full lg:h-auto"
                    >
                        <status-tag
                            v-if="row.resolved"
                            class="bg-green-100 text-green-500"
                        >
                            <CheckBadgeIcon class="h-5" />
                            <span> Resolved </span>
                        </status-tag>
                        <status-tag
                            v-else-if="row.read"
                            class="bg-orange-100 text-amber-500"
                        >
                            <ExclamationCircleIcon class="h-5" />
                            <span> Unresolved </span>
                        </status-tag>
                        <status-tag v-else class="bg-blue-100 text-blue-500">
                            <EnvelopeIcon class="h-5" />
                            <span> Unread </span>
                        </status-tag>
                    </div>
                </td>
                <td class="border-b flex-auto pb-4 lg:pb-0 lg:border-b-0">
                    <div class="flex items-center">
                        <button
                            type="button"
                            class="btn btn--sm items-center font-normal hover:text-warning"
                            @click.capture="markAsRead(row.id, !row.read)"
                        >
                            <template v-if="row.read">
                                <EnvelopeIcon class="h-5" />
                                <p class="pt-1">Unread</p>
                            </template>
                            <template v-else>
                                <EnvelopeOpenIcon class="h-5" />
                                <p class="pt-1">Read</p>
                            </template>
                        </button>
                        <button
                            type="button"
                            :disabled="!row.read"
                            class="btn btn--sm items-center font-normal hover:text-warning"
                            @click.capture="
                                markAsResolved(row.id, !row.resolved)
                            "
                        >
                            <CheckBadgeIcon class="h-5" />
                            <span>Resolve</span>
                        </button>
                    </div>
                </td>
            </tr>
        </tbody>
    </table>
</template>
<script lang="ts" setup>
import {
    CheckBadgeIcon,
    EnvelopeIcon,
    EnvelopeOpenIcon,
    ExclamationCircleIcon,
} from "@heroicons/vue/24/outline";

import { UserCircleIcon } from "@heroicons/vue/24/solid";
import { type Contact } from "@/types/index";
import { ref, computed } from "vue";

const props = defineProps<{
    items: Array<Contact>;
}>();

const emit = defineEmits([
    "open-row",
    "mark-as-read",
    "mark-as-resolved",
    "mark-many-as-read",
    "mark-many-as-resolved",
]);

const headers = [
    {
        key: "message",
        label: "Name",
    },
    {
        key: "subject",
        label: "Subject",
    },
    {
        key: "status",
        label: "Status",
        headerClass: "!text-center",
    },
    {
        key: "actions",
        label: "Actions",
    },
];

const open = (id: number) => {
    emit("open-row", id);
};

const markAsRead = (id: number, read: boolean = true) => {
    emit("mark-as-read", id, read);
};

const markAsResolved = (id: number, resolved: boolean = true) => {
    emit("mark-as-resolved", id, resolved);
};

const selected = defineModel<Array<number>>("selected", { default: [] });

const selectedAll = ref(false);

const selectAll = (isSelected: boolean) => {
    selected.value = isSelected
        ? props.items.map((item: Contact) => item.id)
        : [];
};

const canResolveMany = computed(() =>
    selected.value
        .map((item) => props.items.find((i) => i.id === item))
        .every((item) => item?.read)
);
</script>
