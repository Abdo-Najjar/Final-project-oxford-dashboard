<?php

namespace App\Models;

use App\CourseType;
use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Model;

class MassMedia extends Model
{
    use CrudTrait;

    protected $table = 'mass_media';

    protected $guarded = [];

    public const MEDIA_VEDIO_TYPE = '0';

    public const MEDIA_AUDIO_TYPE = '1';

    public function courseType()
    {
        return $this->belongsTo(CourseType::class);
    }


}
