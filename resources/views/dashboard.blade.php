<x-app-layout>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
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
                                <a href="#" class="admin-link" data-target="manage-users">Manage Users</a>
                            </li>
                            <li style="margin: 10px 0;">
                                <a href="#" class="admin-link" data-target="view-reports">View Reports</a>
                            </li>
                            <li style="margin: 10px 0;">
                                <a href="#" class="admin-link" data-target="settings">Admin Settings</a>
                            </li>
                        </ul>
                    </div>

                    <!-- Main Content Area -->
                    <div class="w-3/4" id="admin-content">
                        <!-- Default content or loading spinner -->
                        <div>Loading...</div>
                    </div>
                </div>
            </div>
        @else
            <p style="color: #E53E3E; font-size: 1.1rem;">Role not recognized.</p>
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
                        contentDiv.innerHTML = '<p>Error loading content.</p>';
                    });
            }
        });
    </script>
</x-app-layout>