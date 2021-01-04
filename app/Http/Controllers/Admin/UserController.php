<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\User\UserUpdate;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Validator;
use Inertia\Inertia;

class UserController extends AdminBaseController
{
    /**
     * Display a listing of the users.
     *
     * @return \Inertia\Response
     */
    public function index()
    {
        $dateTime = Carbon::now();

        $search = Request::get('search');

        $filters = Request::all('trashed', 'verified_email');

        $filters['trashed'] = ($filters['trashed'] != "") ? $filters['trashed'] : ""; // Sets select box to empty string if no value is selected.
        $filters['verified_email'] = ($filters['verified_email'] != "") ? $filters['verified_email'] : ""; // Sets select box to empty string if no value is selected.

        return Inertia::render('User/Admin/Index', [
            'filters' => $filters,
            'search' => $search,
            'stats' => [
                'newUsersMonthly' => [
                    'month' => $dateTime->firstOfMonth()->format('F'),
                    'amount' => User::where('created_at', '>', $dateTime->firstOfMonth())->count(),
                ],
            ],
            'users' => User::orderByDesc('id')
                ->filter($filters)
                ->search($search)
                ->paginate()
                ->through(function ($user) {
                    return [
                        'id' => $user->id,
                        'username' => $user->username,
                        'email' => $user->email,
                        'email_verified_at' => ($user->email_verified_at) ? "verified {$user->email_verified_at->diffForHumans()}" : 'not verified',
                        'isAdmin' => $user->isAdmin(),
                    ];
                }),
        ]);
    }

    /**
     * Show the form for editing the authenticated user.
     *
     * @param $user_username
     * @return \Inertia\Response
     */
    public function show($user_username): \Inertia\Response
    {
        $user = User::where('username', $user_username)->withTrashed()->firstOrFail();

        return Inertia::render('User/Admin/Show', [
            'user' => [
                'id' => $user->id,
                'username' => $user->username,
                'admin' => $user->isAdmin(),
                'email' => $user->email,
                'email_verified_at' => ($user->email_verified_at) ? "verified {$user->email_verified_at->toDateTimeString()}" : 'not verified',
                'created_at' => ($user->created_at) ? "{$user->created_at->toDateTimeString()}" : null,
                'updated_at' => ($user->updated_at) ? "{$user->updated_at->toDateTimeString()}" : null,
                'deleted_at' => ($user->deleted_at) ? "{$user->deleted_at->toDateTimeString()}" : null,
            ],
        ]);
    }

    /**
     * Delete the user in storage.
     *
     * @param $user_username
     * @return RedirectResponse
     */
    public function delete($user_username)
    {
        $user = User::where('username', $user_username)->firstOrFail();

        if ($user->id === Auth::user()->id) {
            return redirect()->back()->with('error', 'Cannot delete your own account');
        }

        $user->delete();

        return redirect()->route('admin.user.show', $user->username)->with('warning', 'User was successfully deleted!');
    }

    /**
     * Delete the user in storage.
     *
     * @param $user_username
     * @return RedirectResponse
     */
    public function restore($user_username)
    {
        $user = User::where('username', $user_username)->withTrashed()->firstOrFail();

        $user->restore();

        return redirect()->route('admin.user.show', $user->username)->with('success', 'User was successfully restored!');
    }
}
