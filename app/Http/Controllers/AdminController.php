<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules\Password;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class AdminController extends Controller
{
    public function index(): View
    {
        $stats = [
            'total_users' => User::count(),
            'total_employees' => User::where('role', 'employee')->count(),
            'total_clients' => User::where('role', 'client')->count()
        ];
        
        return view('admin.dashboard', compact('stats'));
    }

    public function manageUsers(): View
    {
        $users = User::latest()->paginate(10);
        return view('admin.manage-users', compact('users'));
    }

    public function create(): View
    {
        return view('admin.users.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed', Password::defaults()],
            'role' => ['required', 'in:admin,employee,client']
        ]);

        User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'role' => $validated['role']
        ]);

        return to_route('admin.users')->with('success', 'User created successfully');
    }

    public function edit(User $user): View
    {
        return view('admin.users.edit', compact('user'));
    }

    public function update(Request $request, User $user): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,' . $user->id],
            'role' => ['required', 'in:admin,employee,client']
        ]);

        $user->update($validated);

        return to_route('admin.users')->with('success', 'User updated successfully');
    }

    public function destroy(User $user): RedirectResponse
    {
        if (!Auth::hasUser()) {
            return to_route('login');
        }

        if ($user->id === Auth::id()) {
            return back()->with('error', 'You cannot delete your own account.');
        }

        $user->delete();
        return back()->with('success', 'User deleted successfully');
    }

    public function viewReports(): View
    {
        $userStats = [
            'total_users' => User::count(),
            'users_by_role' => [
                'admin' => User::where('role', 'admin')->count(),
                'employee' => User::where('role', 'employee')->count(),
                'client' => User::where('role', 'client')->count(),
            ],
            'recent_users' => User::latest()->take(5)->get()
        ];

        return view('admin.reports', compact('userStats'));
    }

    public function settings(): View
    {
        return view('admin.settings');
    }

    public function updateSettings(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'site_name' => ['required', 'string', 'max:255'],
            'email_notifications' => ['boolean'],
            'maintenance_mode' => ['boolean']
        ]);

        // Update settings logic
        // You can store settings in database or use Laravel's config system

        return back()->with('success', 'Settings updated successfully');
    }

    public function profile(): View|RedirectResponse
    {
        if (!Auth::hasUser()) {
            return to_route('login');
        }
        
        return view('admin.profile', ['user' => Auth::user()]);
    }

    public function updateProfile(Request $request): RedirectResponse
    {
        if (!Auth::hasUser()) {
            return to_route('login');
        }

        $user = Auth::user();

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,' . $user->id],
            'current_password' => ['required_with:new_password', 'current_password'],
            'new_password' => ['nullable', 'confirmed', Password::defaults()]
        ]);

        $user->update([
            'name' => $validated['name'],
            'email' => $validated['email']
        ]);

        if ($request->filled('new_password')) {
            $user->password = Hash::make($validated['new_password']);
        }

        $user->save();

        return back()->with('success', 'Profile updated successfully');
    }
}