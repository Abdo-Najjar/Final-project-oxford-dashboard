<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Application extends Model
{
    use CrudTrait;

    /*
    |--------------------------------------------------------------------------
    | GLOBAL VARIABLES
    |--------------------------------------------------------------------------
    */

    protected $table = 'applications';
    // protected $primaryKey = 'id';
    // public $timestamps = false;
    protected $guarded = ['id'];
    // protected $fillable = [];
    // protected $hidden = [];
    // protected $dates = [];


    public function getPicturePermissionAttribute($attribute)
    {
        return $attribute ? "1" : "0";
    }

    public function getNationalNumberAttribute($attribute)
    {
        return strval($attribute);
    }

    public function courseType()
    {
        return $this->belongsTo(CourseType::class);
    }

    public function getTimeAttribute($value)
    {
        return Carbon::make($value)->format('H:i');
}
}
