<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Model;

class UserType extends Model
{
    use CrudTrait;


    const STUDENT = 1;

    protected $guarded = [];

    public function user()
    {
        return $this->hasMany(User::class);
    }
}
