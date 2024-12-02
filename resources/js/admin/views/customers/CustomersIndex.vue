<template>
    <div>
        <div class="flex items-center mb-3">
            <h2 class="text-2xl font-bold mb-4">customers ({{ customers?.total }})</h2>
        </div>
        <div v-if="r.b" class="mb-5 text-center">
            <div :class="(r.b.success ? 'text-green-500' : 'text-red-500') + ' text-lg'">{{ r.b.message }}</div>
            <div v-if="r.status == 200">Reloading...</div>
            <div v-else-if="r.status == 500" class="text-red-500">{{ r.b.error }}</div>
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
            r: {
                status: null,
                b: null
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
        }
    },
}
</script>