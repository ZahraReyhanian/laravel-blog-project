<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @OA\Schema(
 *     title="Role",
 *     description="Role model",
 *     @OA\Xml(
 *         name="Role"
 *     )
 * )
 */
class Role extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'label'];

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
     *      title="Name",
     *      description="Name of the new role",
     *      example="manage-post"
     * )
     *
     * @var string
     */
    public $name;

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
     *      title="Label",
     *      description="short description of name",
     *      format="int64",
     *      example="مدیریت پست ها"
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

    public function permissions()
    {
        return $this->belongsToMany(Permission::class);
    }
    public function users()
    {
        return $this->belongsToMany(User::class);
    }
}
