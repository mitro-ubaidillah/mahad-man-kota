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

        return view('admin.users.index', compact('users', 'perPage'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.users.create');
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
            'is_admin' => 'sometimes|boolean',
        ]);

        $data['password'] = Hash::make($data['password']);
        $data['is_admin'] = $request->has('is_admin') ? (bool)$request->is_admin : false;

        User::create($data);

        return redirect()->route('admin.users.index')->with('success','User created');
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        return redirect()->route('admin.users.edit',$user);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        return view('admin.users.edit', compact('user'));
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
            'is_admin' => 'sometimes|boolean',
        ]);

        if ($request->filled('password')) {
            $data['password'] = Hash::make($data['password']);
        } else {
            unset($data['password']);
        }

        $data['is_admin'] = $request->has('is_admin') ? (bool)$request->is_admin : false;

        $user->update($data);

        return redirect()->route('admin.users.index')->with('success','User updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        if ($user->email === 'root@root.com') {
            return redirect()->back()->with('error','Cannot delete root user.');
        }

        $user->delete();
        return redirect()->route('admin.users.index')->with('success','User deleted');
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
