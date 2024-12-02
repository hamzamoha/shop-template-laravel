<template>
    <header>
        <div class="flex items-center h-16 bg-white drop-shadow-lg">
            <button class="w-16 h-16 mr-2 text-4xl text-white bg-cyan-600" @click="$emit('toggle-sidebar')"><i
                    class="fa-solid fa-bars-staggered"></i></button>
            <img src="/images/logo.png" alt="Logo" class="h-14">
            <ul class="ml-auto flex items-center">
                <li><router-link to="/"
                        class="block transition-all hover:bg-black/5 h-16 flex items-center px-3">Dashboard</router-link>
                </li>
                <li><router-link to="/"
                        class="block transition-all hover:bg-black/5 h-16 flex items-center px-3">Profile</router-link>
                </li>
                <li><router-link to="/"
                        class="block transition-all hover:bg-black/5 h-16 flex items-center px-3">Settings</router-link>
                </li>
                <li>
                    <form method="post" class="block">
                        <input type="hidden" name="_token" :value="csrf">
                        <button
                            class="transition-all hover:bg-black/5 h-16 flex items-center px-3 focus:ring-0 focus:outline-0 text-red-500"
                            type="submit">Logout</button>
                    </form>
                </li>
            </ul>
        </div>
    </header>
</template>

<script>
export default {
    data: () => ({
        csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
    }),
    methods: {
        toggleSidebar() {
            this.sidebar = !this.sidebar;
        }
    }
}
</script>