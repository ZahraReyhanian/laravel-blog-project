<?php

namespace App\Http\Controllers\api\v1\authorization;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class UserPermissionController extends Controller
{

    /**
     * @param Request $request
     * @param User $user
     * @return JsonResponse
     */
    public function store(Request $request, User $user){
        $user->roles()->sync($request->roles);
        $user->permissions()->sync($request->permissions);

        return response()->json([
            'data' => [
                'permissions' => $user->permissions,
                'roles' => $user->roles,
            ],
            'status' => 'success'
        ], 200);
    }

}
