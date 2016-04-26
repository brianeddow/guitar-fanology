<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Edits extends Model
{
    public function like()
    {
        return $this->hasMany(NoteLikes::class);
    }
}
