<template>
    <div>
        <div class="flex items-center mb-3">
            <h2 class="text-2xl font-bold mb-4">customers ({{ customers?.total }})</h2>
        </div>
        <div v-if="customers">
            <table class="w-full bg-white">
                <thead>
                    <tr class="border-b text-left">
                        <th class="py-2 px-3 w-1">ID</th>
                        <th class="py-2 px-3">Name</th>
                        <th class="py-2 px-3">Email</th>
                        <th class="py-2 px-3">Orders Count</th>
                        <th class="py-2 px-3">Cart Items Count</th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="border-b cursor-pointer hover:bg-gray-100 select-none" @click="showCustomer(customer)" v-for="(customer, index) in customers.data" :key="index">
                        <td class="py-2 px-3 font-bold">{{ customer.id }}</td>
                        <td class="py-2 px-3">{{ customer.name }}</td>
                        <td class="py-1 px-3">{{ customer.email }}</td>
                        <td class="py-1 px-3">{{ customer.orders_count }}</td>
                        <td class="py-1 px-3">{{ customer.cart_count }}</td>
                    </tr>
                </tbody>
            </table>
            <div class="flex justify-center items-center gap-1 py-3 mb-5">
                <template v-for="i in (pagination.end - pagination.start + 1)" :key="i">
                    <span v-if="(pagination.start + i - 1) == customers.current_page" class="px-2 py-1 rounded bg-gray-200 text-black">{{ pagination.start + i - 1 }}</span>
                    <button v-else @click="$emit('load-customers', pagination.start + i - 1)" class="px-2 py-1 rounded bg-cyan-600 text-white" href="#">{{ pagination.start + i - 1 }}</button>
                </template>
            </div>
        </div>
        <div v-if="customer" class="absolute top-0 left-0 w-screen h-screen flex justify-center items-center p-5">
            <div class="bg-white p-5 rounded border shadow-xl max-h-full max-w-full overflow-auto">
                <div class="mb-5">
                    <h2 class="text-xl font-bold">{{ customer.name }}</h2>
                    <span class="block text-sm text-gray-500 font-medium">{{ customer.email }}</span>
                </div>
                <div class="mb-3"  v-if="customer.orders">
                    <h2 class="font-medium mb-2 text-lg">Orders</h2>
                    <table v-if="customer.orders.length > 0" class="text-left border text-sm w-full">
                        <thead>
                            <tr class="bg-slate-100">
                                <th class="py-1 px-3">Order Number</th>
                                <th class="py-1 px-3">Total Amount</th>
                                <th class="py-1 px-3">Status</th>
                                <th class="py-1 px-3">Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="(order, index) in customer.orders" :key="index">
                                <td class="py-1 px-3 border">{{ order.order_number }}</td>
                                <td class="py-1 px-3 border">${{ order.total_amount }}</td>
                                <td class="py-1 px-3 border">{{ order.status }}</td>
                                <td class="py-1 px-3 border">{{ (new Date(order.created_at)).toLocaleDateString("en-US", { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' }) }}</td>
                            </tr>
                        </tbody>
                    </table>
                    <div v-else class="text-center text-gray-500 font-bold">No Orders Yet !</div>
                </div>
                <div class="mb-3" v-if="customer.cart">
                    <h2 class="font-medium mb-2 text-lg">Cart</h2>
                    <table v-if="customer.cart.length > 0" class="text-left border text-sm w-full">
                        <thead>
                            <tr class="bg-slate-100">
                                <th class="py-1 px-3 w-1">#</th>
                                <th class="py-1 px-3">Name</th>
                                <th class="py-1 px-3">Price</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="(item, index) in customer.cart" :key="index">
                                <td class="py-1 px-3 border">{{ index }}</td>
                                <td class="py-1 px-3 border"><img :src="item.product.image_url" alt="" class="w-8 h-8 inline mr-2">{{ item.product.name }}</td>
                                <td class="py-1 px-3 border">${{ item.product.price }}</td>
                            </tr>
                        </tbody>
                    </table>
                    <div v-else class="text-center text-gray-500 font-bold">Cart is Empty !</div>
                </div>
                <div class="mb-3" v-if="customer.wishlist">
                    <h2 class="font-medium mb-2 text-lg">Wishlist</h2>
                    <table v-if="customer.wishlist.length > 0" class="text-left border text-sm w-full">
                        <thead>
                            <tr class="bg-slate-100">
                                <th class="py-1 px-3 w-1">#</th>
                                <th class="py-1 px-3">Name</th>
                                <th class="py-1 px-3">Price</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="(item, index) in customer.wishlist" :key="index">
                                <td class="py-1 px-3 border">{{ index }}</td>
                                <td class="py-1 px-3 border"><img :src="item.product.image_url" alt="" class="w-8 h-8 inline mr-2">{{ item.product.name }}</td>
                                <td class="py-1 px-3 border">${{ item.product.price }}</td>
                            </tr>
                        </tbody>
                    </table>
                    <div v-else class="text-center text-gray-500 font-bold">Wishlist Empty !</div>
                </div>
                <div class="flex items-center justify-center">
                    <button @click="showCustomer(null)" class="py-2 px-4 rounded text-white bg-cyan-600 hover:bg-cyan-500 transition-all">Close</button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props: {
        customers: {
            type: Object,
            required: true,
            default: () => ({})
        }
    },
    data() {
        return {
            pagination: {
                start: 1,
                end: 0
            },
            customer: null
        }
    },
    watch: {
        customers: {
            immediate: true,
            handler(customers) {
                if (customers && customers.current_page) {
                    this.pagination = {
                        start: Math.max(1, Math.min(Math.max(1, customers.current_page - 2) + 4, customers.last_page) - 4),
                        end: Math.min(Math.max(1, customers.current_page - 2) + 4, customers.last_page)
                    }
                }
            }
        },
    },
    methods: {
        showCustomer(customer) {
            this.customer = customer
            if (customer) fetch("/api/users/" + customer.id, { headers: { Accept: "application/json" } }).then(r => r.json()).then(d => this.customer = d).catch(e => console.error(e));
        }
    },
}
</script>