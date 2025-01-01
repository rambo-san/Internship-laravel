<!-- resources/views/admin/manage-users.blade.php -->
<x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
        {{ __('Manage Users') }}
    </h2>
</x-slot>

<div class="bg-gray-800 p-6 rounded-lg shadow-md">
    <h3 class="text-xl text-white mb-4">Manage Users</h3>

    @if (session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 p-2 mb-4 rounded">
            {{ session('success') }}
        </div>
    @endif

    <button class="bg-blue-600 text-white rounded px-4 py-2 mb-4" onclick="openModal()">Create New User</button>

    <table class="min-w-full border-collapse border border-gray-600">
        <thead>
            <tr>
                <th class="border border-gray-600 p-2 text-left text-gray-300">Name</th>
                <th class="border border-gray-600 p-2 text-left text-gray-300">Email</th>
                <th class="border border-gray-600 p-2 text-left text-gray-300">Role</th>
                <th class="border border-gray-600 p-2 text-left text-gray-300">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
                <tr class="hover:bg-gray-700">
                    <td class="border border-gray-600 p-2 text-gray-200">{{ $user->name }}</td>
                    <td class="border border-gray-600 p-2 text-gray-200">{{ $user->email }}</td>
                    <td class="border border-gray-600 p-2 text-gray-200">{{ $user->role }}</td>
                    <td class="border border-gray-600 p-2">
                        <button class="text-blue-400" onclick="editUser({{ json_encode($user) }})">Edit</button>
                        <form action="{{ route('admin.users.destroy', $user) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-400">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {{ $users->links() }} <!-- For pagination -->
</div>

<!-- Modal for Create/Edit User -->
<div id="userModal" class="fixed inset-0 z-50 hidden justify-center items-center bg-black bg-opacity-70">
    <div class="bg-gray-900 rounded-lg p-6 w-1/3">
        <h5 class="text-xl text-white mb-4" id="userModalLabel">Create User</h5>
        <form id="userForm" action="{{ route('admin.users.store') }}" method="POST">
            @csrf
            <input type="hidden" name="user_id" id="user_id">
            <div class="mb-4">
                <label for="name" class="block text-sm font-medium text-gray-300">Name</label>
                <input type="text" name="name" id="name" class="mt-1 block w-full border-gray-600 bg-gray-800 text-white rounded-md" required>
            </div>

            <div class="mb-4">
                <label for="email" class="block text-sm font-medium text-gray-300">Email</label>
                <input type="email" name="email" id="email" class="mt-1 block w-full border-gray-600 bg-gray-800 text-white rounded-md" required>
            </div>

            <div class="mb-4">
                <label for="password" class="block text-sm font-medium text-gray-300">Password (Leave blank to keep current)</label>
                <input type="password" name="password" id="password" class="mt-1 block w-full border-gray-600 bg-gray-800 text-white rounded-md">
            </div>

            <div class="mb-4">
                <label for="password_confirmation" class="block text-sm font-medium text-gray-300">Confirm Password</label>
                <input type="password" name="password_confirmation" id="password_confirmation" class="mt-1 block w-full border-gray-600 bg-gray-800 text-white rounded-md">
            </div>

            <div class="mb-4">
                <label for="role" class="block text-sm font-medium text-gray-300">Role</label>
                <select name="role" id="role" class="mt-1 block w-full border-gray-600 bg-gray-800 text-white rounded-md" required>
                    <option value="admin">Admin</option>
                    <option value="employee">Employee</option>
                    <option value="client">Client</option>
                </select>
            </div>

            <div class="flex justify-end">
                <button type="button" class="bg-gray-700 text-gray-300 px-4 py-2 rounded mr-2" onclick="closeModal()">Cancel</button>
                <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Save Changes</button>
            </div>
        </form>
    </div>
</div>
<script>
    window.editUser = function(user) {
    // Populate the modal fields with the selected user's data
    document.getElementById('user_id').value = user.id; // Set the hidden user ID
    document.getElementById('name').value = user.name; // Set the name
    document.getElementById('email').value = user.email; // Set the email
    document.getElementById('role').value = user.role; // Set the role
    document.getElementById('userModalLabel').innerText = 'Edit User'; // Update modal title

    // Update the form action to point to the update route
    document.getElementById('userForm').action = `/admin/manage-users/${user.id}`; // Set form action for editing
    document.getElementById('userForm').method = 'POST'; // Ensure method is POST

    // Add method spoofing for PATCH
    let input = document.querySelector('input[name="_method"]');
    if (!input) {
        input = document.createElement('input');
        input.type = 'hidden';
        input.name = '_method';
        input.value = 'PATCH';
        document.getElementById('userForm').appendChild(input);
    }

    openModal(); // Open the modal
};
</script>