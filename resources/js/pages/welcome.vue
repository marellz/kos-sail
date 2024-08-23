<template>
    <page-head title="Home" />

    <div
        class="bg-primary bg-opacity-5 mx-6 rounded-xl pt-6 relative overflow-hidden"
    >
        <layout-header></layout-header>
        <layout-container class="pt-12 lg:pt-16">
            <div class="grid md:grid-cols-3">
                <div class="pb-20 col-span-2">
                    <icons-wavy class="mb-5 text-primary" />
                    <div class="space-y-5 lg:space-y-8">
                        <h1
                            class="text-lg lg:text-[40px] uppercase lg:leading-[101px] xl:leading-[80px] font-medium"
                        >
                            WELCOME TO
                            <span
                                class="font-bold text-primary text-4xl lg:text-[80px] block"
                                >KIRINYAGA</span
                            >
                            ONLINE STORES
                        </h1>
                        <p class="text-sm lg:text-3xl">
                            Your trusted source for quality tools & equipment.
                        </p>
                        <div
                            class="translate-y-[175%] md:translate-y-1/2 lg:translate-y-0 flex flex-col items-start space-y-5"
                        >
                            <nav-link
                                :href="route('products.index')"
                                as="button"
                                class="btn btn--lg btn--primary"
                            >
                                <span>Browse tools</span>
                            </nav-link>
                            <nav-link
                                :href="route('categories.index')"
                                class="inline-flex font-medium text-primary items-center"
                            >
                                <span>Expore categories</span>
                                <icons-polygon
                                    class="h-5 transform rotate-90"
                                />
                            </nav-link>
                        </div>
                    </div>
                </div>
                <div
                    class="relative z-10 -translate-y-2/3 transform scale-[1.7] translate-x-1/4 md:translate-y-1/4 lg:scale-[2] lg:translate-y-1/2 lg:-translate-x-1/2"
                >
                    <img src="@/assets/images/drill-xl.png" alt="" />
                </div>
            </div>
        </layout-container>
        <img
            class="bottom-0 -right-1/2 lg:left-1/2 absolute lg:bottom-0 transform lg:-translate-x-1/2 opacity-50 lg:translate-y-1/2"
            src="@/assets/images/waves-2.svg"
            alt=""
        />
    </div>

    <div class="py-20">
        <layout-container>
            <home-title>Explore products</home-title>
            <home-tabs class="mt-5" :tabs="productTabs" @change="getChunks">
                <template #new>
                    <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-5">
                        <product-card
                            :product
                            v-for="product in products"
                            :key="`product-${product.id}`"
                        ></product-card>
                    </div>
                </template>
                <template #popular>
                    <div class="grid md-grid-cols-2 lg:grid-cols-4 gap-5">
                        <product-card
                            :product
                            v-for="product in products"
                            :key="`product-${product.id}`"
                        ></product-card>
                    </div>
                </template>
            </home-tabs>
            <div class="mt-20">
                <nav-cta :href="route('products.index')">Show more</nav-cta>
            </div>
        </layout-container>
    </div>

    <home-wrap class="bg-light-alt bg-opacity-30">
        <home-title>Ready to take your game to the next level?</home-title>
        <p class="text-xs lg:text-base text-gray-500 mt-2 lg:mt-4">
            Start browsing our collection now and discover:
        </p>

        <div class="my-5 lg:my-10 grid lg:grid-cols-5">
            <div
                v-for="(b, index) in dList"
                :key="index"
                class="lg:col-span-2 p-3 lg:p-5 flex items-center space-x-2 lg:space-x-4"
                :class="{
                    'lg:col-start-2':
                        (index + 1) % 2 !== 0 && (index + 1) % 3 === 0,
                }"
            >
                <span
                    class="w-12 h-12 lg:w-24 lg:h-24 rounded-full bg-white flex-none"
                ></span>
                <p class="text-xs font-light">
                    {{ b.details }}
                </p>
            </div>
        </div>

        <img
            src="@/assets/images/wavy-lg.svg"
            class="absolute left-0 top-2/3"
        />
    </home-wrap>
    <home-wrap class="bg-primary bg-opacity-10">
        <home-title>About us</home-title>
        <div
            class="text-xs leading-6 lg:text-base lg:leading-7 space-y-5 mt-6 lg:mt-12"
        >
            <p>
                At Kirinyaga Online Stores, we make home improvement easy.
                Whether you're a seasoned DIY enthusiast or just starting your
                journey in home maintenance, we've got everything you need to
                tackle projects big and small. From essential hand tools to
                advanced power equipment, we're dedicated to providing
                top-quality products that empower you to transform your living
                space with confidence.
            </p>
            <p>
                Explore our extensive catalog of tools and equipment, carefully
                curated to meet the diverse needs of homeowners like you. With a
                focus on durability, performance, and affordability, we're
                committed to delivering value that exceeds your expectations. At
                Kirinyaga Online Stores, we believe that every home and workshop
                deserves the best, and we're here to help you make it happen.
            </p>
        </div>

        <img
            class="absolute right-0 top-1/2 transform -translate-y-1/2 translate-x-1/2 opacity-25 lg:opacity-50"
            src="@/assets/images/waves-2.svg"
            alt=""
        />
    </home-wrap>

    <home-wrap>
        <home-title>For any inquiry/assistance</home-title>
        <div class="grid lg:grid-cols-3 mt-20">
            <div>
                <h4>Reach out on</h4>
                <icons-wavy class="text-primary" />
                <div class="mt-10">
                    <ul class="space-y-2">
                        <li v-for="{ type: typ, contact, label } in contacts">
                            <a
                                class="inline-flex items-center space-x-4 hover:text-primary"
                                :href="`${typ}:${contact}`"
                            >
                                <component class="h-5" :is="contactIcon(typ)" />
                                <span>
                                    {{ label }}
                                </span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
            <div
                class="lg:col-span-2 lg:pl-10 border-t pt-10 mt-10 lg:border-l lg:pt-0 lg:border-t-0"
            >
                <ContactForm :errors :submitted="submittedMessage" />
            </div>
        </div>
    </home-wrap>
    <layout-footer />
