<?php

namespace App\Http\Controllers\api\v1\authorization;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class UserPermissionController extends Controller
{
    public function __construct(){
        $this->middleware('can:show-user-permissions')->only(['index']);
        $this->middleware('can:create-user-permission')->only(['store']);
    }

    /**
     * @param User $user
     * @return JsonResponse
     */
    /**
     * @OA\Get(
     *      path="/auth/permissions/{user}",
     *      operationId="getUserPermissions",
     *      tags={"Permissions"},
     *      summary="Get User permissions and roles",
     *      description="Return User permissions and roles",
     *     security={{"bearerAuth":{}}},
     *      @OA\Parameter(
     *          name="user",
     *          description="User id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation"
     *       ),
     *      @OA\Response(
     *          response=400,
     *          description="Bad Request"
     *      ),
     *     @OA\Response(
     *          response=401,
     *          description="Unauthenticated",
     *      ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden"
     *      )
     * )
     */
    public function index(User $user)
    {
        return response()->json([
            'data' => [
                'permissions' => $user->permissions,
                'roles' => $user->roles,
            ],
            'status' => 'success'
        ], 200);
    }

    /**
     * @param Request $request
     * @param User $user
     * @return JsonResponse
     */
    /**
     * @OA\Post(
     *      path="/auth/permissions/{id}",
     *      operationId="updateUserPermissionAndRole",
     *      tags={"Permissions"},
     *      summary="permissions and roles of a user",
     *      description="Update and store permissions and roles of a user",
     *      security={{"bearerAuth":{}}},
     *
     *      @OA\Parameter(
     *          name="id",
     *          description="User id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *
     *      @OA\SecurityScheme(
     *          securityScheme="bearerAuth",
     *          type="http",
     *          scheme="bearer"
     *      ),
     *     @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(ref="#/components/schemas/UserPermissionRequest")
     *      ),
     *      @OA\Response(
     *          response=201,
     *          description="Successful operation"
     *       ),
     *      @OA\Response(
     *          response=400,
     *          description="Bad Request"
     *      ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthenticated",
     *      ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden"
     *      ),
     *      @OA\Response(
     *          response=404,
     *          description="Resource Not Found"
     *      )
     * )
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
        ], 201);
    }

}
