<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;

class Section extends Model
{
    use CrudTrait;

    /*
    |--------------------------------------------------------------------------
    | GLOBAL VARIABLES
    |--------------------------------------------------------------------------
    */

    protected $table = 'sections';
    // protected $primaryKey = 'id';
    // public $timestamps = false;
    protected $guarded = ['id'];
    // protected $fillable = [];
    // protected $hidden = [];
    // protected $dates = [];
    protected $casts=[
        'start_at' =>'date_time',
        'end_at' =>'date_time',
        ];
    /*
    |--------------------------------------------------------------------------
    | FUNCTIONS
    |--------------------------------------------------------------------------
    */

    /*
    |--------------------------------------------------------------------------
    | RELATIONS
    |--------------------------------------------------------------------------
    */

    /*
    |--------------------------------------------------------------------------
    | SCOPES
    |--------------------------------------------------------------------------
    */

    /*
    |--------------------------------------------------------------------------
    | ACCESSORS
    |--------------------------------------------------------------------------
    */

    /*
    |--------------------------------------------------------------------------
    | MUTATORS
    |--------------------------------------------------------------------------
    */
    public static function getTeachers($section_id)
    {
        $teachers = User::where('usertype_id', User::TEACHER_TYPE)->pluck('first_name', 'id')->toArray();
//        if ($section_id) {
//            $section = Section::find($section_id);
//            $currentTeacher = User::find( $section->user_id);
//            $teachers = Arr::add($teachers, $currentTeacher->id, $currentTeacher->name);
//        }
        return $teachers;
    }

    protected static function boot()
    {
        parent::boot();

        static::created(function ($section) {
            $section->name = Carbon::now()->year . $section->courseType->name . 'S' . $section->id . 'C' . $section->courseType->id;

            $section->save();
        });
    }

    /**
     * elequant relation with course
     */
    public function courseType()
    {
        return $this->belongsTo(CourseType::class);
    }

    /**
     *elequant relation with user
     */
    public function teacher()
    {
        return $this->belongsTo(User::class);
    }

    public function students()
    {
        return $this->belongsToMany(User::class)->withPivot(['book_fees', 'course_fees'])->withTimestamps();
    }

    /**
     * assign student to class or section
     *
     * @param User $user
     *
     * @return void
     */
    public function assignStudent(User $user)
    {
        if ($user->usertype_id != User::STUDENT_TYPE) {
            throw  new Exception('Only students can be assign to section!');
        }

        $this->students()->syncWithoutDetaching($user->id);
    }

    /**
     * fire student from class (Section)
     *
     * @param User $user
     *
     * @return void
     */
    public function fireStudent(User $user)
    {
        if ($user->usertype_id != User::STUDENT_TYPE) {
            throw new Exception('Only students can be fire to section!');
        }

        $this->students()->detach($user->id);
    }
}
