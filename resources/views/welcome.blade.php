<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" x-data="{ darkMode: localStorage.getItem('dark') === 'true' }" x-init="$watch('darkMode', val => localStorage.setItem('dark', val))" :class="{'dark': darkMode === true}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Task Manager') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700&display=swap" rel="stylesheet" />

    <!-- Scripts & Styles -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased bg-white dark:bg-gray-900">
    <x-landing-nav />

    <!-- Hero Section -->
    <div class="relative bg-gradient-to-r from-blue-600 to-indigo-700 dark:from-blue-800 dark:to-indigo-900">
        <div class="absolute inset-0 overflow-hidden">
            <div class="absolute left-0 top-0 transform -translate-x-1/2 -translate-y-1/4">
                <svg width="800" height="800" viewBox="0 0 800 800" xmlns="http://www.w3.org/2000/svg" class="text-white opacity-5">
                    <circle cx="400" cy="400" r="400" fill="currentColor"/>
                </svg>
            </div>
            <div class="absolute right-0 bottom-0 transform translate-x-1/3 translate-y-1/4">
                <svg width="800" height="800" viewBox="0 0 800 800" xmlns="http://www.w3.org/2000/svg" class="text-white opacity-5">
                    <circle cx="400" cy="400" r="400" fill="currentColor"/>
                </svg>
            </div>
        </div>
        
        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-32 md:py-48">
            <div class="lg:grid lg:grid-cols-12 lg:gap-8">
                <div class="lg:col-span-7 xl:col-span-6">
                    <h1 class="text-4xl sm:text-5xl md:text-6xl font-extrabold text-white tracking-tight">
                        Task Manager
                    </h1>
                    <p class="mt-6 text-xl text-blue-100 max-w-3xl">
                        A simple but powerful task manager to organize your daily activities and boost your productivity.
                    </p>
                    <div class="mt-10 flex flex-wrap gap-4">
                        @auth
                            <a href="{{ route('tasks.index') }}" class="px-8 py-3 text-lg font-medium rounded-md text-blue-700 bg-white hover:bg-blue-50 shadow-md transition-all">
                                My Tasks
                            </a>
                        @else
                            <a href="{{ route('login') }}" class="px-8 py-3 text-lg font-medium rounded-md text-blue-700 bg-white hover:bg-blue-50 shadow-md transition-all">
                                Log In
                            </a>
                            <a href="{{ route('register') }}" class="px-8 py-3 text-lg font-medium rounded-md text-white bg-blue-800 bg-opacity-50 hover:bg-opacity-70 shadow-md transition-all">
                                Register
                            </a>
                        @endauth
                    </div>
                </div>
                <div class="hidden lg:block lg:col-span-5 xl:col-span-6 mt-12 lg:mt-0">
                    <div class="relative bg-white dark:bg-gray-800 shadow-xl rounded-lg p-6 overflow-hidden">
                        <!-- Task Management Illustration -->
                        <svg class="w-full h-auto" viewBox="0 0 400 300" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <rect width="400" height="300" fill="transparent"/>
                            <!-- Background elements -->
                            <path d="M370 50C370 39.5066 361.493 31 351 31H49C38.5066 31 30 39.5066 30 50V250C30 260.493 38.5066 269 49 269H351C361.493 269 370 260.493 370 250V50Z" fill="#F3F4F6" class="dark:fill-gray-700"/>
                            
                            <!-- Header bar -->
                            <rect x="30" y="31" width="340" height="40" rx="5" fill="#3B82F6" class="dark:fill-indigo-600"/>
                            <circle cx="55" cy="51" r="10" fill="#FFFFFF" fill-opacity="0.9"/>
                            <rect x="80" y="46" width="120" height="10" rx="5" fill="#FFFFFF" fill-opacity="0.9"/>
                            <rect x="320" y="46" width="30" height="10" rx="5" fill="#FFFFFF" fill-opacity="0.6"/>
                            
                            <!-- Task 1 -->
                            <rect x="50" y="91" width="300" height="40" rx="6" fill="#FFFFFF" class="dark:fill-gray-800" stroke="#E5E7EB" class="dark:stroke-gray-600"/>
                            <rect x="70" y="106" width="180" height="10" rx="5" fill="#1F2937" class="dark:fill-gray-300"/>
                            <circle cx="60" cy="111" r="5" fill="#10B981" class="dark:fill-green-500"/>
                            <circle cx="330" cy="111" r="8" stroke="#D1D5DB" class="dark:stroke-gray-500" stroke-width="2"/>
                            
                            <!-- Task 2 -->
                            <rect x="50" y="141" width="300" height="40" rx="6" fill="#FFFFFF" class="dark:fill-gray-800" stroke="#E5E7EB" class="dark:stroke-gray-600"/>
                            <rect x="70" y="156" width="150" height="10" rx="5" fill="#1F2937" class="dark:fill-gray-300"/>
                            <circle cx="60" cy="161" r="5" fill="#EF4444" class="dark:fill-red-500"/>
                            <circle cx="330" cy="161" r="8" stroke="#D1D5DB" class="dark:stroke-gray-500" stroke-width="2"/>
                            
                            <!-- Task 3 -->
                            <rect x="50" y="191" width="300" height="40" rx="6" fill="#FFFFFF" class="dark:fill-gray-800" stroke="#E5E7EB" class="dark:stroke-gray-600"/>
                            <rect x="70" y="206" width="200" height="10" rx="5" fill="#1F2937" class="dark:fill-gray-300"/>
                            <circle cx="60" cy="211" r="5" fill="#F59E0B" class="dark:fill-yellow-500"/>
                            <circle cx="330" cy="211" r="8" stroke="#D1D5DB" class="dark:stroke-gray-500" stroke-width="2"/>
                            
                            <!-- UI Elements -->
                            <rect x="280" y="250" width="50" height="50" rx="25" fill="#3B82F6" class="dark:fill-indigo-600"/>
                            <path d="M305 260V290M290 275H320" stroke="white" stroke-width="3" stroke-linecap="round"/>
                        </svg>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Features Section -->
    <div class="bg-white dark:bg-gray-900 py-16 sm:py-24">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center">
                <h2 class="text-3xl font-extrabold text-gray-900 dark:text-white sm:text-4xl">
                    Features You'll Love
                </h2>
                <p class="mt-4 text-lg text-gray-500 dark:text-gray-300 max-w-2xl mx-auto">
                    Designed to make your daily task management simple and effective.
                </p>
            </div>

            <div class="mt-16">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    <!-- Feature 1 -->
                    <div class="bg-blue-50 dark:bg-gray-800 rounded-lg p-8 transition-all hover:shadow-lg">
                        <div class="inline-flex items-center justify-center rounded-md bg-blue-100 dark:bg-blue-900 p-3 mb-4">
                            <svg class="w-6 h-6 text-blue-700 dark:text-blue-300" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6A2.25 2.25 0 016 3.75h2.25A2.25 2.25 0 0110.5 6v2.25a2.25 2.25 0 01-2.25 2.25H6a2.25 2.25 0 01-2.25-2.25V6zM3.75 15.75A2.25 2.25 0 016 13.5h2.25a2.25 2.25 0 012.25 2.25V18a2.25 2.25 0 01-2.25 2.25H6A2.25 2.25 0 013.75 18v-2.25zM13.5 6a2.25 2.25 0 012.25-2.25H18A2.25 2.25 0 0120.25 6v2.25A2.25 2.25 0 0118 10.5h-2.25a2.25 2.25 0 01-2.25-2.25V6zM13.5 15.75a2.25 2.25 0 012.25-2.25H18a2.25 2.25 0 012.25 2.25V18A2.25 2.25 0 0118 20.25h-2.25A2.25 2.25 0 0113.5 18v-2.25z" />
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 dark:text-white">Simple Interface</h3>
                        <p class="mt-4 text-gray-600 dark:text-gray-300">Clean and intuitive interface that helps you focus on what matters.</p>
                    </div>

                    <!-- Feature 2 -->
                    <div class="bg-blue-50 dark:bg-gray-800 rounded-lg p-8 transition-all hover:shadow-lg">
                        <div class="inline-flex items-center justify-center rounded-md bg-blue-100 dark:bg-blue-900 p-3 mb-4">
                            <svg class="w-6 h-6 text-blue-700 dark:text-blue-300" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 dark:text-white">Task Organization</h3>
                        <p class="mt-4 text-gray-600 dark:text-gray-300">Organize tasks by priorities, deadlines, and categories.</p>
                    </div>

                    <!-- Feature 3 -->
                    <div class="bg-blue-50 dark:bg-gray-800 rounded-lg p-8 transition-all hover:shadow-lg">
                        <div class="inline-flex items-center justify-center rounded-md bg-blue-100 dark:bg-blue-900 p-3 mb-4">
                            <svg class="w-6 h-6 text-blue-700 dark:text-blue-300" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 17.25v1.007a3 3 0 01-.879 2.122L7.5 21h9l-.621-.621A3 3 0 0115 18.257V17.25m6-12V15a2.25 2.25 0 01-2.25 2.25H5.25A2.25 2.25 0 013 15V5.25m18 0A2.25 2.25 0 0018.75 3H5.25A2.25 2.25 0 003 5.25m18 0V12a2.25 2.25 0 01-2.25 2.25H5.25A2.25 2.25 0 013 12V5.25" />
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 dark:text-white">Cross-Platform</h3>
                        <p class="mt-4 text-gray-600 dark:text-gray-300">Access your tasks from any device with a responsive web design.</p>
                    </div>
                </div>
            </div>
            
            <div class="mt-16 text-center">
                <a href="{{ auth()->check() ? route('tasks.index') : route('register') }}" 
                   class="inline-flex items-center px-6 py-3 border border-transparent text-base font-medium rounded-md shadow-sm text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                    {{ auth()->check() ? 'Go to Tasks' : 'Get Started' }} 
                    <svg class="ml-2 -mr-1 w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3" />
                    </svg>
                </a>
            </div>
        </div>
    </div>

    <!-- How It Works Section -->
    <div class="bg-gray-50 dark:bg-gray-800 py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-3xl font-extrabold text-gray-900 dark:text-white sm:text-4xl">
                    How It Works
                </h2>
                <p class="mt-4 text-lg text-gray-500 dark:text-gray-300 max-w-2xl mx-auto">
                    Get started with Task Manager in three simple steps
                </p>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- Step 1 -->
                <div class="relative">
                    <div class="absolute flex items-center justify-center w-12 h-12 rounded-full bg-blue-600 text-white font-bold text-xl -left-2 -top-2 z-10 border-4 border-white dark:border-gray-800">1</div>
                    <div class="bg-white dark:bg-gray-900 rounded-lg p-6 pt-10 shadow-md h-full">
                        <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-3">Create an Account</h3>
                        <p class="text-gray-600 dark:text-gray-300">Register for a free account to get started with all the features.</p>
                    </div>
                </div>
                
                <!-- Step 2 -->
                <div class="relative">
                    <div class="absolute flex items-center justify-center w-12 h-12 rounded-full bg-blue-600 text-white font-bold text-xl -left-2 -top-2 z-10 border-4 border-white dark:border-gray-800">2</div>
                    <div class="bg-white dark:bg-gray-900 rounded-lg p-6 pt-10 shadow-md h-full">
                        <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-3">Add Your Tasks</h3>
                        <p class="text-gray-600 dark:text-gray-300">Create and organize your tasks with titles, descriptions, and priorities.</p>
                    </div>
                </div>
                
                <!-- Step 3 -->
                <div class="relative">
                    <div class="absolute flex items-center justify-center w-12 h-12 rounded-full bg-blue-600 text-white font-bold text-xl -left-2 -top-2 z-10 border-4 border-white dark:border-gray-800">3</div>
                    <div class="bg-white dark:bg-gray-900 rounded-lg p-6 pt-10 shadow-md h-full">
                        <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-3">Track Progress</h3>
                        <p class="text-gray-600 dark:text-gray-300">Mark tasks as complete and track your productivity over time.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Theme Toggle Button (for mobile) -->
    <div class="fixed bottom-6 right-6 z-50 sm:hidden">
        <button 
            @click="darkMode = !darkMode; localStorage.setItem('dark', darkMode)" 
            class="flex items-center justify-center w-14 h-14 rounded-full bg-blue-600 dark:bg-indigo-600 text-white shadow-lg hover:shadow-xl transition-all duration-300"
            aria-label="Toggle dark mode"
        >
            <svg x-show="!darkMode" xmlns="http://www.w3.org/2000/svg" class="h-7 w-7" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z" />
            </svg>
            <svg x-show="darkMode" xmlns="http://www.w3.org/2000/svg" class="h-7 w-7" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z" />
            </svg>
        </button>
    </div>

    <footer class="bg-gray-50 dark:bg-gray-800 py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center">
                <p class="text-gray-500 dark:text-gray-400">&copy; {{ date('Y') }} Task Manager</p>
                <p class="text-gray-500 dark:text-gray-400 mt-2">Made with ❤️ by <a href="https://alwood.ovh" class="text-blue-600 dark:text-blue-400 hover:underline">alwood</a></p>
            </div>
        </div>
    </footer>
</body>
</html>
