<template>
    <div>
        <div class="flex items-center mb-3">
            <h2 class="text-2xl font-bold mb-4">Inventory</h2>
        </div>
        <form @submit.prevent="loadInventory" class="flex items-center justify-center gap-2 mb-3">
            <div class="flex gap-1 items-center">
                <label for="sku">SKU</label>
                <input type="text" name="sku" id="sku" class="h-8 border-0 rounded bg-gray-200 focus:bg-gray-50 focus:ring-0 text-sm py-0" v-model="sku">
            </div>
            <div class="flex gap-1 items-center">
                <label for="name">Product Name</label>
                <input type="text" name="name" id="name" class="h-8 border-0 rounded bg-gray-200 focus:bg-gray-50 focus:ring-0 text-sm py-0" v-model="name">
            </div>
            <div class="flex gap-1 items-center">
                <label for="status">Status</label>
                <select name="status" id="status" class="h-8 border-0 rounded bg-gray-200 focus:bg-gray-50 focus:ring-0 text-sm py-0" v-model="status">
                    <option value="">All</option>
                    <option value="low">Low Stock</option>
                    <option value="in">In Stock</option>
                    <option value="out">Out of Stock</option>
                </select>
            </div>
            <div>
                <button type="submit" class="py-1 px-4 rounded bg-cyan-600 transition-all hover:bg-cyan-700 text-white">Search</button>
            </div>
        </form>
        <div v-if="inventory">
            <table class="w-full rounded overflow-hidden text-sm text-left bg-white">
                <thead>
                    <tr class="bg-gray-300">
                        <th class="py-1 px-2 border">Product</th>
                        <th class="py-1 px-2 border">SKU</th>
                        <th class="py-1 px-2 border">Category</th>
                        <th class="py-1 px-2 border">Stock Level</th>
                        <th class="py-1 px-2 border">Stock Status</th>
                        <th class="py-1 px-2 border">Price</th>
                        <th class="py-1 px-2 border">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="(item, index) in inventory.data" :key="index" class="border-b hover:bg-gray-200">
                        <td class="py-1 px-2 border">{{ item.name }}</td>
                        <td class="py-1 px-2 border">{{ item.sku }}</td>
                        <td class="py-1 px-2 border">{{ item.category?.parent.name }} <i class="fa-solid fa-angles-right"></i> {{ item.category?.name }}</td>
                        <td class="py-1 px-2 border">{{ item.stock }}</td>
                        <td class="py-1 px-2 border">
                            <div class="flex items-center justify-center">
                                <div class="py-0.5 px-1.5 rounded-full text-xs text-white bg-green-600" v-if="item.stock > 5">In Stock</div>
                                <div class="py-0.5 px-1.5 rounded-full text-xs text-white bg-orange-500" v-else-if="item.stock > 0">Low Stock</div>
                                <div class="py-0.5 px-1.5 rounded-full text-xs text-white bg-red-600" v-else>Out of Stock</div>
                            </div>
                        </td>
                        <td class="py-1 px-2 border">${{ item.price }}</td>
                        <td class="py-1 px-2 border">
                            <div class="flex gap-1 items-center justify-center">
                                <button class="py-0.5 px-1 rounded bg-gray-300 transition-all hover:bg-gray-400" @click="inventoryItem = { ...item }">Adjust Stock</button>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="flex justify-center items-center gap-1 py-3 mb-5" v-if="inventory.last_page > 1">
                <template v-for="i in (pagination.end - pagination.start + 1)" :key="i">
                    <span v-if="(pagination.start + i - 1) == inventory.current_page" class="px-2 py-1 rounded bg-gray-200 text-black">{{ pagination.start + i - 1 }}</span>
                    <button v-else @click="loadInventory(pagination.start + i - 1)" class="px-2 py-1 rounded bg-cyan-600 text-white" href="#">{{ pagination.start + i - 1 }}</button>
                </template>
            </div>
        </div>
        <div v-if="inventoryItem" class="absolute top-0 left-0 w-screen h-screen flex justify-center items-center">
            <div class="bg-white p-5 rounded border shadow-xl">
                <form @submit.prevent="xsubmit">
                    <div class="mb-5">
                        <h2 class="text-2xl font-bold text-cyan-600">{{ inventoryItem.sku }}</h2>
                        <span class="block text-sm text-gray-500 font-medium">{{ (new Date(inventoryItem.updated_at)).toLocaleDateString("en-US", { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' }) }}</span>
                    </div>
                        <div class="mb-5">
                            <label for="stock" class="block text-sm font-medium text-gray-700">Stock</label>
                            <input type="number" min="0" name="stock" id="stock" class="w-full p-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-cyan-600" v-model="inventoryItem.stock">
                        </div>
                    <button type="submit" class="w-full bg-cyan-600 py-2 px-4 rounded hover:bg-cyan-700 transition duration-200 text-white mb-4">Update Discount</button>
                    <button type="button" class="w-full bg-gray-300 text-black py-2 px-4 rounded hover:bg-gray-200 transition duration-200" @click="inventoryItem = null">Cancel</button>
                </form>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props: ['inventory'],
    watch: {
        inventory: {
            immediate: true,
            handler(inventory) {
                if (inventory && inventory.current_page) {
                    this.pagination = {
                        start: Math.max(1, Math.min(Math.max(1, inventory.current_page - 2) + 4, inventory.last_page) - 4),
                        end: Math.min(Math.max(1, inventory.current_page - 2) + 4, inventory.last_page)
                    }
                }
            }
        },
    },
    data() {
        return {
            pagination: {
                start: 1,
                end: 0
            },
            sku: '',
            name: '',
            status: '',
            inventoryItem: null,
        }
    },
    methods: {
        loadInventory(page = 1) {
            this.$emit('load-inventory', page, this.sku, this.name, this.status)
        },
        xsubmit() {
            fetch("/api/inventory/" + this.inventoryItem.id, {
                body: JSON.stringify({
                    _method: 'PUT',
                    stock: this.inventoryItem.stock
                }),
                method: 'POST',
                headers: {
                    Accept: "application/json",
                    "Content-Type": "application/json",
                    "X-CSRF-Token": document.head.querySelector('meta[name="csrf-token"]').content,
                }
            }).then(r => r.json()).then(d => this.$emit("update-inventory", this.inventoryItem)).then(z => this.inventoryItem = null).catch(e => console.error(e));
        },
    },
}
</script>