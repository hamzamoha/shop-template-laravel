<template>
    <div>
        <div class="flex items-center mb-3">
            <h2 class="text-2xl font-bold mb-4">Categories ({{ categories?.length }})</h2>
            <button @click="createCategory" class="block py-2 px-4 rounded bg-orange-600 transition-all hover:bg-orange-500 text-white ml-auto">Add</button>
        </div>
        <div v-if="categories">
            <table class="w-full bg-white text-sm">
                <thead>
                    <tr class="border-b text-left">
                        <th class="py-1 px-2 border">Category</th>
                        <th class="py-1 px-2 border">Sub Categories</th>
                        <th class="py-1 px-2 border">Products Count</th>
                        <th class="py-1 px-2 border">Total Products Count</th>
                    </tr>
                </thead>
                <tbody>
                    <template v-for="(category, j) in categories.filter(a => !a.parent_id)" :key="j">
                        <tr v-for="(item, i) in categories.filter(a => a.parent_id == category.id)" :key="i">
                            <td class="border py-1 px-2" v-if="i == 0" :rowspan="categories.filter(a => a.parent_id == category.id).length">{{ category.name }}</td>
                            <td class="border py-1 px-2">{{ item.name }}</td>
                            <td class="border py-1 px-2">{{ item.products_count }}</td>
                            <td class="border py-1 px-2" v-if="i == 0" :rowspan="categories.filter(a => a.parent_id == category.id).length">{{ categories.filter(a => a.parent_id == category.id).map(a => a.products_count).reduce((a, b) => a + b, 0) }}</td>
                        </tr>
                    </template>
                </tbody>
            </table>
        </div>
        <div v-if="prompt" class="absolute top-0 left-0 w-screen h-screen flex justify-center items-center">
            <div class="bg-white p-10 rounded border shadow-xl">
                <form @submit.prevent="createCategory" :class="(prompt ? '' : '-mt-40 ') + 'transition-all w-96 space-y-5'">
                    <h2 class="text-2xl font-bold">Create Category</h2>
                    <CustomInput type="text" name="name" icon="fa-solid fa-font" v-model="newCategory.name" :required="true"></CustomInput>
                    <div>
                        <label for="parent_id" class="block text-sm py-1">Parent Category</label>
                        <select v-model="newCategory.parent_id" name="parent_id" id="parent_id" class="h-12 border-0 rounded bg-gray-200 w-full focus:bg-gray-100 focus:ring-0 focus:outline-none">
                            <option value="-1" selected class="italic">-- Empty --</option>
                            <option :value="item.id" v-for="(item, index) in categories.filter(a => !a.parent_id)" :key="index">{{ item.name }}</option>
                        </select>
                    </div>
                    <div class="grid grid-cols-2 gap-5">
                        <button class="py-2 bg-gray-300 transition-all hover:bg-gray-200 rounded" @click="createCategory(false)">Cancel</button>
                        <button class="py-2 bg-cyan-600 transition-all hover:bg-cyan-500 rounded text-white">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>

<script>
import CustomInput from '../../elements/CustomInput.vue';

export default {
    props: {
        categories: {
            default: () => ([]),
            required: true,
            type: Array
        },
    },
    data() {
        return {
            prompt: null,
            newCategory: {}
        }
    },
    methods: {
        createCategory(b = true) {
            this.prompt = Boolean(b);
            this.newCategory = {};
        },
    },
    components: { CustomInput }
}
</script>