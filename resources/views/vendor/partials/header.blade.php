<header class="z-10 py-4 bg-white shadow-md dark:bg-gray-800">
    <div class="container flex items-center justify-between px-6 mx-auto text-purple-600 dark:text-purple-300">
        <button class="p-1 md:hidden" @click="isSideMenuOpen = !isSideMenuOpen">Menu</button>
        <div class="flex-1">
            <input class="w-full p-2 text-sm bg-gray-100 rounded-md" type="text" placeholder="Filter Orders..." />
        </div>
        <button @click="dark = !dark" class="p-1">Toggle Theme</button>
    </div>
</header>