import { Config } from "ziggy-js";
import { CartItem } from "./cart";

export interface User {
    id: number;
    name: string;
    email: string;
    email_verified_at: string;
}

export type PageProps<
    T extends Record<string, unknown> = Record<string, unknown>
> = T & {
    auth: {
        user: User;
    };
    ziggy: Config & { location: string };
    cart?: Array<CartItem>;
};

export interface PaginationLink {
    label: string;
    url?: string;
    active: boolean;
}

export interface PaginationMeta {
    links: Array<PaginationLink>;
    last_page: number;
    current_page: number;
}

export interface Contact {
    id: number;
    name: string;
    email: string;
    phone: string;
    subject: string;
    message: string;
    reply_to?: number;
    read: boolean;
    resolved: boolean;
    active?: boolean;
    sent_at?: string;
}

export interface ToastItem {
    type: "success" | "error" | "info";
    message: string;
    timeout?: number;
}
