<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * @OA\Schema(
 *      title="Comment request",
 *      description="Comment request body data",
 *      type="object",
 *      required={"name"}
 * )
 */
class CommentRequest extends FormRequest
{
    /**
     * @OA\Property(
     *      title="Comment",
     *      description="Text of a comment",
     *      example="Awesome!"
     * )
     *
     * @var string
     */
    public $comment;
    /**
     * @OA\Property(
     *      title="Comment ID",
     *      description="Comment Parent ID and it's default is 0",
     *      format="int64",
     *      example=0
     * )
     *
     * @var integer
     */
    public $parent_id;

    /**
     * @OA\Property(
     *      title="Commentable ID",
     *      description="Id of model that user comment on",
     *      format="int64",
     *      example=1
     * )
     *
     * @var integer
     */
    public $commentable_id;

    /**
     * @OA\Property(
     *      title="Commentable Type",
     *      description="Type of model that user comment on",
     *      format="int64",
     *      example="App\Models\Post"
     * )
     *
     * @var integer
     */
    public $commentable_type;
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
