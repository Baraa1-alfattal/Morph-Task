<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class PostModel extends Model
{
    protected $guarded=['id'];

    public function comment():MorphMany
    {
        return $this->morphMany(CommentModel::class,'commentable');
    }

}
