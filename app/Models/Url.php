<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Attributes\Fillable;

#[Fillable(['original_url', 'short_code'])]

class Url extends Model
{
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
