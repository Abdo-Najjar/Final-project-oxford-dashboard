<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class UserInfo extends Model
{
    use CrudTrait;

    /*
    |--------------------------------------------------------------------------
    | GLOBAL VARIABLES
    |--------------------------------------------------------------------------
    */

    protected $table = 'user_infos';
    // protected $primaryKey = 'id';
    // public $timestamps = false;
    protected $guarded = ['id'];
    // protected $fillable = [];
    // protected $hidden = [];
    // protected $dates = [];


    protected $fillable = [
        'course_type_id','days','time','major_of_study','how_knew_oxford','notes','permission_advertisment','national_number'
    ];


    public function user()
    {
        return $this->belongsTo(User::class);
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
