<?php

namespace App\Http\Controllers\api\v1\authorization;

use App\Http\Controllers\Controller;
use App\Models\Role;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index()
    {
        $roles = Role::query()->orderByDesc('id')->paginate(20);

        return response()->json([
            'data' => $roles,
            'status' => 'success'
        ], 200);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return JsonResponse
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255', 'unique:roles'],
            'label' => ['required', 'string', 'max:255'],
            'permissions' => ['required', 'array']
        ]);

        $role = Role::query()->create($data);

        $role->permissions()->sync($data['permissions']);

        return response()->json([
            'data' => $role,
            'status' => 'success'
        ], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param Role $role
     * @return JsonResponse
     */
    public function show(Role $role)
    {
        return response()->json([
            'data' => $role,
            'status' => 'success'
        ], 200);
    }


    /**
     * @param Request $request
     * @param Role $role
     * @return JsonResponse
     */
    public function update(Request $request, Role $role)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255', Rule::unique('roles')->ignore($role->id)],
            'label' => ['required', 'string', 'max:255'],
            'permissions' => ['required', 'array']
        ]);

        $role->update($data);
        $role->permissions()->sync($data['permissions']);

        return response()->json([
            'data' => $role,
            'status' => 'success'
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Role $role
     * @return JsonResponse
     */
    public function destroy(Role $role)
    {
        $role->delete();

        return response()->json([
            'data' => [],
            'status' => 'success'
        ], 200);
    }
}
