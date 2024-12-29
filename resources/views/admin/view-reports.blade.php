<!-- resources/views/admin/view-reports.blade.php -->
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('View Reports') }}
        </h2>
    </x-slot>

    <div style="background-color: #f9fafb; padding: 20px; border-radius: 8px;">
        <h3 style="font-size: 1.5rem; color: #F6AD55;">Reports</h3>

        <!-- Example of displaying reports -->
        <p style="font-size: 1.2rem; color: #555;">Here are the reports generated:</p>

        <!-- Add report listings here -->
        <ul>
            <li>
                <a href="#" class="text-blue-500">Report 1</a> - Generated on 01/01/2024
            </li>
            <li>
                <a href="#" class="text-blue-500">Report 2</a> - Generated on 02/01/2024
            </li>
        </ul>
    </div>
</x-app-layout>
