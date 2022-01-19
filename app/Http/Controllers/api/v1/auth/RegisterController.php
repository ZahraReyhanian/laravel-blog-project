<?php

namespace App\Http\Controllers\api\v1\auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    /**
     * register a user
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    /**
     * @OA\Post(
     *      path="/auth/register",
     *      operationId="registerUser",
     *      tags={"Authentication"},
     *      summary="register a user",
     *      description="register a user",
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(ref="#/components/schemas/RegisterRequest")
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation"
     *       ),
     *     @OA\Response(
     *          response=400,
     *          description="Bad Request"
     *       ),
     * )
     */
    public function register(Request $request)
    {
        $validator = $this->validateData($request);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $user = $this->createUser($request);

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
            'name' => 'required|string|min:2|max:100',
            'email' => 'required|string|email|max:100|unique:users',
            'password' => 'required|string|confirmed|min:6',
        ]);
        return $validator;
    }

    /**
     * @param Request $request
     * @return mixed
     */
    protected function createUser(Request $request)
    {
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);
        return $user;
    }

    /**
     * @param $user
     * @param $token
     * @return \Illuminate\Http\JsonResponse
     */
    protected function responseWithToken($user, $token)
    {
        return response()->json([
            'data' => [
                'message' => 'User successfully registered',
                'user' => $user,
                'token' => $token
            ],
            'status' => 'success'
        ], 201);
    }
}
