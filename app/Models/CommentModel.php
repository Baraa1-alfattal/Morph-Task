<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class CommentModel extends Model
{
    protected $guarded=['id'];

    public function commentable():MorphTo
    {
        return $this->morphTo();
    }
}
