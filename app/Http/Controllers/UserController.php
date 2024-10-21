<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Registered;

class UserController extends Controller
{
    public function index()
    {
        $this->authorize("seeUsers", User::class);
        return view("users.index", ['users' => User::all()]);
    }

    public function create()
    {
        $this->authorize("create", User::class);
        return view('users.create');
    }

    public function store(Request $request)
    {
        $this->authorize("create", User::class);

        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'is_admin' => $request->has('is_admin') ? 1 : 0,
        ]);

        event(new Registered($user));
    }

    public function destroy(User $user)
    {
        $this->authorize('delete', $user);
        $user->delete();
        return redirect()->route('users.index');
    }

    public function deleted()
    {
        $this->authorize('seeDeleted', User::class);
        return view("users.deleted", ['users' => User::onlyTrashed()->get()]);
    }

    public function deletePermanently(User $user)
    {
        $this->authorize('forceDelete', $user);
        if (!$user->trashed()) {
            return redirect()->route('users.deleted')->with('error', 'Soft delete the user first.');
        }
        try {
            $user->forceDelete();
            return redirect()->route('users.deleted');
        } catch (QueryException $e) {
            return redirect()->route('users.deleted')->with('error', 'Cannot delete user due to related records.');
        }
    }

    public function restore(User $user)
    {
        $this->authorize('restore', $user);
        $user->restore();
        return redirect()->route('users.deleted');
    }
}