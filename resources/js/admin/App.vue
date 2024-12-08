<template>
    <div class="flex flex-col h-screen">
        <Header @toggle-sidebar="toggleSidebar" />
        <div class="flex flex-1 overflow-hidden">
            <Sidebar :sidebar="sidebar" />
            <main class="flex-1 p-6 overflow-auto bg-gray-100">
                <router-view v-if="$route.name === 'orders.index'" :orders @load-orders="loadOrders" />
                <router-view v-else-if="$route.name === 'categories.index'" :categories />
                <router-view v-else-if="$route.name?.startsWith('products.')" :products @load-products="loadProducts" />
                <router-view v-else-if="$route.name === 'customers.index'" :customers @load-customers="loadCustomers" />
                <router-view v-else-if="$route.name === 'discounts.index'" :discounts @add-discount="AddDiscount" @update-discounts="updateDiscounts" @delete-discount="deleteDiscount" />
                <router-view v-else-if="$route.name === 'inventory.index'" :inventory @load-inventory="loadInventory" @update-inventory="updateInventory" />
                <router-view v-else-if="$route.name === 'shipping.index'" :shipping @add-shipping="addShipping" @update-shipping="updateShipping" />
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
            discounts: null,
            inventory: null,
            shipping: null,
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
            }).then(res => res.json()).then(data => this.customers = data);
        },
        loadDiscounts() {
            fetch("/api/discounts", {
                headers: {
                    Accept: "application/json"
                }
            }).then(res => res.json()).then(data => this.discounts = data);
        },
        AddDiscount(discount) {
            this.discounts = [discount, ...this.discounts]
        },
        updateDiscounts(discount) {
            this.discounts = this.discounts.map(element => element.id == discount.id ? discount : element)
        },
        deleteDiscount(discount_id) {
            this.discounts = this.discounts.filter(discount => discount.id != discount_id)
        },
        loadInventory(page = 1, sku = '', name = '', status = '') {
            fetch(`/api/inventory?page=${page}&name=${encodeURIComponent(name)}&status=${status}&sku=${encodeURIComponent(sku)}`, {
                headers: {
                    Accept: "application/json"
                },
            }).then(a => a.json()).then(p => this.inventory = p)
        },
        updateInventory(item) {
            this.inventory.data = this.inventory.data.map(k => k.id == item.id ? item : k)
        },
        loadShipping() {
            fetch("/api/shipping", {
                headers: {
                    Accept: 'application/json'
                }
            }).then(n => n.json()).then(c => this.shipping = c);
        },
        addShipping(s) {
            this.shipping.methods = [s, ...this.shipping.methods]
        },
        updateShipping(y) {
            this.shipping.methods = this.shipping.methods.map(f => f.id == y.id ? y : f)
        }
    },
    beforeMount() {
        this.loadProducts();
        this.loadCategories();
        this.loadOrders();
        this.loadCustomers();
        this.loadDiscounts();
        this.loadInventory();
        this.loadShipping();
    },
};
</script>