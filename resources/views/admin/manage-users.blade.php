<!-- resources/views/admin/manage-users.blade.php -->
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Manage Users') }}
        </h2>
    </x-slot>

    <div style="background-color: #f9fafb; padding: 20px; border-radius: 8px;">
        <h3 style="font-size: 1.5rem; color: #4A90E2;">User List</h3>

        <!-- Table of Users -->
        <table class="min-w-full table-auto">
            <thead>
                <tr>
                    <th class="px-4 py-2">Name</th>
                    <th class="px-4 py-2">Email</th>
                    <th class="px-4 py-2">Role</th>
                    <th class="px-4 py-2">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                    <tr>
                        <td class="px-4 py-2">{{ $user->name }}</td>
                        <td class="px-4 py-2">{{ $user->email }}</td>
                        <td class="px-4 py-2">{{ $user->role }}</td>
                        <td class="px-4 py-2">
                            <!-- Add buttons for Edit, Delete, View -->
                            <a href="{{ route('admin.editUser', $user->id) }}" class="text-blue-500">Edit</a>
                            |
                            <a href="{{ route('admin.deleteUser', $user->id) }}" class="text-red-500">Delete</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</x-app-layout>
