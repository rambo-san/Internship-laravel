<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight" style="font-size: 2rem; color: #4A5568; padding: 10px;">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div style="background-color: #f9fafb; padding: 20px; border-radius: 8px;">
        
        
        <p style="font-size: 1.2rem; color: #555;">Welcome, <strong>{{ $user->name }}</strong></p>

        @if ($user->role === 'admin')
            <h2 style="font-size: 2rem; color: #4A90E2;">Admin Panel</h2>
            <ul style="list-style-type: none; padding-left: 0;">
                <li style="margin: 10px 0;"><a href="#" style="color: #2D3748; font-size: 1.1rem; text-decoration: none;">Manage Users</a></li>
                <li style="margin: 10px 0;"><a href="#" style="color: #2D3748; font-size: 1.1rem; text-decoration: none;">View Reports</a></li>
                <li style="margin: 10px 0;"><a href="#" style="color: #2D3748; font-size: 1.1rem; text-decoration: none;">Admin Settings</a></li>
            </ul>
        @elseif ($user->role === 'employee')
            <h2 style="font-size: 2rem; color: #38B2AC;">Employee Panel</h2>
            <ul style="list-style-type: none; padding-left: 0;">
                <li style="margin: 10px 0;"><a href="#" style="color: #2D3748; font-size: 1.1rem; text-decoration: none;">My Tasks</a></li>
                <li style="margin: 10px 0;"><a href="#" style="color: #2D3748; font-size: 1.1rem; text-decoration: none;">Submit Report</a></li>
                <li style="margin: 10px 0;"><a href="#" style="color: #2D3748; font-size: 1.1rem; text-decoration: none;">View Schedule</a></li>
            </ul>
        @elseif ($user->role === 'client')
            <h2 style="font-size: 2rem; color: #F6AD55;">Client Panel</h2>
            <ul style="list-style-type: none; padding-left: 0;">
                <li style="margin: 10px 0;"><a href="#" style="color: #2D3748; font-size: 1.1rem; text-decoration: none;">View Services</a></li>
                <li style="margin: 10px 0;"><a href="#" style="color: #2D3748; font-size: 1.1rem; text-decoration: none;">Submit Feedback</a></li>
                <li style="margin: 10px 0;"><a href="#" style="color: #2D3748; font-size: 1.1rem; text-decoration: none;">Contact Support</a></li>
            </ul>
        @else
            <p style="color: #E53E3E; font-size: 1.1rem;">Role not recognized.</p>
        @endif
    </div>
</x-app-layout>
