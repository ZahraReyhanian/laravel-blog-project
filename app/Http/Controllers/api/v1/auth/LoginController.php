<?php

namespace App\Http\Controllers\api\v1\auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
    /**
     * login user
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    /**
     * @OA\Post(
     *      path="/auth/login",
     *      operationId="loginUser",
     *      tags={"Authentication"},
     *      summary="login a user",
     *      description="login a user",
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(ref="#/components/schemas/LoginRequest")
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation"
     *       ),
     *     @OA\Response(
     *          response=401,
     *          description="Unauthorized"
     *       ),
     * )
     */
    public function login(Request $request)
    {
        $validator = $this->validateData($request);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        if (!$token = auth()->attempt($validator->validated())) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        $user = auth()->user();
        $token = $user->createToken('myapptoken')->plainTextToken;

        return $this->responseWithToken($user, $token);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validateData(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|string|min:6',
        ]);
        return $validator;
    }

    /**
     * @param \Illuminate\Contracts\Auth\Authenticatable $user
     * @param $token
     * @return \Illuminate\Http\JsonResponse
     */
    protected function responseWithToken(\Illuminate\Contracts\Auth\Authenticatable $user, $token)
    {
        return response()->json([
            'data' => [
                'message' => 'User successfully logged in',
                'user' => $user,
                'token' => $token
            ],
            'status' => 'success'
        ], 201);
    }
}
