<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Welcome') }}
        </h2>
    </x-slot>

    <div class="container mx-auto px-4 py-6">
        <h1 class="text-3xl font-bold mb-4">Welcome to My Laravel Application!</h1>
        <p>This is your new welcome page with the header included.</p>
    </div>
</x-app-layout>
