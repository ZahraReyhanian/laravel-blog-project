<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * @OA\Schema(
 *      title="SendEmail request",
 *      description="SendEmail request body data",
 *      type="object",
 *      required={"name"}
 * )
 */
class SendEmailRequest extends FormRequest
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
