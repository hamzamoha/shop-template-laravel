<template>
    <div>
        <div class="flex items-center mb-3">
            <h2 class="text-2xl font-bold mb-4">Discounts ({{ discounts?.length }})</h2>
            <button @click="createDiscount" class="block py-2 px-4 rounded bg-orange-600 transition-all hover:bg-orange-500 text-white ml-auto">Add</button>
        </div>
        <div v-if="discounts">
            <table class="w-full bg-white">
                <thead>
                    <tr class="border-b text-left">
                        <th class="py-2 px-3 w-1">ID</th>
                        <th class="py-2 px-3">Name</th>
                        <th class="py-2 px-3">Type</th>
                        <th class="py-2 px-3">Value</th>
                        <th class="py-2 px-3">Code</th>
                        <th class="py-2 px-3">Status</th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="border-b cursor-pointer hover:bg-gray-100 select-none" @click="show_discount = discount" v-for="(discount, index) in discounts" :key="index">
                        <td class="py-2 px-3 font-bold">{{ discount.id }}</td>
                        <td class="py-2 px-3">{{ discount.name }}</td>
                        <td class="py-1 px-3">{{ discount.type }}</td>
                        <td class="py-1 px-3">{{ (discount.type == "percentage" ? "%" : "$") + discount.value }}</td>
                        <td class="py-1 px-3">{{ discount.code }}</td>
                        <td class="py-1 px-3">{{ discount.is_active ? "Active" : "Inactive" }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div v-if="discount" class="absolute top-0 left-0 w-screen h-screen flex justify-center items-center p-5">
            <div class="bg-white p-6 rounded-lg shadow-md max-h-full max-w-full overflow-auto">
                <form @submit.prevent="storeDiscount">
                    <h2 class="text-2xl font-bold text-cyan-600 mb-4">Create Discount</h2>
                    <div v-if="message" class="text-red-500 mb-4 text-center">
                        <div>{{ message }}</div>
                        <div>{{ error }}</div>
                    </div>
                    <div class="grid grid-cols-2 gap-4 mb-4">
                        <div>
                            <label for="name" class="block text-sm font-medium text-gray-700">Discount Name</label>
                            <input type="text" id="name" name="name" v-model="discount.name" placeholder="e.g., Summer Sale" required class="w-full p-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-cyan-600">
                        </div>
                        <div>
                            <label for="type" class="block text-sm font-medium text-gray-700">Discount Type</label>
                            <select id="type" name="type" v-model="discount.type" required class="w-full p-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-cyan-600">
                                <option value="flat">Flat Amount</option>
                                <option value="percentage">Percentage</option>
                            </select>
                        </div>
                        <div>
                            <label for="value" class="block text-sm font-medium text-gray-700">Discount Value</label>
                            <input type="number" id="value" name="value" v-model="discount.value" step="0.01" placeholder="e.g., 20 or 10.50" required class="w-full p-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-cyan-600">
                        </div>
                        <div>
                            <label for="code" class="block text-sm font-medium text-gray-700">Coupon Code (Optional)</label>
                            <input type="text" id="code" name="code" v-model="discount.code" placeholder="e.g., SUMMER20" class="w-full p-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-cyan-600">
                        </div>
                        <div>
                            <label for="starts_at" class="block text-sm font-medium text-gray-700">Start Date</label>
                            <input type="datetime-local" id="starts_at" name="starts_at" v-model="discount.starts_at" class="w-full p-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-cyan-600">
                        </div>
                        <div>
                            <label for="ends_at" class="block text-sm font-medium text-gray-700">End Date</label>
                            <input type="datetime-local" id="ends_at" name="ends_at" v-model="discount.ends_at" class="w-full p-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-cyan-600">
                        </div>
                    </div>
                    <button type="submit" class="w-full bg-cyan-600 py-2 px-4 rounded hover:bg-cyan-700 transition duration-200 text-white mb-2">Create Discount</button>
                    <button type="button" class="w-full bg-gray-300 py-2 px-4 rounded hover:bg-gray-200 transition duration-200" @click="createDiscount(null)">Cancel</button>
                </form>
            </div>
        </div>
        <div v-if="show_discount" class="absolute top-0 left-0 w-screen h-screen flex justify-center items-center p-5">
            <div class="bg-white p-6 rounded-lg shadow-md max-h-full max-w-full overflow-auto">
                <h2 class="text-2xl font-bold text-cyan-600 mb-4">Discount #{{ show_discount.id }}</h2>
                <div class="grid grid-cols-2 gap-4 mb-4">
                    <div>Discount Name: {{ show_discount.name }}</div>
                    <div>Discount Type: {{ show_discount.type }}</div>
                    <div>Discount Value: {{ (show_discount.type == "percentage" ? "%" : "$") + show_discount.value }}</div>
                    <div>Discount Code: {{ show_discount.code ? show_discount.code : "none" }}</div>
                    <div>Starts At: {{ show_discount.starts_at ? (new Date(show_discount.starts_at)).toLocaleString() : 'none' }}</div>
                    <div>Ends At: {{ show_discount.ends_at ? (new Date(show_discount.ends_at)).toLocaleString() : 'none' }}</div>
                </div>
                <div class="grid grid-cols-4 gap-4 mb-2">
                    <button type="button" class="w-full bg-cyan-600 py-2 px-4 rounded hover:bg-cyan-700 transition duration-200 text-white col-span-3" @click="editDiscount">Edit</button>
                    <button type="button" class="w-full bg-red-600 py-2 px-4 rounded hover:bg-red-700 transition duration-200 text-white" @click="deleteDiscount">Delete</button>
                </div>
                <button type="button" class="w-full bg-gray-300 py-2 px-4 rounded hover:bg-gray-200 transition duration-200" @click="show_discount = null">Close</button>
            </div>
        </div>
        <div v-if="edit_discount" class="absolute top-0 left-0 w-screen h-screen flex justify-center items-center p-5">
            <div class="bg-white p-6 rounded-lg shadow-md max-h-full max-w-full overflow-auto">
                <form @submit.prevent="updateDiscount">
                    <h2 class="text-2xl font-bold text-cyan-600 mb-4">Edit Discount #{{ edit_discount.id }}</h2>
                    <div v-if="message" class="text-red-500 mb-4 text-center">
                        <div>{{ message }}</div>
                        <div>{{ error }}</div>
                    </div>
                    <div class="grid grid-cols-2 gap-4 mb-4">
                        <div>
                            <label for="name" class="block text-sm font-medium text-gray-700">Discount Name</label>
                            <input type="text" id="name" name="name" v-model="edit_discount.name" placeholder="e.g., Summer Sale" required class="w-full p-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-cyan-600">
                        </div>
                        <div>
                            <label for="type" class="block text-sm font-medium text-gray-700">Discount Type</label>
                            <select id="type" name="type" v-model="edit_discount.type" required class="w-full p-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-cyan-600">
                                <option value="flat">Flat Amount</option>
                                <option value="percentage">Percentage</option>
                            </select>
                        </div>
                        <div>
                            <label for="value" class="block text-sm font-medium text-gray-700">Discount Value</label>
                            <input type="number" id="value" name="value" v-model="edit_discount.value" step="0.01" placeholder="e.g., 20 or 10.50" required class="w-full p-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-cyan-600">
                        </div>
                        <div>
                            <label for="code" class="block text-sm font-medium text-gray-700">Coupon Code (Optional)</label>
                            <input type="text" id="code" name="code" v-model="edit_discount.code" placeholder="e.g., SUMMER20" class="w-full p-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-cyan-600">
                        </div>
                        <div>
                            <label for="starts_at" class="block text-sm font-medium text-gray-700">Start Date</label>
                            <input type="datetime-local" id="starts_at" name="starts_at" v-model="starts_at" class="w-full p-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-cyan-600">
                        </div>
                        <div>
                            <label for="ends_at" class="block text-sm font-medium text-gray-700">End Date</label>
                            <input type="datetime-local" id="ends_at" name="ends_at" v-model="ends_at" class="w-full p-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-cyan-600">
                        </div>
                    </div>
                    <button type="submit" class="w-full bg-cyan-600 py-2 px-4 rounded hover:bg-cyan-700 transition duration-200 text-white mb-4">Update Discount</button>
                    <button type="button" class="w-full bg-gray-300 text-black py-2 px-4 rounded hover:bg-gray-200 transition duration-200" @click="editDiscount(null)">Cancel</button>
                </form>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props: {
        discounts: {
            type: Object,
            required: true,
            default: () => ([])
        }
    },
    data() {
        return {
            discount: null,
            message: null,
            error: null,
            show_discount: null,
            edit_discount: null,
        }
    },
    computed: {
        starts_at: {
            set(v) {
                let d = new Date(v)
                this.edit_discount.starts_at = `${d.getFullYear()}-${(d.getMonth() + 1) < 10 ? '0' : ''}${(d.getMonth() + 1)}-${d.getDate() < 10 ? '0' : ''}${d.getDate()}T${d.getHours() < 10 ? '0' : ''}${d.getHours()}:${d.getMinutes() < 10 ? '0' : ''}${d.getMinutes()}`
            },
            get() {
                let d = this.edit_discount.starts_at ? new Date(this.edit_discount.starts_at) : new Date()
                return `${d.getFullYear()}-${(d.getMonth() + 1) < 10 ? '0' : ''}${(d.getMonth() + 1)}-${d.getDate() < 10 ? '0' : ''}${d.getDate()}T${d.getHours() < 10 ? '0' : ''}${d.getHours()}:${d.getMinutes() < 10 ? '0' : ''}${d.getMinutes()}`
            }
        },
        ends_at: {
            set(v) {
                let d = new Date(v)
                this.edit_discount.ends_at = `${d.getFullYear()}-${(d.getMonth() + 1) < 10 ? '0' : ''}${(d.getMonth() + 1)}-${d.getDate() < 10 ? '0' : ''}${d.getDate()}T${d.getHours() < 10 ? '0' : ''}${d.getHours()}:${d.getMinutes() < 10 ? '0' : ''}${d.getMinutes()}`
            },
            get() {
                let d = this.edit_discount.ends_at ? new Date(this.edit_discount.ends_at) : new Date()
                return  `${d.getFullYear()}-${(d.getMonth() + 1) < 10 ? '0' : ''}${(d.getMonth() + 1)}-${d.getDate() < 10 ? '0' : ''}${d.getDate()}T${d.getHours() < 10 ? '0' : ''}${d.getHours()}:${d.getMinutes() < 10 ? '0' : ''}${d.getMinutes()}`
            }
        }
    },
    methods: {
        createDiscount(b) {
            if (b) {
                this.discount = {}
            } else {
                this.discount = this.message = null
            }

        },
        editDiscount(b) {
            if (b) {
                this.edit_discount = { ...this.show_discount }
                this.show_discount = null
            } else {
                this.edit_discount = this.message = null
            }
        },
        storeDiscount() {
            if (this.discount) {
                fetch("/api/discounts", {
                    method: "POST",
                    headers: {
                        Accept: "application/json",
                        "Content-Type": "application/json",
                        "X-CSRF-Token": document.head.querySelector('meta[name="csrf-token"]').content,
                    },
                    body: JSON.stringify(this.discount),
                }).then(r => r.json()).then(d => {
                    if (d.success) {
                        this.$emit('add-discount', d.data)
                        this.discount = this.message = null
                    }
                    else {
                        this.message = d.message
                        this.error = d.error
                    }
                })
            }
        },
        updateDiscount() {
            if (this.edit_discount) {
                fetch("/api/discounts/" + this.edit_discount.id, {
                    method: "POST",
                    headers: {
                        Accept: "application/json",
                        "Content-Type": "application/json",
                        "X-CSRF-Token": document.head.querySelector('meta[name="csrf-token"]').content,
                    },
                    body: JSON.stringify({ ...this.edit_discount, _method: "PUT" }),
                }).then(r => r.json()).then(d => {
                    if (d.success) {
                        this.$emit('update-discounts', d.data)
                        this.edit_discount = this.message = null
                    }
                    else {
                        this.message = d.message
                        this.error = d.error
                    }
                })
            }
        },
        deleteDiscount() {
            if (this.show_discount) {
                fetch("/api/discounts/" + this.show_discount.id, {
                    method: "POST",
                    headers: {
                        Accept: "application/json",
                        "Content-Type": "application/json",
                        "X-CSRF-Token": document.head.querySelector('meta[name="csrf-token"]').content,
                    },
                    body: JSON.stringify({ _method: "DELETE" }),
                }).then(r => r.json()).then(d => {
                    if (d.success) {
                        this.$emit('delete-discount', this.show_discount.id)
                        this.show_discount = null
                    }
                })
            }
        },
    },
}
</script>