<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * @OA\Schema(
 *      title="Permission request",
 *      description="Permission request body data",
 *      type="object",
 *      required={"name"}
 * )
 */
class PermissionRequest extends FormRequest
{

    /**
     * @OA\Property(
     *      title="Name",
     *      description="Name of the new permission",
     *      example="edit-post"
     * )
     *
     * @var string
     */
    public $name;

    /**
     * @OA\Property(
     *      title="Label",
     *      description="short description of name",
     *      format="int64",
     *      example="ویرایش پست"
     * )
     *
     * @var string
     */
    public $label;
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
