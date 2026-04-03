<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $perPage = request()->input('per_page', 20);
        $perPage = is_numeric($perPage) ? (int) $perPage : 20;
        $perPage = max(1, min(100, $perPage)); // limit between 1 and 100

        $users = User::orderBy('id', 'desc')->paginate($perPage)->withQueryString();

        return view('users.index', compact('users', 'perPage'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('users.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6|confirmed',
            'is_admin' => 'required|boolean',
        ]);

        $data['password'] = Hash::make($data['password']);

        User::create($data);

    return redirect()->route('users.index')->with("success", __("User created"));
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
    return redirect()->route('users.edit',$user);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
    return view('users.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => "required|email|unique:users,email,{$user->id}",
            'password' => 'nullable|string|min:6|confirmed',
            'is_admin' => 'required|boolean',
        ]);

        if ($request->filled('password')) {
            $data['password'] = Hash::make($data['password']);
        } else {
            unset($data['password']);
        }

        $user->update($data);

    return redirect()->route('users.index')->with("success", __("User updated"));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        // Prevent deleting the seeded root user (centralized in the model)
        if (method_exists($user, 'isRoot') && $user->isRoot()) {
            return redirect()->back()->with("error", __("Cannot delete root user."));
        }

        // If the current user is not root, prevent deleting admin accounts
        $current = auth()->user();
        if (! ($current && method_exists($current, 'isRoot') && $current->isRoot())) {
            if ($user->is_admin) {
                return redirect()->back()->with("error", __("Cannot delete admin user. Only root can delete admin accounts."));
            }
        }

        $user->delete();
    return redirect()->route('users.index')->with("success", __("User deleted"));
    }

    /**
     * Check email availability (AJAX)
     */
    public function checkEmail(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'user_id' => 'nullable|integer',
        ]);

        $email = $request->input('email');
        $userId = $request->input('user_id');

        $exists = User::where('email', $email)
            ->when($userId, function ($q) use ($userId) {
                return $q->where('id', '!=', $userId);
            })
            ->exists();

        return response()->json(['available' => ! $exists]);
    }
}
