<x-layout>
    <x-slot name="title">
        Custom title
    </x-slot>
    <div class="relative flex items-top justify-center min-vh-100 bg-gray-100 dark:bg-gray-900 sm:items-center sm:pt-0">
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
            <div class="flex justify-center pt-8 sm:justify-start sm:pt-0">
                <x-logo />
            </div>

            <div class="text-gray-600 py-4 text-center">
                <h2>Hello, friend!</h2>
                <h3>Let's pay some money!</h3>
                <h1><a href="/register">Go to billing</a></h1>
            </div>
        </div>
    </div>
</x-layout>
