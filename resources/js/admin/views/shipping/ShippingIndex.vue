<template>
    <div>
        <div class="flex items-center mb-3">
            <h2 class="text-2xl font-bold mb-4">Shipping</h2>
            <button @click="create = {}" class="block py-2 px-4 rounded bg-orange-600 transition-all hover:bg-orange-500 text-white ml-auto">Add</button>
        </div>
        <table class="w-full bg-white text-left rounded overflow-hidden">
            <thead class="bg-cyan-600/30">
                <tr>
                    <th class="py-2 px-4">Method</th>
                    <th class="py-2 px-4">Cost</th>
                    <th class="py-2 px-4">Region</th>
                    <th class="py-2 px-4">Action</th>
                </tr>
            </thead>
            <tbody class="">
                <tr class="even:bg-cyan-600/30" v-for="(item, index) in shipping?.methods" :key="index">
                    <td class="py-2 px-4">{{ item.method }}</td>
                    <td class="py-2 px-4">${{ item.cost }}</td>
                    <td class="py-2 px-4"><template v-if="shipping.regions.filter(e => e.id == item.region_id).length > 0">{{ shipping.regions.filter(e => e.id == item.region_id)[0].name }}</template><i v-else class='text-gray-500'>all</i></td>
                    <td class="py-2 px-4"><button @click="edit = { ...item, region_id: shipping.regions.filter(e => e.id == item.region_id).length > 0 ? item.region_id : '-1' }" class="py-1 px-3 rounded bg-cyan-600 text-white text-sm hover:bg-cyan-700 transition-all">Edit</button></td>
                </tr>
            </tbody>
        </table>
        <div v-if="create" class="absolute top-0 left-0 w-screen h-screen flex justify-center items-center p-5">
            <div class="bg-white p-6 rounded-lg shadow-md max-h-full max-w-full overflow-auto">
                <h2 class="text-2xl font-bold text-cyan-600 mb-4">Craete Shipping Method</h2>
                <form @submit.prevent="xsubmit">
                    <div class="mb-5">
                        <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
                        <input type="text" name="name" id="name" class="w-full p-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-cyan-600" required aria-required="true" v-model="create.name">
                    </div>
                    <div class="mb-5">
                        <label for="cost" class="block text-sm font-medium text-gray-700">Cost</label>
                        <input type="number" min="0" step="0.01" name="cost" id="cost" class="w-full p-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-cyan-600" required aria-required="true" v-model="create.cost">
                    </div>
                    <div class="mb-5">
                        <label for="region" class="block text-sm font-medium text-gray-700">Region</label>
                        <select name="region" id="region" class="w-full p-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-cyan-600" v-model="create.region">
                            <option value="-1">All</option>
                            <option v-for="(item, index) in shipping.regions" :key="index" :value="item.id">{{ item.name }}</option>
                        </select>
                    </div>
                    <button type="submit" class="w-full bg-cyan-600 py-2 px-4 rounded hover:bg-cyan-700 transition duration-200 text-white mb-4">Save</button>
                    <button type="button" class="w-full bg-gray-300 text-black py-2 px-4 rounded hover:bg-gray-200 transition duration-200" @click="create = false">Cancel</button>
                </form>
            </div>
        </div>
        <div v-if="edit" class="absolute top-0 left-0 w-screen h-screen flex justify-center items-center p-5">
            <div class="bg-white p-6 rounded-lg shadow-md max-h-full max-w-full overflow-auto">
                <h2 class="text-2xl font-bold text-cyan-600 mb-4">Craete Shipping Method</h2>
                <form @submit.prevent="xsubmit2">
                    <div class="mb-5">
                        <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
                        <input type="text" name="name" id="name" class="w-full p-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-cyan-600" required aria-required="true" v-model="edit.method">
                    </div>
                    <div class="mb-5">
                        <label for="cost" class="block text-sm font-medium text-gray-700">Cost</label>
                        <input type="number" min="0" step="0.01" name="cost" id="cost" class="w-full p-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-cyan-600" required aria-required="true" v-model="edit.cost">
                    </div>
                    <div class="mb-5">
                        <label for="region" class="block text-sm font-medium text-gray-700">Region</label>
                        <select name="region" id="region" class="w-full p-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-cyan-600" v-model="edit.region_id">
                            <option value="-1">All</option>
                            <option v-for="(item, index) in shipping.regions" :key="index" :value="item.id">{{ item.name }}</option>
                        </select>
                    </div>
                    <button type="submit" class="w-full bg-cyan-600 py-2 px-4 rounded hover:bg-cyan-700 transition duration-200 text-white mb-4">Save</button>
                    <button type="button" class="w-full bg-gray-300 text-black py-2 px-4 rounded hover:bg-gray-200 transition duration-200" @click="edit = false">Cancel</button>
                </form>
            </div>
        </div>
    </div>
</template>
<script>

export default {
    props: ['shipping'],
    data() {
        return {
            create: null,
            edit: null,
        }
    },
    methods: {
        xsubmit() {
            fetch("/api/shipping", {
                method: "POST",
                headers: {
                    Accept: "application/json",
                    "Content-Type": "application/json",
                    "X-CSRF-Token": document.head.querySelector('meta[name="csrf-token"]').content,
                },
                body: JSON.stringify(this.create),
            }).then(r => r.json()).then(d => {
                if (d.success) {
                    this.$emit('add-shipping', d.data)
                    this.create = null
                }
            })
        },
        xsubmit2() {
            fetch("/api/shipping/" + this.edit.id, {
                method: "POST",
                headers: {
                    Accept: "application/json",
                    "Content-Type": "application/json",
                    "X-CSRF-Token": document.head.querySelector('meta[name="csrf-token"]').content,
                },
                body: JSON.stringify({...this.edit, _method: 'PUT'}),
            }).then(r => r.json()).then(d => {
                if (d.success) {
                    this.$emit('update-shipping', d.data)
                    this.edit = null
                }
            })
        }
    },
}
</script>