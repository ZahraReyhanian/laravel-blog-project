<?php

namespace App\Models;

use Faker\Provider\File;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @OA\Schema(
 *     title="Post",
 *     description="Post model",
 *     @OA\Xml(
 *         name="Post"
 *     )
 * )
 */
class Post extends Model
{
    /**
     * @OA\Property(
     *     title="ID",
     *     description="ID",
     *     format="int64",
     *     example=1
     * )
     *
     * @var integer
     */
    private $id;

    /**
     * @OA\Property(
     *      title="Title",
     *      description="Title of the new post",
     *      example="A nice post"
     * )
     *
     * @var string
     */
    public $title;

    /**
     * @OA\Property(
     *      title="Description",
     *      description="Description of the new post",
     *      example="This is new post's description"
     * )
     *
     * @var string
     */
    public $description;

    /**
     * @OA\Property(
     *     title="Created at",
     *     description="Created at",
     *     example="2020-01-27 17:50:45",
     *     format="datetime",
     *     type="string"
     * )
     *
     * @var \DateTime
     */
    private $created_at;

    /**
     * @OA\Property(
     *     title="Updated at",
     *     description="Updated at",
     *     example="2020-01-27 17:50:45",
     *     format="datetime",
     *     type="string"
     * )
     *
     * @var \DateTime
     */
    private $updated_at;

    /**
     * @OA\Property(
     *      title="User ID",
     *      description="User's id of the new post",
     *      format="int64",
     *      example=1
     * )
     *
     * @var integer
     */
    public $user_id;

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
     *     title="comments",
     *     description="Post comments"
     * )
     *
     * @var \App\Models\Comment
     */
    private $comments;

    /**
     * @OA\Property(
     *     title="categories",
     *     description="Post categories"
     * )
     *
     * @var \App\Models\Category
     */
    private $categories;

    use HasFactory;
    protected $fillable = [
        'title', 'user_id', 'description', 'image', 'likeCount', 'commentCount'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function comments(){
        return $this->morphMany(Comment::class, 'commentable');
    }

    public function categories(){
        return $this->belongsToMany(Category::class);
    }
}
