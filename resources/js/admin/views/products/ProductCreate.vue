<template>
    <div class="p-5 bg-white rounded">
        <div class="mb-5 flex items-center">
            <router-link class="underline group" :to="{ name: 'products.index' }"><i class="fa-solid fa-angles-left pl-3 group-hover:pr-3 group-hover:pl-0 transition-all"></i>Back</router-link>
        </div>
        <h1 class="font-bold text-3xl mb-3">Create Product</h1>
        <div v-if="response.message" class="mb-5 text-center">
            <div :class="(response.message.success ? 'text-green-500' : 'text-red-500') + ' text-lg'">{{ response.message.message }}</div>
            <div v-if="response.message.success">Redirecting...</div>
            <div v-else-if="response.status == 422" v-for="(error, index) in response.message.errors" :key="index" class="text-red-500">{{ error[0] }}</div>
            <div v-else-if="response.status == 500" class="text-red-500">{{ response.message.error }}</div>
        </div>
        <div>
            <ProductForm @xsubmit="xsubmit" />
        </div>
    </div>
</template>

<script>
import ProductForm from './ProductForm.vue';

export default {
    data() {
        return {
            response: {
                message: null,
                status: null
            }
        }
    },
    methods: {
        xsubmit(data) {
            const formData = new FormData();
            for (const key in data) if (data[key]) formData.append(key, data[key]);
            if (data.image) formData.append("image", data.image);
            fetch("/api/products/", {
                body: formData,
                method: 'POST',
                headers: {
                    Accept: "application/json",
                    "X-CSRF-Token": document.head.querySelector('meta[name="csrf-token"]').content,
                }
            }).then(r => {
                this.response.status = r.status;
                return r.json()
            }).then(d => {
                this.response.message = { ...d, data: undefined }
                d.data ? this.product = d.data : null
            })
                .then(() => this.response.status == 201 ? setTimeout(() => this.$router.push({ name: "products.show", params: { slug: this.product.slug } }), 2000) : null)
                .catch(e => console.error(e));
        },
    },
    components: { ProductForm }
}
</script>