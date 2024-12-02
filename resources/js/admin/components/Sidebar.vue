<template>
    <aside :class="(sidebar ? 'w-64' : 'w-16') + ' transition-all bg-gray-800 text-white flex-shrink-0 overflow-y-auto'">
        <nav :class="(sidebar ? 'p-4 ' : '') + 'transition-all'">
            <ul :class="(sidebar ? 'space-y-4 ' : '') + '[&>*]:transition-all text-gray-400'">
                <li>
                    <router-link to="/" :class="(sidebar ? 'px-4' : '') + ' overflow-hidden block h-16 flex items-center rounded hover:text-white hover:bg-cyan-600 transition-all'">
                        <span :class="(sidebar ? 'pr-2' : 'block w-16 shrink-0 text-center') + ' transition-[width,padding] text-xl'"><i class="fa-solid fa-house-chimney"></i></span>
                        <span>Dashboard</span>
                    </router-link>
                </li>
                <li>
                    <router-link :to="{ name: 'products.index' }" :class="(sidebar ? 'px-4' : '') + ' overflow-hidden block h-16 flex items-center rounded hover:text-white hover:bg-cyan-600 transition-all'">
                        <span :class="(sidebar ? 'pr-2' : 'block w-16 shrink-0 text-center') + ' transition-[width,padding] text-xl'"><i class="fa-solid fa-cubes"></i></span>
                        <span>Products</span>
                    </router-link>
                </li>
                <li>
                    <router-link :to="{ name: 'categories.index' }" :class="(sidebar ? 'px-4' : '') + ' overflow-hidden block h-16 flex items-center rounded hover:text-white hover:bg-cyan-600 transition-all'">
                        <span :class="(sidebar ? 'pr-2' : 'block w-16 shrink-0 text-center') + ' transition-[width,padding] text-xl'"><i class="fa-solid fa-layer-group"></i></span>
                        <span>Categories</span>
                    </router-link>
                </li>
                <li>
                    <router-link :to="{ name: 'orders.index' }" :class="(sidebar ? 'px-4' : '') + ' overflow-hidden block h-16 flex items-center rounded hover:text-white hover:bg-cyan-600 transition-all'">
                        <span :class="(sidebar ? 'pr-2' : 'block w-16 shrink-0 text-center') + ' transition-[width,padding] text-xl'"><i class="fa-solid fa-border-all"></i></span>
                        <span>Orders</span>
                    </router-link>
                </li>
                <li>
                    <router-link :to="{name: 'customers.index'}" :class="(sidebar ? 'px-4' : '') + ' overflow-hidden block h-16 flex items-center rounded hover:text-white hover:bg-cyan-600 transition-all'">
                        <span :class="(sidebar ? 'pr-2' : 'block w-16 shrink-0 text-center') + ' transition-[width,padding] text-xl'"><i class="fa-solid fa-users"></i></span>
                        <span>Customers</span>
                    </router-link>
                </li>
                <li>
                    <router-link to="/" :class="(sidebar ? 'px-4' : '') + ' overflow-hidden block h-16 flex items-center rounded hover:text-white hover:bg-cyan-600 transition-all'">
                        <span :class="(sidebar ? 'pr-2' : 'block w-16 shrink-0 text-center') + ' transition-[width,padding] text-xl'"><i class="fa-solid fa-percent"></i></span>
                        <span>Discounts</span>
                    </router-link>
                </li>
                <li>
                    <router-link to="/" :class="(sidebar ? 'px-4' : '') + ' overflow-hidden block h-16 flex items-center rounded hover:text-white hover:bg-cyan-600 transition-all'">
                        <span :class="(sidebar ? 'pr-2' : 'block w-16 shrink-0 text-center') + ' transition-[width,padding] text-xl'"><i class="fa-solid fa-warehouse"></i></span>
                        <span>Inventory</span>
                    </router-link>
                </li>
                <li>
                    <router-link to="/" :class="(sidebar ? 'px-4' : '') + ' overflow-hidden block h-16 flex items-center rounded hover:text-white hover:bg-cyan-600 transition-all'">
                        <span :class="(sidebar ? 'pr-2' : 'block w-16 shrink-0 text-center') + ' transition-[width,padding] text-xl'"><i class="fa-solid fa-dolly"></i></span>
                        <span>Shipping</span>
                    </router-link>
                </li>
                <li>
                    <router-link to="/" :class="(sidebar ? 'px-4' : '') + ' overflow-hidden block h-16 flex items-center rounded hover:text-white hover:bg-cyan-600 transition-all'">
                        <span :class="(sidebar ? 'pr-2' : 'block w-16 shrink-0 text-center') + ' transition-[width,padding] text-xl'"><i class="fa-solid fa-gear"></i></span>
                        <span>Settings</span>
                    </router-link>
                </li>
                <li>
                    <router-link to="/" :class="(sidebar ? 'px-4' : '') + ' overflow-hidden block h-16 flex items-center rounded hover:text-white hover:bg-cyan-600 transition-all'">
                        <span :class="(sidebar ? 'pr-2' : 'block w-16 shrink-0 text-center') + ' transition-[width,padding] text-xl'"><i class="fa-solid fa-comments"></i></span>
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