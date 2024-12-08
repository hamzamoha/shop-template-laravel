<template>
    <aside :class="(sidebar ? 'w-64' : 'w-16') + ' transition-all bg-gray-800 text-white flex-shrink-0 '">
        <nav :class="(sidebar ? 'p-4 ' : '') + 'transition-all'">
            <ul :class="(sidebar ? 'space-y-4 ' : '') + '[&>*]:transition-all text-gray-400'">
                <li>
                    <router-link to="/" :class="(sidebar ? 'px-4' : '') + ' block h-16 flex items-center rounded hover:text-white hover:bg-cyan-600 transition-all group'">
                        <span :class="(sidebar ? 'pr-2' : 'block w-16 shrink-0 text-center') + ' transition-[width,padding] text-xl relative'">
                            <i class="fa-solid fa-house-chimney"></i>
                            <span v-if="!sidebar" class="group-hover:opacity-100 group-hover:visible invisible transition-opacity opacity-0 py-1 px-2 absolute top-1/2 -translate-y-1/2 left-[115%] text-white bg-black rounded text-sm after:absolute after:top-1/2 after:-translate-y-1/2 after:right-full after:border-y-8 after:border-y-transparent after:border-r-8 after:border-r-black">Dashboard</span>
                        </span>
                        <span>Dashboard</span>
                    </router-link>
                </li>
                <li>
                    <router-link :to="{ name: 'products.index' }" :class="(sidebar ? 'px-4' : '') + ' block h-16 flex items-center rounded hover:text-white hover:bg-cyan-600 transition-all group'">
                        <span :class="(sidebar ? 'pr-2' : 'block w-16 shrink-0 text-center') + ' transition-[width,padding] text-xl relative'">
                            <i class="fa-solid fa-cubes"></i>
                            <span v-if="!sidebar" class="group-hover:opacity-100 group-hover:visible invisible transition-opacity opacity-0 py-1 px-2 absolute top-1/2 -translate-y-1/2 left-[115%] text-white bg-black rounded text-sm after:absolute after:top-1/2 after:-translate-y-1/2 after:right-full after:border-y-8 after:border-y-transparent after:border-r-8 after:border-r-black">Products</span>
                        </span>
                        <span>Products</span>
                    </router-link>
                </li>
                <li>
                    <router-link :to="{ name: 'categories.index' }" :class="(sidebar ? 'px-4' : '') + ' block h-16 flex items-center rounded hover:text-white hover:bg-cyan-600 transition-all group'">
                        <span :class="(sidebar ? 'pr-2' : 'block w-16 shrink-0 text-center') + ' transition-[width,padding] text-xl relative'">
                            <i class="fa-solid fa-layer-group"></i>
                            <span v-if="!sidebar" class="group-hover:opacity-100 group-hover:visible invisible transition-opacity opacity-0 py-1 px-2 absolute top-1/2 -translate-y-1/2 left-[115%] text-white bg-black rounded text-sm after:absolute after:top-1/2 after:-translate-y-1/2 after:right-full after:border-y-8 after:border-y-transparent after:border-r-8 after:border-r-black">Categories</span>
                        </span>
                        <span>Categories</span>
                    </router-link>
                </li>
                <li>
                    <router-link :to="{ name: 'orders.index' }" :class="(sidebar ? 'px-4' : '') + ' block h-16 flex items-center rounded hover:text-white hover:bg-cyan-600 transition-all group'">
                        <span :class="(sidebar ? 'pr-2' : 'block w-16 shrink-0 text-center') + ' transition-[width,padding] text-xl relative'">
                            <i class="fa-solid fa-border-all"></i>
                            <span v-if="!sidebar" class="group-hover:opacity-100 group-hover:visible invisible transition-opacity opacity-0 py-1 px-2 absolute top-1/2 -translate-y-1/2 left-[115%] text-white bg-black rounded text-sm after:absolute after:top-1/2 after:-translate-y-1/2 after:right-full after:border-y-8 after:border-y-transparent after:border-r-8 after:border-r-black">Orders</span>
                        </span>
                        <span>Orders</span>
                    </router-link>
                </li>
                <li>
                    <router-link :to="{name: 'customers.index'}" :class="(sidebar ? 'px-4' : '') + ' block h-16 flex items-center rounded hover:text-white hover:bg-cyan-600 transition-all group'">
                        <span :class="(sidebar ? 'pr-2' : 'block w-16 shrink-0 text-center') + ' transition-[width,padding] text-xl relative'">
                            <i class="fa-solid fa-users"></i>
                            <span v-if="!sidebar" class="group-hover:opacity-100 group-hover:visible invisible transition-opacity opacity-0 py-1 px-2 absolute top-1/2 -translate-y-1/2 left-[115%] text-white bg-black rounded text-sm after:absolute after:top-1/2 after:-translate-y-1/2 after:right-full after:border-y-8 after:border-y-transparent after:border-r-8 after:border-r-black">Customers</span>
                        </span>
                        <span>Customers</span>
                    </router-link>
                </li>
                <li>
                    <router-link :to="{name: 'discounts.index'}" :class="(sidebar ? 'px-4' : '') + ' block h-16 flex items-center rounded hover:text-white hover:bg-cyan-600 transition-all group'">
                        <span :class="(sidebar ? 'pr-2' : 'block w-16 shrink-0 text-center') + ' transition-[width,padding] text-xl relative'">
                            <i class="fa-solid fa-percent"></i>
                            <span v-if="!sidebar" class="group-hover:opacity-100 group-hover:visible invisible transition-opacity opacity-0 py-1 px-2 absolute top-1/2 -translate-y-1/2 left-[115%] text-white bg-black rounded text-sm after:absolute after:top-1/2 after:-translate-y-1/2 after:right-full after:border-y-8 after:border-y-transparent after:border-r-8 after:border-r-black">Discounts</span>
                        </span>
                        <span>Discounts</span>
                    </router-link>
                </li>
                <li>
                    <router-link :to="{name: 'inventory.index'}" :class="(sidebar ? 'px-4' : '') + ' block h-16 flex items-center rounded hover:text-white hover:bg-cyan-600 transition-all group'">
                        <span :class="(sidebar ? 'pr-2' : 'block w-16 shrink-0 text-center') + ' transition-[width,padding] text-xl relative'">
                            <i class="fa-solid fa-warehouse"></i>
                            <span v-if="!sidebar" class="group-hover:opacity-100 group-hover:visible invisible transition-opacity opacity-0 py-1 px-2 absolute top-1/2 -translate-y-1/2 left-[115%] text-white bg-black rounded text-sm after:absolute after:top-1/2 after:-translate-y-1/2 after:right-full after:border-y-8 after:border-y-transparent after:border-r-8 after:border-r-black">Inventory</span>
                        </span>
                        <span>Inventory</span>
                    </router-link>
                </li>
                <li>
                    <router-link :to="{name: 'shipping.index'}" :class="(sidebar ? 'px-4' : '') + ' block h-16 flex items-center rounded hover:text-white hover:bg-cyan-600 transition-all group'">
                        <span :class="(sidebar ? 'pr-2' : 'block w-16 shrink-0 text-center') + ' transition-[width,padding] text-xl relative'">
                            <i class="fa-solid fa-dolly"></i>
                            <span v-if="!sidebar" class="group-hover:opacity-100 group-hover:visible invisible transition-opacity opacity-0 py-1 px-2 absolute top-1/2 -translate-y-1/2 left-[115%] text-white bg-black rounded text-sm after:absolute after:top-1/2 after:-translate-y-1/2 after:right-full after:border-y-8 after:border-y-transparent after:border-r-8 after:border-r-black">Shipping</span>
                        </span>
                        <span>Shipping</span>
                    </router-link>
                </li>
                <li>
                    <router-link to="/" :class="(sidebar ? 'px-4' : '') + ' block h-16 flex items-center rounded hover:text-white hover:bg-cyan-600 transition-all group'">
                        <span :class="(sidebar ? 'pr-2' : 'block w-16 shrink-0 text-center') + ' transition-[width,padding] text-xl relative'">
                            <i class="fa-solid fa-gear"></i>
                            <span v-if="!sidebar" class="group-hover:opacity-100 group-hover:visible invisible transition-opacity opacity-0 py-1 px-2 absolute top-1/2 -translate-y-1/2 left-[115%] text-white bg-black rounded text-sm after:absolute after:top-1/2 after:-translate-y-1/2 after:right-full after:border-y-8 after:border-y-transparent after:border-r-8 after:border-r-black">Settings</span>
                        </span>
                        <span>Settings</span>
                    </router-link>
                </li>
                <li>
                    <router-link to="/" :class="(sidebar ? 'px-4' : '') + ' block h-16 flex items-center rounded hover:text-white hover:bg-cyan-600 transition-all group'">
                        <span :class="(sidebar ? 'pr-2' : 'block w-16 shrink-0 text-center') + ' transition-[width,padding] text-xl relative'">
                            <i class="fa-solid fa-comments"></i>
                            <span v-if="!sidebar" class="group-hover:opacity-100 group-hover:visible invisible transition-opacity opacity-0 py-1 px-2 absolute top-1/2 -translate-y-1/2 left-[115%] text-white bg-black rounded text-sm after:absolute after:top-1/2 after:-translate-y-1/2 after:right-full after:border-y-8 after:border-y-transparent after:border-r-8 after:border-r-black">Reviews</span>
                        </span>
                        <span>Reviews</span>
                    </router-link>
                </li>
            </ul>
        </nav>
    </aside>
</template>
<script>
export default {
    props: {
        sidebar: {
            type: Boolean,
            required: true
        }
    }
}
</script>
<style>
aside {
    scrollbar-width: none;
}

aside::-webkit-scrollbar {
    width: 0px;
}

aside::-webkit-scrollbar-thumb {
    background-color: transparent;
}

aside::-webkit-scrollbar-thumb:hover {
    background-color: transparent
}

aside::-webkit-scrollbar-track {
    background-color: transparent
}
</style>