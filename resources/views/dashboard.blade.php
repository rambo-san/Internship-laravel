<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight" style="font-size: 2rem; color: #4A5568; padding: 10px;">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div style="background-color: #f9fafb; padding: 20px; border-radius: 8px;">
        <p style="font-size: 1.2rem; color: #555;">Welcome, <strong>{{ $user->name }}</strong></p>

        @if ($user->role === 'admin')
            <div class="admin-panel">
                <h2 style="font-size: 2rem; color: #4A90E2;">Admin Panel</h2>
                <div class="flex">
                    <!-- Sidebar Navigation -->
                    <div class="w-1/4 pr-4">
                        <ul style="list-style-type: none; padding-left: 0;">
                            <li style="margin: 10px 0;">
                                <a href="{{ route('admin.manage-users') }}" 
                                   class="admin-link {{ request()->routeIs('admin.manage-users') ? 'text-blue-600' : 'text-gray-600' }}"
                                   style="font-size: 1.1rem; text-decoration: none;">
                                    Manage Users
                                </a>
                            </li>
                            <li style="margin: 10px 0;">
                                <a href="{{ route('admin.view-reports') }}" 
                                   class="admin-link {{ request()->routeIs('admin.view-reports') ? 'text-blue-600' : 'text-gray-600' }}"
                                   style="font-size: 1.1rem; text-decoration: none;">
                                    View Reports
                                </a>
                            </li>
                            <li style="margin: 10px 0;">
                                <a href="{{ route('admin.settings') }}" 
                                   class="admin-link {{ request()->routeIs('admin.settings') ? 'text-blue-600' : 'text-gray-600' }}"
                                   style="font-size: 1.1rem; text-decoration: none;">
                                    Admin Settings
                                </a>
                            </li>
                        </ul>
                    </div>

                    <!-- Main Content Area -->
                    <div class="w-3/4">
                        @if(request()->routeIs('admin.manage-users'))
                            @include('admin.manage-users')
                        @elseif(request()->routeIs('admin.view-reports'))
                            @include('admin.view-reports')
                        @elseif(request()->routeIs('admin.settings'))
                            @include('admin.settings')
                        @else
                            <!-- Default Admin Dashboard Content -->
                            <div class="bg-white p-6 rounded-lg shadow-md">
                                <h3 class="text-xl mb-4">Quick Statistics</h3>
                                <div class="grid grid-cols-3 gap-4">
                                    <div class="p-4 bg-blue-100 rounded">
                                        <p class="text-lg">Total Users</p>
                                        <p class="text-2xl font-bold">{{ \App\Models\User::count() }}</p>
                                    </div>
                                    <!-- Add more statistics as needed -->
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        @elseif ($user->role === 'employee')
            <!-- Your existing employee panel code -->
        @elseif ($user->role === 'client')
            <!-- Your existing client panel code -->
        @else
            <p style="color: #E53E3E; font-size: 1.1rem;">Role not recognized.</p>
        @endif
    </div>
</x-app-layout>