<template>
    <div>
        <div class="flex items-center mb-3">
            <h2 class="text-2xl font-bold mb-4">Products ({{ products?.total }})</h2>
            <router-link :to="{ name: 'products.create' }" class="block py-2 px-4 rounded bg-orange-600 transition-all hover:bg-orange-500 text-white ml-auto">Add</router-link>
        </div>
        <div v-if="r.b" class="mb-5 text-center">
            <div :class="(r.b.success ? 'text-green-500' : 'text-red-500') + ' text-lg'">{{ r.b.message }}</div>
            <div v-if="r.status == 200">Reloading...</div>
            <div v-else-if="r.status == 500" class="text-red-500">{{ r.b.error }}</div>
        </div>
        <div v-if="products">
            <table class="w-full bg-white">
                <thead>
                    <tr class="border-b text-left">
                        <th class="py-2 px-3 w-1">ID</th>
                        <th class="py-2 px-3">Name</th>
                        <th class="py-2 px-3">Image</th>
                        <th class="py-2 px-3">Price</th>
                        <th class="py-2 px-3">Stock</th>
                        <th class="py-2 px-3">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="border-b" v-for="(product, index) in products?.data" :key="index">
                        <td class="py-2 px-3 font-bold">{{ product.id }}</td>
                        <td class="py-2 px-3">{{ product.name }}</td>
                        <td class="py-1 px-3"><img :src="product.image_url" :alt="product.name" class="w-16 h-16 object-contain"></td>
                        <td class="py-2 px-3">${{ product.price }}</td>
                        <td class="py-2 px-3">{{ product.stock }}</td>
                        <td class="py-2 px-3">
                            <div class="flex items-center gap-0.5">
                                <router-link :to="{ name: 'products.show', params: { slug: product.slug } }" class="block py-0.5 px-1 text-xs font-bold bg-sky-500 rounded hover:bg-sky-400 transition-all">Show</router-link>
                                <router-link :to="{ name: 'products.edit', params: { slug: product.slug } }" class="block py-0.5 px-1 text-xs font-bold bg-emerald-500 rounded hover:bg-emerald-400 transition-all">Edit</router-link>
                                <button @click="deleteProduct(product)" class="block py-0.5 px-1 text-xs font-bold bg-red-500 rounded hover:bg-red-400 transition-all">Delete</button>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="flex justify-center items-center gap-1 py-3 mb-5">
                <template v-for="i in (pagination.end - pagination.start + 1)" :key="i">
                    <span v-if="(pagination.start + i - 1) == products.current_page" class="px-2 py-1 rounded bg-gray-200 text-black">{{ pagination.start + i - 1 }}</span>
                    <button v-else @click="$emit('load-products', pagination.start + i - 1)" class="px-2 py-1 rounded bg-cyan-600 text-white" href="#">{{ pagination.start + i - 1 }}</button>
                </template>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props: {
        products: {
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
        }
    },
    watch: {
        products: {
            immediate: true,
            handler(products) {
                if (products && products.current_page) {
                    this.pagination = {
                        start: Math.max(1, Math.min(Math.max(1, products.current_page - 2) + 4, products.last_page) - 4),
                        end: Math.min(Math.max(1, products.current_page - 2) + 4, products.last_page)
                    }
                }
            }
        },
    },
    methods: {
        deleteProduct(product) {
            fetch("/api/products/" + product.slug, {
                body: JSON.stringify({
                    _method: 'DELETE',
                }),
                method: 'POST',
                headers: {
                    Accept: "application/json",
                    "Content-Type": "application/json",
                    "X-CSRF-Token": document.head.querySelector('meta[name="csrf-token"]').content,
                }
            }).then(r => {
                this.r.status = r.status
                return r.json()
            }).then(b => {
                document.querySelector("main").scrollTo(0,0)
                this.r.b = b
                this.$emit('load-products')
                setTimeout(() => this.r = {b: null, status: null}, 1000);
            }).catch(e => console.log(e));
        }
    },
}
</script>