<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>
    <h1>Dashboard</h1>

<p>Welcome, {{ $user->name }}</p>

@if ($user->role === 'admin')
    <h2>Admin Panel</h2>
    <ul>
        <li><a href="#">Manage Users</a></li>
        <li><a href="#">View Reports</a></li>
        <li><a href="#">Admin Settings</a></li>
    </ul>
@elseif ($user->role === 'employee')
    <h2>Employee Panel</h2>
    <ul>
        <li><a href="#">My Tasks</a></li>
        <li><a href="#">Submit Report</a></li>
        <li><a href="#">View Schedule</a></li>
    </ul>
@elseif ($user->role === 'client')
    <h2>Client Panel</h2>
    <ul>
        <li><a href="#">View Services</a></li>
        <li><a href="#">Submit Feedback</a></li>
        <li><a href="#">Contact Support</a></li>
    </ul>
@else
    <p>Role not recognized.</p>
@endif



</x-app-layout>
