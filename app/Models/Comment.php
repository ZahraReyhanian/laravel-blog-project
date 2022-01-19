<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @OA\Schema(
 *     title="Comment",
 *     description="Comment model",
 *     @OA\Xml(
 *         name="Comment"
 *     )
 * )
 */
class Comment extends Model
{
    use HasFactory;
    protected $fillable = ['comment', 'parent_id', 'approved', 'commentable_id', 'commentable_type'];

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


    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function child(){
        return $this->hasMany(Comment::class, 'parent_id', 'id');
    }

    public function commentable(){
        return $this->morphTo();
    }
}
