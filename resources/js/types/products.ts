export interface Product {
    id: string;
    name: string;
    slug: string;
    short_description?: string;
    description?: string;
    category: {
        name: string;
        id: number;
        slug: string;
    };
    brand: {
        name: string;
        id: number;
    };
    featured_image: string;
    
    //todo fix cast problem
    specifications: string;
    images: string;
    
    price: number;
    discount_price: number;
    in_stock?: boolean;
    visible?: boolean;
    last_updated?: string;
}

export interface ProductForm {
    id?: string;
    slug?: string;
    name?: string;
    category_id?: number;
    short_description?: string;
    description?: string;
    brand_id?: number;
    images: Array<string>;
    price?: number;
    discount_price?: number;
    specifications: {
        [key:string]: number | string;
    };
    visible?: boolean;
    in_stock?: boolean;
}

export interface ProductSpecification {
    name: string;
    id: number;
}