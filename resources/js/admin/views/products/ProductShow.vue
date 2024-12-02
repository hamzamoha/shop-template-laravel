<template>
    <div v-if="product" class="bg-white p-5 rounded">
        <div class="mb-5 flex items-center">
            <router-link class="underline group" :to="{ name: 'products.index' }"><i class="fa-solid fa-angles-left pl-3 group-hover:pr-3 group-hover:pl-0 transition-all"></i> Back</router-link>
            <router-link class="ml-auto bg-green-600 text-white py-2 px-4 rounded transition-all hover:bg-green-500" :to="{ name: 'products.edit', params: { slug: product.slug } }">Edit</router-link>
        </div>
        <div class="flex gap-5">
            <div>
                <img :src="product.image_url" :alt="product.name" class="w-64 h-64 object-contain">
            </div>
            <div>
                <h1 class="font-bold text-3xl mb-3">{{ product.name }}</h1>
                <p class="text-lg mb-3">{{ product.description }}</p>
                <div class="text-lg mb-3">Price: ${{ product.price }}</div>
                <div class="text-lg">Quantity: {{ product.stock }}</div>
                <div>
                    <router-link to="/">{{ product.category.parent.name }} <i class="fa-solid fa-angles-right"></i> {{ product.category.name }}</router-link>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            product: null
        }
    },
    methods: {
        loadProduct() { },
    },
    beforeMount() {
        fetch("/api/products/" + this.$route.params.slug, {
            headers: {
                Accept: "application/json"
            }
        }).then(res => res.json()).then(data => this.product = data);
    },
}
</script>