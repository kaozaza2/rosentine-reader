<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\PermissionLevel;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    public function index(Request $request): View
    {
        $users = User::query();

        if ($search = $request->query('search')) {
            $users->where('name', 'like', "%{$search}%")
                ->orWhere('email', 'like', "%{$search}%");
        }

        return view(
            view: 'admin.users',
            data: ['users' => $users->paginate(10)],
        );
    }

    public function update(Request $request, User $user): RedirectResponse
    {
        Gate::authorize('manage-user');

        $request->validate('userPromotion', [
            'level' => ['required', Rule::enum(PermissionLevel::class)],
        ]);

        $user->permission->fill([
            'level' => $request->input('level'),
        ])->save();

        return redirect()->back()->with(
            'success', __('admin.user-updated'),
        );
    }

    public function destroy(Request $request, User $user): RedirectResponse
    {
        Gate::authorize('manage-user');

        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        if ($self = $request->user()->is($user)) {
            Auth::logout();

            $request->session()->invalidate();
            $request->session()->regenerateToken();
        }

        $user->delete();

        return $self ? redirect('/') : redirect()->back()->with(
            'success', __('admin.user-deleted'),
        );
    }
}
