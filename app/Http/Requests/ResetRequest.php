<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * @OA\Schema(
 *      title="Reset request",
 *      description="Reset request body data",
 *      type="object",
 *      required={"name"}
 * )
 */
class ResetRequest extends FormRequest
{
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
     * @OA\Property(
     *      title="token",
     *      description="token that is send to email and it has limited life time",
     *      example="7a246c3fdd83f204af6f80544bfeebc614aed8cfaf81e31221c33775ce05c26f"
     * )
     *
     * @var string
     */
    public $token;

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
