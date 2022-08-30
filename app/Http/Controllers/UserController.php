<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Spatie\Permission\Models\Role;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;

class UserController extends Controller
{
    /**
     * Display all users
     *
     * @return View
     */
    public function index()
    {
        $users = User::latest()->paginate(10);

        return view('dashboard.general.user.index', compact('users'));
    }

    /**
     * Show form for creating user
     *
     * @return View
     */
    public function create()
    {
        return view('dashboard.general.user.create');
    }

    /**
     * Store a newly created user
     *
     * @param User $user
     * @param StoreUserRequest $request
     *
     * @return RedirectResponse
     */
    public function store(User $user, StoreUserRequest $request)
    {
        //For demo purposes only. When creating user or inviting a user
        // you should create a generated random password and email it to the user
        $user->create(array_merge($request->validated(), [
            'password' => 'test'
        ]));

        return redirect()->route('users.index')
            ->with('success', __('User created successfully.'));
    }

    /**
     * Show user data
     *
     * @param User $user
     *
     * @return View
     */
    public function show(User $user)
    {
        return view('dashboard.general.user.show', [
            'user' => $user
        ]);
    }

    /**
     * Edit user data
     *
     * @param User $user
     *
     * @return View
     */
    public function edit(User $user)
    {
        return view('dashboard.general.user.edit', [
            'user' => $user,
            'userRole' => $user->roles->pluck('name')->toArray(),
            'roles' => Role::latest()->get()
        ]);
    }

    /**
     * Update user data
     *
     * @param User $user
     * @param UpdateUserRequest $request
     *
     * @return RedirectResponse
     */
    public function update(User $user, UpdateUserRequest $request)
    {
        $user->update($request->validated());

        $user->syncRoles($request->get('role'));

        return redirect()->route('users.index')
            ->with('success', __('User updated successfully.'));
    }

    /**
     * Delete user data
     *
     * @param User $user
     *
     * @return RedirectResponse
     */
    public function destroy(User $user)
    {
        $user->delete();

        return redirect()->route('users.index')
            ->with('success', __('User deleted successfully.'));
    }
}
