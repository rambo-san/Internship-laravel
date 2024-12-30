<x-app-layout>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="bg-gray-900 p-6 rounded-lg">
        <p class="text-gray-300 text-lg">
            Welcome, <strong class="text-blue-400">{{ $user->name }}</strong>
        </p>

        @if ($user->role === 'admin')
            <div class="admin-panel mt-4">
                <h2 class="text-2xl text-blue-400">Admin Panel</h2>
                <div class="flex">
                    <!-- Sidebar Navigation -->
                    <div class="w-1/4 pr-4 bg-gray-800 rounded-lg p-4">
                        <ul class="list-none pl-0">
                            <li class="my-2">
                                <a href="#" class="admin-link text-blue-300 hover:text-blue-400" data-target="manage-users">Manage Users</a>
                            </li>
                            <li class="my-2">
                                <a href="#" class="admin-link text-blue-300 hover:text-blue-400" data-target="view-reports">View Reports</a>
                            </li>
                            <li class="my-2">
                                <a href="#" class="admin-link text-blue-300 hover:text-blue-400" data-target="settings">Admin Settings</a>
                            </li>
                        </ul>
                    </div>

                    <!-- Main Content Area -->
                    <div class="w-3/4" id="admin-content">
                        <!-- Default content or loading spinner -->
                        <div class="text-gray-300">Loading...</div>
                    </div>
                </div>
            </div>
        @else
            <p class="text-red-400 text-lg">Role not recognized.</p>
        @endif
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const links = document.querySelectorAll('.admin-link');
            const contentDiv = document.getElementById('admin-content');

            // Load default content
            loadContent('manage-users');

            links.forEach(link => {
                link.addEventListener('click', function(e) {
                    e.preventDefault();
                    const target = this.getAttribute('data-target');
                    loadContent(target);
                });
            });

            function loadContent(target) {
                fetch(`/admin/${target}`)
                    .then(response => response.text())
                    .then(html => {
                        contentDiv.innerHTML = html;
                    })
                    .catch(error => {
                        console.error('Error loading content:', error);
                        contentDiv.innerHTML = '<p class="text-red-400">Error loading content.</p>';
                    });
            }
        });
    </script>
</x-app-layout>