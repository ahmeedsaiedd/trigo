<!DOCTYPE html>
<html :class="{ 'theme-dark': dark }" x-data="data()" lang="en">

<head>
    <meta charset="UTF-8" />
    <script src="https://cdn.tiny.cloud/1/fwuvvz8jdo1f9a3p4oqxp5ko9vhbxidg4l9i5gqr3jgmjd6r/tinymce/7/tinymce.min.js"
        referrerpolicy="origin"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>@yield('title', \App\Models\Setting::where('key', 'business_name')->value('value') ?? 'Trigo')</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('dashboard/assets/css/tailwind.output.css') }}" />
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert2/11.7.3/sweetalert2.all.min.js"></script>
    <script src="{{ asset('dashboard/assets/js/init-alpine.js') }}"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js" defer></script>
    <script src="{{ asset('dashboard/assets/js/charts-lines.js') }}" defer></script>
    <script src="{{ asset('dashboard/assets/js/charts-pie.js') }}" defer></script>
    <style>
        :root {
            --primary-color: {{ \App\Models\Setting::where('key', 'primary_color')->value('value') ?? '#4f46e5' }};
            --secondary-color: {{ \App\Models\Setting::where('key', 'secondary_color')->value('value') ?? '#10b981' }};
        }

        .bg-primary-custom {
            background-color: var(--primary-color);
        }

        .text-primary-custom {
            color: var(--primary-color);
        }

        .bg-secondary-custom {
            background-color: var(--secondary-color);
        }

        .text-secondary-custom {
            color: var(--secondary-color);
        }

        .focus\:ring-primary-custom:focus {
            ring-color: var(--primary-color);
        }

        .focus\:border-primary-custom:focus {
            border-color: var(--primary-color);
        }
    </style>
</head>

