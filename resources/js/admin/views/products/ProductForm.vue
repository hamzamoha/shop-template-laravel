<template>
    <form @submit.prevent="handleSubmit">
        <div class="flex gap-5">
            <div class="shrink-0 grow-0 w-64 overflow-hidden">
                <img v-if="product.image_url" :src="product.image_url" :alt="product.name" class="w-64 h-64 object-contain">
                <div class="py-2 text-xl">Upload Image</div>
                <ImagePreview v-model="imageFile" />
            </div>
            <div class="flex-1 space-y-5">
                <CustomInput name="name" :required="true" v-model="formData.name"></CustomInput>
                <CustomInput name="description" v-model="formData.description"></CustomInput>
                <div class="mb-5 grid grid-cols-4 gap-5">
                    <CustomInput icon="fa-solid fa-dollar-sign" :required="true" name="price" type="number" step="0.01" min="0" v-model="formData.price"></CustomInput>
                    <CustomInput icon="fa-solid fa-boxes-stacked" :required="true" name="stock" type="number" step="1" min="0" v-model="formData.stock"></CustomInput>
                    <div class="col-span-2">
                        <label for="category" class="block text-sm py-1">Category</label>
                        <select v-model="formData.category_id" name="category_id" id="category" required class="h-12 border-0 rounded bg-gray-200 w-full focus:bg-gray-100 focus:ring-0 focus:outline-none">
                            <option value="" selected disabled hidden>-- Select Category --</option>
                            <optgroup v-for="(maincategory, index) in categories.filter(a => !a.parent_id)" :key="index" :label="maincategory.name">
                                <option v-for="(category, index) in categories.filter(a => a.parent_id == maincategory.id)" :key="index" :value="category.id">{{ category.name }}</option>
                            </optgroup>
                        </select>
                    </div>
                </div>
                <div class="flex justify-center">
                    <button class="py-3 px-5 rounded bg-cyan-600 hover:bg-cyan-500 transition-all text-white font-bold text-sm">Save</button>
                </div>
            </div>
        </div>
    </form>
</template>

<script>
import CustomInput from '../../elements/CustomInput.vue';
import ImagePreview from '../../elements/ImagePreview.vue';

export default {
    props: {
        product: {
            type: Object,
            default: () => ({}),
        },
    },
    data() {
        return {
            formData: { ...this.product },
            categories: [],
            imageFile: null
        };
    },
    methods: {
        handleSubmit() {
            this.$emit("xsubmit", { ...this.formData, image: this.imageFile });
        },
        loadCategories() {
            fetch("/api/categories/", {
                headers: {
                    Accept: "application/json"
                }
            }).then(r => r.json()).then(d => this.categories = d);
        },
    },
    components: {
        CustomInput, ImagePreview
    },
    beforeMount() {
        this.loadCategories()
    },
};
</script>