<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Mirror\Facades\Mirror;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $sort = $request->get('sort', 'id');
        $direction = $request->get('direction', 'asc');
        $search = $request->get('search', '');
        $size = $request->get('size', 10);

        if (Gate::denies('view', User::class)) {
            // not authorised so redirect and display message
            return redirect()->route('home')
                ->with('error', 'You are not authorized to view users.');
        }

        $users = User::search($search)
            ->orderBy($sort, $direction)
            ->paginate($size)
            ->withQueryString();

        return view('users.index', ['users' => $users, 'search' => $search]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('users.edit', ['user' => $user]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, int $id)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $id,
            'role' => 'required',
            'password' => 'nullable|string|min:8',
        ]);

        $user = User::findOrFail($id);
        $user->update($data);

        return redirect()->route('users.index')->with('success', 'User updated successfully.');
    }

    public function start(int $id)
    {
        $user = User::findOrFail($id);

        if (! Auth::user()->canImpersonate()) {
            return redirect()->route('home', 303)
                ->with('error', 'You do not have permission to impersonate another user.');
        }

        if (! $user->canBeImpersonated()) {
            return redirect()->route('home', 303)
                ->with('error', 'You cannot impersonate this user.');
        }

        Mirror::start($user);

        return redirect()->route('home')->with('info', 'You are now impersonating ' . $user->name . '.');
    }

    public function stop()
    {
        Mirror::stop();

        return redirect()->route('home')->with('success', 'Impersonation ended.');
    }
}
