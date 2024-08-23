<template>
    <table class="table-auto w-full border-separate border-spacing-y-3">
        <thead>
            <tr>
                <th
                    v-for="(header, index) in headers"
                    :key="index"
                    class="font-medium text-sm border-b text-left"
                    :class="[header.headerClass]"
                >
                    {{ header.label }}
                </th>
            </tr>
        </thead>
        <tbody>
            <template v-for="row in items" :key="row.id">
                <tr
                    @click="open(row.id)"
                    class=""
                >
                    <td class="">
                        <div class="flex space-x-2">
                            <UserCircleIcon
                                class="h-10 flex-none text-gray-400"
                            />
                            <div>
                                <h2
                                    class="text-lg font-medium"
                                    :class="{
                                        'text-gray-400': row.read,
                                    }"
                                >
                                    {{ row.name }}
                                </h2>

                                <div
                                    class="inline-flex space-x-1 text-gray-500"
                                >
                                    <span class="text-xs">
                                        {{ row.email }}
                                    </span>

                                    <span class="text-gray-500">|</span>

                                    <span class="text-xs">
                                        {{ row.phone }}
                                    </span>
                                </div>
                            </div>
                        </div>
                    </td>
                    <td class="">
                        <p>
                            {{ row.subject }}
                        </p>
                    </td>
                    <td class="">
                        <div class="px-2 text-center">
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
                            <status-tag
                                v-else
                                class="bg-blue-100 text-blue-500"
                            >
                                <EnvelopeIcon class="h-5" />
                                <span> Unread </span>
                            </status-tag>
                        </div>
                    </td>
                    <td class="">
                        <div class="flex items-center space-x-3">
                            <button
                                type="button"
                                class="btn btn--sm border-gray-200 items-center font-normal"
                            >
                                <EnvelopeOpenIcon class="h-5" />
                                <p class="pt-1">Open</p>
                            </button>
                            <button
                                type="button"
                                class="btn btn--sm border-gray-200 items-center font-normal"
                            >
                                <EnvelopeOpenIcon class="h-5" />
                                <p class="pt-1">Mark as unread</p>
                            </button>
                        </div>
                    </td>
                </tr>
                <tr v-show="activeRow && row.id === Number(activeRow)">
                    <td
                        colspan="4"
                        class="border-b space-y-3 bg-blue-50 p-3 rounded-xl"
                    >
                        <h1 class="text-sm font-medium">Message content</h1>
                        <div class="py-3">
                            <p>
                                {{ row.message }}
                            </p>
                        </div>
                        <div class="flex items-center space-x-3">
                            <button
                                type="button"
                                class="btn text-blue-500 border-blue-500"
                            >
                                <CheckBadgeIcon class="h-5" />
                                <span>Mark as resoved</span>
                            </button>
                            <button
                                type="button"
                                class="btn text-red-500 border-red-500"
                            >
                                <TrashIcon class="h-5" />
                                <span>Delete message</span>
                            </button>
                        </div>
                    </td>
                </tr>
            </template>
        </tbody>
    </table>
</template>
<script lang="ts" setup>
import {
    CheckBadgeIcon,
    EnvelopeIcon,
    EnvelopeOpenIcon,
    ExclamationCircleIcon,
    TrashIcon,
} from "@heroicons/vue/24/outline";
import { UserCircleIcon } from "@heroicons/vue/24/solid";
import { type Contact } from "@/types/index";

const props = defineProps<{
    items: Array<Contact>;
    activeRow: string | null;
}>();

const emit = defineEmits(["open-row"]);

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

const rowIsActive = (id: number) => {
    return props.activeRow && id === Number(props.activeRow)
}
</script>
