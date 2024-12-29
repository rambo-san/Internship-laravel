<!-- resources/views/admin/settings.blade.php -->
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Admin Settings') }}
        </h2>
    </x-slot>

    <div style="background-color: #f9fafb; padding: 20px; border-radius: 8px;">
        <h3 style="font-size: 1.5rem; color: #4A90E2;">Site Settings</h3>

        <!-- Example settings form -->
        <form action="{{ route('admin.updateSettings') }}" method="POST">
            @csrf
            <div class="mb-4">
                <label for="site_name" class="block text-sm font-medium text-gray-700">Site Name</label>
                <input type="text" id="site_name" name="site_name" class="mt-1 block w-full" value="{{ old('site_name', config('app.name')) }}">
            </div>

            <div class="mb-4">
                <label for="site_email" class="block text-sm font-medium text-gray-700">Site Email</label>
                <input type="email" id="site_email" name="site_email" class="mt-1 block w-full" value="{{ old('site_email', config('mail.from.address')) }}">
            </div>

            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Update Settings</button>
        </form>
    </div>
</x-app-layout>
