<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * @OA\Schema(
 *      title="Role request",
 *      description="Role request body data",
 *      type="object",
 *      required={"name"}
 * )
 */
class RoleRequest extends FormRequest
{
    /**
     * @OA\Property(
     *      title="Name",
     *      description="Name of the new role",
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
     * @OA\Property(
     *      title="permissions",
     *      description="list of permissions",
     *      type="array",
     *      @OA\Items(
     *               type="number",
     *               description="The Permission ID",
     *               @OA\Schema(type="number"),
     *              example = 1
     *         ),
     * )
     *
     * @var array
     */
    public $permissions;

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
