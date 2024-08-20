export interface CartProduct {
    id: string;
    name: string;
    slug: string;
    short_description?: string;
    category: {
        name: string;
    };
    brand: {
        name: string;
    };
    featured_image: string;

    price: number;
    discount_price: number;
    in_stock?: boolean;
    visible?: boolean;
}

export interface CartItem {
    item: CartProduct;
    quantity: number;
}