<body>
    <div class="flex h-screen bg-gray-50 dark:bg-gray-900" :class="{ 'overflow-hidden': isSideMenuOpen }">
        <!-- Desktop sidebar -->
        <aside class="z-20 hidden w-64 overflow-y-auto bg-white dark:bg-gray-800 md:block flex-shrink-0">
            <div class="py-4 text-gray-500 dark:text-gray-400">
                <a class="ml-6 text-lg font-bold text-gray-800 dark:text-gray-200" href="{{ url('/admin') }}">
                    @if (\App\Models\Setting::where('key', 'logo')->value('value'))
                        <img src="{{ asset('storage/' . \App\Models\Setting::where('key', 'logo')->value('value')) }}"
                            alt="Logo" class="inline-block h-8 w-auto mr-2">
                    @endif
                    {{ \App\Models\Setting::where('key', 'business_name')->value('value') ?? 'Trigo' }}
                </a>
                <ul class="mt-6">
                    <li class="relative px-6 py-3 {{ request()->is('admin') ? 'bg-gray-100' : '' }}">
                        <span
                            class="{{ request()->is('admin') ? 'absolute inset-y-0 left-0 w-1 bg-primary-custom rounded-tr-lg rounded-br-lg' : '' }}"
                            aria-hidden="true"></span>
                        <a class="inline-flex items-center w-full text-sm font-semibold text-gray-800 transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200 {{ request()->is('admin') ? 'dark:text-gray-100' : '' }}"
                            href="{{ url('/admin') }}">
                            <svg class="w-5 h-5" aria-hidden="true" fill="none" stroke-linecap="round"
                                stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
                                <path
                                    d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6">
                                </path>
                            </svg>
                            <span class="ml-4">Dashboard</span>
                        </a>
                    </li>
                    <li class="relative px-6 py-3 {{ request()->is('admin/vendors') ? 'bg-gray-100' : '' }}">
                        <span
                            class="{{ request()->is('admin/vendors') ? 'absolute inset-y-0 left-0 w-1 bg-primary-custom rounded-tr-lg rounded-br-lg' : '' }}"
                            aria-hidden="true"></span>
                        <a class="inline-flex items-center w-full text-sm font-semibold text-gray-800 transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200 {{ request()->is('admin/vendors') ? 'dark:text-gray-100' : '' }}"
                            href="{{ url('/admin/vendors') }}">
                            <svg class="w-5 h-5" aria-hidden="true" fill="none" stroke-linecap="round"
                                stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
                                <path d="M12 4v1m6 11h2m-6 0h-2v4m0-11v3m-6-3v13m6-13a9 9 0 110 18 9 9 0 010-18z">
                                </path>
                            </svg>
                            <span class="ml-4">Vendors</span>
                        </a>
                    </li>
                    <!-- All Products -->
                    <li class="relative px-6 py-3 {{ request()->is('admin/products') ? 'bg-gray-100' : '' }}">
                        <span
                            class="{{ request()->is('admin/products') ? 'absolute inset-y-0 left-0 w-1 bg-primary-custom rounded-tr-lg rounded-br-lg' : '' }}"
                            aria-hidden="true"></span>
                        <a class="inline-flex items-center w-full text-sm font-semibold text-gray-800 transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200 {{ request()->is('admin/products') ? 'dark:text-gray-100' : '' }}"
                            href="{{ route('admin.products') }}">
                            <svg class="w-5 h-5" aria-hidden="true" fill="none" stroke-linecap="round"
                                stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
                                <path
                                    d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4">
                                </path>
                            </svg>
                            <span class="ml-4">Products</span>
                        </a>
                    </li>
                    <!-- Add Products -->
                    <li class="relative px-6 py-3 {{ request()->is('admin/products/create') ? 'bg-gray-100' : '' }}">
                        <span
                            class="{{ request()->is('admin/products/create') ? 'absolute inset-y-0 left-0 w-1 bg-primary-custom rounded-tr-lg rounded-br-lg' : '' }}"
                            aria-hidden="true"></span>
                        <a class="inline-flex items-center w-full text-sm font-semibold text-gray-800 transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200 {{ request()->is('admin/products/create') ? 'dark:text-gray-100' : '' }}"
                            href="{{ route('admin.add-product') }}">
                            <svg class="w-5 h-5" aria-hidden="true" fill="none" stroke-linecap="round"
                                stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
                                <path d="M12 4v16m8-8H4"></path>
                            </svg>
                            <span class="ml-4">Add Product</span>
                        </a>
                    </li>
                    <li class="relative px-6 py-3 {{ request()->is('admin/orders') ? 'bg-gray-100' : '' }}">
                        <span
                            class="{{ request()->is('admin/orders') ? 'absolute inset-y-0 left-0 w-1 bg-primary-custom rounded-tr-lg rounded-br-lg' : '' }}"
                            aria-hidden="true"></span>
                        <a class="inline-flex items-center w-full text-sm font-semibold text-gray-800 transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200 {{ request()->is('admin/orders') ? 'dark:text-gray-100' : '' }}"
                            href="{{ url('/admin/orders') }}">
                            <svg class="w-5 h-5" aria-hidden="true" fill="none" stroke-linecap="round"
                                stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
                                <path
                                    d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z">
                                </path>
                            </svg>
                            <span class="ml-4">Orders</span>
                        </a>
                    </li>
                    <li class="relative px-6 py-3 {{ request()->is('admin/customers') ? 'bg-gray-100' : '' }}">
                        <span
                            class="{{ request()->is('admin/customers') ? 'absolute inset-y-0 left-0 w-1 bg-primary-custom rounded-tr-lg rounded-br-lg' : '' }}"
                            aria-hidden="true"></span>
                        <a class="inline-flex items-center w-full text-sm font-semibold text-gray-800 transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200 {{ request()->is('admin/customers') ? 'dark:text-gray-100' : '' }}"
                            href="{{ url('/admin/customers') }}">
                            <svg class="w-5 h-5" aria-hidden="true" fill="none" stroke-linecap="round"
                                stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
                                <path
                                    d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z">
                                </path>
                            </svg>
                            <span class="ml-4">Customers</span>
                        </a>
                    </li>
                    <!-- Add Categories Button -->
                    <li class="relative px-6 py-3 {{ request()->is('admin/categories/create') ? 'bg-gray-100' : '' }}">
                        <span
                            class="{{ request()->is('admin/categories/create') ? 'absolute inset-y-0 left-0 w-1 bg-primary-custom rounded-tr-lg rounded-br-lg' : '' }}"
                            aria-hidden="true"></span>
                        <a href="{{ url('/admin/categories/create') }}"
                            class="inline-flex items-center w-full text-sm font-semibold text-gray-800 transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200 {{ request()->is('admin/categories/create') ? 'dark:text-gray-100' : '' }}">
                            <svg class="w-5 h-5 mr-2" aria-hidden="true" fill="none" stroke-linecap="round"
                                stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
                                <path d="M12 4v16m8-8H4"></path> <!-- Plus icon -->
                            </svg>
                            <span class="ml-2">Add Categories</span>
                        </a>
                    </li>
                    <!-- All Categories Button -->
                    <li class="relative px-6 py-3 {{ request()->is('admin/categories') ? 'bg-gray-100' : '' }}">
                        <span
                            class="{{ request()->is('admin/categories') ? 'absolute inset-y-0 left-0 w-1 bg-primary-custom rounded-tr-lg rounded-br-lg' : '' }}"
                            aria-hidden="true"></span>
                        <a href="{{ url('/admin/categories') }}"
                            class="inline-flex items-center w-full text-sm font-semibold text-gray-800 transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200 {{ request()->is('admin/categories') ? 'dark:text-gray-100' : '' }}">
                            <svg class="w-5 h-5 mr-2" aria-hidden="true" fill="none" stroke-linecap="round"
                                stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
                                <path d="M4 6h16M4 10h16M4 14h16M4 18h7"></path> <!-- List icon -->
                            </svg>
                            <span class="ml-2">All Categories</span>
                        </a>
                    </li>
                    <li class="relative px-6 py-3 {{ request()->is('admin/shipping') ? 'bg-gray-100' : '' }}">
                        <span
                            class="{{ request()->is('admin/shipping') ? 'absolute inset-y-0 left-0 w-1 bg-primary-custom rounded-tr-lg rounded-br-lg' : '' }}"
                            aria-hidden="true"></span>
                        <a class="inline-flex items-center w-full text-sm font-semibold text-gray-800 transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200 {{ request()->is('admin/shipping') ? 'dark:text-gray-100' : '' }}"
                            href="{{ url('/admin/shipping') }}">
                            <svg class="w-5 h-5" aria-hidden="true" fill="none" stroke-linecap="round"
                                stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
                                <path
                                    d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v3a2 2 0 01-2 2h-1m-3 0a2 2 0 11-4 0H8a2 2 0 11-4 0H3a2 2 0 01-2-2v-3m16-5H4">
                                </path>
                            </svg>
                            <span class="ml-4">Shipping</span>
                        </a>
                    </li>
                    <li class="relative px-6 py-3 {{ request()->is('admin/payments') ? 'bg-gray-100' : '' }}">
                        <span
                            class="{{ request()->is('admin/payments') ? 'absolute inset-y-0 left-0 w-1 bg-primary-custom rounded-tr-lg rounded-br-lg' : '' }}"
                            aria-hidden="true"></span>
                        <a class="inline-flex items-center w-full text-sm font-semibold text-gray-800 transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200 {{ request()->is('admin/payments') ? 'dark:text-gray-100' : '' }}"
                            href="{{ url('/admin/payments') }}">
                            <svg class="w-5 h-5" aria-hidden="true" fill="none" stroke-linecap="round"
                                stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
                                <path
                                    d="M15 9a2 2 0 10-4 0 2 2 0 004 0zm-2 6a4 4 0 01-4-4h8a4 4 0 01-4 4zM5 5h14a2 2 0 012 2v10a2 2 0 01-2 2H5a2 2 0 01-2-2V7a2 2 0 012-2z">
                                </path>
                            </svg>
                            <span class="ml-4">Payments</span>
                        </a>
                    </li>
                    <li class="relative px-6 py-3 {{ request()->is('admin/reports') ? 'bg-gray-100' : '' }}">
                        <span
                            class="{{ request()->is('admin/reports') ? 'absolute inset-y-0 left-0 w-1 bg-primary-custom rounded-tr-lg rounded-br-lg' : '' }}"
                            aria-hidden="true"></span>
                        <a class="inline-flex items-center w-full text-sm font-semibold text-gray-800 transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200 {{ request()->is('admin/reports') ? 'dark:text-gray-100' : '' }}"
                            href="{{ url('/admin/reports') }}">
                            <svg class="w-5 h-5" aria-hidden="true" fill="none" stroke-linecap="round"
                                stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
                                <path
                                    d="M8 7v8m4-8v4m4-4v6M5 3h14a2 2 0 012 2v14a2 2 0 01-2 2H5a2 2 0 01-2-2V5a2 2 0 012-2z">
                                </path>
                            </svg>
                            <span class="ml-4">Reports</span>
                        </a>
                    </li>
                    <li class="relative px-6 py-3 {{ request()->is('admin/business-settings') ? 'bg-gray-100' : '' }}">
                        <span
                            class="{{ request()->is('admin/business-settings') ? 'absolute inset-y-0 left-0 w-1 bg-primary-custom rounded-tr-lg rounded-br-lg' : '' }}"
                            aria-hidden="true"></span>
                        <a class="inline-flex items-center w-full text-sm font-semibold text-gray-800 transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200 {{ request()->is('admin/business-settings') ? 'dark:text-gray-100' : '' }}"
                            href="{{ url('/admin/business-settings') }}">
                            <svg class="w-5 h-5" aria-hidden="true" fill="none" stroke-linecap="round"
                                stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
                                <path
                                    d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z">
                                </path>
                                <path d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            </svg>
                            <span class="ml-4">Business Settings</span>
                        </a>
                    </li>
                    <li class="relative px-6 py-3 {{ request()->routeIs('roles.index') ? 'bg-gray-100' : '' }}">
                        <span class="{{ request()->routeIs('roles.index') ? 'absolute inset-y-0 left-0 w-1 bg-primary-custom rounded-tr-lg rounded-br-lg' : '' }}" aria-hidden="true"></span>
                        <a class="inline-flex items-center w-full text-sm font-semibold text-gray-800 transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200 {{ request()->routeIs('roles.index') ? 'dark:text-gray-100' : '' }}"
                            href="{{ route('roles.index') }}">
                            <svg class="w-5 h-5" aria-hidden="true" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
                                <path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"></path>
                            </svg>
                            <span class="ml-4">Go to Users</span>
                        </a>
                    </li>
                    <li class="relative px-6 py-3 {{ request()->routeIs('permissions.index') ? 'bg-gray-100' : '' }}">
                        <span class="{{ request()->routeIs('permissions.index') ? 'absolute inset-y-0 left-0 w-1 bg-primary-custom rounded-tr-lg rounded-br-lg' : '' }}" aria-hidden="true"></span>
                        <a class="inline-flex items-center w-full text-sm font-semibold text-gray-800 transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200 {{ request()->routeIs('permissions.index') ? 'dark:text-gray-100' : '' }}"
                            href="{{ route('permissions.index') }}">
                            <svg class="w-5 h-5" aria-hidden="true" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
                                <path d="M12 11c1.66 0 3-1.34 3-3s-1.34-3-3-3-3 1.34-3 3 1.34 3 3 3zm0 2c-2.76 0-5 2.24-5 5h10c0-2.76-2.24-5-5-5z"></path>
                            </svg>
                            <span class="ml-4">Go to Permissions</span>
                        </a>
                    </li>
                    
                </ul>
            </div>
        </aside>

        <!-- Mobile sidebar -->
        <div x-show="isSideMenuOpen" x-transition:enter="transition ease-in-out duration-150"
            x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
            x-transition:leave="transition ease-in-out duration-150" x-transition:leave-start="opacity-100"
            x-transition:leave-end="opacity-0"
            class="fixed inset-0 z-10 flex items-end bg-black bg-opacity-50 sm:items-center sm:justify-center"></div>
        <aside class="fixed inset-y-0 z-20 flex-shrink-0 w-64 mt-16 overflow-y-auto bg-white dark:bg-gray-800 md:hidden"
            x-show="isSideMenuOpen" x-transition:enter="transition ease-in-out duration-150"
            x-transition:enter-start="opacity-0 transform -translate-x-20" x-transition:enter-end="opacity-100"
            x-transition:leave="transition ease-in-out duration-150" x-transition:leave-start="opacity-100"
            x-transition:leave-end="opacity-0 transform -translate-x-20" @click.away="closeSideMenu"
            @keydown.escape="closeSideMenu">
            <div class="py-4 text-gray-500 dark:text-gray-400">
                <a class="ml-6 text-lg font-bold text-gray-800 dark:text-gray-200" href="{{ url('/admin') }}">
                    @if (\App\Models\Setting::where('key', 'logo')->value('value'))
                        <img src="{{ asset('storage/' . \App\Models\Setting::where('key', 'logo')->value('value')) }}"
                            alt="Logo" class="inline-block h-8 w-auto mr-2">
                    @endif
                    {{ \App\Models\Setting::where('key', 'business_name')->value('value') ?? 'Trigo' }}
                </a>
                <ul class="mt-6">
                    <li class="relative px-6 py-3 {{ request()->is('admin') ? 'bg-gray-100' : '' }}">
                        <span
                            class="{{ request()->is('admin') ? 'absolute inset-y-0 left-0 w-1 bg-primary-custom rounded-tr-lg rounded-br-lg' : '' }}"
                            aria-hidden="true"></span>
                        <a class="inline-flex items-center w-full text-sm font-semibold text-gray-800 transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200 {{ request()->is('admin') ? 'dark:text-gray-100' : '' }}"
                            href="{{ url('/admin') }}">
                            <svg class="w-5 h-5" aria-hidden="true" fill="none" stroke-linecap="round"
                                stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
                                <path
                                    d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6">
                                </path>
                            </svg>
                            <span class="ml-4">Dashboard</span>
                        </a>
                    </li>
                    <li class="relative px-6 py-3 {{ request()->is('admin/vendors') ? 'bg-gray-100' : '' }}">
                        <span
                            class="{{ request()->is('admin/vendors') ? 'absolute inset-y-0 left-0 w-1 bg-primary-custom rounded-tr-lg rounded-br-lg' : '' }}"
                            aria-hidden="true"></span>
                        <a class="inline-flex items-center w-full text-sm font-semibold text-gray-800 transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200 {{ request()->is('admin/vendors') ? 'dark:text-gray-100' : '' }}"
                            href="{{ url('/admin/vendors') }}">
                            <svg class="w-5 h-5" aria-hidden="true" fill="none" stroke-linecap="round"
                                stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
                                <path d="M12 4v1m6 11h2m-6 0h-2v4m0-11v3m-6-3v13m6-13a9 9 0 110 18 9 9 0 010-18z">
                                </path>
                            </svg>
                            <span class="ml-4">Vendors</span>
                        </a>
                    </li>
                    <li class="relative px-6 py-3 {{ request()->is('admin/products') ? 'bg-gray-100' : '' }}">
                        <span
                            class="{{ request()->is('admin/products') ? 'absolute inset-y-0 left-0 w-1 bg-primary-custom rounded-tr-lg rounded-br-lg' : '' }}"
                            aria-hidden="true"></span>
                        <a class="inline-flex items-center w-full text-sm font-semibold text-gray-800 transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200 {{ request()->is('admin/products') ? 'dark:text-gray-100' : '' }}"
                            href="{{ url('/admin/products') }}">
                            <svg class="w-5 h-5" aria-hidden="true" fill="none" stroke-linecap="round"
                                stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
                                <path
                                    d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4">
                                </path>
                            </svg>
                            <span class="ml-4">Products</span>
                        </a>
                    </li>
                    <li class="relative px-6 py-3 {{ request()->is('admin/orders') ? 'bg-gray-100' : '' }}">
                        <span
                            class="{{ request()->is('admin/orders') ? 'absolute inset-y-0 left-0 w-1 bg-primary-custom rounded-tr-lg rounded-br-lg' : '' }}"
                            aria-hidden="true"></span>
                        <a class="inline-flex items-center w-full text-sm font-semibold text-gray-800 transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200 {{ request()->is('admin/orders') ? 'dark:text-gray-100' : '' }}"
                            href="{{ url('/admin/orders') }}">
                            <svg class="w-5 h-5" aria-hidden="true" fill="none" stroke-linecap="round"
                                stroke-linejoin="round" stroke-width="2" viewBox="0 0 24  intervent24" stroke="currentColor">
                                <path
                                    d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z">
                                </path>
                            </svg>
                            <span class="ml-4">Orders</span>
                        </a>
                    </li>
                    <li class="relative px-6 py-3 {{ request()->is('admin/customers') ? 'bg-gray-100' : '' }}">
                        <span
                            class="{{ request()->is('admin/customers') ? 'absolute inset-y-0 left-0 w-1 bg-primary-custom rounded-tr-lg rounded-br-lg' : '' }}"
                            aria-hidden="true"></span>
                        <a class="inline-flex items-center w-full text-sm font-semibold text-gray-800 transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200 {{ request()->is('admin/customers') ? 'dark:text-gray-100' : '' }}"
                            href="{{ url('/admin/customers') }}">
                            <svg class="w-5 h-5" aria-hidden="true" fill="none" stroke-linecap="round"
                                stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
                                <path
                                    d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z">
                                </path>
                            </svg>
                            <span class="ml-4">Customers</span>
                        </a>
                    </li>
                    <!-- Add Categories Button -->
                    <li class="relative px-6 py-3 {{ request()->is('admin/categories/create') ? 'bg-gray-100' : '' }}">
                        <span
                            class="{{ request()->is('admin/categories/create') ? 'absolute inset-y-0 left-0 w-1 bg-primary-custom rounded-tr-lg rounded-br-lg' : '' }}"
                            aria-hidden="true"></span>
                        <a href="{{ url('/admin/categories/create') }}"
                            class="inline-flex items-center w-full text-sm font-semibold text-gray-800 transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200 {{ request()->is('admin/categories/create') ? 'dark:text-gray-100' : '' }}">
                            <svg class="w-5 h-5 mr-2" aria-hidden="true" fill="none" stroke-linecap="round"
                                stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
                                <path d="M12 4v16m8-8H4"></path> <!-- Plus icon -->
                            </svg>
                            <span class="ml-2">Add Categories</span>
                        </a>
                    </li>
                    <!-- All Categories Button -->
                    <li class="relative px-6 py-3 {{ request()->is('admin/categories') ? 'bg-gray-100' : '' }}">
                        <span
                            class="{{ request()->is('admin/categories') ? 'absolute inset-y-0 left-0 w-1 bg-primary-custom rounded-tr-lg rounded-br-lg' : '' }}"
                            aria-hidden="true"></span>
                        <a href="{{ url('/admin/categories') }}"
                            class="inline-flex items-center w-full text-sm font-semibold text-gray-800 transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200 {{ request()->is('admin/categories') ? 'dark:text-gray-100' : '' }}">
                            <svg class="w-5 h-5 mr-2" aria-hidden="true" fill="none" stroke-linecap="round"
                                stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
                                <path d="M4 6h16M4 10h16M4 14h16M4 18h7"></path> <!-- List icon -->
                            </svg>
                            <span class="ml-2">All Categories</span>
                        </a>
                    </li>
                    <li class="relative px-6 py-3 {{ request()->is('admin/shipping') ? 'bg-gray-100' : '' }}">
                        <span
                            class="{{ request()->is('admin/shipping') ? 'absolute inset-y-0 left-0 w-1 bg-primary-custom rounded-tr-lg rounded-br-lg' : '' }}"
                            aria-hidden="true"></span>
                        <a class="inline-flex items-center w-full text-sm font-semibold text-gray-800 transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200 {{ request()->is('admin/shipping') ? 'dark:text-gray-100' : '' }}"
                            href="{{ url('/admin/shipping') }}">
                            <svg class="w-5 h-5" aria-hidden="true" fill="none" stroke-linecap="round"
                                stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
                                <path
                                    d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v3a2 2 0 01-2 2h-1m-3 0a2 2 0 11-4 0H8a2 2 0 11-4 0H3a2 2 0 01-2-2v-3m16-5H4">
                                </path>
                            </svg>
                            <span class="ml-4">Shipping</span>
                        </a>
                    </li>
                    <li class="relative px-6 py-3 {{ request()->is('admin/payments') ? 'bg-gray-100' : '' }}">
                        <span
                            class="{{ request()->is('admin/payments') ? 'absolute inset-y-0 left-0 w-1 bg-primary-custom rounded-tr-lg rounded-br-lg' : '' }}"
                            aria-hidden="true"></span>
                        <a class="inline-flex items-center w-full text-sm font-semibold text-gray-800 transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200 {{ request()->is('admin/payments') ? 'dark:text-gray-100' : '' }}"
                            href="{{ url('/admin/payments') }}">
                            <svg class="w-5 h-5" aria-hidden="true" fill="none" stroke-linecap="round"
                                stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
                                <path
                                    d="M15 9a2 2 0 10-4 0 2 2 0 004 0zm-2 6a4 4 0 01-4-4h8a4 4 0 01-4 4zM5 5h14a2 2 0 012 2v10a2 2 0 01-2 2H5a2 2 0 01-2-2V7a2 2 0 012-2z">
                                </path>
                            </svg>
                            <span class="ml-4">Payments</span>
                        </a>
                    </li>
                    <li class="relative px-6 py-3 {{ request()->is('admin/reports') ? 'bg-gray-100' : '' }}">
                        <span
                            class="{{ request()->is('admin/reports') ? 'absolute inset-y-0 left-0 w-1 bg-primary-custom rounded-tr-lg rounded-br-lg' : '' }}"
                            aria-hidden="true"></span>
                        <a class="inline-flex items-center w-full text-sm font-semibold text-gray-800 transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200 {{ request()->is('admin/reports') ? 'dark:text-gray-100' : '' }}"
                            href="{{ url('/admin/reports') }}">
                            <svg class="w-5 h-5" aria-hidden="true" fill="none" stroke-linecap="round"
                                stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
                                <path
                                    d="M8 7v8m4-8v4m4-4v6M5 3h14a2 2 0 012 2v14a2 2 0 01-2 2H5a2 2 0 01-2-2V5a2 2 0 012-2z">
                                </path>
                            </svg>
                            <span class="ml-4">Reports</span>
                        </a>
                    </li>
                    <li class="relative px-6 py-3 {{ request()->is('admin/business-settings') ? 'bg-gray-100' : '' }}">
                        <span
                            class="{{ request()->is('admin/business-settings') ? 'absolute inset-y-0 left-0 w-1 bg-primary-custom rounded-tr-lg rounded-br-lg' : '' }}"
                            aria-hidden="true"></span>
                        <a class="inline-flex items-center w-full text-sm font-semibold text-gray-800 transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200 {{ request()->is('admin/business-settings') ? 'dark:text-gray-100' : '' }}"
                            href="{{ url('/admin/business-settings') }}">
                            <svg class="w-5 h-5" aria-hidden="true" fill="none" stroke-linecap="round"
                                stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
                                <path
                                    d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z">
                                </path>
                                <path d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            </svg>
                            <span class="ml-4">Business Settings</span>
                        </a>
                    </li>
                </ul>
            </div>
        </aside>

        <div class="flex flex-col flex-1 w-full">
            <!-- Header -->
            <header class="z-10 py-4 bg-white shadow-md dark:bg-gray-800">
                <div
                    class="container flex items-center justify-between h-full px-6 mx-auto text-primary-custom dark:text-primary-custom">
                    <button
                        class="p-1 mr-5 -ml-1 rounded-md md:hidden focus:outline-none focus:shadow-outline-primary-custom"
                        @click="toggleSideMenu" aria-label="Menu">
                        <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 15a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z"
                                clip-rule="evenodd"></path>
                        </svg>
                    </button>
                    <div class="flex justify-center flex-1 lg:mr-32">
                        <div class="relative w-full max-w-xl mr-6 focus-within:text-primary-custom">
                            <div class="absolute inset-y-0 flex items-center pl-2">
                                <svg class="w-4 h-4" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                                        clip-rule="evenodd"></path>
                                </svg>
                            </div>
                            <input
                                class="w-full pl-8 pr-2 text-sm text-gray-700 placeholder-gray-600 bg-gray-100 border-0 rounded-md dark:placeholder-gray-500 dark:focus:shadow-outline-gray dark:focus:placeholder-gray-600 dark:bg-gray-700 dark:text-gray-200 focus:placeholder-gray-500 focus:bg-white focus:border-primary-custom focus:outline-none focus:shadow-outline-primary-custom form-input"
                                type="text" placeholder="Search for projects" aria-label="Search" />
                        </div>
                    </div>
                    <ul class="flex items-center flex-shrink-0 space-x-6">
                        <li class="flex">
                            <button class="rounded-md focus:outline-none focus:shadow-outline-primary-custom"
                                @click="toggleTheme" aria-label="Toggle color mode">
                                <template x-if="!dark">
                                    <svg class="w-5 h-5" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M17.293 13.293A8 8 0 016.707 2.707a8.001 8.001 0 1010.586 10.586z">
                                        </path>
                                    </svg>
                                </template>
                                <template x-if="dark">
                                    <svg class="w-5 h-5" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd"
                                            d="M10 2a1 1 0 011 1v1a1 1 0 11-2 0V3a1 1 0 011-1zm4 8a4 4 0 11-8 0 4 4 0 018 0zm-.464 4.95l.707.707a1 1 0 001.414-1.414l-.707-.707a1 1 0 00-1.414 1.414zm2.12-10.607a1 1 0 010 1.414l-.706.707a1 1 0 11-1.414-1.414l.707-.707a1 1 0 011.414 0zM17 11a1 1 0 100-2h-1a1 1 0 100 2h1zm-7 4a1 1 0 011 1v1a1 1 0 11-2 0v-1a1 1 0 011-1zM5.05 6.464A1 1 0 106.465 5.05l-.708-.707a1 1 0 00-1.414 1.414l.707.707zm1.414 8.486l-.707.707a1 1 0 01-1.414-1.414l.707-.707a1 1 0 011.414 1.414zM4 11a1 1 0 100-2H3a1 1 0 000 2h1z"
                                            clip-rule="evenodd"></path>
                                    </svg>
                                </template>
                            </button>
                        </li>
                        <li class="relative">
                            <button
                                class="relative align-middle rounded-md focus:outline-none focus:shadow-outline-primary-custom"
                                @click="toggleNotificationsMenu" @keydown.escape="closeNotificationsMenu"
                                aria-label="Notifications" aria-haspopup="true">
                                <svg class="w-5 h-5" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20">
                                    <path
                                        d="M10 2a6 6 0 00-6 6v3.586l-.707.707A1 1 0 004 14h12a1 1 0 00.707-1.707L16 11.586V8a6 6 0 00-6-6zM10 18a3 3 0 01-3-3h6a3 3 0 01-3 3z">
                                    </path>
                                </svg>
                                <span aria-hidden="true"
                                    class="absolute top-0 right-0 inline-block w-3 h-3 transform translate-x-1 -translate-y-1 bg-red-600 border-2 border-white rounded-full dark:border-gray-800"></span>
                            </button>
                            <template x-if="isNotificationsMenuOpen">
                                <ul x-transition:leave="transition ease-in duration-150"
                                    x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
                                    @click.away="closeNotificationsMenu" @keydown.escape="closeNotificationsMenu"
                                    class="absolute right-0 w-56 p-2 mt-2 space-y-2 text-gray-600 bg-white border border-gray-100 rounded-md shadow-md dark:text-gray-300 dark:border-gray-700 dark:bg-gray-700">
                                    <li class="flex">
                                        <a class="inline-flex items-center justify-between w-full px-2 py-1 text-sm font-semibold transition-colors duration-150 rounded-md hover:bg-gray-100 hover:text-gray-800 dark:hover:bg-gray-800 dark:hover:text-gray-200"
                                            href="#">
                                            <span>Messages</span>
                                            <span
                                                class="inline-flex items-center justify-center px-2 py-1 text-xs font-bold leading-none text-red-600 bg-red-100 rounded-full dark:text-red-100 dark:bg-red-600">13</span>
                                        </a>
                                    </li>
                                </ul>
                            </template>
                        </li>
                        <li class="relative">
                            <button
                                class="align-middle rounded-full focus:shadow-outline-primary-custom focus:outline-none"
                                @click="toggleProfileMenu" @keydown.escape="closeProfileMenu" aria-label="Account"
                                aria-haspopup="true">
                                <img class="object-cover w-8 h-8 rounded-full"
                                    src="https://images.unsplash.com/photo-1502378735452-bc7d86632805?ixlib=rb-0.3.5&q=80&fm=jpg&crop=entropy&cs=tinysrgb&w=200&fit=max&s=aa3a807e1bbdfd4364d1f449eaa96d82"
                                    alt="" aria-hidden="true" />
                            </button>
                            <template x-if="isProfileMenuOpen">
                                <ul x-transition:leave="transition ease-in duration-150"
                                    x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
                                    @click.away="closeProfileMenu" @keydown.escape="closeProfileMenu"
                                    class="absolute right-0 w-56 p-2 mt-2 space-y-2 text-gray-600 bg-white border border-gray-100 rounded-md shadow-md dark:border-gray-700 dark:text-gray-300 dark:bg-gray-700"
                                    aria-label="submenu">
                                    <li class="flex">
                                        <a class="inline-flex items-center w-full px-2 py-1 text-sm font-semibold transition-colors duration-150 rounded-md hover:bg-gray-100 hover:text-gray-800 dark:hover:bg-gray-800 dark:hover:text-gray-200"
                                            href="#">
                                            <svg class="w-4 h-4 mr-3" aria-hidden="true" fill="none"
                                                stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                viewBox="0 0 24 24" stroke="currentColor">
                                                <path
                                                    d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z">
                                                </path>
                                            </svg>
                                            <span>Profile</span>
                                        </a>
                                    </li>
                                    <li class="relative px-6 py-3">
                                        <a class="inline-flex items-center w-full text-sm font-semibold transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200" href="{{ url('/admin/business-settings') }}">
                                            <svg class="w-5 h-5" aria-hidden="true" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
                                                <path d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                                                <path d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                            </svg>
                                            <span class="ml-4">Business Settings</span>
                                        </a>
                                    </li>
                                    <li class="relative px-6 py-3">
                                        <a class="inline-flex items-center w-full text-sm font-semibold transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200" href="{{ route('roles.index') }}">
                                            <svg class="w-5 h-5" aria-hidden="true" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
                                                <path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"></path>
                                            </svg>
                                            <span class="ml-4">Go to Users</span>
                                        </a>
                                    </li>
                                    <li class="relative px-6 py-3">
                                        <a class="inline-flex items-center w-full text-sm font-semibold transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200" href="{{ route('permissions.index') }}">
                                            <svg class="w-5 h-5" aria-hidden="true" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
                                                <path d="M12 11c1.66 0 3-1.34 3-3s-1.34-3-3-3-3 1.34-3 3 1.34 3 3 3zm0 2c-2.76 0-5 2.24-5 5h10c0-2.76-2.24-5-5-5z"></path>
                                            </svg>
                                            <span class="ml-4">Go to Permissions</span>
                                        </a>
                                    </li>
                                    <li class="flex">
                                        <form action="{{ route('logout') }}" method="POST" class="w-full">
                                            @csrf
                                            <button type="submit"
                                                class="inline-flex items-center w-full px-2 py-1 text-sm font-semibold transition-colors duration-150 rounded-md hover:bg-gray-100 hover:text-gray-800 dark:hover:bg-gray-800 dark:hover:text-gray-200">
                                                <svg class="w-4 h-4 mr-3" aria-hidden="true" fill="none"
                                                    stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    viewBox="0 0 24 24" stroke="currentColor">
                                                    <path
                                                        d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1">
                                                    </path>
                                                </svg>
                                                <span>Log out</span>
                                            </button>
                                        </form>
                                    </li>
                                </ul>
                            </template>
                        </li>
                    </ul>
                </div>
            </header>

            <!-- Main content -->
            <main class="h-full overflow-y-auto">
                <div class="container px-6 mx-auto grid">
                    @yield('content')
                </div>
            </main>
        </div>
    </div>
    @stack('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert2/11.7.3/sweetalert2.all.min.js"></script>
    @yield('scripts')
</body>

</html>