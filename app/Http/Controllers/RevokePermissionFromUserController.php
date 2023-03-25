<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Spatie\Permission\Models\Permission;

class RevokePermissionFromUserController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(User $user, Permission $permission): RedirectResponse
    {
        $user->revokePermissionTo($permission);
        return back();
    }
}
