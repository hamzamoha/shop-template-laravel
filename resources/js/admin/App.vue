<template>
    <div class="flex flex-col h-screen">
        <Header @toggle-sidebar="toggleSidebar" />
        <div class="flex flex-1 overflow-hidden">
            <Sidebar :sidebar="sidebar" />
            <main class="flex-1 p-6 overflow-auto bg-gray-100">
                <router-view v-if="$route.name === 'orders.index'" :orders @load-orders="loadOrders" />
                <router-view v-else-if="$route.name === 'categories.index'" :categories />
                <router-view v-else-if="$route.name === 'products.index'" :products @load-products="loadProducts" />
                <router-view v-else-if="$route.name === 'customers.index'" :customers @load-customers="loadCustomers" />
                <router-view v-else />
            </main>
        </div>
        <Footer />
    </div>
</template>

<script>
import Header from './components/Header.vue';
import Sidebar from './components/Sidebar.vue';
import Footer from './components/Footer.vue';
export default {
    components: {
        Header,
        Sidebar,
        Footer,
    },
    data() {
        return {
            sidebar: false,
            products: null,
            categories: null,
            orders: null,
            customers: null,
        }
    },
    methods: {
        toggleSidebar() {
            this.sidebar = !this.sidebar;
        },
        loadProducts(page = 1) {
            fetch("/api/products?page=" + page, {
                headers: {
                    Accept: "application/json"
                }
            }).then(res => res.json()).then(data => this.products = data);
        },
        loadCategories() {
            fetch("/api/categories", {
                headers: {
                    Accept: "application/json"
                }
            }).then(res => res.json()).then(data => this.categories = data);
        },
        loadOrders() {
            fetch("/api/orders", {
                headers: {
                    Accept: "application/json"
                }
            }).then(res => res.json()).then(data => this.orders = data);
        },
        loadCustomers() {
            fetch("/api/users", {
                headers: {
                    Accept: "application/json"
                }
            }).then(res => res.json()).then(data => this.customers   = data);
        },
    },
    beforeMount() {
        this.loadProducts();
        this.loadCategories();
        this.loadOrders();
        this.loadCustomers();
    },
};
</script>