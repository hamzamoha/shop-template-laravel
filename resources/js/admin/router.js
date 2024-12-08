import { createRouter, createWebHashHistory } from 'vue-router';
import Home from './views/Home.vue';
import ProductsIndex from './views/products/ProductsIndex.vue';
import ProductCreate from "./views/products/ProductCreate.vue";
import ProductShow from './views/products/ProductShow.vue';
import ProductEdit from "./views/products/ProductEdit.vue";

import CategoriesIndex from './views/categories/CategoriesIndex.vue';

import OrderIndex from './views/orders/OrderIndex.vue';

import CustomersIndex from './views/customers/CustomersIndex.vue';

import DiscountsIndex from './views/discounts/DiscountsIndex.vue';

import InventoryIndex from './views/inventory/InventoryIndex.vue';

import ShippingIndex from './views/shipping/ShippingIndex.vue';

const routes = [
    { path: '/', component: Home, name: 'Home' },
    { path: '/products', component: ProductsIndex, name: 'products.index' },
    { path: '/products/create', component: ProductCreate, name: 'products.create' },
    { path: '/products/show/:slug', component: ProductShow, name: 'products.show' },
    { path: '/products/edit/:slug', component: ProductEdit, name: 'products.edit' },
    { path: '/categories', component: CategoriesIndex, name: 'categories.index' },
    { path: '/orders', component: OrderIndex, name: 'orders.index' },
    { path: '/customers', component: CustomersIndex, name: 'customers.index' },
    { path: '/discounts', component: DiscountsIndex, name: 'discounts.index' },
    { path: '/inventory', component: InventoryIndex, name: 'inventory.index' },
    { path: '/shipping', component: ShippingIndex, name: 'shipping.index' },
];

const router = createRouter({
    history: createWebHashHistory(),
    routes,
});

export default router;