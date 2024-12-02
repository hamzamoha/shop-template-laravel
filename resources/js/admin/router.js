import { createRouter, createWebHashHistory } from 'vue-router';
import Home from './views/Home.vue';
import ProductsIndex from './views/products/ProductsIndex.vue';
import ProductCreate from "./views/products/ProductCreate.vue";
import ProductShow from './views/products/ProductShow.vue';
import ProductEdit from "./views/products/ProductEdit.vue";

import CategoriesIndex from './views/categories/CategoriesIndex.vue';

import OrderIndex from './views/orders/OrderIndex.vue';

import CustomersIndex from './views/customers/CustomersIndex.vue';

const routes = [
    { path: '/', component: Home, name: 'Home' },
    // Products
    { path: '/products', component: ProductsIndex, name: 'products.index' },
    { path: '/products/create', component: ProductCreate, name: 'products.create' },
    { path: '/products/show/:slug', component: ProductShow, name: 'products.show' },
    { path: '/products/edit/:slug', component: ProductEdit, name: 'products.edit' },
    // Categories
    { path: '/categories', component: CategoriesIndex, name: 'categories.index' },
    // Orders
    { path: '/orders', component: OrderIndex, name: 'orders.index' },
    // Users
    { path: '/customers', component: CustomersIndex, name: 'customers.index' },
];

const router = createRouter({
    history: createWebHashHistory(),
    routes,
});

export default router;