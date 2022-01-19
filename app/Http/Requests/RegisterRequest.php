<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * @OA\Schema(
 *      title="Register request",
 *      description="Register request body data",
 *      type="object",
 *      required={"name"}
 * )
 */
class RegisterRequest extends FormRequest
{
    /**
     * @OA\Property(
     *      title="name",
     *      description="name of an user",
     *      example="zahra"
     * )
     *
     * @var string
     */
    public $name;

    /**
     * @OA\Property(
     *      title="email",
     *      description="email of an user",
     *      example="zahra@gmail.com"
     * )
     *
     * @var string
     */
    public $email;

    /**
     * @OA\Property(
     *      title="password",
     *      description="password of user",
     *      example="12345678"
     * )
     *
     * @var string
     */
    public $password;

    /**
     * @OA\Property(
     *      title="password_confirmation",
     *      description="confirmation of password",
     *      example="12345678"
     * )
     *
     * @var string
     */
    public $password_confirmation;

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            //
        ];
    }
}
