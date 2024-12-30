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
    
        @if (session('error'))
            <div class="bg-red-100 border border-red-400 text-red-700 p-2 mb-4 rounded">
                {{ session('error') }}
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
                            <button class="text-blue-400" onclick="editUser({{ $user }})">Edit</button>
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
    
    <!-- Modal -->
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
                    <label for="role" class="block text-sm font-medium text-gray-300">Role</label>
                    <select name="role" id="role" class="mt-1 block w-full border-gray-600 bg-gray-800 text-white rounded-md" required>
                        <option value="admin">Admin</option>
                        <option value="employee">Employee</option>
                        <option value="client">Client</option>
                    </select>
                </div>
    
                <div class="flex justify-end">
                    <button type="button" class="bg-gray-700 text-gray-300 px-4 py-2 rounded mr-2" onclick="closeModal()">Cancel</button>
                    <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Save User</button>
                </div>
            </form>
        </div>
    </div>
    
    <script>
        function openModal() {
            document.getElementById('userModal').classList.remove('hidden');
            clearForm();
        }
    
        function closeModal() {
            document.getElementById('userModal').classList.add('hidden');
        }
    
        function clearForm() {
            document.getElementById('userForm').reset();
            document.getElementById('user_id').value = '';
            document.getElementById('userModalLabel').innerText = 'Create User';
        }
    
        function editUser(user) {
            document.getElementById('user_id').value = user.id;
            document.getElementById('name').value = user.name;
            document.getElementById('email').value = user.email;
            document.getElementById('role').value = user.role;
            document.getElementById('userModalLabel').innerText = 'Edit User';
            document.getElementById('userForm').action = '/admin/manage-users/' + user.id; // Update form action for editing
            document.getElementById('userForm').method = 'POST'; // Set method to POST for editing
            // Add method spoofing for PATCH
            const input = document.createElement('input');
            input.type = 'hidden';
            input.name = '_method';
            input.value = 'PATCH';
            document.getElementById('userForm').appendChild(input);
            openModal();
        }
    </script>