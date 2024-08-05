import { PageProps as InertiaPageProps } from '@inertiajs/core';
import { AxiosInstance } from 'axios';
import { PageProps as AppPageProps } from './';

declare global {
    interface Window {
        axios: AxiosInstance;
    }

    let route
}

declare module 'vue' {
    interface ComponentCustomProperties {
        route
    }
}

declare module '@inertiajs/core' {
    interface PageProps extends InertiaPageProps, AppPageProps {}
}
