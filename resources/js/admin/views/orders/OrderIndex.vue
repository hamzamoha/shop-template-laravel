<template>
    <div>
        <div class="flex items-center mb-3">
            <h2 class="text-2xl font-bold mb-4">Orders ({{ orders?.total }})</h2>
        </div>
        <div v-if="r.b" class="mb-5 text-center">
            <div :class="(r.b.success ? 'text-green-500' : 'text-red-500') + ' text-lg'">{{ r.b.message }}</div>
            <div v-if="r.status == 200">Reloading...</div>
            <div v-else-if="r.status == 500" class="text-red-500">{{ r.b.error }}</div>
        </div>
        <div v-if="orders">
            <table class="w-full bg-white">
                <thead>
                    <tr class="border-b text-left">
                        <th class="py-2 px-3 w-1">ID</th>
                        <th class="py-2 px-3">Order Number</th>
                        <th class="py-2 px-3">Status</th>
                        <th class="py-2 px-3">Total Amount</th>
                        <th class="py-2 px-3">Shipping Cost</th>
                        <th class="py-2 px-3">Shipping Method</th>
                        <th class="py-2 px-3">Payment Method</th>
                        <th class="py-2 px-3">Items Count</th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="border-b cursor-pointer hover:bg-gray-100 select-none" @click="showOrder(order)" v-for="(order, index) in orders?.data" :key="index">
                        <td class="py-2 px-3 font-bold">{{ order.id }}</td>
                        <td class="py-2 px-3">{{ order.order_number }}</td>
                        <td class="py-1 px-3">{{ order.status }}</td>
                        <td class="py-2 px-3">${{ order.total_amount }}</td>
                        <td class="py-2 px-3">{{ order.shipping_cost }}</td>
                        <td class="py-2 px-3">{{ order.shipping_method }}</td>
                        <td class="py-2 px-3">{{ order.payment_method }}</td>
                        <td class="py-2 px-3">{{ order.items.length }}</td>
                    </tr>
                </tbody>
            </table>
            <div class="flex justify-center items-center gap-1 py-3 mb-5">
                <template v-for="i in (pagination.end - pagination.start + 1)" :key="i">
                    <span v-if="(pagination.start + i - 1) == orders.current_page" class="px-2 py-1 rounded bg-gray-200 text-black">{{ pagination.start + i - 1 }}</span>
                    <button v-else @click="$emit('load-orders', pagination.start + i - 1)" class="px-2 py-1 rounded bg-cyan-600 text-white" href="#">{{ pagination.start + i - 1 }}</button>
                </template>
            </div>
        </div>
        <div v-if="order" class="absolute top-0 left-0 w-screen h-screen flex justify-center items-center">
            <div class="bg-white p-5 rounded border shadow-xl">
                <div class="mb-5">
                    <h2 class="text-xl font-bold">{{ order.order_number }}</h2>
                    <span class="block text-sm text-gray-500 font-medium">{{ ((d)=>(d.toLocaleDateString("en-US", {weekday: 'long', year: 'numeric', month: 'long', day: 'numeric'})))(new Date(order.created_at)) }}</span>
                </div>
                <div class="grid grid-cols-2 gap-5 mb-5">
                    <div>
                        <h3 class="text-lg font-bold mb-1">Customer</h3>
                        <div>Name: {{ order.user.name }}</div>
                        <div>Email: {{ order.user.email }}</div>
                    </div>
                    <div>
                        <h3 class="text-lg font-bold mb-1">Order Info</h3>
                        <div>Shipping Method: {{ order.shipping_method }}</div>
                        <div>Payment Method: {{ order.payment_method }}</div>
                        <div>Status: {{ order.status }}</div>
                    </div>
                    <div>
                        <h3 class="text-lg font-bold mb-1">Shipping Address</h3>
                        <div>{{ order.shipping_address.country + ", " + order.shipping_address.state }}</div>
                        <div>{{ order.shipping_address.city + ", " + order.shipping_address.postal_code }}</div>
                        <div>{{ order.shipping_address.address_line_1 + (order.shipping_address.address_line_2 ? ", " + order.shipping_address.address_line_2 : '') }}</div>
                    </div>
                    <div>
                        <h3 class="text-lg font-bold mb-1">Billing Address</h3>
                        <div>{{ order.billing_address.country + ", " + order.billing_address.state }}</div>
                        <div>{{ order.billing_address.city + ", " + order.billing_address.postal_code }}</div>
                        <div>{{ order.billing_address.address_line_1 + (order.billing_address.address_line_2 ? ", " + order.billing_address.address_line_2 : '') }}</div>
                    </div>
                </div>
                <table class="text-left border mb-5">
                    <thead>
                        <tr class="bg-slate-100">
                            <th class="py-2 px-4">Name</th>
                            <th class="py-2 px-4">Price</th>
                            <th class="py-2 px-4">Quantity</th>
                            <th class="py-2 px-4">Sub Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="(item, index) in order.items" :key="index">
                            <td class="py-2 px-4"><img :src="item.product.image_url" alt="" class="w-8 h-8 inline mr-2">{{ item.product.name }}</td>
                            <td class="py-2 px-4">${{ item.price }}</td>
                            <td class="py-2 px-4">{{ item.quantity }}</td>
                            <td class="py-2 px-4">${{ item.subtotal }}</td>
                        </tr>
                    </tbody>
                    <tfoot>
                        <tr class="bg-slate-100">
                            <th colspan="3" class="text-right py-2 px-4">Total</th>
                            <th class="py-2 px-4">${{ order.total_amount }}</th>
                        </tr>
                    </tfoot>
                </table>
                <div class="flex items-center justify-center">
                    <button @click="showOrder(null)" class="py-2 px-4 rounded text-white bg-cyan-600 hover:bg-cyan-500 transition-all">Close</button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props: {
        orders: {
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
            r: {
                status: null,
                b: null
            },
            order: null
        }
    },
    watch: {
        orders: {
            immediate: true,
            handler(orders) {
                if (orders && orders.current_page) {
                    this.pagination = {
                        start: Math.max(1, Math.min(Math.max(1, orders.current_page - 2) + 4, orders.last_page) - 4),
                        end: Math.min(Math.max(1, orders.current_page - 2) + 4, orders.last_page)
                    }
                }
            }
        },
    },
    methods: {
        showOrder(order) {
            this.order = order
        }
    },
}
</script>