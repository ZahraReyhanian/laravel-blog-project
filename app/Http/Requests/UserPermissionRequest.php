<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * @OA\Schema(
 *      title="UserPermission request",
 *      description="UserPermission request body data",
 *      type="object",
 *      required={"name"}
 * )
 */
class UserPermissionRequest extends FormRequest
{
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
     * @OA\Property(
     *      title="roles",
     *      description="list of roles",
     *      type="array",
     *      @OA\Items(
     *               type="number",
     *               description="The Role ID",
     *               @OA\Schema(type="number"),
     *              example = 1
     *         ),
     * )
     *
     * @var array
     */
    public $roles;
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
