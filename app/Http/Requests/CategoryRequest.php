<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * @OA\Schema(
 *      title="Category request",
 *      description="Category request body data",
 *      type="object",
 *      required={"name"}
 * )
 */
class CategoryRequest extends FormRequest
{
    /**
     * @OA\Property(
     *      title="Name",
     *      description="Name of the new category",
     *      example="Tree"
     * )
     *
     * @var string
     */
    public $name;

    /**
     * @OA\Property(
     *      title="Parent",
     *      description="Parent of the category",
     *      example="0"
     * )
     *
     * @var string
     */
    public $parent;
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
