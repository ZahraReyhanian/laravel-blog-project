<?php

namespace App\Http\Requests;

use Faker\Provider\File;
use Illuminate\Foundation\Http\FormRequest;
/**
 * @OA\Schema(
 *      title="Post request",
 *      description="Post request body data",
 *      type="object",
 *      required={"name"}
 * )
 */

class PostRequest extends FormRequest
{
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
     * @OA\Property(
     *      title="title",
     *      description="title of the new post",
     *      example="A nice post"
     * )
     *
     * @var string
     */
    public $title;

    /**
     * @OA\Property(
     *      title="image",
     *      description="image of the new post",
     *     example="https://res.cloudinary.com/demo/image/upload/q_60/sample.jpg",
     *      format="binary",
     *      type="string",
     * )
     *
     * @var File
     */
    public $image;

    /**
     * @OA\Property(
     *      title="description",
     *      description="Description of the new post",
     *      example="This is new post's description"
     * )
     *
     * @var string
     */
    public $description;

    /**
     * @OA\Property(
     *      title="user_id",
     *      description="Author's id of the new post",
     *      format="int64",
     *      example=1
     * )
     *
     * @var integer
     */
    public $user_id;

    /**
     * @OA\Property(
     *     title="categories",
     *     description="Post categories",
     *     type="array",
     *     @OA\Items(
     *               type="number",
     *               description="The Category ID",
     *               @OA\Schema(type="number"),
     *              example = 1
     *         ),
     * )
     *
     * @var \App\Models\Category
     */
    private $categories;



    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title' => 'required|string|max:255|min:3',
            'user_id' => 'required|exists:users,id',
            'image' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
            'description' => 'required|min:5',
        ];
    }
}
