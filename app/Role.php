<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Role extends Model
{
    //
    public function department() : BelongsTo
    {
        return $this->belongsTo(\App\Department::class);
    }
}