</template>
<script setup lang="ts">
import Blank from "@/layouts/blank.vue";
import LayoutHeader from "@/components/layout/header.vue";
import LayoutFooter from "@/components/layout/footer.vue";
import HomeTitle from "@/components/home/title.vue";
import HomeTabs from "@/components/home/tabs.vue";
import HomeWrap from "@/components/home/wrap.vue";
import ProductCard from "@/components/client/product/card.vue";
import { ref, computed } from "vue";
import {
    EnvelopeIcon,
    PhoneIcon,
} from "@heroicons/vue/24/outline";

import ContactForm from '@/components/client/contact/form.vue'

import { Product } from "@/types/products";
import { router } from "@inertiajs/vue3";
import { useScroll } from "@vueuse/core";

const productTabs = ref([
    {
        key: "new",
        label: "New products",
    },
    {
        key: "popular",
        label: "Popular products",
    },
]);

defineOptions({
    layout: Blank,
});

defineProps<{
    products: Array<Product>;
    chunk: string;
    submittedMessage?: boolean;
    errors: {
        [key: string]: string,
    }
}>();

enum ContactIcons {
    Tel = "tel",
    Email = "email",
}

interface Contact {
    type: ContactIcons;
    contact: string;
    label: string;
}

const contacts: Array<Contact> = [
    {
        type: ContactIcons.Tel,
        contact: "01231231",
        label: "01231231",
    },
    {
        type: ContactIcons.Email,
        contact: "example@gm.com",
        label: "example@gm.com",
    },
];

const contactIcons = {
    [ContactIcons.Tel]: PhoneIcon,
    [ContactIcons.Email]: EnvelopeIcon,
};

const socials = [
    {
        type: "facebook",
        name: "",
        url: "",
    },
    {
        type: "",
        name: "",
        url: "",
    },
];

const dList = [
    {
        details:
            "Expert advice and resources to guide you through your projects with ease.",
    },
    {
        details:
            "Power equipment for efficient landscaping, woodworking, and more.",
    },
    {
        details:
            "High-quality hand tools for everyday repairs and maintenance.",
    },
    {
        details:
            "Safety gear and accessories to ensure a secure and comfortable working environment.",
    },
];

const contactIcon = (typ: ContactIcons) => {
    return contactIcons[typ];
};

const getChunks = (chunk: string) => {
    router.visit(route("home"), {
        data: {
            chunk,
        },
        preserveState: true,
        preserveScroll: true,
    });
};

const scroll = useScroll(window);

const scrollOffset = computed(() => {});
</script>
