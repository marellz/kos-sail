import { Product } from "./products";

export interface Category {
    id: string;
    name: string;
    slug: string;
    description: string;
    parent_id?: string;
    product_count?: number;
    subcategories?: Array<Category>;
    products?: Array<Product>
}

export interface CategoryForm {
    id?: string | null;
    name?: string | null;
    slug?: string | null;
    parent_id?: string | null;
    description?: string | null;
    subcategories?: Array<Category | null>;
}
